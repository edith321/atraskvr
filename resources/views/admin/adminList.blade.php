@extends('admin.adminCore')

@section('content')
    <div id="list">
    <div class="container">
        <h2>{{$title}}</h2>
        @if(sizeof($list)>0)
        <table class="table table-hover">
            <thead>
                <tr>
                    @foreach($list[0] as $key => $header)
                    <th>{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>

                @foreach($list as $key => $values)
                <tr>
                    @foreach($values as $key => $value)
                        <td>
                            @if($key == 'is_active')
                                @if($value == 1)
                                    <a onclick="enableDisableLanguage('{{route($call_to_action, $values['id'])}}', 1)" class="btn btn-info btn-sm" style="display: none;">{{trans('app.adminActivateButton')}}</a>
                                    <a onclick="enableDisableLanguage('{{route($call_to_action, $values['id'])}}', 0)" class="btn btn-info btn-sm" >{{trans('app.adminDeactivateButton')}}</a>
                                @else
                                    <a onclick="enableDisableLanguage('{{route($call_to_action, $values['id'])}}', 1)"  class="btn btn-info btn-sm" >{{trans('app.adminActivateButton')}}</a>
                                    <a onclick="enableDisableLanguage('{{route($call_to_action, $values['id'])}}', 0)" class="btn btn-info btn-sm" style="display: none;">{{trans('app.adminDeactivateButton')}}</a>
                                @endif
                                @else
                                    {{$value}}
                            @endif
                        </td>
                    @endforeach

                </tr>
                @endforeach

            </tbody>
        </table>
        @else
        <p>NO DATA</p>
        @endif
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        function enableDisableLanguage(url, value){
            alert('Hello')
        }
    </script>
@endsection