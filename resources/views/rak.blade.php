@extends('layouts.main')
@section('konten')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Rak Aster</h1>
                <div class="section-header-breadcrumb">
                    <div>
                        @if (Auth::user())
                            <form id="resetForm" action="{{ route('barang.reset') }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    data-confirm="Apakah Anda yakin ingin mereset tabel barang?|are you sure?"
                                    data-confirm-yes="document.getElementById('resetForm').submit()">Reset</button>
                            </form>

                            <a class="btn btn-success btn-icon" data-toggle="modal" data-target="#modal-import"
                                title="" data-original-title="export"><i class="fas fa-file-import"></i></a>
                        @endif
                        <a href="{{ route('export') }}" class="btn btn-warning btn-icon" data-toggle="tooltip"
                            title="" data-original-title="export"><i class="fas fa-file-excel"></i></a>
                    </div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    @foreach ($dataRak as $item)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <a href="/rak/{{ $item->id }}">
                                    <div class="card-icon bg-primary">
                                        <i class="far fa">{{ $item->nama }}</i>
                                    </div>
                                </a>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total Barang</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $item->barang_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <div class="modal fade" id="modal-import" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Import Barang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Upload File Excel/CSV</label>
                                <input name="file" type="file" class="form-control" required>
                                <small>*.xlsx / *.csv</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/node_modules/izitoast/dist/css/iziToast.min.css') }}">
    @endpush
    @push('js-libs')
        <script src="{{ asset('assets/node_modules/izitoast/dist/js/iziToast.min.js') }}"></script>
        <script src="{{ asset('assets/js/page/modules-toastr.js') }}"></script>
    @endpush
