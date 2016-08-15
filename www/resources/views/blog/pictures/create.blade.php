@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1>New picture</h1>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::model($picture, [
                    'files' => true,
                    'route' => ['blog.pictures.store'],
                ]) !!}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        {!! Form::label($name = 'picture', $value = 'Source', $options = [
                            'class' => 'control-label',
                        ]) !!}
                        {!! Form::file($name = 'picture', $options = [
                            'accept' => '.jpg,.jpeg,.png,.svg,image/*', // @link http://www.iana.org/assignments/media-types/media-types.xhtml#image
                        ]) !!}
                        <p class="help-block">Upload a picture</p>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        {!! Form::label($name = 'alternate_text', $value = 'Alternate Text', $options = [
                            'class' => 'control-label',
                        ]) !!}
                        {!! Form::text($name = 'alternate_text', $value = null , $options = [
                            'class' => 'form-control',
                            'placeholder' => 'The alternate text for your picture&hellip;',
                        ]) !!}
                    </div>
                    {!! Form::submit($value = 'Save', $options = [
                        'class' => 'btn btn-primary',
                    ]) !!}
                    {!! link_to_route($name = 'blog.pictures.index', $title = 'Cancel', $parameters = null, $attributes = [
                        'class' => 'btn btn-default',
                    ]) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection