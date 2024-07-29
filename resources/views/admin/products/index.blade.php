@extends('admin.layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>cateory</th>
                                        <th>code</th>
                                        <th>SellingPrice</th>
                                        <th>BuyingPrice</th>

                                        <th>Availabel</th>
                                        <th>Sold</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $item)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td class="" style="width: 50px; height: 50px;">

                                                <img class="img img-thumbnail" src="{{ asset($item->image) }}">
                                            </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->product_code }}</td>
                                            <td>{{ $item->selling_price }}</td>
                                            <td>{{ $item->buying_price }}</td>
                                            <td>{{ $item->availabel_quantity }}</td>
                                            <td>{{ $item->sold_quantity }}</td>

                                            <td>
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('products.show', $item->id) }}">
                                                    <i class="fas fa-folder">
                                                    </i>

                                                </a>
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('products.edit', $item->id) }}">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>

                                                </a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('products.destroy', $item->id) }}">
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>cateory</th>
                                        <th>code</th>
                                        <th>SellingPrice</th>
                                        <th>BuyingPrice</th>
                                        <th>Availabel</th>
                                        <th>Sold</th>
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
