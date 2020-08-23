<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/*Closureクラス　無名関数 を表すために使うクラス */

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    /*
    $request = Illuminate\Http\Request{}
    $next = Closure($passable) {#1104 ▼
                                        class: "Illuminate\Routing\Pipeline"
                                        this: Illuminate\Routing\Pipeline {#1093 …}
                                        use: {▶}
                                        file: "/Users/koruha/WebTestApp/vendor/laravel/framework/src/Illuminate/Routing/Pipeline.php"
                                        line: "28 to 36"
    }
    $guard = null
    */

    /*ログイン状態かどうかを調べている。ログイン状態であれば、ログイン画面には移動させたくないので、
    ログイン済であれば、redirectしている。
    Auth::guard($guard)->check()はSessionGuardのcheckメソッドを実行しており
    認証が完了している場合は/homeにリダイレクトが走る
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
        /*アプリケーションを次に進めるには、$nextコールバックを呼び出します */
    }
}
