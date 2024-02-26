@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>Produk
                    <a href="{{ url('admin/products/create') }}" class="btn btn-rounded btn-primary text-white btn-sm float-end">
                        Tambahkan Produk
                    </a>
                </h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categori</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if ($product->category)
                                    {{ $product->category->name }}
                                @else
                                    No Category
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>Rp.{{ number_format($product->selling_price) }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>{{ $product->status == '1' ? 'Hidden':'Visible'}}</td>
                            <td>
                                <a href="{{ url('admin/products/'.$product->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                <a href="{{ url('admin/products/'.$product->id.'/delete') }}" onclick="return confirm('Apakah kamu yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No Products Available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
