@extends('admin.index')
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <!-- This Form For Filter -->
                    <div style="margin-bottom: 10px;float: right">
                        <form action="{{ adminUrl('filter-offers') }}" method="GET" class="d-inline-block">
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
                    @if(count($offers))
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                                <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('admin.offer_title')}}</th>
                                    <th>{{trans('admin.restaurant_name')}}</th>
                                    <th>{{trans('admin.offer_start')}}</th>
                                    <th>{{trans('admin.offer_end')}}</th>
                                    <th>{{trans('admin.contact_show')}}</th>
                                    <th>{{trans('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php
                                if (isset($filter)){
                                    $offers = $filter;
                                }else{
                                    $offers = $offers;
                                }
                                $i = 1;
                                ?>
                                @foreach($offers as $offer)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$offer->title}}</td>
                                        <td>{{optional($offer->restaurant)->name}}</td>
                                        <td>{{$offer->start_at}}</td>
                                        <td>{{$offer->end_at}}</td>
                                        <td>
                                            <a type="button" class="btn btn-primary" href="{{ adminUrl('offers/'.$offer->id) }}">
                                                <i class="ti-plus"></i>show
                                            </a>
                                        </td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                               data-toggle="modal" href="#delete{{ $offer->id }}" title="حذف"><i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Delete -->
                                    <div class="modal fade" id="delete{{ $offer->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{trans('admin.delete_offer')}}</h6>
                                                    <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('offers.destroy','test') }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>{{trans('admin.msg_delete')}}</p><br>
                                                        <input type="hidden" name="id" id="id" value="{{ $offer->id }}">
                                                        <input class="form-control" name="title" id="title" type="text"
                                                               value="{{ $offer->title }}" readonly>
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
                                    <th>{{trans('admin.offer_title')}}</th>
                                    <th>{{trans('admin.restaurant_name')}}</th>
                                    <th>{{trans('admin.offer_start')}}</th>
                                    <th>{{trans('admin.offer_end')}}</th>
                                    <th>{{trans('admin.contact_show')}}</th>
                                    <th>{{trans('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <tr>
                                    <td colspan="7" class="text-center text-danger">لايوجد اي عروض</td>
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
