@extends('admin.layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blogs </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Blogs</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>


        <div class="container ">
           
           <div class="card p-3">
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                </div>
               
                <div class="form-group">
                    <label for="slug">Slug (make-title-as-slug-automatic) </label>
                    <input type="text" name="slug" id="slug" class="form-control">
                </div>
                <div class="form-group">
                    <label for="meta_title">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="meta_keywords">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" class="form-control">
                </div>
                <div class="form-group">
                    <label for="image">Image Path</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
           </div>
        </div>
 
@endsection
