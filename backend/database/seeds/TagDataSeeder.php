<?php

use Illuminate\Database\Seeder;

class TagDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => '家電'],
            ['name' => 'パソコン周辺機器'],
            ['name' => 'ゲーム機'],
            ['name' => 'ゲーム周辺機器'],
            ['name' => 'スマートフォン'],
            ['name' => 'カメラ'],
            ['name' => '掃除機'],
            ['name' => 'ホビー'],
            ['name' => 'キッチン用品'],
            ['name' => 'ドリンク'],
            ['name' => '食品'],
            ['name' => 'ペット'],
            ['name' => '本'],
            ['name' => 'CD'],
            ['name' => 'DVD'],
            ['name' => 'スポーツ'],
            ['name' => '腕時計'],
            ['name' => '保険'],
            ['name' => 'アウトドア'],
            ['name' => 'インテリア'],
            ['name' => '家具'],
        ];

        DB::table('tags')->insert($tags);
    }
}
