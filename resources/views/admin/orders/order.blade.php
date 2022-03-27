@extends('admin.index')
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Details</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="main-content-body-invoice" id="print">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                            <div class="row">
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.order_number') }}</span>
                                                            <span class="info-box-number text-center text-muted mb-0">{{ $order->id }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.client_name') }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-info">{{ optional($order->client)->name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.client_phone') }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-warning">{{ optional($order->client)->phone }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.cost') }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-primary">{{ $order->cost }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.delivery') }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-danger">{{ $order->delivery_cost }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.total') }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-dark">{{ $order->total }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.delivery_at') }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-secondary">{{ $order->delivery_at }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.status') }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-success">{{ $order->status }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.client_delivery_confirm') }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-{{$order->client_delivery_confirm == 1 ? 'success' : 'info'}}">{{ $order->client_delivery_confirm == 1 ? 'confirm' : 'Not Confirm' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.restaurant_delivery_confirm') }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-{{$order->restaurant_delivery_confirm == 1 ? 'success' : 'info'}}">{{ $order->restaurant_delivery_confirm == 1 ? 'confirm' : 'Not Confirm' }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.payment_method') }}</span>
                                                            <span class="info-box-number text-center text-muted mb-0">{{ optional($order->payment_method)->name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-12">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">{{ trans('admin.notes') }}</span>
                                                            <span class="info-box-number text-center text-muted mb-0">{{ $order->notes }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2" style="padding-left: 2%">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="post">
                                                    <h3>{{ trans('admin.items') }}</h3>
                                                    <div class="row">
                                                        @foreach($order->items as $item)
                                                            <div class="col-12 col-sm-6">
                                                                <div class="info-box bg-light">
                                                                    <div class="info-box-content">
                                                                        <span class="info-box-number text-center mb-0 badge badge-pill badge-secondary">Name : {{ $item->name }}</span>
                                                                        <span class="info-box-number text-center mb-0 badge badge-pill badge-primary">Price : {{ $item->price }} $</span>
                                                                        <img class="img-circle mb-3" src="{{ URL::asset($item->image) }}" alt="Item image" style="width: 80px;height: 50px;margin: 10% 20%;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <a href="#" class="btn btn-info float-left mt-3 mr-2" id="order_print" onclick="printOrder()">
                                <i class="fas fa-print ml-1"></i> طباعه
                            </a>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
@endsection

@push('css')
    <style>
        @media print {
            #order_print{ display: none; }
        }
    </style>
@endpush

@push('js')
    <script>
        function printOrder(){
            var content = document.getElementById('print').innerHTML;
            document.body.innerHTML = content;
            window.print();
            location.reload();
        }
    </script>
@endpush
