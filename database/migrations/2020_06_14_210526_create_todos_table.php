<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

//migratioin fileの作成を行うコマンド　php artisan make:migration create_todos_table --create=todosの実行結果
class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *　
     * @return void
     */
    /*Schemaクラスのcreateメソッドにアクセスしている　::はスコープ定義演算子
    Schema::create('第一引数（テーブル名）',第二引数（無名関数）);
    第二引数はカラム型定義を行っている。新しいテーブルにどんなカラムがあるのかを指定している。
    string()は文字列のカラムを定義するのに利用
    */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }

    /*
        +------------+------------------+------+-----+---------+----------------+
    | Field      | Type             | Null | Key | Default | Extra          |
    +------------+------------------+------+-----+---------+----------------+
    | id         | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
    | title      | varchar(255)     | NO   |     | NULL    |                |
    | created_at | timestamp        | YES  |     | NULL    |                |
    | updated_at | timestamp        | YES  |     | NULL    |                |
    +------------+------------------+------+-----+---------+----------------+
    */

    /*
    +----+--------------------------------------------+---------------------+---------------------+
    | id | title                                      | created_at          | updated_at          |
    +----+--------------------------------------------+---------------------+---------------------+
    |  1 | Laravel Lessonを終わらせる                 | 2018-01-01 21:35:01 | 2018-01-04 21:35:01 |
    |  2 | レビューに向けて理解を深める               | 2018-02-01 21:35:01 | 2018-02-05 21:35:01 |
    |  4 | test                                       | 2020-06-16 21:51:52 | 2020-06-16 21:51:52 |
    |  6 | test3                                      | 2020-06-18 03:43:48 | 2020-06-18 03:43:48 |
    |  7 | test3                                      | 2020-06-18 03:48:03 | 2020-06-18 03:48:03 |
    |  8 | テスト                                     | 2020-06-19 12:21:00 | 2020-06-19 12:21:00 |
    |  9 | レビュー１回目                             | 2020-06-19 13:17:18 | 2020-06-19 13:17:18 |
    +----+--------------------------------------------+---------------------+---------------------+
    */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
