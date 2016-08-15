@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <p><a class="btn btn-default" href="{{ route('store.products.create') }}" data-toggle="tooltip" data-placement="right" title="New product"><i class="glyphicon glyphicon-pencil"></i></a></p>
                @foreach ($products as $product)
                    <div class="panel panel-primary product">
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
                            </div>
                            <div class="right">
                                <img src="{{ $product->pictures }}" alt="product image">
                            </div>

                        </div>
                        <div class="panel-footer">
                            <small><i class="glyphicon glyphicon-user"></i>&nbsp;<b>{{ $product->user->name }}</b> &mdash; <i class="glyphicon glyphicon-calendar"></i>&nbsp;{{ $product->created_at }}</small>

                            <div class="btn-group pull-right">
                                <a class="btn btn-xs btn-default" href="{{ route('store.products.show', $product->id) }}" data-toggle="tooltip" data-placement="top" title="Show"><i class="glyphicon glyphicon-open-file"></i></a>
                                <a class="btn btn-xs btn-default" href="{{ route('store.products.edit', $product->id) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                <button class="btn btn-xs btn-default" data-method="DELETE" data-uri="{{ route('store.products.destroy', $product->id) }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts-bottom')
<script>
    $(function () {
        // Tooltip
        $('[data-toggle=tooltip]')
                .tooltip();

        // Delete buttons
        $('button[data-method]').on('click', function () {
            var self = $(this),
                    product = self.parents('.product');
            product.hide();
            $.ajax({
                        url: self.data('uri'),
                        type: self.data('method'),
                        data: {
                            _token : '{!! csrf_token() !!}'
                        }
                    })
                    .success(function (response) {
                        console.log('deleted:', self.data('uri'), response);
                    })
                    .error(function (error) {
                        product.show();
                        console.error('error:', self.data('uri'), error);
                    });
        });
    });
</script>
@endpush