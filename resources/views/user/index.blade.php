@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pt-3">
                                <!-- Showing data from employees table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">NIK</th>
                                            <th scope="col">NAMA USER</th>
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
                                            <td style="font-size:13px;">
                                                <!-- Hidden delete button for super admin -->
                                                @if($user->nik == '123456789')
                                                @else
                                                <!-- Button for delete data -->
                                                <form action="/users/{{ $user->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus {{ strtoupper($user->first_name) }} {{ strtoupper($user->last_name) }}?')"><i class="bi bi-trash-fill"></i></button>
                                                </form>
                                                @endif
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