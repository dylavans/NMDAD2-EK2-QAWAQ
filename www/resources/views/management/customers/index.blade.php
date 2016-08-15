@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @foreach ($customers as $customer)
                    <div class="panel panel-primary customer">
                        <div class="panel-heading">
                            {{ $customer->user_name }}
                            <span class="label label-info pull-right">Bestellingen:</span>
                        </div>
                        <div class="panel-body">
                            <div class="left">
                                <p>
                                    <strong>First name:</strong>
                                    {{ $customer->first_name }}
                                </p>
                                <p>
                                    <strong>Last name:</strong>
                                    {{ $customer->last_name }}
                                </p>
                                <p>
                                    <strong>Email:</strong>
                                    {{ $customer->email }}
                                </p>
                        </div>
                        </div>
                        <div class="panel-footer">
                            <small><i class="glyphicon glyphicon-calendar"></i>&nbsp;{{ $customer->created_at }}</small>

                            <div class="btn-group pull-right">
                                <button class="btn btn-xs btn-default" data-method="DELETE" data-uri="{{ route('management.customers.destroy', $customer->id) }}" data-toggle="tooltip" data-placement="top" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
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
                    customer = self.parents('.customer');
            customer.hide();
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
                        customer.show();
                        console.error('error:', self.data('uri'), error);
                    });
        });
    });
</script>
@endpush