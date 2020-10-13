@extends('admin.layout.template')

@section('adminBodyContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Category Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Update Category Info</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    {{-- content body  --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('category.update',$category->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Category Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="desc" rows="5" class="form-control">{{$category->desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Parent Category</label>
                                    <select name="parent_id" class="form-control">
                                        <option value="0">Please Select a Parent Category If Any</option>
                                        @foreach( $primary_category as $cat )
                                            <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : ''}}>{{ $cat->name }}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Category Logo/Image</label>
                                    @if ( $category->image == NULL)
                                        <br>
                                        No Image Uploaded
                                    @else
                                        <br><img src="{{ asset('backend/img/categories/' .$category->image )}}" width="50px" alt=""><br><br>
                                    @endif
                                    <input type="file" name="image" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="updateCategory" class="btn btn-primary btn-block"
                                        value="Save Changes">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- content body  --}}
</div>
@endsection
