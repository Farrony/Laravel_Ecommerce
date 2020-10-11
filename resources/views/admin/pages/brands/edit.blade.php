@extends('admin.layout.template')

@section('adminBodyContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Brand Information</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Update Brand Info</li>
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
                            <h3 class="card-title">Edit Brand</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('brands.update',$brand->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Brand Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$brand->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="desc" rows="5" class="form-control">{{$brand->desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Brand Logo/Image</label>
                                    @if ( $brand->image == NULL)
                                        <br>
                                        No Image Uploaded
                                    @else
                                        <br><img src="{{ asset('backend/img/brands/' .$brand->image )}}" width="50px" alt=""><br><br>
                                    @endif
                                    <input type="file" name="image" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="updateBrand" class="btn btn-primary btn-block"
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
