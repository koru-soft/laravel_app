<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{-- サービスコンテナを使うことでgetLocale()によりconfig\app.phpの'locale' => 'en'を参照しに行っている 
str_replace(検索文字列, 置換文字列, 対象文字列 [, 置換した回数を格納する変数])
たとえば「MovaleType」という文字列があったら「WordPress」に変換する場合
$str = "MovableType is written in PHP";
echo str_replace("MovableType", "WordPress", $str);
--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- HTML中のmetaタグにトークンを保存 --}}

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- config()はヘルパ関数。設定変数の値を取得。
        設定値へ簡単にアクセスできる。
        設定値はファイルとオプションの名前を含む「ドット」記法を使いアクセスする
        config(設定値,デフォルト値)
        デフォルト値が指定でき、設定オプションが存在しない時に返される。
    --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script> タグに defer 属性を追加することで、
        HTML パース完了後、DOMContentLoaded イベントの直前に (※WHATWG 仕様) JS ファイルを実行します 
        JSの読み込みタイミングを制御しているのがdefer。
        --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- url()はヘルパ関数。指定したパスへの完全なURLを生成する
                        Route::get('/', function () {return view('welcome');}); 
                        を起動しにいく。だからwelcomeのbladeファイルを変えればhref先も変わる
                    --}}
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                {{-- __()はヘルパ関数。指定した翻訳文字列か翻訳キーをローカリゼーションファイルを使用し、翻訳する＝多言語化対応を行う
                    指定した翻訳文字列や翻訳キーが存在しない場合、__関数は指定した値をそのまま返す
                 --}}
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        {{-- 認証ディレクティブ。@authと@guestディレクティブは、現在のユーザーが認証されているか、
                            もしくはゲストであるかを簡単に判定するために使用します 
                            @authは認証済、@guestは認証されていない場合の処理を記述できる
                            ディレクティブ・・・コンパイル時にコンパイラーに与える補足情報
                            --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                {{-- route()はURLを生成する。__()はヘルパ関数でLoginという文字を表示させているだけ --}}
                            </li>
                            @if (Route::has('register'))
                            {{-- リクエストに値が存在するかを判定するには、hasメソッドを使用します。
                                hasメソッドは、リクエストに値が存在する場合に、trueを返します。 --}}
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    {{-- App\Http\Controllers\Auth\RegisterController@showRegistrationFormを実行 --}}
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
