@extends('admin.index')
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <!-- This Form For Filter -->
                    <div style="margin-bottom: 10px;float: left">
                        <form action="{{ route('orders.filter-status') }}" method="POST" class="d-inline-block">
                            {{ csrf_field() }}
                            <select class="custom-select mr-sm-2" name="id" data-style="btn-info" onchange="this.form.submit()">
                                <option value="" selected disabled>اختر الحالة</option>
                                <option value="completed">Completed</option>
                                <option value="pending">Pending</option>
                                <option value="received">Received</option>
                                <option value="refused">Refused</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </form>
                    </div>
                    <div style="margin-bottom: 10px;float: right">
                        <form action="{{ adminUrl('filter-orders') }}" method="GET" class="d-inline-block">
                            <div class="row">
                                <div class="col-lg-4" id="end_at">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="end_at" value="{{$end_at ?? ''}}">
                                    </div><!-- input-group -->
                                </div>
                                <div class="col-lg-4" id="start_at">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="start_at" value="{{$start_at ?? ''}}">
                                    </div><!-- input-group -->
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block">بحث من : الي</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- This Form For Filter -->
                    @if(count($orders))
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.client_name')}}</th>
                                        <th>{{trans('admin.client_phone')}}</th>
                                        <th>{{trans('admin.client_address')}}</th>
                                        <th>{{trans('admin.cost')}}</th>
                                        <th>{{trans('admin.delivery')}}</th>
                                        <th>{{trans('admin.total')}}</th>
                                        <th>{{trans('admin.payment_method')}}</th>
                                        <th>{{trans('admin.status')}}</th>
                                        <th>{{trans('admin.order_show')}}</th>
                                        <th>{{trans('admin.order_print')}}</th>
                                        <th>{{trans('admin.control')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php
                                if (isset($filter)){
                                    $offers = $filter;
                                }else{
                                    $orders = $orders;
                                }
                                $i = 1;
                                ?>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{optional($order->client)->name}}</td>
                                        <td>{{optional($order->client)->phone}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->cost}}</td>
                                        <td>{{$order->delivery_cost}}</td>
                                        <td><span class="badge badge-pill badge-primary">{{$order->total}}</span></td>
                                        <td>{{optional($order->payment_method)->name}}</td>
                                        <td>
                                            @if($order->status == 'completed')
                                                <span class="badge badge-pill badge-success">{{$order->status}}</span>
                                            @elseif($order->status == 'pending')
                                                <span class="badge badge-pill badge-warning">{{$order->status}}</span>
                                            @elseif($order->status == 'accepted')
                                                <span class="badge badge-pill badge-primary">{{$order->status}}</span>
                                            @elseif($order->status == 'rejected')
                                                <span class="badge badge-pill badge-danger">{{$order->status}}</span>
                                            @elseif($order->status == 'received')
                                                <span class="badge badge-pill badge-info">{{$order->status}}</span>
                                            @elseif($order->status == 'refused')
                                                <span class="badge badge-pill badge-secondary">{{$order->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-primary" href="{{ adminUrl('orders/'.$order->id) }}">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-secondary" href="{{ adminUrl('print_order/'.$order->id) }}">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                               data-toggle="modal" href="#delete{{ $order->id }}" title="حذف"><i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Delete -->
                                    <div class="modal fade" id="delete{{ $order->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{trans('admin.delete_order')}}</h6>
                                                    <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('orders.destroy','test') }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>{{trans('admin.msg_delete')}}</p><br>
                                                        <input type="hidden" name="id" id="id" value="{{ $order->id }}">
                                                        <input class="form-control" name="title" id="title" type="text"
                                                               value="{{ $order->id }}" readonly>
                                                        <br>
                                                        <input class="form-control" name="title" id="title" type="text"
                                                               value="{{ optional($order->client)->name }}" readonly>
                                                        <br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{trans('admin.btn_close')}}</button>
                                                        <button type="submit"
                                                                class="btn btn-danger">{{trans('admin.btn_confirm')}}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete -->

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                                <thead class="text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>{{trans('admin.client_name')}}</th>
                                        <th>{{trans('admin.client_phone')}}</th>
                                        <th>{{trans('admin.client_address')}}</th>
                                        <th>{{trans('admin.cost')}}</th>
                                        <th>{{trans('admin.delivery')}}</th>
                                        <th>{{trans('admin.total')}}</th>
                                        <th>{{trans('admin.payment_method')}}</th>
                                        <th>{{trans('admin.status')}}</th>
                                        <th>{{trans('admin.order_show')}}</th>
                                        <th>{{trans('admin.order_print')}}</th>
                                        <th>{{trans('admin.control')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                <tr>
                                    <td colspan="12" class="text-center text-danger">لا يوجد اي طلبات</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
