@extends('layouts.app')

@section('title', 'Terima Kasih')

@section('content')

    <div class="py-3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="p-4 shadow bg-white">
                        <h2>logo</h2>
                        <h4>Terima Kasih Telah Membeli Product Kami</h4>
                        <a href="{{ url('collections') }}" class="btn btn-primary">Belanja Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

