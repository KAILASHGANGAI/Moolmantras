@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="container">
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #{{ $order->id }}</h2>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <span class="me-3">{{ $order->created_at }}</span>
                                    <span class="me-3">#{{ $order->id }}</span>

                                    <span class="badge rounded-pill bg-info">{{ Str::upper($order->status) }}</span>
                                </div>
                                <div class="d-flex">
                                    <a hresf="{{ url('/admin/checkout/bill?order=' . $order->id) }}" class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text"><i
                                            class="bi bi-download"></i> <span class="text"><i class="fas fa-print">
                                            </i></span></a>
                                    
                                </div>
                            </div>
                            
                            <table class="table table-borderless">
                                <tbody>
                                    @foreach ($order->orderProducts as $key => $item)
                                   
                                    <tr>
                                            <td>
                                                <div class="d-flex mb-2">
                                                    <div class="flex-shrink-0">
                                                        <img src="{{ asset($item->product->image) }}" alt=""
                                                            width="35" class="img-fluid p-1">
                                                    </div>
                                                    <div class="flex-lg-grow-1 ms-3">
                                                        <h6 class="small mb-0">
                                                            <a class="h6" href="{{ route('showProduct', $item->product->sku) }}" class="text-reset">
                                                              {{  $item->product->product_name }}
                                                            </a>
                                                        </h6>
                                                        <span class="small">SKU: {{  $item->product->sku }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="text-end">Rs.{{ $item->unitPrice }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">Subtotal</td>
                                        <td class="text-end">Rs. {{  $order->orderProducts->sum('subtotal')  }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Shipping</td>
                                        <td class="text-end">Rs. {{ $order->delivaryCharge }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td colspan="2">Discount (Code: NEWYEAR)</td>
                                        <td class="text-danger text-end">-$10.00</td>
                                    </tr> --}}
                                    <tr class="fw-bold">
                                        <td colspan="2">TOTAL</td>
                                        <td class="text-end">Rs. {{ $order->nettotal }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="h6">Payment Method</h3>

                                    @if ($order->payment_method == 'COD')
                                    <span class="badge bg-success rounded-pill">{{ 'CACHE ON DELIVERY'}}</span>

                                    @else
                                    <p>Visa -1234 <br>
                                        Total: $169,98 <span class="badge bg-success rounded-pill">{{ Str::upper($item->payment_method) }}</span></p>
                                    @endif
                                    
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Billing address</h3>
                                    <address>
                                        <strong>{{ $order->customer->name }}</strong><br>
                                        {{ $order->customer->provinces }}, {{ $order->customer->district }}<br>
                                        {{ $order->customer->gaupalika }}, {{ 'Ward No. :'.$order->customer->ward_no }}<br>
                                        <abbr title="Phone">Phone:</abbr> {{ $order->customer->phone }} <br>
                                        <abbr title="Phone">E-mail:</abbr> {{ $order->customer->email }} <br>
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Customer Notes -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="h6 text-warning">Customer Notes</h3>
                            <p>{{ $order->orderdelivary->note ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <!-- Shipping information -->
                        <div class="card-body">
                            <h3 class="h6">Shipping Information</h3>
                        
                            <h3 class="h6">Address</h3>
                            <address>
                                <strong>{{ $order->orderdelivary->name }}</strong><br>
                                {{ $order->orderdelivary->provinces }}, {{ $order->orderdelivary->district }}<br>
                                {{ $order->orderdelivary->gaupalika }}, {{ 'Ward No. :'.$order->orderdelivary->ward_no }}<br>
                                <abbr title="Phone">Phone:</abbr> {{ $order->orderdelivary->phone }} <br>
                                <abbr title="Phone">E-mail:</abbr> {{ $order->orderdelivary->email }} <br>
                            </address>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
