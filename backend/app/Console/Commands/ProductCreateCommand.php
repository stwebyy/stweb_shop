<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Models\Product;
use App\Models\Tag;

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
     * Productのレコードを作成
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
        $this->info('Start creating products.');
        $bar = $this->output->createProgressBar($loop + 1);

        for ($i = 0; $i < $loop; $i++) {
            $products = $this->createProduct(1000);
            DB::table('products')->insert($products);
            $bar->advance();
            $products = [];
        }

        DB::table('products')->insert($this->createProduct($remainder));

        $bar->advance();
        $bar->finish();
        $this->info(PHP_EOL . 'Products create is done.');

        $loop = (int)floor($count / 1000);
        $remainder = $count % 1000;
        $this->info('Start creating products tags.');
        $bar = $this->output->createProgressBar($loop + 1);

        $products_count = Product::count();
        $tags_count = Tag::count();

        for ($i = 0; $i < $loop; $i++) {
            $products_tags = $this->createProductTags(1000, $products_count, $tags_count);
            DB::beginTransaction();
            try {
                DB::table('products_has_tags')->insert($products_tags);
                DB::commit();
            } catch (QueryException $e) {
                DB::rollBack();
                report($e);
            }
            $bar->advance();
            $products_tags = [];
        }

        DB::beginTransaction();
        try {
            DB::table('products_has_tags')->insert($this->createProductTags($remainder, $products_count, $tags_count));
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            report($e);
        }

        $bar->advance();
        $bar->finish();
        $this->info(PHP_EOL . 'Products tags create is done.');
    }

    protected function createProduct($count)
    {
        $attributes = [];

        for ($i = 0; $i < $count; $i++) {
            $attributes[] = [
                'name' => $this->faker->sentence(1),
                'price' => $this->faker->numberBetween(1000, 10000),
                'stock' => $this->faker->numberBetween(0, 10000),
                'description' => $this->faker->sentence(),
                'image' => $this->faker->imageUrl(),
                'admin_user_id' => $this->faker->numberBetween(1, 5),
            ];
        }

        return $attributes;
    }

    protected function createProductTags($count, $products_count, $tags_count)
    {
        $attributes = [];

        for ($i = 0; $i < $count; $i++) {
            $attributes[] = [
                'product_id' => $this->faker->numberBetween(1, $products_count),
                'tag_id' => $this->faker->numberBetween(1, $tags_count),
            ];
        }

        return $attributes;
    }
}
