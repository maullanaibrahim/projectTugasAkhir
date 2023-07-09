@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pt-3">
                                <!-- Button for create new branch -->
                                <a href="/employees/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>

                                <!-- Showing data from employees table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">NIK</th>
                                            <th scope="col">NAMA KARYAWAN</th>
                                            <th scope="col">JABATAN</th>
                                            <th scope="col">CABANG / DIVISI</th>
                                            <th scope="col">PERUSAHAAN</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($employees as $employee)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->nik }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->employee_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->employee_position }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->employee_location }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->company }}</td>
                                            <td style="font-size:13px;">
                                                <!-- Button for edit data -->
                                                <a href="#{{ $employee->id }}"><button class="btn btn-secondary btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                <!-- Button for delete data -->
                                                <form action="/employees/{{ $employee->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus {{ strtoupper($employee->employee_name) }}?')"><i class="bi bi-trash-fill"></i></button>
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