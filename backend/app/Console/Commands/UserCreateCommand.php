<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserCreateCommand extends Command
{
    private const ADMIN_ROLE_ID = 1;
    private const GENERAL_ROLE_ID = 2;

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
     * Userのレコードを作成
     *
     * @return mixed
     */
    public function handle()
    {
        $count = (int)$this->argument('count');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Start creating users.');
        $password = \Hash::make('test1234');
        $this->info('Start creating admin users.');
        DB::table('users')->insert($this->createAdminUser($password));
        $this->info('admin users create is done.');

        $loop = (int)floor($count / 750);
        $remainder = $count % 750;
        $this->info('Start creating general users.');
        $bar = $this->output->createProgressBar($loop + 1);

        for ($i = 0; $i < $loop; $i++) {
            $users = $this->createGeneralUser(750, $password);
            DB::table('users')->insert($users);
            $bar->advance();
            $users = [];
        }
        DB::table('users')->insert($this->createGeneralUser($remainder, $password));

        $bar->advance();
        $bar->finish();
        $this->info(PHP_EOL . 'users create is done.');
    }

    protected function createAdminUser($password)
    {
        $attributes = [];
        $gender = $this->faker->numberBetween(0, 2);
        $tmp_char = $this->faker->randomLetter() . $this->faker->randomLetter();

        for ($i = 0; $i < 5; $i++) {
            $attributes[] = [
                'first_name' => $this->faker->firstName(),
                'last_name' => $this->faker->lastName(),
                'first_name_ruby' => $this->faker->firstKanaName($gender),
                'last_name_ruby' => $this->faker->lastKanaName($gender),
                'email' => $this->faker->email() . (string)$i . $tmp_char . $this->faker->randomLetter(),
                'email_verified_at' => null,
                'password' => $password,
                'role_id' => self::ADMIN_ROLE_ID,
                'postal_code' => $this->faker->postcode(),
                'gender' => $gender,
                'birthday' => $this->faker->dateTimeBetween('-80 years', '-20years')->format('Y-m-d'),
                'pref_id' => $this->faker->numberBetween(1, 47),
                'city' => $this->faker->city(),
                'block' => $this->faker->streetAddress(),
                'building' => $this->faker->secondaryAddress(),
                'phone_number' => $this->faker->phoneNumber(),
            ];
        }

        return $attributes;
    }

    protected function createGeneralUser($count, $password)
    {
        $attributes = [];
        $gender = $this->faker->numberBetween(0, 2);
        $tmp_char = $this->faker->randomLetter() . $this->faker->randomLetter();

        for ($i = 0; $i < $count; $i++) {
            $attributes[] = [
                'first_name' => $this->faker->firstName(),
                'last_name' => $this->faker->lastName(),
                'first_name_ruby' => $this->faker->firstKanaName($gender),
                'last_name_ruby' => $this->faker->lastKanaName($gender),
                'email' => $this->faker->email() . (string)$i . $tmp_char . $this->faker->randomLetter(),
                'email_verified_at' => null,
                'password' => $password,
                'role_id' => self::GENERAL_ROLE_ID,
                'postal_code' => $this->faker->postcode(),
                'gender' => $gender,
                'birthday' => $this->faker->dateTimeBetween('-80 years', '-20years')->format('Y-m-d'),
                'pref_id' => $this->faker->numberBetween(1, 47),
                'city' => $this->faker->city(),
                'block' => $this->faker->streetAddress(),
                'building' => $this->faker->secondaryAddress(),
                'phone_number' => $this->faker->phoneNumber(),
            ];
        }

        return $attributes;
    }
}
