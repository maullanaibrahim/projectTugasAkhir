@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body pb-1">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="card-title"><i class="bi bi-cart-check me-2"></i>{{ $title }}</h5>
                                    </div>
                                    
                                    <div class="col-2">
                                    </div>
                                    <div class="col-4 mt-3">
                                        <form action="{{ route('receiving.search') }}" method="GET">
                                            @csrf
                                            <div class="input-group">
                                                <input type="text" class="form-control me-1" placeholder="Cari Data Receiving..." name="search">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search me-1"></i> Cari</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- <!-- Button for create new receiving -->
                                @if(auth()->user()->position_id == '1')
                                <a href="/receivings/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>
                                @else
                                @endif

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
                                        @if($receiving->purchase->ppbje->maker_division == auth()->user()->division->division_name or auth()->user()->division->division_name == "Procurement")
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
                                                <!-- Button for look detail Receiving -->
                                                <a href="/receivings/{{ $receiving->id }}"><button class="btn btn-outline-secondary btn-sm"><i class="bi bi-file-earmark-text-fill"></i></button></a>
                                                <!-- Button for edit Receiving -->
                                                @if(auth()->user()->position_id == '1')
                                                    @if($receiving->receiving_status == "selesai")
                                                    <button class="btn btn-success btn-sm" disabled><i class="bi bi-pencil-square"></i></button>
                                                    @else
                                                    <a href="/receivings/{{ $receiving->id }}/edit"><button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                    @endif
                                                @else
                                                @endif
                                            </td>
                                        </tr>
                                        @else
                                        <tr></tr>
                                        @endif
                                        @endforeach
                                    </tbody>
                                </table> --}}
                            </div><!-- End Card Body -->
                        </div><!-- End card -->

                        @foreach($purchases as $purchase)
                        <a href="/purchases/{{ encrypt($purchase->id) }}-{{ encrypt($purchase->purchase_number) }}">
                        <div class="card info-card secondary-card mb-2">
                            <div class="card-body pb-2 pt-1 ">
                                <div class="row border-bottom pt-2 pb-0 mb-3">
                                    <div class="col-4">
                                        <p class="text-secondary"><b><i class="bi bi-file-earmark-text"></i> {{ $purchase->purchase_number }} </b>| {{ strtoupper($purchase->supplier->supplier_name) }} | {{ date('d-M-Y', strtotime($purchase->created_at)) }}</p>
                                    </div>
                                    <div class="col-6"></div>
                                    <div class="col-2">
                                        @if($purchase->purchase_status == "menunggu kiriman")
                                        <div class="badge bg-secondary float-end text-uppercase px-3">{{ $purchase->purchase_status }}</div>
                                        @elseif($purchase->purchase_status == "kiriman selisih")
                                        <div class="badge bg-warning float-end text-uppercase px-3">{{ $purchase->purchase_status }}</div>
                                        @else
                                        <div class="badge bg-success float-end text-uppercase px-3">{{ $purchase->purchase_status }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4=8">
                                        <p class="text-secondary">Nomor PPBJe <span>: {{ $purchase->ppbje->ppbje_number }}</p></p>
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                                <div class="row">
                                    <div class="col-4=8">
                                        <p class="text-secondary">Beban Biaya <span>: {{ $purchase->cost->cost_name }}</p></p>
                                    </div>
                                    <div class="col-4"></div>
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        @if($purchase->purchase_status == "menunggu kiriman")
                                            <p class="text-secondary">Receiving <span>: {{ $purchase->receiving_number }} </p>
                                        @else
                                            <p class="text-secondary">Receiving <span>: {{ $purchase->receiving_number }} | {{ date('d-M-Y', strtotime($purchase->updated_at)) }}</p>
                                        @endif
                                    </div>
                                    <div class="col-4">
                                        @if($purchase->purchase_status == "menunggu kiriman" || $purchase->purchase_status == "kiriman selisih")
                                        <form action="{{ route('receiving.create') }}" method="POST">
                                            @csrf
                                            <input type="text" name="purchase_number" value="{{ $purchase->purchase_number }}" hidden />
                                            <input type="text" name="purchase_id" value="{{ $purchase->id }}" hidden />
                                            <button type="submit" class="btn btn-outline-success float-end"><i class="bi bi-check2-square"></i> Terima Barang</button>
                                        </form>
                                        @else
                                        <form action="{{ route('receiving.show') }}" method="GET">
                                            @csrf
                                            <input type="text" name="receiving_number" value="{{ $purchase->receiving_number }}" hidden />
                                            <input type="text" name="purchase_id" value="{{ $purchase->id }}" hidden />
                                            <button type="submit" class="btn btn-outline-primary float-end"><i class="bi bi-file-earmark-text"></i></i> Lihat Detail Receiving</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                        @endforeach
                    </div><!-- End col-12 -->
                </div><!-- End row -->
            </div><!-- End col-lg-12 -->
        </div><!-- End row -->
    </section>
@endsection