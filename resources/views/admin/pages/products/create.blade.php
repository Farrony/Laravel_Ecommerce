@extends('admin.layout.template')

@section('adminBodyContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
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
                            <h3 class="card-title">Add Product</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('product.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    {{-- left div  --}}
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <label for="">Product Title</label>
                                            <input type="text" name="title"
                                                class="form-control form-control-name @error('title') is-invalid @enderror"
                                                name="title" value="{{old('title')}}" id="title"">
                                        @error('title')
                                            <div class=" text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror"></textarea>
                                        @error('description')
                                            <div class=" text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Category</label>
                                        <select class="form-control @error('category_id') is-invalid @enderror" value="{{old('category_id')}}" name="category_id">
                                            <option value="">Please Select the Product Category</option>
                                            @foreach(
                                                App\Models\Backend\Category::orderBy('name','asc')->where('parent_id',0)->get()
                                                as
                                                $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    {{-- read sub category  --}}
                                                    @foreach(
                                                    App\Models\Backend\Category::orderBy('name','asc')->where('parent_id',$category->id)->get()
                                                    as
                                                    $childcat)
                                                        <option value="{{ $childcat->id }}">--{{ $childcat->name }}</option>
                                                    @endforeach
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class=" text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Brand</label>
                                        <select class="form-control" name="brand_id">
                                            <option value="">Please Select the Product Brand</option>
                                            @foreach( App\Models\Backend\Brand::orderBy('name','asc')->get() as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class=" text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- right div  --}}
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <label for="">Regular Price</label>
                                        <input type="text" name="price"
                                            class="form-control form-control-name @error('price') is-invalid @enderror"
                                            name="price" value="{{old('price')}}" id="price"">
                                        @error('price')
                                            <div class=" text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Offer Price</label>
                                        <input type="text" name="offer_price"
                                            class="form-control form-control-name @error('offer_price') is-invalid @enderror"
                                            name="offer_price" value="{{old('offer_price')}}" id="offer_price"">
                                        @error('offer_price')
                                            <div class=" text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Product Quantity</label>
                                        <input type="text" name="quantity"
                                            class="form-control form-control-name @error('quantity') is-invalid @enderror"
                                            name="quantity" value="{{old('quantity')}}" id="quantity"">
                                        @error('quantity')
                                            <div class=" text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Publish Status</label>
                                        <select class="form-control" name="status" >
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        
                                    </div>
                                </div>
                            </div>
                            {{-- image section  --}}
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">Product Thumbnail Image</label>
                                        <input type="file" name="p_image[]" class="form-control-file">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Image 2</label>
                                        <input type="file" name="p_image[]" class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Image 3</label>
                                        <input type="file" name="p_image[]" class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Image 4</label>
                                        <input type="file" name="p_image[]" class="form-control-file">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Image 5</label>
                                        <input type="file" name="p_image[]" class="form-control-file">
                                    </div>
                                </div>
                            </div>
                            {{-- image section  --}}

                            <div class="form-group">
                                <input type="submit" name="addCategory" class="btn btn-primary btn-block"
                                value="Add New Category">
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
