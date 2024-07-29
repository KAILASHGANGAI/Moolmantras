@extends('../layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">products</a></li>
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
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{{ asset($product->image) }}" class="img-fluid" alt="">
                            </div>
                            <div class="col-sm-4 p-4">
                                <h5> <strong>Product Name:</strong> {{ $product->product_name }}</h5>
                                <h6><strong>Category: </strong> {{ $product->category_id }}</h6>
                                <span><strong>Product Code:</strong> {{ $product->product_code }}</span> <br>
                                <span><strong>Buying Quantity:</strong> {{ $product->total_quantity }}</span> <br>
                                <span><strong>Buying Price:</strong> {{ $product->buying_price }}</span> <br>
                                <span><strong>Seling Price:</strong> {{ $product->selling_price }}</span> <br>
                                <span><strong>Supplier Name/Company:</strong> {{ $product->supplier_name }}</span> <br>
                                <span><strong>Buying Date:</strong> {{ $product->buying_date }}</span> <br>


                                <span><strong>Avaiabel Quantity:</strong> {{ $product->availabel_quantity }}</span> <br>
                                <span><strong>Sold Quantity:</strong> {{ $product->sold_quantity }}</span> <br>
                                <span><strong>Occupation:</strong> {{ $product->occupation }}</span> <br>

                            </div>
                            <div class="col-sm-4 p-4">
                                <br>
                            </div>
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
