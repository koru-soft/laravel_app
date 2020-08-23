<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon; // 追記

class TodosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ここから追記
        DB::table('todos')->truncate();
        DB::table('todos')->insert([
            [
                'title'      => 'Laravel Lessonを終わらせる',
                'created_at' => Carbon::create(2018, 1, 1),
                'updated_at' => Carbon::create(2018, 1, 4),
            ],
            [
                'title'      => 'レビューに向けて理解を深める',
                'created_at' => Carbon::create(2018, 2, 1),
                'updated_at' => Carbon::create(2018, 2, 5),
            ],
        ]);

        // ここまで追記
    }
}

/*php artisan make:seeder TodosTableSeederを実行して作成したファイル
Seederファイルを継承している
CarbonとはPHPで使える日付操作のライブラリ

DBファサード
DB::table(テーブル名) 
でテーブルを指定し、メソッドチェーンで各句(clause)を記述しSQLを組み立てた
*/
