@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-cart-check me-2"></i>{{ $title }}</h5>

                                <!-- Button for create new branch -->
                                <a href="/receivings/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>

                                <!-- Showing Supplier Table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">TGL RECEIVING</th>
                                            <th scope="col">NO. RECEIVING</th>
                                            <th scope="col">NOMOR PO</th>
                                            <th scope="col">PENERIMA</th>
                                            <th scope="col">DIVISI</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($receivings as $receiving)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($receiving->created_at)); }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $receiving->receiving_number }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $receiving->purchase->purchase_number }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $receiving->recipient }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $receiving->division_name }}</td>
                                            @if($receiving->receiving_status == "selesai")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-success">{{ $receiving->receiving_status }}<span></td>
                                            @else
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-warning">{{ $receiving->receiving_status }}</span></td>
                                            @endif
                                            <td style="font-size:13px;">
                                                <!-- Button for look detail Purchase Order -->
                                                <a href="/receivings/{{ $receiving->id }}"><button class="btn btn-outline-secondary btn-sm"><i class="bi bi-file-earmark-text-fill"></i></button></a>
                                                @if($receiving->receiving_status == "selesai")
                                                <button class="btn btn-success btn-sm" disabled><i class="bi bi-pencil-square"></i></button>
                                                @else
                                                <a href="/receivings/{{ $receiving->id }}/edit"><button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                @endif
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