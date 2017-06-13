@extends('admin.adminCore')

@section('content')
    <div class="container">
        <h3>{{trans('app.adminCreate')}}: {{$title}}</h3>
        {!!Form::open(['url' => route($submit)]) !!}
        <br>
        @foreach($fields as $field)
            @if($field['type'] == 'single_line')
                {{Form::label($field['key'], $field['label'])}}
                <br>
                {{Form::text($field['key'])}}
                <br>
                <br>
            @elseif($field['type'] == 'drop_down')
                {{Form::label($field['key'], $field['label'])}}
                <br/>
                {{Form::select($field['key'], $field['options'])}}
                <br/>
                <br>
            @endif
        @endforeach
        {{Form::submit(trans('app.adminSubmit'), array('class' => 'btn')) }}
        {!! Form::close() !!}
    </div>
@endsection
