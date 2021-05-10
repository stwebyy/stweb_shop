<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use  Illuminate\Database\QueryException;

class OrderCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:order {count=1000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new Orderts and new Order_items';

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
     * OrderとOrder_Itemのデータを作成
     *
     * @return mixed
     */
    public function handle()
    {
        $count = (int)$this->argument('count');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Order::truncate();
        DB::table('order_items')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $loop = (int)floor($count / 1000);
        $remainder = $count % 1000;
        $this->info("Start creating order.");
        $bar = $this->output->createProgressBar($loop + 1);

        $user_count = User::count();
        for ($i = 0; $i < $loop; $i++) {
            $orders = $this->orderTimes(1000, $user_count);
            DB::table('orders')->insert($orders);
            $bar->advance();
            $orders = [];
        }

        DB::table('orders')->insert($this->orderTimes($remainder, $user_count));

        $bar->advance();
        $bar->finish();
        $this->info(PHP_EOL . 'Order create is done.');

        $loop = (int)floor($count * 3 / 1000);
        $remainder = $count % 1000;
        $bar = $this->output->createProgressBar($loop + 1);
        $this->info('Start creating order items.');

        $order_count = Order::count();
        $product_count = Product::count();
        for ($i = 0; $i < $loop; $i++) {
            $orders = $this->orderItemTimes(1000, $order_count, $product_count);
            DB::beginTransaction();
            try {
                DB::table('order_items')->insert($orders);
                DB::commit();
            } catch (QueryException $e) {
                DB::rollBack();
                report($e);
            }
            $bar->advance();
            $orders = [];
        }

        DB::beginTransaction();
        try {
            DB::table('order_items')->insert($this->orderItemTimes($remainder, $order_count, $product_count));
            DB::commit();
        } catch (QueryException $e) {
            DB::rollBack();
            report($e);
        }

        $bar->advance();
        $bar->finish();
        $this->info(PHP_EOL . 'Order Item create is done.');
    }

    protected function orderTimes($count, $user_count)
    {
        $attributes = [];

        for ($i = 0; $i < $count; $i++) {
            $attributes[] = [
                'user_id' => $this->faker->numberBetween(1, $user_count),
                'order_status_id' => 1,
                'order_number' => rand(),
            ];
        }

        return $attributes;
    }

    protected function orderItemTimes($count, $order_count, $product_count)
    {
        $attributes = [];

        for ($i = 0; $i < $count; $i++) {
            $attributes[] = [
                'order_id' => $this->faker->numberBetween(1, $order_count),
                'product_id' => $this->faker->numberBetween(1, $product_count),
                'quantity' => $this->faker->numberBetween(1, 10),
            ];
        }

        return $attributes;
    }
}
