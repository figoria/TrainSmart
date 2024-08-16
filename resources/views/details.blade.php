@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Details oefening</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="./"> Back</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Naam oefening:</strong>
                {{ $exercise->title }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Spiergroep:</strong>
                {{ $exercise->muscle }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>uitleg:</strong>
                {{ $exercise->info }}
            </div>
        </div>
        <div class="flex-row justify-content-start">
            @foreach($exercise->tags as $tag)
                <span class="border rounded p-2 m-0 bg-dark-subtle me-3">
                                    {{$tag->name}}
                                </span>
            @endforeach
        </div>
    </div>
@endsection
