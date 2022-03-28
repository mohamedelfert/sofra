@extends('admin.index')
@push('css')
    <style>
        @media print {
            #order_print{ display: none; }
        }
    </style>
@endpush
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Details</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="main-content-body-invoice" id="print">
                                    <div class="invoice-header">
                                        <div class="billed-from">
                                            <h6>Sofra System</h6>
                                            <p>
                                                Tel No: {{ $settings->phone }}<br>
                                                Email: {{ $settings->email }}
                                            </p>
                                        </div><!-- billed-from -->
                                    </div><!-- invoice-header -->

                                    <hr style="border: 1px solid #d9dbe0">

                                    <div class="row mg-t-20">
                                        <div class="col-md">
                                            <label class="tx-gray-600">Bill To :</label>
                                            <div class="billed-to">
                                                <h6>Name : {{ optional($order->client)->name }}</h6>
                                                <p>Address : {{ optional($order->client->region)->name }}</p>
                                                <p>Tel No : <span> {{ optional($order->client)->phone }} </span></p>
                                                <p>E-mail : <span> {{ optional($order->client)->email }} </span></p>
                                            </div>
                                        </div>

                                        <div class="col-md">
                                            <label class="tx-gray-600">Order Details</label>
                                            <p class="invoice-info-row"><span>Order Number :</span> <span>{{ $order->id }}</span></p>
                                            <p class="invoice-info-row"><span>Date :</span> <span>{{ date('Y-m-d') }}</span></p>
                                            <p class="invoice-info-row"><span>Restaurant :</span> <span>{{ optional($order->restaurant)->name }}</span></p>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="table-responsive mg-t-40">
                                        <table class="table table-invoice border text-md-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="wd-20p">#</th>
                                                    <th class="wd-40p">Items</th>
                                                    <th class="tx-center">Price</th>
                                                    <th class="wd-40p">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($order->items as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td class="tx-12">{{ $item->name }}</td>
                                                        <td class="tx-center">${{ number_format($item->pivot->price , 2) }}</td>
                                                        <td class="tx-12">{{ $item->pivot->quantity }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="valign-middle" colspan="1" rowspan="4">
                                                        <div class="order-notes">
                                                            <label class="main-content-label tx-13"></label>
                                                        </div><!-- invoice-notes -->
                                                    </td>
                                                    <td class="tx-right font-weight-bold">Total</td>
                                                    <td class="tx-right" colspan="2">${{ number_format($order->total, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right font-weight-bold">Delivery Fee</td>
                                                    <td class="tx-right" colspan="2">${{$order->delivery_cost}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right font-weight-bold">Discount</td>
                                                    <td class="tx-right" colspan="2">$ 00.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right tx-uppercase tx-bold tx-inverse font-weight-bold">Total + Tax</td>
                                                    <td class="tx-right" colspan="2">
                                                        <h4 class="tx-primary tx-bold">${{number_format($order->total , 2)}}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <hr class="mg-b-40">
                            <a href="#" class="btn btn-info float-left mt-3 mr-2" id="order_print" onclick="printOrder()">
                                <i class="fas fa-print ml-1"></i> طباعه
                            </a>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
@endsection

@push('js')
    <script>
        function printOrder(){
            var content = document.getElementById('print').innerHTML;
            document.body.innerHTML = content;
            window.print();
            location.reload();
        }
    </script>
@endpush
