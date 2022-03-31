@extends('admin.index')
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <!-- This Form For Filter -->
                    <div style="margin-bottom: 10px;float: left">
                        <form action="{{ route('restaurants.status-filter') }}" method="POST" class="d-inline-block">
                            {{ csrf_field() }}
                            <select class="custom-select mr-sm-2" name="id" data-style="btn-info" onchange="this.form.submit()">
                                <option value="" selected disabled>اختر الحالة</option>
                                <option value="open">Open</option>
                                <option value="close">Close</option>
                            </select>
                        </form>
                    </div>
                    <div style="margin-bottom: 10px;float: right">
                        <form action="{{ adminUrl('filter-restaurants') }}" method="GET" class="d-inline-block">
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
                    @if(count($restaurants))
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                                <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.email')}}</th>
                                    <th>{{trans('admin.phone')}}</th>
                                    <th>{{trans('admin.region_name')}}</th>
                                    <th>{{trans('admin.status')}}</th>
                                    <th>{{trans('admin.active')}}</th>
                                    <th>{{trans('admin.restaurant_show')}}</th>
                                    <th>{{trans('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php
                                if (isset($filter)){
                                    $offers = $filter;
                                }else{
                                    $restaurants = $restaurants;
                                }
                                $i = 1;
                                ?>
                                @foreach($restaurants as $restaurant)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$restaurant->name}}</td>
                                        <td>{{$restaurant->email}}</td>
                                        <td>{{$restaurant->phone}}</td>
                                        <td>{{optional($restaurant->region)->name}}</td>
                                        <td>{{$restaurant->status}}</td>
                                        <td>
                                            @if($restaurant->is_active == 0)
                                                <a href="restaurant-activate/{{$restaurant->id}}">
                                                    <span class="badge badge-pill badge-success">تفعيل</span>
                                                </a>
                                            @elseif($restaurant->is_active == 1)
                                                <a href="restaurant-deactivate/{{$restaurant->id}}">
                                                    <span class="badge badge-pill badge-danger">الغاء التفعيل</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a type="button" class="btn btn-primary" href="{{ adminUrl('restaurants/'.$restaurant->id) }}">
                                                <i class="ti-plus"></i>show
                                            </a>
                                        </td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                               data-toggle="modal" href="#delete{{ $restaurant->id }}" title="حذف"><i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Delete -->
                                    <div class="modal fade" id="delete{{ $restaurant->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{trans('admin.delete_restaurant')}}</h6>
                                                    <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('restaurants.destroy','test') }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>{{trans('admin.msg_delete')}}</p><br>
                                                        <input type="hidden" name="id" id="id" value="{{ $restaurant->id }}">
                                                        <input class="form-control" name="title" id="title" type="text"
                                                               value="{{ $restaurant->name }}" readonly>
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
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.email')}}</th>
                                    <th>{{trans('admin.phone')}}</th>
                                    <th>{{trans('admin.region_name')}}</th>
                                    <th>{{trans('admin.status')}}</th>
                                    <th>{{trans('admin.active')}}</th>
                                    <th>{{trans('admin.restaurant_show')}}</th>
                                    <th>{{trans('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <tr>
                                    <td colspan="9" class="text-center text-danger">لايوجد اي مطاعم</td>
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
