@extends('admin.layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Categories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Categories</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h1>Update Category</h1>

                            <form action="{{ route('category.update', $category->id) }}" class="row" method="POST"  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3 col-sm-6">
                                    <label for="parent_category_id" class="form-label">Parent Category</label>
                                    <select id="parent_category_id" name="parent_category_id" class="form-control">
                                        <option value="0">None</option>
                                        <!-- Populate options dynamically if needed -->
                                        @foreach ($categories as $cat)
                                            <option @if($cat->id == $category->parent_category_id) selected @endif value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Parent Category -->


                                <!-- Category Name -->
                                <div class="mb-3 col-sm-6">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control" id="category_name"  name="category_name"
                                        value="{{ $category->category_name ?? old('category_name') }}" required>
                                </div>





                                <!-- Tags -->
                                <div class="mb-3 col-sm-12">
                                    <label for="tags" class="form-label">Tags</label>
                                    <textarea id="tags" name="tags" class="form-control" rows="3">{{ $category->tags ?? old('tags') }}</textarea>
                                </div>

                                <!-- Slug -->
                                <div class="mb-3 col-sm-12">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ $category->slug ?? old('slug') }}">
                                </div>

                                <!-- Status -->
                                <div class="mb-3 form-check col-sm-4">
                                    <input type="checkbox" class="form-check-input" id="status" name="status"
                                        value="1" {{$category->status ?? old('status') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="status">Status</label>
                                </div>


                                <!-- Banner -->
                                <div class="mb-3 col-sm-4">
                                    <label for="banner" class="form-label">Banner Image</label>
                                    <input type="file" class="form-control" id="banner" name="banner">
                                </div>

                                <!-- Image -->
                                <div class="mb-3 col-sm-4">
                                    <label for="image" class="form-label">Category Image</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                </div>
                                <!-- Description -->
                                <div class="mb-3 col-sm-12">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" name="description" class="form-control" rows="3">{{$category->description ?? old('description') }}</textarea>
                                </div>
                                <button class="btn btn-primary" type="submit">Update Category</button>
                            </form>
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
