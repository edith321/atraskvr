@extends('admin.adminCore')

@section('content')
    <div class="container">
        <h3>{{$title_name}}: {{$title}}</h3>
        <div>@if( Session::has('errors') )
                <div class="alert alert-danger" role="alert" align="center">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif</div>

        @foreach($fields as $field)

            @if($field['type'] == 'image')
                {!!Form::open(['url' => $submit]) !!}
            @endif
                {!!Form::open(['url' => $submit, 'files' => true]) !!}
                <br>

            @if($field['type'] == 'single_line')

                {{Form::label($field['key'], $field['label'])}}
                <br>
                @if(isset($edit[$field['key']]))
                    {{Form::text($field['key'], $edit[$field['key']])}}
                @else
                    {{Form::text($field['key'])}}
                @endif
                <br>
                <br>


            @elseif($field['type'] == 'drop_down')

                {{Form::label($field['key'], $field['label'])}}
                <br/>
                @if(isset($edit[$field['key']]))

                    @if($field['key'] == 'language_code')
                        {{Form::select($field['key'], $field['options'], $edit[$field['key']])}}
                    @else
                        {{Form::select($field['key'], $field['options'], $edit[$field['key']], ['placeholder' => trans('app.placeholder')])}}
                    @endif
                @else
                    @if($field['key'] == 'language_code')
                        {{Form::select($field['key'], $field['options'], null)}}
                    @else
                        {{Form::select($field['key'], $field['options'], null, ['placeholder' => trans('app.placeholder')])}}
                    @endif

                @endif
                <br/>
                <br>


            @elseif($field['type'] == 'checkbox')

                @if(isset($field['key']))
                {{Form::label($field['key'], $field['label'])}}
                <br/>
                @endif

                @foreach($field['options'] as $option)
                    @if(isset($option['title']))

                        @if(isset($edit[$field['key']]))
                            @if($edit[$field['key']] == 1)
                                {{ Form::checkbox($option['name'], $option['value'], true)}} {{$option['title']}}
                            @else
                                {{ Form::checkbox($option['name'], $option['value'])}} {{$option['title']}}
                            @endif
                        @else
                            {{ Form::checkbox($option['name'], $option['value'])}} {{$option['title']}}
                        @endif
                    @else

                        @if(isset($edit[$field['key']]))
                            @if($edit[$field['key']] == 1)
                                {{ Form::checkbox($option['name'], $option['value'], true)}}
                            @else
                                {{ Form::checkbox($option['name'], $option['value'])}}
                            @endif
                        @else
                            {{ Form::checkbox($option['name'], $option['value'])}}
                        @endif

                    @endif
                    <br/>
                @endforeach
                <br/>
            @elseif($field['type'] == 'short_text')
                {{Form::label($field['key'], $field['label'])}}
                <br>
                @if(isset($edit[$field['key']]))
                    {{ Form::textarea($field['key'], $edit[$field['key']], ['size' => '30x5']) }}
                @else
                    {{ Form::textarea($field['key'], null, ['size' => '30x5']) }}
                @endif
                <br>
                <br>
            @elseif($field['type'] == 'long_text')
                {{Form::label($field['key'], $field['label'])}}
                <br>
                @if(isset($edit[$field['key']]))
                    {{ Form::textarea($field['key'], $edit[$field['key']]) }}
                @else
                    {{ Form::textarea($field['key']) }}
                @endif
                <br>
                <br>
            @elseif($field['type'] == 'image')
                <div class="form-group">
                    {!! Form::label($field['key'], $field['label']) !!}
                    {!! Form::file($field['key'], null) !!}
                </div>
            @endif


        @endforeach

        {{Form::submit(trans('app.adminSubmit'), array('class' => 'btn')) }}
        <a class="btn btn-info" href="{{$back}}">{{trans('app.adminBack')}}</a>
        {!! Form::close() !!}
    </div>
@endsection

@section('scripts')
    <script>

        $('#language_code').bind('change', function(){
            window.location.href= '?language_code=' + $('#language_code').val();
            /*alert($('#language_code').val())*/
        })

    </script>
@endsection
