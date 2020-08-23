<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo; //追記
use Auth;

//php artisan make:controller TodoController --resourceの実行結果

class TodoController extends Controller
{
    // ここから追記
    private $todo;

    public function __construct(Todo $instanceClass)
    {
        $this->middleware('auth');
        $this->todo = $instanceClass;
    }
    // ここまで追記
    // __constructはClassのインスタンス化 が行われた際に設定しておきたい値などを設定するメソッド
    //　初期値の設定などで使用。オブジェクトの挿入。
    // メソッドの中で $this->todo という風に書いたものに引数で渡ってきたものを代入してます。
    //　これは、private $todo; へアクセスし代入を行なっていることになります。
    // $this->todo の $this が自身(Class自体)をさしているのでその中に存在する $todo を意味しています。
    // これがないと、インスタンスを作る度にnewをしないといけない。このインスタンス作成文を１箇所でまとめるためにconstructしている。
    //$thisはTodoインスタンスと認識すること。じゃあTodoインスタンスとは何かというと、レコード=モデル。
    //Todoクラスのインスタンスを使う時だけDBに接続できる。だから、DBに繋ぐ時は$this->todoをしている。

    /*
    Todoクラスのインスタンスが$instanceClassに代入される。この$instanceClassが、TodoControllerクラスの$todoプロパティに
    代入される。つまり、$todoはTodoクラスのインスタンスである。Todoクラスのインスタンスには、
    protected $fillable = ['title'];がプロパティとして定義されている。

    dd($instanceClass);
    App\Todo {#1099 ▼
    #fillable: array:1 [▼
    0 => "XXXX"　XXXXには$fillableの代入値が入る
    ]
    */

    // Illuminate\Database\Eloquent\Collection
    //Collectionはレコードを配列化するクラス。配列で使えるメソッドがたくさんあり、これを定義している
    //Queryだとわかりにくい。

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "Hello world!!";
        // return view('layouts.app');
        // return view('todo.index');  // 追記
        $todos = $this->todo->getByUserId(Auth::id());//追記
        /*
        Illuminate\Database\Eloquent\Collection {#1165 ▼
        #items: []
        }
        */
        // $todos = $this->todo->all(); // 追記　SELECT * FROM todos;をやっている all()でCollectionのインスタンスを返す

        //all()の具体的値
        //Illuminate\Database\Eloquent\Collection {#1147 ▼
          #items: array:8 [▼
        // 0 => App\Todo {#1148 ▶}
        // 1 => App\Todo {#1149 ▶}
        // 2 => App\Todo {#1150 ▶}
        // 3 => App\Todo {#1151 ▶}
        // 4 => App\Todo {#1152 ▶}
        // 5 => App\Todo {#1153 ▶}
        // 6 => App\Todo {#1154 ▶}
        // 7 => App\Todo {#1155 ▶}
        //   ]
        // }
       
        return view('todo.index', compact('todos'));  // 編集　todoのindex.blade.phpへ変数を渡している
        //todos = $todosをcompactで行い、todosの値を連想配列としてtodo.indexに渡す

        //compactがやりたかったのは、連想配列として渡すこと
        //キー名　＝　valueになるのはお作法のようなもの
        //Viewに５〜１０個連想配列を渡すとコードも見にくくなる。だからcompactがいい
        //foreach($todos as $todo)の$todosはレコード1個1個　具体的には0 => のところ

        //all()でやっていることは、DBno全レコードを配列として持ってきている
        //だからbladeの方でforeachで回せる。foreachで回したいから、連想配列で渡さなきゃいけない。

        //'todos' => $todos

        /*array(
            todos => $todos
        );*/

