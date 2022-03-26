@extends('admin.index')
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <!-- This Form For Filter -->
                    <div style="margin-bottom: 10px;float: right">
                        <form action="{{ adminUrl('filter-transactions') }}" method="GET" class="d-inline-block">
                            <div class="row">
                                <div class="col-lg-4" id="end_at">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="end_at" value="{{$end_at ?? ''}}">
                                    </div><!-- input-group -->
                                </div>
                                <div class="col-lg-4" id="start_at">
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="start_at"
                                               value="{{$start_at ?? ''}}">
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

                    <div style="margin-bottom: 10px;">
                        <button type="button" class="modal-effect btn btn-success" data-effect="effect-scale"
                                data-toggle="modal" data-target="#add">
                            <i class="ti-plus"></i> {{trans('admin.add_transaction')}}
                        </button>
                    </div>
                    <hr>
                    @if(count($transactions))
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0">
                                <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>{{trans('admin.amount')}}</th>
                                    <th>{{trans('admin.notes')}}</th>
                                    <th>{{trans('admin.date')}}</th>
                                    <th>{{trans('admin.restaurant_name')}}</th>
                                    <th>{{trans('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <?php
                                if (isset($filter)) {
                                    $transactions = $filter;
                                } else {
                                    $transactions = $transactions;
                                }
                                $i = 1;
                                ?>
                                @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$transaction->amount}}</td>
                                        <td>{{$transaction->notes}}</td>
                                        <td>{{$transaction->date}}</td>
                                        <td>{{optional($transaction->restaurant)->name}}</td>
                                        <td>
                                            <a class="modal-effect btn btn-info" data-effect="effect-scale"
                                               data-toggle="modal" href="#edit{{ $transaction->id }}" title="تعديل">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a class="modal-effect btn btn-danger" data-effect="effect-scale"
                                               data-toggle="modal" href="#delete{{ $transaction->id }}" title="حذف">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Edit -->
                                    <div class="modal fade" id="edit{{ $transaction->id }}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLabel">{{trans('admin.edit_transaction')}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('transactions.update','test') }}"
                                                          method="post">
                                                        {{ method_field('patch') }}
                                                        {{ csrf_field() }}

                                                        <div class="row">
                                                            <div class="col">
                                                                <input type="hidden" name="id" id="id"
                                                                       value="{{ $transaction->id }}">
                                                                <label for="amount">{{trans('admin.amount')}}</label>
                                                                <input type="number" class="form-control" id="amount"
                                                                       name="amount"
                                                                       value="{{ $transaction->amount }}" required>
                                                            </div>
                                                            <div class="col">
                                                                <label
                                                                    for="restaurant_id">{{trans('admin.restaurant_name')}}</label>
                                                                <select class="form-control select2 "
                                                                        name="restaurant_id" id="restaurant_id">
                                                                    <option value="" selected disabled>اختر المطعم
                                                                    </option>
                                                                    @foreach($restaurants as $restaurant)
                                                                        <option
                                                                            value="{{ $restaurant->id }}" {{ $restaurant->id == $transaction->restaurant_id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="date">{{trans('admin.date')}}</label>
                                                                <input type="date" class="form-control" id="date"
                                                                       name="date"
                                                                       value="{{ $transaction->date }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <label for="notes">{{trans('admin.notes')}}</label>
                                                                <textarea class="form-control" name="notes" id="notes"
                                                                          rows="6">{{ $transaction->notes  }}</textarea>
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
                                    </div>
                                    <!-- Edit -->

                                    <!-- Delete -->
                                    <div class="modal fade" id="delete{{ $transaction->id }}">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content modal-content-demo">
                                                <div class="modal-header">
                                                    <h6 class="modal-title">{{trans('admin.delete_transaction')}}</h6>
                                                    <button aria-label="Close" class="close" data-dismiss="modal"
                                                            type="button"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                                <form action="{{ route('transactions.destroy','test') }}" method="post">
                                                    {{ method_field('delete') }}
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <p>{{trans('admin.msg_delete')}}</p><br>
                                                        <input type="hidden" name="id" id="id"
                                                               value="{{ $transaction->id }}">
                                                        <input class="form-control" name="name" id="name" type="text"
                                                               value="{{ $transaction->amount }}" readonly>
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
                                    <th>{{trans('admin.amount')}}</th>
                                    <th>{{trans('admin.notes')}}</th>
                                    <th>{{trans('admin.date')}}</th>
                                    <th>{{trans('admin.restaurant_name')}}</th>
                                    <th>{{trans('admin.control')}}</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                <tr>
                                    <td colspan="7" class="text-center text-danger">لا يوجد اي مدفوعات</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Add New  -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">{{trans('admin.add_transaction')}}</h6>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('transactions.store') }}" method="post">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col">
                                    <label for="amount">{{trans('admin.amount')}}</label>
                                    <input type="number" class="form-control" id="amount" name="amount"
                                           value="{{old('amount')}}" required>
                                </div>
                                <div class="col">
                                    <label for="restaurant_id">{{trans('admin.restaurant_name')}}</label>
                                    <select class="form-control select2 " name="restaurant_id" id="restaurant_id">
                                        <option value="" selected disabled>اختر المطعم</option>
                                        @foreach($restaurants as $restaurant)
                                            <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="date">{{trans('admin.date')}}</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                           value="{{old('date')}}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="notes">{{trans('admin.notes')}}</label>
                                    <textarea class="form-control" name="notes" id="notes"
                                              rows="6">{{ old('notes')  }}</textarea>
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
