@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>Edit post</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::model($product, [
                    'method' => 'put',
                    'route' => ['store.products.update', $product->id],
                ]) !!}
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    {!! Form::label($name = 'title', $value = 'Title', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::text($name = 'title', $value = null , $options = [
                        'class' => 'form-control',
                        'placeholder' => 'The title of your product&hellip;',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($name = 'pictures', $value = 'Pictures', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::text($name = 'pictures', $value = null , $options = [
                        'class' => 'form-control',
                        'placeholder' => 'hier de url van uw afbeelding (beta)',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($name = 'btw', $value = 'BTW-Tarief', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::text($name = 'btw', $value = null , $options = [
                        'class' => 'form-control',
                        'placeholder' => '%',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($name = 'sale', $value = 'Sale', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::text($name = 'sale', $value = null , $options = [
                        'class' => 'form-control',
                        'placeholder' => '%',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($name = 'stock', $value = 'In Stock', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    <div class="radio">
                        <label>
                            {!! Form::radio($name = 'stock', $value = null , $options = [
                            'class' => 'radio',
                            ]) !!} Yes/No
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label($name = 'price', $value = 'Price', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::text($name = 'price', $value = null , $options = [
                        'class' => 'form-control',
                        'placeholder' => 'The price of your product&hellip;'
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($name = 'content', $value = 'Content', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::textarea($name = 'content', $value = null, $options = [
                        'class' => 'form-control',
                        'placeholder' => 'Write your description here&hellip;',
                    ]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label($name = 'category', $value = 'Category', $options = [
                        'class' => 'control-label',
                    ]) !!}
                    {!! Form::select($name = 'category', $value = $categories, $selected = $product->category->id, $options = [
                        'class' => 'form-control',
                    ]) !!}
                </div>
                {!! Form::submit($value = 'Save', $options = [
                    'class' => 'btn btn-primary',
                ]) !!}
                {!! link_to_route($name = 'store.products.index', $value = 'Cancel', $parameters = null, $attributes = [
                    'class' => 'btn btn-default',
                ]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection