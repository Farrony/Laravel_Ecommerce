@extends('admin.layout.template')

@section('adminBodyContent')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage All Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Manage Products</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">All Product List</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-striped table-responsive">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#Sl.</th>
                                        <th scope="col">Thumbnail</th>
                                        <th scope="col">Product Title</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Status </th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Offer Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i=1;  @endphp
                                    @foreach ($products as $product)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>
                                            @php $j=1; @endphp
                                            @foreach($product->images as $img)
                                                @if( $img->image == NULL)
                                                    No Thumbnail
                                                @elseif( $j > 0 )
                                                <img src="{{asset('backend/img/products/' . $img->image )}}" alt="" width="75">
                                                @endif
                                                @php $j--; @endphp
                                            @endforeach
                                        </td>
                                        <td>{{ $product->title }}</td>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->brand->name }}</td>
                                        <td>
                                            @if( $product->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->price }} BDT</td>
                                        <td>
                                            @if( $product->offer_price == NULL)
                                                <span class="badge badge-info">N/A</span>
                                            @else
                                                <span class="badge badge-danger">{{$product->offer_price}}</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->quantity }} Pcs</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="btn btn-primary btn-sm">Update</a>
                                                <a href="" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#deleteProduct{{ $product->id}}">Delete</a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="deleteProduct{{ $product->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Do you
                                                                    confirm to delete this product?</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <form
                                                                    action="{{ route('product.destroy',$product->id)}}"
                                                                    method="post">
                                                                    @csrf
                                                                    <div class="btn-group">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Yes</button>
                                                                        <button type="button" class="btn btn-success"
                                                                            data-dismiss="modal">No</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                            </div>
                                        </td>
                                    </tr>
                                    @php  $i++;  @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
