@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pt-3">
                                <!-- Create New Supplier Button -->

                                <!-- Showing Supplier Table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">TANGGAL PO</th>
                                            <th scope="col">NOMOR PO</th>
                                            <th scope="col">BEBAN BIAYA</th>
                                            <th scope="col">NAMA SUPPLIER</th>
                                            <th scope="col">PEMBUAT</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($purchases as $purchase)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($purchase->created_at)); }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->puchase_number }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->cost->cost_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->supplier_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->purchase_maker }}</td>
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