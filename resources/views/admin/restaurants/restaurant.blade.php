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
                                <h3 class="card-title">Restaurant Details</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.restaurant_name') }}</span>
                                                        <span
                                                            class="info-box-number text-center text-muted mb-0">{{ $restaurant->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.phone') }}</span>
                                                        <span
                                                            class="info-box-number text-center mb-0 badge badge-pill badge-success">{{ $restaurant->phone }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.email') }}</span>
                                                        <span
                                                            class="info-box-number text-center mb-0 badge badge-pill badge-warning">{{ $restaurant->email }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.second_phone') }}</span>
                                                        <span
                                                            class="info-box-number text-center mb-0 badge badge-pill badge-primary">{{ $restaurant->second_phone }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.region_name') }}</span>
                                                        <span
                                                            class="info-box-number text-center mb-0 badge badge-pill badge-danger">{{ optional($restaurant->region)->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.city_name') }}</span>
                                                        <span
                                                            class="info-box-number text-center text-muted mb-0">{{ optional($restaurant->region->city)->name }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.whatsapp') }}</span>
                                                        <span
                                                            class="info-box-number text-center mb-0 badge badge-pill badge-secondary">{{ $restaurant->whatsapp }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.minimum_order') }}</span>
                                                        <span
                                                            class="info-box-number text-center mb-0 badge badge-pill badge-success">{{ $restaurant->minimum_order }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.delivery_fee') }}</span>
                                                        <span
                                                            class="info-box-number text-center mb-0 badge badge-pill badge-info">{{ $restaurant->delivery_fee }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.status') }}</span>
                                                        <span
                                                            class="info-box-number text-center text-muted mb-0">{{ $restaurant->status }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-4">
                                                <div class="info-box bg-light">
                                                    <div class="info-box-content">
                                                        <span
                                                            class="info-box-text text-center text-muted">{{ trans('admin.active') }}</span>
                                                        <span
                                                            class="info-box-number text-center text-muted mb-0">{{ $restaurant->is_active === 1 ? 'Active' : 'Not Active' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="post">
                                                    <h3>{{ trans('admin.items') }}</h3>
                                                    <div class="row">
                                                        @foreach($restaurant->items as $item)
                                                            <div class="col-12 col-sm-4">
                                                                <div class="info-box bg-light">
                                                                    <div class="info-box-content">
                                                                        <span class="info-box-number text-center mb-0 badge badge-pill badge-secondary">Name : {{ $item->name }}</span>
                                                                        <span class="info-box-number text-center mb-0 badge badge-pill badge-primary">Price : {{ $item->price }} $</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="post">
                                                    <h3>{{ trans('admin.orders') }}</h3>
                                                    <div class="row">
                                                        @foreach($restaurant->orders as $order)
                                                            <div class="col-12 col-sm-4">
                                                                <div class="info-box bg-light">
                                                                    <div class="info-box-content">
                                                                        <span class="info-box-number text-center text-muted mb-0">Number : {{ $order->id }}</span>
                                                                        <span class="info-box-number text-center text-muted mb-0">Cost : {{ $order->cost }} $</span>
                                                                        <span class="info-box-number text-center text-muted mb-0">Total : {{ $order->total }} $</span>
                                                                        <span class="info-box-number text-center mb-0 badge badge-pill badge-{{ $order->status == 'completed' ? 'success' : 'warning' }}">Status : {{ $order->status }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2" style="padding-left: 2%">
                                        <h3 class="text-primary"><i class="fas fa-image"></i> {{ trans('admin.image') }} </h3>
                                        <p class="text-muted">
                                            <img class="img-circle mb-3" src="{{ URL::asset($restaurant->image) }}" alt="Offer image" style="width: 80px;height: 50px;">
                                        </p>
                                        <hr>
                                        <h3>{{ trans('admin.categories') }}</h3>
                                        <div class="row">
                                            @foreach($restaurant->categories as $category)
                                                <div class="col-12 col-sm-12">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-number text-center text-muted mb-0">{{ $category->name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <hr>
                                        <h3>{{ trans('admin.offers') }}</h3>
                                        <div class="row">
                                            @foreach($restaurant->offers as $offer)
                                                <div class="col-12 col-sm-12">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-info">{{ $offer->title }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-secondary">{{ $offer->start_at }}</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-warning">{{ $offer->end_at }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>

        </div>
        <!-- row closed -->
@endsection
