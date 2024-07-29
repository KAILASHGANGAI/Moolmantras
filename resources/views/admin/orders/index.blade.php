@extends('../layouts.app')
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
                                        <th>Payed By</th>
                                        <th>Due</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>

                                            <td>{{ $item->customer->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>{{ $item->pay_amount }}</td>

                                            <td>{{ $item->due }}</td>

                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ url('checkout/bill?order=' . $item->id) }}">
                                                    <i class="fas fa-folder">
                                                    </i>

                                                </a>

                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('orders.destroy', $item->id) }}">
                                                    <i class="fas fa-trash">
                                                    </i>

                                                </a>
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
                                        <th>Payed</th>
                                        <th>Due</th>
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
