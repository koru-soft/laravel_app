@extends ('layouts.app') <!-- 追記 -->
@section ('content') <!-- 追記 -->

<h1 class="page-header">{{Auth::user()->name}}のToDo一覧</h1>
<p class="text-right">
  <a class="btn btn-success" href="/todo/create">新規作成</a>
</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>ID</th>
      <th>やること</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo)
      <tr>
        <td class="align-middle">{{ $todo->id }}</td>
        <td class="align-middle">{{ $todo->title }}</td>
        <td class="align-middle">{{ $todo->created_at }}</td>
        <td class="align-middle">{{ $todo->updated_at }}</td>
        <td><a class="btn btn-primary" href="{{ route('todo.edit', $todo->id) }}">編集</a></td>
        <td>
          {!! Form::open(['route' => ['todo.destroy', $todo->id], 'method' => 'DELETE']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
          {{--
          <form method="POST" action="http://127.0.0.1:8000/todo/1" accept-charset="UTF-8">
          <input name="_method" type="hidden" value="DELETE">
          <input name="_token" type="hidden" value="gdzI0P0CrYqxC6yCTpPSJofHBlmNKXl4GCghp9VM">
          <input class="btn btn-danger" type="submit" value="削除">
          </form>
          
          <form method="POST" action="http://127.0.0.1:8000/todo/2" accept-charset="UTF-8">
          <input name="_method" type="hidden" value="DELETE">
          <input name="_token" type="hidden" value="gdzI0P0CrYqxC6yCTpPSJofHBlmNKXl4GCghp9VM">
          <input class="btn btn-danger" type="submit" value="削除">
          </form>
          以下同
          --}}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@endsection
{{--
Illuminate\Database\Eloquent\Collection {#1142 ▼
    #items: array:3 [▼
    0 => App\Todo {#1143 ▼
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
    --}}