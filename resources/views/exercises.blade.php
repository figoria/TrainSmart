@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="pull-left">
                <h2>Oefeningen</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('exercises.create') }}"> Maak nieuwe oefening</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Naam oefening</th>
            <th>Spiergroep</th>
            <th>info</th>
            <th width="280px">peop</th>
        </tr>
        @foreach ($exercises as $exercise)
            <tr>
                <td>{{ $exercise->id }}</td>
                <td>{{ $exercise->name }}</td>
                <td>{{ $exercise->muscle }}</td>
                <td>{{ $exercise->info }}</td>

                <td>
                    <form action="{{ route('exercises.destroy',$exercise->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('exercises.show',$exercise->id) }}">Show</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
    {{ $exercises->links() }}


@endsection
