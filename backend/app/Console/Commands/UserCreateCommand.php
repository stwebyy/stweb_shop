<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user {count=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Faker $faker)
    {
        parent::__construct();
        $this->faker = $faker;
    }

    /**
     * Execute the console command.
     * 1000件ずつバルクインサートを実行する
     *
     * @return mixed
     */
    public function handle()
    {
        $count = (int)$this->argument('count');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $loop = (int)floor($count / 1000);
        $remainder = $count % 1000;
        $bar = $this->output->createProgressBar($loop + 1);

        for ($i = 0; $i < $loop; $i++) {
            $users = $this->times(1000);
            DB::table('users')->insert($users);
            $bar->advance();
            $users = [];
        }

        DB::table('users')->insert($this->times($remainder));

        $bar->advance();
        $bar->finish();
        $this->info("User create is done.");
    }

    protected function times($count)
    {
        $faker = $this->faker;
        $attributes = [];
        $password = \Hash::make('test1234');
        $gender = $faker->numberBetween(0,2);

        for ($i = 0; $i < $count; $i++) {
            $attributes[] = [
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'first_name_ruby' => $faker->firstKanaName($gender),
                'last_name_ruby' => $faker->lastKanaName($gender),
                'email' => $faker->email() . (string)$i . $faker->randomLetter() . $faker->randomLetter() . $faker->randomLetter(),
                'email_verified_at' => null,
                'password' => $password,
                'role_id' => 2,
                'postal_code' => $faker->postcode(),
                'gender' => $gender,
                'birthday' => $faker->dateTimeBetween('-80 years', '-20years')->format('Y-m-d'),
                'pref_id' => $faker->numberBetween(1,47),
                'city' => $faker->city(),
                'block' => $faker->streetAddress(),
                'building' => $faker->secondaryAddress(),
                'phone_number' => $faker->phoneNumber(),
            ];
        }

        return $attributes;
    }
}
