<?php

use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            ['status' => '決済前'],
            ['status' => '決済後'],
        ];

        DB::table('order_statuses')->insert($status);
    }
}
