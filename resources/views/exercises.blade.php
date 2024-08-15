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

    <form method="GET" action="{{ route('exercises.search') }}">
        <div class="input-group">
                <input type="text" class="form-control" placeholder="Zoeken..."
                       name="search" value="{{Request('search')}}">
            <div class="col">
                <button type="submit" class="btn btn-primary">Zoek</button>
            </div>
        </div>
        <div class="row mt-2 flex-wrap">
            <p class="col m-0 p-0">Filters:</p>
            @foreach($tags as $tag)
                <div class="col p-0">
                    <input class="form-check-input" type="checkbox" name="filters[]" id="tag{{$tag->id}}"
                           value="{{$tag->id}}" @if(collect($filters)->contains($tag->id)) checked @endif>
                    <label class="form-check-label" for="tag{{$tag->id}}">{{$tag->name}}</label>
                </div>
            @endforeach
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
                <td>{{ $exercise->title }}</td>
                <td>{{ $exercise->muscle }}</td>

                <td>
                    <form>
                        <a class="btn btn-info" href="{{ route('exercises.show',$exercise->id) }}">Show</a>
                    </form>
                </td>
            </tr>
        @endforeach

    </table>
    {{ $exercises->links() }}


@endsection
