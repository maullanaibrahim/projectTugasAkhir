@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-truck me-2"></i>{{ $title }}</h5>

                                <!-- Button for create new supplier -->
                                @if(auth()->user()->position_id == '1')
                                <a href="/suppliers/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>
                                @else
                                @endif

                                <!-- Showing Supplier Table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">KODE</th>
                                            <th scope="col">NAMA SUPPLIER</th>
                                            <th scope="col">PIC</th>
                                            <th scope="col">KONTAK</th>
                                            <th scope="col">ALAMAT</th>
                                            <th scope="col">PPN</th>
                                            <th scope="col">TERMIN</th>
                                            <th scope="col">TERDAFTAR</th>
                                            @if(auth()->user()->position_id == '1')
                                            <th scope="col">AKSI</th>
                                            @else
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($suppliers as $supplier)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $supplier->supplier_code }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $supplier->supplier_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $supplier->supplier_pic }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $supplier->supplier_contact }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $supplier->supplier_address }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $supplier->tax }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $supplier->term }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($supplier->created_at)); }}</td>
                                            @if(auth()->user()->position_id == '1')
                                            <td style="font-size:13px;">
                                                <!-- Button for edit data -->
                                                <a href="/suppliers/{{ $supplier->id }}/edit"><button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                <!-- Button for delete data
                                                <form action="/suppliers/{{ $supplier->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="askDelete()"><i class="bi bi-trash-fill"></i></button>
                                                </form> -->
                                            </td>
                                            @else
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- End Card Body -->
                        </div><!-- End card top-selling -->
                    </div><!-- End col-12 -->
                </div><!-- End row -->
            </div><!-- End col-lg-12 -->
        </div><!-- End row -->
    </section>
@endsection