@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo作成</h2>
{!! Form::open(['route' => 'todo.store']) !!}
{{--form method="POST" action="http://127.0.0.1:8000/todo" accept-charset="UTF-8">input name="_token" type="hidden" value="gdzI0P0CrYqxC6yCTpPSJofHBlmNKXl4GCghp9VM"--}}

<div class="form-group">
{!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!}
{{--input required class="form-control" placeholder="ToDo内容" name="title" type="text">--}}
{{-- nameの値がキーになる　title = value --}}
{{-- FORMファサードがトークンを作ってくれている。トークンを作っているのは{{ではない --}}

</div>
{!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!}
{{--input class="btn btn-success float-right" type="submit" value="追加">/form>--}}

{!! Form::close() !!}

@endsection