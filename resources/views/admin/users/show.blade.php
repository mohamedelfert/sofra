@extends('admin.index')
@section('content')

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-lg-6 mb-4 mb-lg-0">
                                <div class="card mb-3" style="border-radius: .5rem;">
                                    <div class="row g-0">
                                        <div class="col-md-4 gradient-custom text-center text-white"
                                             style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                            <img
                                                src="{{URL::asset('assets/img/faces/avatar.jpg')}}"
                                                alt="..."
                                                class="img-fluid my-5 brround"
                                                style="width: 80px;"
                                            />
                                            <h5>
                                                @if ($user->role_name == 'superAdmin')
                                                    المدير العام
                                                @elseif($user->role_name == 'admin')
                                                    المدير
                                                @elseif($user->role_name == 'user')
                                                    مستخدم
                                                @endif
                                            </h5>
                                            <i class="far fa-user fa-2x mb-5"></i>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body p-4">
                                                <h6>بيانات المستخدم</h6>
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>اسم المستخدم</h6>
                                                        <p class="label text-primary d-flex">{{ $user->name }}</p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>البريد الالكتروني</h6>
                                                        <p class="label text-warning d-flexd">{{ $user->email }}</p>
                                                    </div>
                                                </div>
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h6>الحاله</h6>
                                                        <p class="text-muted">
                                                            @if ($user->status == 'مفعل')
                                                                <span
                                                                    class="label text-success d-flex">{{ $user->status }}</span>
                                                            @else
                                                                <span
                                                                    class="label text-danger d-flex">{{ $user->status }}</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h6>تسجيل في</h6>
                                                        <p class="text-muted">
                                                            <span
                                                                class="label text-info d-flex">{{ $user->created_at }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--/div-->
    </div>

    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
