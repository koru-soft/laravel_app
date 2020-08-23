<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*ウェブサイトでは、例えばAフォルダにB.htmlを入れればhttp://○○/A/B.htmlでアクセスできますが、Laravelはそうはいきません。
Laravelは特定のアドレスにアクセスすると、そのアドレスに割り当てられたプログラムが実行されます。
このように「〇〇というアドレスにアクセスしたら✕✕という処理を呼び出す」という関連付けをしているのがルーティングです。 */

/*
Route::get(アドレス, 関数など);
第１引数に割り当てる「アドレス」を、第２引数にはそれによって「呼び出される処理」を記述
*/

/*
view関数
ヘルパ関数の1つ。viewインスタンスを返す＝指定されたviewファイル（=bladeテンプレート）を表示する。
view('開きたいviewファイル=bladeファイル','渡したい値')
*/
Route::get('/', function () {
    return view('welcome');
});

Route::resource('todo', 'TodoController');  // 追記 todoというURIにアクセスしたらTodoController@indexを呼び出す
/*
  Route::resource('todo', 'TodoController');
  Illuminate\Routing\PendingResourceRegistration {#139 ▼
  #registrar: Illuminate\Routing\ResourceRegistrar {#138 ▶}
  #name: "todo"
  #controller: "TodoController"
  #options: []
  #registered: false
*/

/*
Domain   | Method    | URI(ドメイン以下)  | Name         | Action                                      | Middleware   |
+--------+-----------+------------------+--------------+---------------------------------------------+--------------+
|        | GET|HEAD  | /                |              | Closure                                     | web          |
|        | GET|HEAD  | api/user         |              | Closure                                     | api,auth:api |
|        | GET|HEAD  | todo             | todo.index   | App\Http\Controllers\TodoController@index   | web          |
|        | POST      | todo             | todo.store   | App\Http\Controllers\TodoController@store   | web          |
|        | GET|HEAD  | todo/create      | todo.create  | App\Http\Controllers\TodoController@create  | web          |
|        | GET|HEAD  | todo/{todo}      | todo.show    | App\Http\Controllers\TodoController@show    | web          |
|        | PUT|PATCH | todo/{todo}      | todo.update  | App\Http\Controllers\TodoController@update  | web          |
|        | DELETE    | todo/{todo}      | todo.destroy | App\Http\Controllers\TodoController@destroy | web          |
|        | GET|HEAD  | todo/{todo}/edit | todo.edit    | App\Http\Controllers\TodoController@edit    | web  
URI（Uniform Resource Identifier）：
　名前または場所を識別する書き方のルールの総称（親玉）。
　URLやURNは、URIで定められたルールに従って書かれたり使われたりする。

Name
この URI を使用する際は、この Name を使用すれば対象 Action のメソッドが使用されますよ。という意味

Middleware
使用しているMiddlewareの記載
*/

/*名前つきメソッド*/

Auth::routes();
/*詳細　https://hiroslog.com/post/110 */

/*
Route::get(アドレス, 関数など);
第１引数に割り当てる「アドレス」を、第２引数にはそれによって「呼び出される処理」を記述
*/
Route::get('/home', 'HomeController@index')->name('home');

/*
 Domain | Method    | URI                    | Name             | Action                                                                 | Middleware   |
+--------+-----------+------------------------+------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                      |                  | Closure                                                                | web          |
|        | GET|HEAD  | api/user               |                  | Closure                                                                | api,auth:api |
|        | GET|HEAD  | home                   | home             | App\Http\Controllers\HomeController@index                              | web,auth     |
|        | POST      | login                  |                  | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | GET|HEAD  | login                  | login            | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST      | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | POST      | password/email         | password.email   | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest    |
|        | GET|HEAD  | password/reset         | password.request | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest    |
|        | POST      | password/reset         | password.update  | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest    |
|        | GET|HEAD  | password/reset/{token} | password.reset   | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest    |
|        | GET|HEAD  | register               | register         | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
|        | POST      | register               |                  | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
|        | GET|HEAD  | todo                   | todo.index       | App\Http\Controllers\TodoController@index                              | web,auth     |
|        | POST      | todo                   | todo.store       | App\Http\Controllers\TodoController@store                              | web,auth     |
|        | GET|HEAD  | todo/create            | todo.create      | App\Http\Controllers\TodoController@create                             | web,auth     |
|        | GET|HEAD  | todo/{todo}            | todo.show        | App\Http\Controllers\TodoController@show                               | web,auth     |
|        | PUT|PATCH | todo/{todo}            | todo.update      | App\Http\Controllers\TodoController@update                             | web,auth     |
|        | DELETE    | todo/{todo}            | todo.destroy     | App\Http\Controllers\TodoController@destroy                            | web,auth     |
|        | GET|HEAD  | todo/{todo}/edit       | todo.edit        | App\Http\Controllers\TodoController@edit                               | web,auth  

*/

/*
php artisan route:list | grep logout
|        | POST      | logout                 | logout           | App\Http\Controllers\Auth\LoginController@logout                       | web          |
*/
