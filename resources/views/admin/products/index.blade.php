@extends('admin.layout')
@section('title', 'Danh sách sản phẩm')
@section('body')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
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
                            <div class="card-header">
                                <h3 class="card-title">Danh sách sản phẩm</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Sale</th>
                                            <th>Biến thể</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>
                                                <a href="{{ route('products.create') }}" class="btn btn-primary">Thêm
                                                    mới</a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $stt => $product)
                                            <tr>
                                                <td>{{ $stt + 1 }}</td>
                                                <td>{{ $product->code }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/'.$product->image) }}" width="50" alt="">
                                                </td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->sale_price }}</td>
                                                <td>
                                                    @foreach ($product->variants as $variant)
                                                        {{ $variant->color->name }},
                                                        {{ $variant->size->name }},
                                                        {{ $variant->quantity }} <br>
                                                    @endforeach
                                                </td>
                                                <td>{{ $product->category->name }}</td>
                                                <td>{{ $product->brand->name }}</td>
                                                <td class="d-flex">
                                                    <a href="{{ route('products.edit', $product) }}"
                                                        class="btn btn-primary mr-1">Edit</a>
                                                    <form action="{{ route('products.delete', $product) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Sale</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                            <!-- /.card-body -->
                            {{ $products->links() }}
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
    </div>
@endsection