@extends('admin.index')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>5</h3>
                        <p>{{ trans('main.donations') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <a href="{{ adminUrl() }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>5</h3>
                        <p>{{ trans('main.posts') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-pen-alt"></i>
                    </div>
                    <a href="{{ adminUrl() }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>5</h3>
                        <p>{{ trans('main.clients') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{ adminUrl() }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>5</h3>
                        <p>{{ trans('main.contacts') }}</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    <a href="{{ adminUrl() }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- Donations --}}
            <section class="col-lg-7 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title text-danger">
                            <i class="fas fa-hand-holding-usd mr-1"></i>
                            Last Donations Requests
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="tab-content p-0">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <b>Patient Name :</b>
                                        <span class="info-box-number text-center mb-0 badge badge-pill badge-dark">fdsf</span>
                                    </h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                            <div class="row">
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">Phone</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-success">fdsf</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">City</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-warning">fsdf</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">Governorate</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-secondary">fsdf</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">Age</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-primary">fsdfd</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">blood Type</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-danger">fsdf</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center text-muted">Bags Num</span>
                                                            <span class="info-box-number text-center mb-0 badge badge-pill badge-info">sdfsd</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-12 col-sm-12">
                                                    <div class="info-box bg-light">
                                                        <div class="info-box-content">
                                                            <span class="info-box-text text-center mb-0 badge badge-info">Donation Notes</span>
                                                            <span class="info-box-number text-center text-muted mb-0">fsdf</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2" style="padding-left: 2%">
                                            <h3 class="text-primary"><i class="fas fa-hospital"></i> Hospital </h3>
                                            <p class="text-muted">
                                                <span class="info-box-number text-center mb-0 badge badge-pill badge-success">fsdf</span>
                                            </p>
                                            <br>
                                            <div class="text-muted">
                                                <p class="text-sm">Hospital Address
                                                    <b class="d-block"><span class="info-box-number text-center mb-0 badge badge-pill badge-warning">sdf</span></b>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- Donations --}}

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
                                <div class="col-12 col-sm-6 col-md-6 align-items-stretch">
                                <div class="card bg-light">
                                    <div class="card-header text-muted border-bottom-0">
                                        <b>Name: </b>sfdf
                                    </div>
                                    <hr>
                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-12">
                                                <h2 class="lead"><b>sdf</b></h2>
                                                <p class="text-muted text-sm"><b>Message: </b> fsdf </p>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-clock"></i></span> fsdf </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="text-right">
                                            <a href="{{ adminUrl() }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-user"></i> View Message
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- Contacts --}}
        </div>
    </div>
@endsection
