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
            <th width="280px">opties</th>
        </tr>
        @foreach ($data as $exercise)
            <tr>
                <td>{{ $exercise->id }}</td>
                <td>{{ $exercise->title }}</td>
                <td>{{ $exercise->muscle }}</td>
                <td>
                    <form action="{{ route('exercises.destroy',$exercise->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('exercises.show',$exercise->id) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('exercises.edit',$exercise->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <form id="form" action="{{route('exercises.softDeleteOrRestore', $exercise)}}" method="POST">
                        @csrf
                        <div class="form-check form-switch">
                            <label class="form-label">Exercise status:@if(!$exercise->trashed()) <strong>On</strong> @else <strong>Off</strong> @endif</label>
                            <button class="form-control btn @if(!$exercise->trashed()) btn-danger @else btn-primary @endif" type="submit"
                                    name="on">Switch @if(!$exercise->trashed()) off @else on @endif</button>
                        </div>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
    {{ $exercises->links() }}


@endsection

