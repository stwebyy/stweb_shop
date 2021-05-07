<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:product {count=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Products';

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
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $loop = (int)floor($count / 1000);
        $remainder = $count % 1000;
        $bar = $this->output->createProgressBar($loop + 1);

        for ($i = 0; $i < $loop; $i++) {
            $products = $this->times(1000);
            DB::table('products')->insert($products);
            $bar->advance();
            $products = [];
        }

        DB::table('products')->insert($this->times($remainder));

        $bar->advance();
        $bar->finish();
        $this->info("Products create is done.");
    }

    protected function times($count)
    {
        $faker = $this->faker;
        $attributes = [];

        for ($i = 0; $i < $count; $i++) {
            $attributes[] = [
                'name' => $faker->sentence(1),
                'price' => $faker->numberBetween(1000,10000),
                'stock' => $faker->numberBetween(0,10000),
                'description' => $faker->sentence(),
                'image' => $faker->imageUrl(),
            ];
        }

        return $attributes;
    }
}
