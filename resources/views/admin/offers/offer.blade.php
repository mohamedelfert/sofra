@extends('admin.index')
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="col-md-12">
                            <form id="messages">
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-12">
                                        <label for="title">{{ trans('admin.offer_title') }}</label>
                                        <input type="text" name="title" class="form-control" id="title"
                                               disabled value="{{ $offer->title }}">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-6">
                                        <label for="restaurant_name">{{ trans('admin.restaurant_name') }}</label>
                                        <input type="text" name="restaurant_name" class="form-control" id="restaurant_name"
                                               disabled value="{{ optional($offer->restaurant)->name }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="status">{{ trans('admin.offer_status') }}</label>
                                        <input type="text" name="status" class="form-control" id="status"
                                               disabled value="{{ $offer->status }}">
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 5px">
                                    <div class="col-6">
                                        <label for="start_at">{{ trans('admin.offer_start') }}</label>
                                        <input type="text" name="start_at" class="form-control" id="start_at"
                                               disabled value="{{ $offer->start_at }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="end_at">{{ trans('admin.offer_end') }}</label>
                                        <input type="text" name="end_at" class="form-control" id="end_at"
                                               disabled value="{{ $offer->end_at }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="description">{{ trans('admin.offer_description') }}</label>
                                    <textarea class="form-control" name="description" id="description" rows="6" disabled>{{ $offer->description }}ه</textarea>
                                </div>
                                <div class="form-group">
                                    <img class="img-fluid mb-3" src="{{ URL::asset($offer->image) }}" alt="Offer image" style="width: 130px;height: 100px;">
                                </div>
                            </form>
                            <div class="text-center">
                                <a href="{{ adminUrl('offers') }}" class="btn btn-block btn-primary">العودة للعروض</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- row closed -->
@endsection
