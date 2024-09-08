@extends('layouts.main')
@section('konten')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ url('/rak') }}" class="btn btn-danger"><i class="fas fa-arrow-left"></i></a>

                </div>
                <h1>Data Rak / {{ $rak->nama }}</h1>
                <div class="section-header-button">
                    @if (Auth::user())
                        <a href="{{ url('rak/' . $rak->id . '/create') }}" class="btn btn-primary">Tambah <i
                                class="fas fa-plus"></i></a>
                    @endif
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <form class="form-inline">
                                    <div class="input-group">
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            class="form-control" placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm table-hover table-bordered"
                                        style="width:100% ">
                                        <tr>
                                            <th>#</th>
                                            <th>image</th>
                                            <th>Nama</th>
                                            <th>Kode Barang</th>
                                            <th>Kategori</th>
                                            <th>Vendor</th>
                                            <th>Gramasi</th>
                                            <th>Stok</th>
                                            <th>SAT</th>
                                            <th>Action</th>
                                        </tr>
                                        @if ($dataBarang->count() > 0)
                                            @foreach ($dataBarang as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration + ($dataBarang->currentPage() - 1) * $dataBarang->perPage() }}
                                                    </td>
                                                    <td>
                                                        @if ($item->image)
                                                            <img src="{{ url('uploads/' . $item->image) }}" width="55">
                                                        @else
                                                            <img src="{{ url('/assets/img/example-image-50.jpg') }}"
                                                                width="55">
                                                        @endif
                                                    </td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->kode }}</td>
                                                    <td>{{ $item->kategori->nama }}</td>
                                                    <td>{{ $item->vendor->nama }}</td>
                                                    <td>{{ $item->gramasi }}</td>
                                                    @if ($item->stok)
                                                        <td>{{ $item->stok }}</td>
                                                    @else
                                                        <td>#</td>
                                                    @endif
                                                    <td>{{ $item->satuan->nama }}</td>
                                                    <td style="white-space: nowrap;">

                                                        <a class="btn btn-secondary btn-action mr-1" id="barangDetail"
                                                            data-toggle="modal" data-target="#modal-detail"
                                                            data-imagebarang="{{ $item->image }}"
                                                            data-namabarang="{{ $item->nama }}"
                                                            data-kodebarang="{{ $item->kode }}"
                                                            data-gramasibarang="{{ $item->gramasi }}"
                                                            data-stokbarang="{{ $item->stok }}"
                                                            data-satuanbarang="{{ $item->satuan->nama }}"
                                                            data-vendorbarang="{{ $item->vendor->nama }}"
                                                            data-kategoribarang="{{ $item->kategori->nama }}"
                                                            data-ketbarang="{{ $item->ket }}">
                                                            <i class="fas fa-info"></i>
                                                        </a>
                                                        @if (Auth::user())
                                                            <a class="btn btn-primary btn-action mr-1"
                                                                href="{{ url('rak/' . $rak->id . '/edit/' . $item->id) }}"
                                                                data-toggle="tooltip" title=""
                                                                data-original-title="Edit"><i
                                                                    class="fas fa-pencil-alt"></i></a>
                                                            <form action="{{ route('barang.destroy', $item->id) }}"
                                                                method="post" style="display: inline-block;"
                                                                id="delete-form-{{ $item->id }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a class="btn btn-danger btn-action trigger--fire-modal-1"
                                                                    data-toggle="tooltip" title=""
                                                                    data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?"
                                                                    data-confirm-yes="document.getElementById('delete-form-{{ $item->id }}').submit()"
                                                                    data-original-title="Delete"><i
                                                                        class="fas fa-trash"></i></a>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8" class="text-center">Tidak ada data</td>
                                            </tr>
                                        @endif
                                    </table>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <nav class="d-inline-block">
                                    <ul class="pagination mb-0">
                                        <!-- Previous Page Link -->
                                        @if ($dataBarang->onFirstPage())
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1"><i
                                                        class="fas fa-chevron-left"></i></a>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $dataBarang->previousPageUrl() }}"
                                                    tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                                            </li>
                                        @endif

                                        <!-- Pagination Links -->
                                        @foreach ($dataBarang->getUrlRange(1, $dataBarang->lastPage()) as $page => $url)
                                            @if ($page == $dataBarang->currentPage())
                                                <li class="page-item active">
                                                    <a class="page-link" href="#">{{ $page }} <span
                                                            class="sr-only">(current)</span></a>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        <!-- Next Page Link -->
                                        @if ($dataBarang->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $dataBarang->nextPageUrl() }}"><i
                                                        class="fas fa-chevron-right"></i></a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('crud.show')

@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/node_modules/izitoast/dist/css/iziToast.min.css') }}">
@endpush
@push('js-libs')
    <script src="{{ asset('assets/node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('assets/js/page/modules-toastr.js') }}"></script>
@endpush
@push('js')
    <script>
        $('#modal-detail').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang diklik untuk membuka modal
            var modal = $(this);

            // Mengambil data dari tombol yang diklik
            var image = button.data('imagebarang') ? '{{ url('uploads') }}/' + button.data('imagebarang') :
                '{{ url('/assets/img/example-image-50.jpg') }}';
            var nama = button.data('namabarang');
            var kode = button.data('kodebarang');
            var kategori = button.data('kategoribarang');
            var vendor = button.data('vendorbarang');
            var gramasi = button.data('gramasibarang');
            var stok = button.data('stokbarang');
            var satuan = button.data('satuanbarang');
            var ket = button.data('ketbarang');

            // Mengisi elemen modal dengan data yang diambil
            modal.find('#detail-image').attr('src', image);
            modal.find('#detail-nama').text(nama);
            modal.find('#detail-kode').text(kode);
            modal.find('#detail-kategori').text(kategori);
            modal.find('#detail-vendor').text(vendor);
            modal.find('#detail-gramasi').text(gramasi);
            modal.find('#detail-stok').text(stok);
            modal.find('#detail-satuan').text(satuan);
            modal.find('#detail-ket').text(ket);
        });
    </script>
@endpush
