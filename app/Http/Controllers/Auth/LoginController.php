<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';
    //homeから変更。 Login した後の遷移先を指定する箇所
    //ValidationExceptionクラスやAuthenticationExceptionクラスに記載がある

    //ログイン回数のオーバーライド
    /*
    ThrottlesLoginsのなかにmaxAttemptsの記述があるが、こいつはtraitファイル
    classのメソッド  >  useしているtraitのメソッド > 継承しているclassのメソッド
    という優先順位により、class内の記述が優先されるため、試行回数を変更できる。
    */
    protected $maxAttempts = 2; 

    /**
     * Create a new controller instance.
     *
     * @return void
     * ログアウト(Logout)以外のメソッド、
     * つまり会員登録（Register）と
     * ログイン（Login)のメソッドにおいて、
     * すでにログインしているなら/homeにリダイレクト。
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}
