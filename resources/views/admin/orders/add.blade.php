@extends('../layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create New Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Product</a></li>
                        <li class="breadcrumb-item active">add</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- /.row -->
        </div>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <form id="quickForm" method="post" action="{{ route('products.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4 form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="product_name" class="form-control"
                                        value="{{ old('product_name') }}" placeholder="Enter name">
                                    @error('product_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-4 form-group">
                                    <div class="">
                                        <label>Product cateory</label>
                                        <select class="form-control select2" name="category_id"
                                            value="{{ old('category_id') }}" style="width: 100%;">
                                            <option selected="selected" disabled>Select category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach

                                        </select>
                                        @error('category_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Product Code</label>
                                    <input type="text" name="product_code" class="form-control"
                                        value="{{ old('product_code') }}">
                                    @error('product_code')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Product Quantity Buy</label>
                                    <input type="text" name="total_quantity" class="form-control"
                                        value="{{ old('total_quantity') }}" placeholder="Enter Product code">
                                    @error('total_quantity')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Buying price</label>
                                    <input type="text" name="buying_price" class="form-control"
                                        value="{{ old('buying_price') }}" id="exampleInputPassword1">
                                    @error('buying_price')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label>Product Selling Price</label>
                                    <input type="text" name="selling_price" class="form-control"
                                        value="{{ old('selling_price') }}" placeholder="Enter selling price">
                                    @error('selling_price')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Product Supplier</label>
                                    <input type="text" name="supplier_name" class="form-control"
                                        value="{{ old('supplier_name') }}" placeholder="Enter Full name">
                                    @error('supplier_name')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label>Buying date</label>
                                    <input type="date" name="buying_date" class="form-control"
                                        value="{{ old('buying_date') }}" placeholder="Enter Product code">
                                    @error('buying_date')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Availabel quantity</label>
                                    <input type="text" name="availabel_quantity" value="{{ old('availabel_quantity') }}"
                                        class="form-control" id="exampleInputPassword1">
                                    @error('availabel_quantity')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Sold quantity</label>
                                    <input type="text" name="sold_quantity" class="form-control"
                                        value="{{ old('sold_quantity') }}" id="exampleInputPassword1">
                                    @error('sold_quantity')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Image</label> <br>
                                    <input type="file" name="image" />
                                    @error('image')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
