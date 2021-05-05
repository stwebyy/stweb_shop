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
            ['status_id' => 1, 'status' => '決済前'],
            ['status_id' => 2, 'status' => '決済後'],
        ];

        DB::table('order_statuses')->insert($status);
    }
}
