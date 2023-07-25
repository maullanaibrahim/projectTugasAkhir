@extends('layouts.main')
@section('content')
    <!-- Content -->
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pt-3">
                                <!-- Button for create new branch -->
                                <a href="/branches/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>

                                <!-- Showing data from branches table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">KODE</th>
                                            <th scope="col">NAMA CABANG</th>
                                            <th scope="col">ALAMAT</th>
                                            <th scope="col">REGIONAL</th>
                                            <th scope="col">AREA</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">UPDATE</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($branches as $branch)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $branch->branch_code }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $branch->branch_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $branch->branch_address }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $branch->regional }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $branch->area }}</td>
                                            @if($branch->status == "aktif")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-success">{{ $branch->status }}</td>
                                            @else
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-danger">{{ $branch->status }}</td>
                                            @endif
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($branch->updated_at)); }}</td>
                                            <td style="font-size:13px;">
                                                <!-- Button for edit data -->
                                                <a href="/branches/{{ $branch->id }}/edit"><button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                <!-- Button for delete data
                                                <form action="/branches/{{ $branch->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus cabang {{ strtoupper($branch->branch_name) }}?')"><i class="bi bi-trash-fill"></i></button>
                                                </form> -->
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