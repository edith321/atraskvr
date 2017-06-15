@extends('admin.adminCore')

@section('content')
    <div class="container">
        <h3>{{$title_name}}: {{$title}}</h3>
        {!!Form::open(['url' => $submit]) !!}
        <br>
        @foreach($fields as $field)
            @if($field['type'] == 'single_line')
                {{Form::label($field['key'], $field['label']/*, $edit['translation']['language_code']*/)}}
                <br>
                {{Form::text($field['key']/*, $edit['translation']['name']*/)}}
                <br>
                <br>
            @elseif($field['type'] == 'drop_down')
                {{Form::label($field['key'], $field['label'])}}
                <br/>
                {{Form::select($field['key'], /*[null=>'Please Select'] +*/ $field['options'])}}
                <br/>
                <br>
            @elseif($field['type'] == 'checkbox')
                @if(isset($field['key']))
                {{Form::label($field['key'], $field['label'])}}
                <br/>
                @endif
                @foreach($field['options'] as $option)
                    {{ Form::checkbox($option['name'], $option['value'])}} @if(isset($option['title'])) {{$option['title']}} @endif
                    <br/>
                @endforeach
                <br/>
            @endif
        @endforeach
        {{Form::submit(trans('app.adminSubmit'), array('class' => 'btn')) }}
        <a class="btn btn-info" href="{{$back}}">{{trans('app.adminBack')}}</a>
        {!! Form::close() !!}
    </div>
@endsection

{{--
@section('scripts')
    <script>
        var $languageDropDown = $("[name='language_id']");
        $languageDropDown.bind('change', function () {
            location.href = "/admin/menus/{{$item['id']}}/edit/" + $languageDropDown.val();
        });
    </script>
@endsection
--}}
