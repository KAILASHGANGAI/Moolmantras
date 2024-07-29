@extends('admin.layouts.admin')

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
                                <div class="col-sm-8 form-group">
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
                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                            @endforeach

                                        </select>
                                        @error('category_id')
                                            <p class="error text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Product Code</label>
                                    <input type="text" name="sku" class="form-control" value="{{ old('sku') }}">
                                    @error('sku')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3     form-group">
                                    <label>barcode Code</label>
                                    <input type="text" name="barcode" class="form-control" value="{{ old('barcode') }}">
                                    @error('barcode')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Stock On Hand</label>
                                    <input type="text" name="stock_on_hand" class="form-control"
                                        value="{{ old('stock_on_hand') }}" placeholder="Enter Product code">
                                    @error('stock_on_hand')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Compare price</label>
                                    <input type="text" name="compare_price" class="form-control"
                                        value="{{ old('compare_price') }}" id="exampleInputPassword1">
                                    @error('compare_price')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label>Product Selling Price</label>
                                    <input type="text" name="selling_price" class="form-control"
                                        value="{{ old('selling_price') }}" placeholder="Enter selling price">
                                    @error('selling_price')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-sm-3 form-group">
                                    <label>Product Supplier</label>
                                    <input type="text" name="supplier" class="form-control"
                                        value="{{ old('supplier') }}" placeholder="Enter Full name">
                                    @error('supplier')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label for="exampleInputPassword1">Buying price</label>
                                    <input type="text" name="buying_price" class="form-control"
                                        value="{{ old('buying_price') }}" id="exampleInputPassword1">
                                    @error('buying_price')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>Buying date</label>
                                    <input type="date" name="buying_date" class="form-control"
                                        value="{{ old('buying_date') }}" placeholder="Enter Product code">
                                    @error('buying_date')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>weight</label>
                                    <input type="text" name="weight" class="form-control"
                                        value="{{ old('weight') }}" placeholder="Enter Product code">
                                    @error('weight')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-sm-3 form-group">
                                    <label>weightUnit</label>
                                    <input type="text" name="weightUnit" class="form-control"
                                        value="{{ old('weightUnit') }}" placeholder="Enter Product code">
                                    @error('weightUnit')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Status -->
                                <div class="mb-3 form-check col-sm-2 pt-5">
                                    <input type="checkbox" class="form-check-input" id="status" name="status"
                                        value="1" {{ old('status') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Status</label>
                                </div>
                                <div class="col-sm-4 form-group">
                                    <label for="exampleInputPassword1">Image</label> <br>
                                    <input type="file" name="images[]" multiple />
                                    @error('image')
                                        <p class="error text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="mb-3 col-sm-12">
                            <label for="tags" class="form-label">Tags</label>
                            <textarea id="tags" name="tags" class="form-control" rows="3">{{ old('tags') }}</textarea>
                        </div>

                        <!-- Slug -->
                        <div class="mb-3 col-sm-12">
                            <label for="slug" class="form-label">Slug (Default product-name-slug)</label>
                            <input type="text" class="form-control" id="slug" name="slug"
                                value="{{ old('slug') }}">
                        </div>
                        <!-- Description -->
                        <div class="mb-3 col-sm-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
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
