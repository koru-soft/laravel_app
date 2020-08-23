@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo編集</h2>
{!! Form::open(['route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!} {{--変更--}}
  <div class="form-group">
  {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control']) !!} {{--変更--}}
  {{--input type="text" class="form-control" placeholder="ToDo内容"--}}
  </div>
  {!! Form::submit('更新', ['class' => 'btn btn-success float-right']) !!} {{--変更--}}
  {!! Form::close() !!}
  {{--button type="submit" class="btn btn-success float-right">更新/button--}}

  {{--
  <form method="POST" action="http://127.0.0.1:8000/todo/4" accept-charset="UTF-8">
    <input name="_method" type="hidden" value="PUT">
    <input name="_token" type="hidden" value="zwKvVEYOHD4m1HGs1j1Jmz3zTCvzYciHXnoKrTcd"> 
    <div class="form-group">
      <input required="" class="form-control" name="title" type="text" value="test"> 
    </div>
    <input class="btn btn-success float-right" type="submit" value="更新"> 
  </form>
  --}}

@endsection