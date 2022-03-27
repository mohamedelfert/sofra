@extends('admin.index')
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <!-- This Form For Filter -->
                    <div style="margin-bottom: 10px;float: left">
                        <form action="{{ route('clients.active-filter') }}" method="POST" class="d-inline-block">
                            {{ csrf_field() }}
                            <select class="custom-select mr-sm-2" name="id" data-style="btn-info" onchange="this.form.submit()">
                                <option value="" selected disabled>اختر الحالة</option>
                                <option value="1">Active</option>
                                <option value="0">Not Active</option>
                            </select>
                        </form>
                    </div>
                    <div style="margin-bottom: 10px;float: right">
                        <form action="{{ adminUrl('filter-clients') }}" method="GET" class="d-inline-block">
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
                    @if(count($clients))
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                                <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('admin.name')}}</th>
                                    <th>{{trans('admin.email')}}</th>
                                    <th>{{trans('admin.phone')}}</th>
                                    <th>{{trans('admin.region_name')}}</th>
                                    <th>{{trans('admin.city_name')}}</th>
                                    <th>{{trans('admin.image')}}</th>
                                    <th>{{trans('admin.active')}}</th>
                                    <th>{{trans('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php
                                if (isset($filter)){
                                    $offers = $filter;
                                }else{
                                    $clients = $clients;
                                }
                                $i = 1;
                                ?>
                                @foreach($clients as $client)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$client->name}}</td>
                                        <td>{{$client->email}}</td>
                                        <td>{{$client->phone}}</td>
                                        <td>{{optional($client->region)->name}}</td>
                                        <td>{{optional($client->region->city)->name}}</td>
                                        <td><img class="img-circle mb-3" src="{{ URL::asset($client->image) }}" alt="Client image" style="width: 80px;height: 50px;"></td>
                                        <td>
                                            @if($client->is_active == 0)
                                                <a href="activate/{{$client->id}}">
                                                    <span class="badge badge-pill badge-success">تفعيل</span>
                                                </a>
                                            @elseif($client->is_active == 1)
                                                <a href="deactivate/{{$client->id}}">
                                                    <span class="badge badge-pill badge-danger">الغاء التفعيل</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                               data-toggle="modal" href="#delete{{ $client->id }}" title="حذف"><i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Delete -->
                                    <div class="modal fade" id="delete{{ $client->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{trans('admin.delete_client')}}</h6>
                                                    <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('clients.destroy','test') }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>{{trans('admin.msg_delete')}}</p><br>
                                                        <input type="hidden" name="id" id="id" value="{{ $client->id }}">
                                                        <input class="form-control" name="title" id="title" type="text"
                                                               value="{{ $client->name }}" readonly>
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
                                        <th>{{trans('admin.city_name')}}</th>
                                        <th>{{trans('admin.image')}}</th>
                                        <th>{{trans('admin.active')}}</th>
                                        <th>{{trans('admin.control')}}</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                <tr>
                                    <td colspan="9" class="text-center text-danger">لا يوجد اي عملاء</td>
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