        //DBからの返却データは、Objectとしてデータが返却されます。
        //この返却されたObjectをViewに渡し取得した値を表示したりしてます。
        //そのためには、取得したデータをViewに渡さなければなりません。
        //そのための記述としてcompact() にview側に渡したい変数を記述してあげます。
        //そうすることによってview側で変数を使用することが可能となります。
    }

    /*view関数
    ヘルパ関数の1つ。viewインスタンスを返す＝指定されたviewファイル（=bladeテンプレート）を表示する。
    view('開きたいviewファイル=bladeファイル','渡したい値')
    */

    /*compact
    Illuminate\View\View {#1135 ▼
    #factory: Illuminate\View\Factory {#110 ▶}
    #engine: Illuminate\View\Engines\CompilerEngine {#1129 ▶}
    #view: "todo.index"
    #data: array:1 [▼
        "todos" => Illuminate\Database\Eloquent\Collection {#1146 ▼
        #items: array:7 [▼
             0 => App\Todo {#1147 ▼
          #fillable: array:1 [▶]
          #connection: "mysql"
          #table: "todos"
          #primaryKey: "id"
          #keyType: "int"
          +incrementing: true
          #with: []
          #withCount: []
          #perPage: 15
          +exists: true
          +wasRecentlyCreated: false
          #attributes: array:4 [▼
            "id" => 1
            "title" => "Laravel Lessonを終わらせる"
            "created_at" => "2018-01-01 21:35:01"
            "updated_at" => "2018-01-04 21:35:01"
          ]
          #original: array:4 [▶]
          #changes: []
          #casts: []
          #dates: []
          #dateFormat: null
          #appends: []
          #dispatchesEvents: []
          #observables: []
          #relations: []
          #touches: []
          +timestamps: true
          #hidden: []
          #visible: []
          #guarded: array:1 [▶]
            1 => App\Todo {#1148 ▶}
            2 => App\Todo {#1149 ▶}
            3 => App\Todo {#1150 ▶}
            4 => App\Todo {#1151 ▶}
            5 => App\Todo {#1152 ▶}
            6 => App\Todo {#1153 ▶}
        ]
        }
    ]
    #path: "/Users/koruha/WebTestApp/resources/views/todo/index.blade.php"} 

    compact関数
    $arr = array(
    'apple' => $apple,
    'orange' => $orange,
    'lemon' => $lemon,
    );
    という記述を
    $arr = compact('apple', 'orange', 'lemon');
    で終わらせる関数
    */

    /*select * from todos
        id | title                                      | created_at          | updated_at          |
    +----+--------------------------------------------+---------------------+---------------------+
    |  1 | Laravel Lessonを終わらせる                 | 2018-01-01 21:35:01 | 2018-01-04 21:35:01 |
    |  2 | レビューに向けて理解を深める               | 2018-02-01 21:35:01 | 2018-02-05 21:35:01 |
    |  4 | test                                       | 2020-06-16 21:51:52 | 2020-06-16 21:51:52 |
    |  6 | test3                                      | 2020-06-18 03:43:48 | 2020-06-18 03:43:48 |
    |  7 | test3                                      | 2020-06-18 03:48:03 | 2020-06-18 03:48:03 |
    |  8 | テスト                                     | 2020-06-19 12:21:00 | 2020-06-19 12:21:00 |
    |  9 | レビュー１回目                             | 2020-06-19 13:17:18 | 2020-06-19 13:17:18 
    */

    /*DBからの返却データ
    dd($todos);
    Illuminate\Database\Eloquent\Collection {#1142 ▼}←collectionインスタンスですよ　1142はオブジェクト値ですよ＝メモリの場所
    #items: array:3 [

      0 => App\Todo {#1143 ▼}　←Todoクラスのインスタンス＝レコード
      1 => 以下同
    ];

    #items: array:3 [▼
    0 => App\Todo {#1143 ▼}

      #fillable: array:1 [▼
        0 => "title"
      ]
      #connection: "mysql"
      #table: "todos"
      #primaryKey: "id"
      #keyType: "int"
      +incrementing: true
      #with: []
      #withCount: []
      #perPage: 15
      +exists: true
      +wasRecentlyCreated: false
      #attributes: array:4 [▼
        "id" => 1
        "title" => "Laravel Lessonを終わらせる"
        "created_at" => "2018-01-01 21:35:01"
        "updated_at" => "2018-01-04 21:35:01"
      ]
      #original: array:4 [▼
        "id" => 1
        "title" => "Laravel Lessonを終わらせる"
        "created_at" => "2018-01-01 21:35:01"
        "updated_at" => "2018-01-04 21:35:01"
      ]
      #changes: []
      #casts: []
      #dates: []
      #dateFormat: null
      #appends: []
      #dispatchesEvents: []
      #observables: []
      #relations: []
      #touches: []
      +timestamps: true
      #hidden: []
      #visible: []
      #guarded: array:1 [▶]
    }
    1 => App\Todo {#1144 ▼
      #fillable: array:1 [▶]
      #connection: "mysql"
      #table: "todos"
      #primaryKey: "id"
      #keyType: "int"
      +incrementing: true
      #with: []
      #withCount: []
      #perPage: 15
      +exists: true
      +wasRecentlyCreated: false
      #attributes: array:4 [▼
        "id" => 2
        "title" => "レビューに向けて理解を深める"
        "created_at" => "2018-02-01 21:35:01"
        "updated_at" => "2018-02-05 21:35:01"
      ]
      #original: array:4 [▼
        "id" => 2
        "title" => "レビューに向けて理解を深める"
        "created_at" => "2018-02-01 21:35:01"
        "updated_at" => "2018-02-05 21:35:01"
      ]
      #changes: []
      #casts: []
      #dates: []
      #dateFormat: null
      #appends: []
      #dispatchesEvents: []
      #observables: []
      #relations: []
      #touches: []
      +timestamps: true
      #hidden: []
      #visible: []
      #guarded: array:1 [▶]
    }
    2 => App\Todo {#1145 ▼
      #fillable: array:1 [▶]
      #connection: "mysql"
      #table: "todos"
      #primaryKey: "id"
      #keyType: "int"
      +incrementing: true
      #with: []
      #withCount: []
      #perPage: 15
      +exists: true
      +wasRecentlyCreated: false
      #attributes: array:4 [▼
        "id" => 4
        "title" => "test"
        "created_at" => "2020-06-16 21:51:52"
        "updated_at" => "2020-06-16 21:51:52"
      ]
      #original: array:4 [▼
        "id" => 4
        "title" => "test"
        "created_at" => "2020-06-16 21:51:52"
        "updated_at" => "2020-06-16 21:51:52"
      ]
      #changes: []
      #casts: []
      #dates: []
      #dateFormat: null
      #appends: []
      #dispatchesEvents: []
      #observables: []
      #relations: []
      #touches: []
      +timestamps: true
      #hidden: []
      #visible: []
      #guarded: array:1 [▶]
    }
  ]
}*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');  // 追記
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //DBにデータを格納するための処理を行うメソッド
    
    public function store(Request $request)
    {
        // 以下 returnまで追記;
        $input = $request->all();
        /*
        array:2 [▼
                     "_token" => "TPzjqazMh17eskN7jMh3qOOvhWRORpHoNnhOulyH"
                     "title" => "test3"
                ]
        */
        // dd($input);
        // dd($this->todo->fill($input));
        $input['user_id'] = Auth::id();//追記

        $this->todo->fill($input)->save();

        /* ->fill($input)->save();
        属性の代入　→　fillメソッド。引数に設定された配列の値をモデルのプロパティに代入する。
        Todoインスタンスの中で定義されているから、Sthisを指定することで使えるようになる。
        DBの保存 → save メソッド
        */

        /*fill($input)とは
        _tokenというキーがあるか、titleというキーがあるかを$fillableに見に行っている。
        そこにあるものはtitle
        fillableは設定可能なカラムであることを表し、その確認がfill()メソッドで行える
        */

        /*Requestクラスとは
        inputで入れた内容をPOSTで送る時に使う
        */

        /*App\Http\Controllers\TodoController {#1097 ▼
        -todo: App\Todo {#1098 ▶}
        #middleware: []
        }*/

        /* $test = $this->todo->fill($input);
        dd($test);
        App\Todo {#1098 ▼
        #fillable: array:1 [▼
            0 => "title"
        ]
        #connection: null
        #table: null
        #primaryKey: "id"
        #keyType: "int"
        +incrementing: true
        #with: []
        #withCount: []
        #perPage: 15
        +exists: false
        +wasRecentlyCreated: false
        #attributes: array:1 [▼
            "title" => "test3"
        ]
        #original: []
        #changes: []
        #casts: []
        #dates: []
        #dateFormat: null
        #appends: []
        #dispatchesEvents: []
        #observables: []
        #relations: []
        #touches: []
        +timestamps: true
        #hidden: []
        #visible: []
        #guarded: array:1 [▼
            0 => "*"
        ]
        } */

        //$test = $this->todo->fill($input)->save(); dd($test); →　true
        return redirect()->to('todo');
    }
    /*return redirect()->route('todo.index');で書くこともできる
    今回の書き方だと、todoの名前を変えた時、toの引数も一緒に変更しなきゃいけない
  
    */

    //redirect()->to()
    //redirectヘルパ関数で取得したリダイレクタインスタンスにパスを指定する
    //末尾が/todoのURLにリダイレクトする

    //Request $requestはfileの上部に記載ある use Illuminate\Http\Request; の Request を使用してます。
    //これを使うことで何が実現できているかというとForm タグで送信した POST 情報を取得することを実現してます。
    //$this->todo->fill($input)->save();
    //fillは、引数を設定できるかどうかを確認してくれます。
    //これは、Model ファイル に追記した記述をしていることによって可能としてます。
    //かつ最後の save() でデータの保存を行います。※指定外のものは無視します。
    //最後に保存完了後は、一覧画面に遷移させる記述を行なっています。

    /*
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //このメソッドを通してTodoの更新を行います。
    public function edit($id)
    {
        $todo = $this->todo->find($id);  // 追記 select * from todos where id = 1;
        return view('todo.edit', compact('todo'));  // 追記
    }
    //compact('todo')→todo = $todoの生成。この生成値をedit.blade.phpに渡す。

    /*edit($id)のidについて
    index.bladeの方で$todo->idが指定されており、この記述によってidが使えるようになる
    アローでカラム名を指定することで、その値が取得できる
    送られて来るものは、route(第一引数,第二引数)の第二引数。第二引数はパラメータ＝使いたい値のため。
    */

    //edit($id)はURL のパラメータの取得のための記述
    //$this->todo->find($id);
    //パラメータで渡ってきた値を元にDBへ検索を行なっています。
    //これにより指定のデータのみ取得することが可能になり、編集画面に一覧で選択したTitleのものを表示し更新を可能にします。

    /*
    find()メソッド
    Eloquentメソッドの1つ
    ex.find(1);→id=1 のレコードを抽出する
    */

    /*dd($todo);
    App\Todo {#1142 ▼
  #fillable: array:1 [▶]
  #connection: "mysql"
  #table: "todos"
  #primaryKey: "id"
  #keyType: "int"
  +incrementing: true
  #with: []
  #withCount: []
  #perPage: 15
  +exists: true
  +wasRecentlyCreated: false
  #attributes: array:4 [▶]→更新をクリックした要素のid番号の値が取得されている
  #original: array:4 [▶]
  #changes: []
  #casts: []
  #dates: []
  #dateFormat: null
  #appends: []
  #dispatchesEvents: []
  #observables: []
  #relations: []
  #touches: []
  +timestamps: true
  #hidden: []
  #visible: []
  #guarded: array:1 [▶]
} */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //追記
        $input = $request->all();
        /*
        dd($input);→配列を返す。
        array:3 [▼
        "_method" => "PUT"
        "_token" => "zwKvVEYOHD4m1HGs1j1Jmz3zTCvzYciHXnoKrTcd"
        "title" => "test4"
        ]
        */
        $this->todo->find($id)->fill($input)->save();
        //findでやりたいことは１レコードを１件取得すること。だから$todoという単数形になっている
        //レコードのidで検索をかけている
        //allの場合は$todosという複数形になっている

        //updateメソッドはForm系だからRequestが返ってくる
        /*更新とは、
        ①更新の対象を見つけること＝１レコードを見つけること
        findメソッドにて、どれを書き換えたいのかを知る
        その際、 idで検索された１レコードが返ってくる。
        ここでは、更新前のものが飛んでくる
        ②更新をかける
        fill($input)メソッドにて、更新をかける
        ③保存する
        save();にて更新後のデータを保存する
        */

        return redirect()->to('todo');
        //find で検索し、fill で設定の確認(検証)し、保存という流れ
        //属性の代入　→　fillメソッド。引数に設定された配列の値をモデルのプロパティに代入する。
        //DBの保存 → save メソッド
        //末尾/todoへのリダイレクト
    }

    //$this->todoでまず元々入っていたtitleの値を参照し、その後、idをキーとしてテーブルを検索
    //fillでtitleをキーにした要素を代入し、saveで保存させている

    /*
    public function __construct(Todo $instanceClass)
    {
        $this->todo = $instanceClass;
    }

    dd($instanceClass);
    App\Todo {#1099 ▼
    #fillable: array:1 [▼
    0 => "title"　
    ]
    */
    /*
    redirect()→URL転送
    引数無しで呼び出した場合は、リダイレクタインスタンスを返します。

    リダイレクトの基本形
    return redirect('todofuken/tokyo');
    こうすることで、「http://*****.com/todofuken/tokyo」へリダイレクトしてくれます
    そして、これは
    return redirect()->to('todofuken/tokyo');
    と書いても同じ

    redirect()->to()
    redirect関数で取得したリダイレクタインスタンスにパスを指定する
    */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //追記　find で検索し、delete で物理削除
        $this->todo->find($id)->delete();
        return redirect()->to('todo');
        //末尾/todoへのリダイレクト
    }
}
