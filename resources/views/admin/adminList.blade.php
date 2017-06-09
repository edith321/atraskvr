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
                                    <a onclick="toggleActive('{{route($call_to_action, $values['id'])}}', 1)" class="btn btn-info btn-sm" style="display: none;">{{trans('app.adminActivateButton')}}</a>
                                    <a onclick="toggleActive('{{route($call_to_action, $values['id'])}}', 0)" class="btn btn-info btn-sm" >{{trans('app.adminDeactivateButton')}}</a>
                                @else
                                    <a onclick="toggleActive('{{route($call_to_action, $values['id'])}}', 1)"  class="btn btn-info btn-sm" >{{trans('app.adminActivateButton')}}</a>
                                    <a onclick="toggleActive('{{route($call_to_action, $values['id'])}}', 0)" class="btn btn-info btn-sm" style="display: none;">{{trans('app.adminDeactivateButton')}}</a>
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
        $.ajaxSetup({ //kiekvieno ajax kreipimosi metu tokena uzstato
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function toggleActive(url, value) {
            $.ajax({ // sita f-ja paduoda ne visa forma o tik viena kintamaji
                url: url,
                type: 'POST',
                data: {
                    is_active: value // paduodamam kintamajam reikia priskirti key, kad zinotu kurioj vietoj duombazej irasyt value
                }, // su sitais skliaustais apsirasome kaip objekta, galima dar kaip stringa
                success: function (r) {
                    console.log(r)
                }
            });
        }
    </script>
@endsection
