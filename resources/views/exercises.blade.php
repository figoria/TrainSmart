@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Oefeningen</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif


    <form method="get" action="#">
        <div class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Zoeken..." value="{{request('search')}}">
            <button type="submit" class="btn btn-primary">Zoek</button>
        </div>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Naam oefening</th>
            <th>Spiergroep</th>
            <th width="280px"></th>
        </tr>
        @foreach ($exercises as $exercise)
            <tr>
                <td>{{ $exercise->id }}</td>
                <td>{{ $exercise->name }}</td>
                <td>{{ $exercise->muscle }}</td>

                <td>
                    <form>
                        <a class="btn btn-info" href="{{ route('exercises.show',$exercise->id) }}">Show</a>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>


@endsection
