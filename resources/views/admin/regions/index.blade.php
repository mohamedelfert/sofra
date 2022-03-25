@extends('admin.index')
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div style="margin-bottom: 10px;">
                        <button type="button" class="modal-effect btn btn-success" data-effect="effect-scale"
                                data-toggle="modal" data-target="#add">
                            <i class="ti-plus"></i> {{trans('admin.add_region')}}
                        </button>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0">
                            <thead class="text-center">
                            <tr>
                                <th>#</th>
                                <th>{{trans('admin.region_name')}}</th>
                                <th>{{trans('admin.city_name')}}</th>
                                <th>{{trans('admin.control')}}</th>
                            </tr>
                            </thead>
                            <tbody class="text-center">
                            <?php $i = 1; ?>
                            @foreach($regions as $region)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$region->name}}</td>
                                    <td>{{optional($region->city)->name}}</td>
                                    <td>
                                        <a class="modal-effect btn btn-info" data-effect="effect-scale"
                                           data-toggle="modal" href="#edit{{ $region->id }}" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="modal-effect btn btn-danger" data-effect="effect-scale"
                                           data-toggle="modal" href="#delete{{ $region->id }}" title="حذف">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>

                                <!-- Edit -->
                                <div class="modal fade" id="edit{{ $region->id }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="exampleModalLabel">{{trans('admin.edit_region')}}</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('regions.update','test') }}" method="post">
                                                {{ method_field('patch') }}
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="hidden" name="id" id="id" value="{{ $region->id }}">
                                                            <label
                                                                for="exampleInputEmail1">{{trans('admin.city_name')}}</label>
                                                            <input type="text" class="form-control" id="name"
                                                                   name="name" value="{{ $region->name }}" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="governorate_id">المدينه</label>
                                                            <select class="form-control select2 " name="city_id" id="city_id" >
                                                                <option value="" selected disabled>اختر المدينه</option>
                                                                @foreach($cities as $city)
                                                                    <option value="{{ $city->id }}" {{ $city->id == $region->city_id ? 'selected': '' }}>{{ $city->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                            class="btn btn-primary">{{trans('admin.btn_confirm')}}</button>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{trans('admin.btn_close')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Edit -->

                                <!-- Delete -->
                                <div class="modal fade" id="delete{{ $region->id }}">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content modal-content-demo">
                                            <div class="modal-header">
                                                <h6 class="modal-title">{{trans('admin.delete_region')}}</h6>
                                                <button aria-label="Close" class="close" data-dismiss="modal"
                                                        type="button"><span
                                                        aria-hidden="true">&times;</span></button>
                                            </div>
                                            <form action="{{ route('regions.destroy','test') }}" method="post">
                                                {{ method_field('delete') }}
                                                {{ csrf_field() }}
                                                <div class="modal-body">
                                                    <p>{{trans('admin.msg_delete')}}</p><br>
                                                    <input type="hidden" name="id" id="id" value="{{ $region->id }}">
                                                    <input class="form-control" name="name" id="name" type="text"
                                                           value="{{ $region->name }}" readonly>
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
                </div>
            </div>
        </div>

        <!-- Add New  -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">{{trans('admin.add_region')}}</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('regions.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col">
                                    <label for="exampleInputEmail1">{{trans('admin.region_name')}}</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{old('name')}}" required>
                                </div>
                                <div class="col">
                                    <label for="governorate_id">المدينه</label>
                                    <select class="form-control select2 " name="city_id" id="city_id" >
                                        <option value="" selected disabled>اختر المدينه</option>
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit"
                                        class="btn btn-success">{{trans('admin.btn_confirm')}}</button>
                                <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{trans('admin.btn_close')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add New -->

    </div>
    <!-- row closed -->
@endsection
