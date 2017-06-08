@extends('admin.adminCore')

@section('content')
    <div id="list">
    <div class="container">
        <h2>Hover Rows</h2>
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
                        <td>{{$value}}</td>
                    @endforeach
                    <td><a href="#" class="btn btn-info btn-sm">Activate</a></td>
                    <td><a href="#" class="btn btn-info btn-sm">Deactivate</a></td>
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