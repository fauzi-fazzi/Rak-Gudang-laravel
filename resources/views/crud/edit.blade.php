@extends('layouts.main')
@section('konten')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ url('rak/' . $rak->id) }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Edit Data Barang</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Form edit data barang</h4>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-warning">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>
                                                    {{ $error }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ url('rak/' . $rak->id . '/update/' . $barang->id) }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            @if ($barang->image)
                                                <img src="{{ url('uploads/' . $barang->image) }}" class="img-thumbnail mb-2"
                                                    width="190"
                                                    style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
                                            @else
                                                <img src="{{ url('/assets/img/example-image-50.jpg') }}"
                                                    class="img-thumbnail mb-2" width="100"
                                                    style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
                                            @endif
                                        </div>
                                        <input type="file" name="image" class="form-control mt-2">
                                        <small style="font-style: italic">note: jika ada ; max image size 5MB</small>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input type="text" name="nama" value="{{ $barang->nama }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Barang</label>
                                        <input type="text" name="kode" value="{{ $barang->kode }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Kategori</label>
                                        <select class="form-control" name="kategori_id" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $barang->kategori_id ? 'selected' : '' }}>
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Vendor</label>
                                        <select class="form-control" name="vendor_id" required>
                                            <option value="">Pilih Vendor</option>
                                            @foreach ($vendor as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $barang->vendor_id ? 'selected' : '' }}>
                                                    {{ $item->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Gramasi</label>
                                        <input type="text" name="gramasi" value="{{ $barang->gramasi }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input type="number" name="stok" value="{{ $barang->stok }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="d-block">SAT</label>
                                        <div class="form-check">
                                            @foreach ($satuan as $item)
                                                <div class="form-check-inline">
                                                    <input class="form-check-input" type="radio" name="satuan_id"
                                                        id="{{ $item->id }}" value="{{ $item->id }}"
                                                        {{ $item->id == $barang->satuan_id ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="{{ $item->id }}">
                                                        {{ $item->nama }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <textarea class="form-control" name="ket">{{ $barang->ket }}</textarea>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary mr-1" type="submit">Submit</button>
                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
@push('js')
    <script></script>
@endpush
