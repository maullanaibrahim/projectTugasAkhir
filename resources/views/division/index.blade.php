@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pt-3">
                                <!-- Button for create new Division -->
                                <a href="/divisions/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>

                                <!-- Showing data from divisions table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">NAMA DIVISI</th>
                                            <th scope="col">LOKASI</th>
                                            <th scope="col">ALAMAT</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($divisions as $division)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $division->division_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $division->location }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $division->address }}</td>
                                            <td style="font-size:13px;">
                                                <!-- Button for edit data -->
                                                <a href="#{{ $division->id }}"><button class="btn btn-secondary btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                <!-- Button for delete data -->
                                                <form action="/divisions/{{ $division->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus divisi {{ strtoupper($division->division_name) }}?')"><i class="bi bi-trash-fill"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- End Card Body -->
                        </div> <!-- End card top-selling -->
                    </div> <!-- End col-12 -->
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div> <!-- End row -->
    </section>
@endsection