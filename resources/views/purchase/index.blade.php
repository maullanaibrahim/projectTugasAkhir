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
                                            <th scope="col">TGL PO</th>
                                            <th scope="col">NOMOR PO</th>
                                            <th scope="col">BEBAN BIAYA</th>
                                            <th scope="col">SUPPLIER</th>
                                            <th scope="col">NOMINAL</th>
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
                                            <td class="text-uppercase" style="font-size:13px;"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($purchase->purchase_total,2,'.',',') }}</div></td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->ppbje->ppbje_type }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $purchase->purchase_maker }}</td>
                                            @if($purchase->purchase_status == "belum disetujui")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-secondary">{{ $purchase->purchase_status }}</td>
                                            @elseif($purchase->purchase_status == "menunggu kiriman")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-primary">{{ $purchase->purchase_status }}</td>
                                            @elseif($purchase->purchase_status == "sudah diterima")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-success">{{ $purchase->purchase_status }}</td>
                                            @elseif($purchase->purchase_status == "tidak disetujui")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-danger">{{ $purchase->purchase_status }}</td>
                                            @endif
                                            <td style="font-size:13px;">
                                                <!-- Button for look detail Purchase Order -->
                                                <a href="/purchases/{{ encrypt($purchase->id) }}-{{ encrypt($purchase->purchase_number) }}"><button class="btn btn-outline-secondary btn-sm"><i class="bi bi-file-earmark-text-fill"></i></button></a>
                                                <!-- Hanya staff Procurement yang dapat merubah atau merevisi PO -->
                                                @if(auth()->user()->position_id == 10)
                                                    @if($purchase->approved == "yes" or $purchase->purchase_status == "tidak disetujui")
                                                    <!-- Button for edit data -->
                                                    <button class="btn btn-success btn-sm" disabled><i class="bi bi-pencil-square"></i></button>
                                                    @else
                                                    <a href="/purchases/{{ encrypt($purchase->purchase_number) }}/edit{{ $purchase->id }}"><button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                    @endif
                                                @else
                                                @endif
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