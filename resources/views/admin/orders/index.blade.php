@extends('admin.layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Orders</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Customer</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>PaymentMethod</th>
                                        <th>DelivaryCharge</th>
                                        <th>Status</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>

                                            <td>{{ $item->customer->name }}</td>
                                            <td>{{ $item->no_of_item }}</td>
                                            <td>{{ $item->nettotal }}</td>
                                            <td>{{ $item->payment_method }}</td>

                                            <td>{{ $item->delivaryCharge }}</td>
                                            <td>{{ $item->status }}</td>

                                            <td>
                                                <a class=""
                                                    href="{{ url('/admin/checkout/bill?order=' . $item->id) }}">
                                                    <i class="fas fa-print">
                                                    </i>

                                                </a>
                                                <a class="" href="{{ route('orders.show', $item->id) }}">
                                                    <i class="fas fa-eye">
                                                    </i>

                                                </a>
                                                <a class="" href="{{ route('orders.reject', ['id' => $item->id]) }}">

                                                    ❎
                                                </a>

                                                <a href="{{ route('orders.approve', ['id' => $item->id]) }}">

                                                    ✅
                                                </a>
                                                <form action="{{ route('orders.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach



                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Customer</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>PaymentMethod</th>
                                        <th>DelivaryCharge</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
