@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>maak nieuwe oefening</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href='./'> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('exercises.store') }}">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>naam:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Naam oefening">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>spiergroep:</strong>
                    <input type="text" name="muscle" class="form-control" placeholder="Spiergroep">
                </div>
                <div class="form-group">
                    <strong>Uitleg:</strong>
                    <input type="text" name="info" class="form-control" placeholder="uitleg">
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

    </form>
@endsection
