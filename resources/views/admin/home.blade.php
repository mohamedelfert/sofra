@extends('admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ App\Models\Client::count()  }}</h3>
                        <p>{{ trans('main.clients') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ adminUrl('clients') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ App\Models\Restaurant::count()  }}</h3>
                        <p>{{ trans('main.restaurants') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-utensils"></i>
                    </div>
                    <a href="{{ adminUrl('restaurants') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ App\Models\Order::count()  }}</h3>
                        <p>{{ trans('main.orders') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-coffee"></i>
                    </div>
                    <a href="{{ adminUrl('orders') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ App\Models\Offer::count()  }}</h3>
                        <p>{{ trans('main.offers') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-asterisk"></i>
                    </div>
                    <a href="{{ adminUrl('offers') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- Contacts --}}
            <section class="col-lg-5 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-info">
                            <i class="fas fa-envelope-open mr-1"></i>
                            Last Contacts
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0 row d-flex align-items-stretch">
                            @foreach($contacts = App\Models\Contact::orderBy('id','desc')->paginate(4) as $contact)
                                <div class="col-12 col-sm-6 col-md-6 align-items-stretch">
                                    <div class="card bg-light">
                                        <div class="card-header text-muted border-bottom-0">
                                            <b>Name: </b>{{ $contact->name }}
                                        </div>
                                        <hr>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h2 class="lead"><b>{{ mb_strlen($contact->subject) > 35 ? mb_substr($contact->subject,0,35) : $contact->subject }}</b></h2>
                                                    <p class="text-muted text-sm"><b>Message: </b> {{ mb_strlen($contact->message) > 60 ? mb_substr($contact->message,0,60) : $contact->message }} </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span> {{ $contact->created_at }} </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="text-right">
                                                <a href="{{ adminUrl('contacts/'.$contact->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-user"></i> View Message
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            {{-- Contacts --}}
        </div>
    </div>
@endsection
