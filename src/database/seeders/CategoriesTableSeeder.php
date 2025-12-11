<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contents = [
            '商品のお届けについて',
            '商品の交換について',
            '商品トラブル',
            'ショップへのお問い合わせ',
            'その他'
        ];
        foreach($contents as $content) {
            DB::table('categories')->insert(['content' => $content]);
        }
        // insert() に渡す値は['カラム名' => 値]文字列だけ（$content）を渡しても Laravel がどのカラムに入れるのか判別できずエラーになる

    }
}
