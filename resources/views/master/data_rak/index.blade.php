@extends('layouts.main')
@section('konten')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Data Rak</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Table Rak</h4>
                            </div>
                            <div class="card-body">
                                <div class="table">
                                    <table class="table table-striped" style="font-size: 12px;" id="table-rak">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 5%;">#</th>
                                                <th style="width: 50px;">Nama Rak</th>
                                                <th style="width: 15px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rak as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>
                                                        <form action="{{ route('rak.destroy', $item->id) }}" method="post"
                                                            style="display: inline-block;"
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
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-body">
                                    <div class="card-header-action">
                                        <h4>Form Tambah</h4>
                                    </div>
                                    <form action="{{ url('master/rak/store') }}" enctype="multipart/form-data"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label>Nama Rak</label>
                                            <input type="text" name="nama" class="form-control">
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

                </div>
            </div>
        </section>
    </div>
@endsection
@include('components.notif')
@push('js-libs')
    <script src="{{ asset('assets/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
@endpush
@push('js')
    <script>
        $(document).ready(function() {
            $('#table-rak').DataTable({
                "pageLength": 5
            });
        });
    </script>
    <script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>
@endpush
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush
