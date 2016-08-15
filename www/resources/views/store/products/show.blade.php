@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        {{ $product->title }}
                        <span class="label label-info pull-right">{{ $product->category->name }}</span>
                    </div>
                    <div class="panel-body">
                        <div class="left">
                            <p>
                                <strong>Description:</strong>
                                {{ $product->content }}
                            </p>
                            <p>
                                <strong>Price:</strong>
                                <i>{{ $product->price }} $</i>
                            </p>
                            <p>
                                <strong>BTW:</strong>
                                {{ $product->btw }} %
                            </p>
                            <p>
                                <strong>Sale:</strong>
                                {{ $product->sale }} % korting!
                            </p>
                            <p>
                                <strong>In Stock:</strong>
                                {{ $product->stock }}<i> (0=false)</i>
                            </p>
                            <p>
                                <strong>TODO:</strong>
                                <i>RATING</i>
                            </p>
                            <p>
                                <strong>TODO:</strong>
                                <h1>PRIJSHISTORIEK!</h1>
                            </p>
                        </div>
                        <div class="right">
                            <img src="{{ $product->pictures }}" alt="product image">
                        </div>

                    </div>
                    <div class="panel-footer">
                        <small><i class="glyphicon glyphicon-user"></i>&nbsp;<b>{{ $product->user->name }}</b> &mdash; <i class="glyphicon glyphicon-calendar"></i>&nbsp;{{ $product->created_at }}</small>

                        <div class="btn-group pull-right">
                            <a class="btn btn-xs btn-default" href="{{ route('store.products.edit', $product->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                            <button class="btn btn-xs btn-default" data-method="DELETE" data-uri="{{ route('store.products.destroy', $product->id) }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection