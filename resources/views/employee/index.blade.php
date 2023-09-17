@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-people me-2"></i>{{ $title }}</h5>

                                <!-- Button for create new employee -->
                                @if(auth()->user()->position_id == '1')
                                <a href="/employees/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>
                                @else
                                @endif

                                <!-- Showing data from employees table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">NIK</th>
                                            <th scope="col">NAMA KARYAWAN</th>
                                            <th scope="col">JABATAN</th>
                                            <th scope="col">CABANG / DIVISI</th>
                                            <th scope="col">PERUSAHAAN</th>
                                            @if(auth()->user()->position_id == '1')
                                            <th scope="col">AKSI</th>
                                            @else
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($employees as $employee)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->nik }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->employee_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->position->position_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->cost->cost_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $employee->company }}</td>
                                            @if(auth()->user()->position_id == '1')
                                            <td style="font-size:13px;">
                                                <!-- Button for edit data -->
                                                <a href="/employees/{{ $employee->id }}/edit"><button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                <!-- Button for delete data -->
                                                <form action="/employees/{{ $employee->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus {{ strtoupper($employee->employee_name) }}?')"><i class="bi bi-trash-fill"></i></button>
                                                </form>
                                            </td>
                                            @else
                                            @endif
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