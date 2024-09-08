@extends('layouts.main')
@section('konten')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>

            <div class="row">
                <x-card-data-master href="{{ url('rak') }}" icon="layer-group" color="primary" label="Data Rak"
                    value="{{ $sumRak }}" />
                <x-card-data-master href="{{ route('master.vendor') }}" icon="warehouse" color="danger" label="Data Vendor"
                    value="{{ $sumVendor }}" />
                <x-card-data-master href="{{ route('master.kategori') }}" icon="boxes" color="warning"
                    label="Data Kategori" value="{{ $sumKategori }}" />
                <x-card-data-master href="{{ route('master.satuan') }}" icon="balance-scale" color="success"
                    label="Data Satuan" value="{{ $sumSatuan }}" />
            </div>
        </section>
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endpush
@push('js-libs')
    <script src="{{ asset('assets/node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-toastr.js') }}"></script>
@endpush
