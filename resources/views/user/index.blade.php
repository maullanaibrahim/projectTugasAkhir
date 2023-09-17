@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-person-circle me-2"></i>{{ $title }}</h5>

                                <!-- Button for Register new User -->
                                @if(auth()->user()->position_id == '1')
                                <a href="/register"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-person-plus me-1"></i> Registrasi</button></a>
                                @else
                                @endif
                                
                                <!-- Showing data from employees table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">NIK</th>
                                            <th scope="col">NAMA PENGGUNA</th>
                                            <th scope="col">JABATAN</th>
                                            <th scope="col">CABANG / DIVISI</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($users as $user)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $user->nik }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $user->position->position_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $user->division->division_name }}</td>
                                            @if(auth()->user()->position_id == '1')
                                            <td style="font-size:13px;">
                                                <!-- Hidden delete button for super admin -->
                                                @if($user->nik == '1234')
                                                @else
                                                <!-- Button for delete data -->
                                                <form action="/users/{{ $user->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus {{ strtoupper($user->first_name) }} {{ strtoupper($user->last_name) }}?')"><i class="bi bi-trash-fill"></i></button>
                                                </form>
                                                @endif
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