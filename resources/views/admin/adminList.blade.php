@extends('admin.adminCore')

@section('content')
    <div id="list">
    <div class="container">
        <h2>{{$title}}</h2>
        @if(isset($new))
           <div><a class="btn btn-info" href="{{$new}}">{{trans('app.addNewButton')}}</a></div>
        @endif

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

                @foreach($list as $key => $record)
                <tr id="{{$record['id']}}">
                    @foreach($record as $key => $value)

                            @if($key == 'is_active')

                                @if($value == 1)
                                <td><a onclick="toggleActive('{{route($call_to_action, $record['id'])}}', 1)" class="btn btn-success btn-sm" style="display: none;">{{trans('app.adminActivateButton')}}</a>
                                <a onclick="toggleActive('{{route($call_to_action, $record['id'])}}', 0)" class="btn btn-danger btn-sm" >{{trans('app.adminDeactivateButton')}}</a></td>
                                @else
                                <td><a onclick="toggleActive('{{route($call_to_action, $record['id'])}}', 1)"  class="btn btn-success btn-sm" >{{trans('app.adminActivateButton')}}</a>
                                <a onclick="toggleActive('{{route($call_to_action, $record['id'])}}', 0)" class="btn btn-danger btn-sm" style="display: none;">{{trans('app.adminDeactivateButton')}}</a></td>
                                @endif

                            @elseif($key == 'translation')

                                @if(isset($value['name']))
                                    <td>{{$value['name'] . ' ' . $value['language_code']}}</td>
                                @elseif(isset($value['title']))
                                    <td>{{$value['title'] . ' ' . $value['language_code']}}</td>
                                @else
                                    <td></td>
                                @endif

                            @else
                            <td>{{$value}}</td>

                            @endif

                    @endforeach
                    @if(isset($edit))
                        <td>
                            <a class="btn btn-info" href="{{route($edit, $record['id'])}}">{{trans('app.adminEdit')}}</a>
                    @endif
                    @if(isset($delete))
                            <a class="btn btn-danger" onclick="deleteItem('{{route($delete, $record['id'])}}')">{{trans('app.adminDelete')}}</a>
                        </td>
                    @endif

                </tr>
                @endforeach

            </tbody>
        </table>
        @else
            <div class="noData">
                <h3>{{$no_data}}</h3>
            </div>
        @endif
    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function deleteItem(route) {
            $.ajax({
                url: route,
                dataType: 'json',
                type: 'DELETE',
                success: function () {
                    /*alert('DELETED');*/
                    location.reload();
                },
                error: function () {
                    alert('ERROR');
                }
            });
        }

        function toggleActive(url, value) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    is_active: value
                },
                success: function (response) {
                    var danger = $('#'+ response.id).find('.btn-danger')
                    var success = $('#'+ response.id).find('.btn-success')

                    if(response.is_active  === '1') {
                        success.hide();
                        danger.show()
                    } else {
                        success.show();
                        danger.hide()
                    }
                }
            });


        }
    </script>
@endsection
