@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-cart me-2"></i>{{ $title }}</h5>

                                <!-- Showing Supplier Table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">TANGGAL PO</th>
                                            <th scope="col">NOMOR PO</th>
                                            <th scope="col">BEBAN BIAYA</th>
                                            <th scope="col">NAMA SUPPLIER</th>
                                            <th scope="col">JENIS PO</th>
                                            <th scope="col">PEMBUAT</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($purchases as $purchase)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($purchase->created_at)); }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->purchase_number }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->cost->cost_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->supplier->supplier_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->ppbje->ppbje_type }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->purchase_maker }}</td>
                                            @if($purchase->purchase_status == "selesai")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-success">{{ $purchase->purchase_status }}</td>
                                            @elseif($purchase->purchase_status == "berlangsung")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-warning">{{ $purchase->purchase_status }}</td>
                                            @elseif($purchase->purchase_status == "belum disetujui")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-secondary">{{ $purchase->purchase_status }}</td>
                                            @elseif($purchase->purchase_status == "batal")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-danger">{{ $purchase->purchase_status }}</td>
                                            @elseif($purchase->purchase_status == "tidak disetujui")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-danger">{{ $purchase->purchase_status }}</td>
                                            @endif
                                            <td style="font-size:13px;">
                                                <!-- Button for edit data -->
                                                <a href="/purchases/{{ $purchase->id }}/edit"><button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                <!-- Button for delete data
                                                <form action="/purchases/{{ $purchase->id }}" method="post" class="d-inline">
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