@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p><a class="btn btn-default" href="{{ route('blog.pictures.create') }}" data-toggle="tooltip" data-placement="right" title="New picture"><i class="glyphicon glyphicon-pencil"></i></a></p>
                <ul>
                @foreach ($pictures as $picture)
                    <li><img src="/{{ $picture->source }}" alt="{{ $picture->alternate_text }}"></li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection