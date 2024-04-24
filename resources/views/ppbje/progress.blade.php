@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <div class="card-title border-bottom mb-3"><i class="bi bi-bar-chart-fill me-2"></i>
                                    {{ $title }} |

                                    @if($ppbje->ppbje_status == "belum disetujui")
                                    <div class="badge bg-secondary text-uppercase ms-1">{{ $ppbje->ppbje_status }}</div>
                                    @elseif($ppbje->ppbje_status == "berlangsung")
                                        @if($ppbje->ppbje_note == "cek stock")
                                        <div class="badge bg-warning text-uppercase ms-1">cek stock asset</div>
                                        @else
                                        <div class="badge bg-warning text-uppercase ms-1">proses pembuatan po</div>
                                        @endif
                                    @elseif($ppbje->ppbje_status == "persetujuan po")
                                    <div class="badge bg-warning text-uppercase ms-1">{{ $ppbje->ppbje_status }}</div>
                                    @elseif($ppbje->ppbje_status == "menunggu kiriman")
                                    <div class="badge bg-primary text-uppercase ms-1">{{ $ppbje->ppbje_status }}</div>
                                    @elseif($ppbje->ppbje_status == "selesai")
                                    <div class="badge bg-success text-uppercase ms-1">{{ $ppbje->ppbje_status }}</div>
                                    @elseif($ppbje->ppbje_status == "batal")
                                    <div class="badge bg-danger text-uppercase ms-1">{{ $ppbje->ppbje_status }}</div>
                                    @elseif($ppbje->ppbje_status == "tidak disetujui")
                                    <div class="badge bg-danger text-uppercase ms-1">{{ $ppbje->ppbje_status }}</div>
                                    @endif

                                    <div class="float-end">
                                    @can('procurement')
                                        @if($ppbje->ppbje_note == "beli")
                                            <!-- Menampilkan tombol Buat PO jika posisi user sebagai staff procurement -->
                                            @if(auth()->user()->position_id == 10)
                                            <!-- Button for Create Purchase Order -->
                                            <div class="btn-group ms-1" role="group">
                                                @if($ppbje->ppbje_status == "berlangsung")
                                                <button type="button" class="btn btn-primary shadow-sm dropdown-toggle rounded" data-bs-toggle="dropdown">
                                                    <i class="bi bi-cart-plus-fill"></i> Buat PO
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @foreach($getSuppliers as $getSupplier)
                                                    <li><a class="dropdown-item" href="/purchases/create{{ encrypt($ppbje->id) }}-{{ encrypt($getSupplier->supplier->id) }}">{{ strtoupper($getSupplier->supplier->supplier_name) }}</a></li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                <button type="button" class="btn btn-primary shadow-sm dropdown-toggle rounded" data-bs-toggle="dropdown" disabled>
                                                    <i class="bi bi-cart-plus-fill"></i> Buat PO
                                                </button>
                                                @endif
                                            </div>
                                            @endif
                                        @else
                                        @endif
                                        @endcan

                                        @can('asset')
                                        @if($ppbje->ppbje_note == "cek stock")
                                            @if(auth()->user()->position_id == 10)
                                            <!-- Tombol untuk Cek Stock Asset -->
                                            <a href="/ppbje-asset/stock{{ $ppbje->id }}" method="post" class="d-inline">
                                                <button class="btn btn-primary shadow-sm rounded"><i class="bi bi-tags-fill"></i> Tandai Stock / Beli</button>
                                            </a>
                                            @endif
                                        @else
                                            @if(auth()->user()->position_id == 1)
                                                @if($ppbje->ppbje_status == "selesai")
                                                <div class="btn-group ms-1" role="group">
                                                    <button type="button" class="btn btn-primary shadow-sm dropdown-toggle rounded" data-bs-toggle="dropdown" disabled>
                                                        <i class="bi bi-card-text"></i> Input Mutasi
                                                    </button>
                                                </div>
                                                @else
                                                <!-- Tombol untuk Cek Stock Asset -->
                                                <div class="btn-group ms-1" role="group">
                                                    <button type="button" class="btn btn-primary shadow-sm dropdown-toggle rounded" data-bs-toggle="dropdown">
                                                        <i class="bi bi-card-text"></i> Input Mutasi
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-arrow mt-2 end-0">
                                                        <li class="px-2" style="width:300px">
                                                            <form action="/ppbje-mutation{{ $ppbje->id }}" method="POST">
                                                                @csrf
                                                                <input type="text" class="form-control" name="mutationNumber" id="mutationNumber" placeholder="Input Nomor Mutasi Asset...">
                                                                <button type="submit" class="btn btn-sm btn-primary shadow-sm rounded mt-2 float-end">Submit</button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @endif
                                            @endif
                                        @endif
                                        @endcan
                                    </div>
                                </div>

                                <form class="row g-3 mb-3">
                                    @csrf
                                    <!-- Form PPBJe -->
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control bg-light" name="ppbje_number" id="noPpbje" value="{{ old('ppbje_number', $ppbje->ppbje_number) }}" readonly>
                                            <label for="noPpbje">Nomor PPBJe</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="cost_name" id="costName" value="{{ old('cost_name', $ppbje->cost->cost_name) }}" readonly>
                                            <label for="costName">Beban Biaya</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="date_of_need" id="tglKebutuhan" value="{{ old('date_of_need', date('d-M-Y', strtotime($ppbje->date_of_need))) }}" readonly>
                                            <label for="tglKebutuhan">Tgl Kebutuhan</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="applicant_name" id="applicantName" value="{{ old('applicant_name', $ppbje->applicant_name) }}" readonly>
                                            <label for="applicantName">Pemohon</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="ppbje_type" id="ppbjeType" value="{{ old('ppbje_type', $ppbje->ppbje_type) }}" readonly>
                                            <label for="ppbjeType">Jenis PPBJe</label>
                                        </div>
                                    </div>
                                </form>

                                <!-- Form Detail PPBJe -->
                                <div class="col-md-12">
                                    <p class="border-bottom">Detail Barang</p>

                                    <table class="table table-bordered w-auto m-0">
                                        <thead>
                                            <tr class="text-center">
                                                <td class="bg-light" style="width:5%;"><b>NO.</b></td>
                                                <th class="col-md-5 bg-light">NAMA BARANG</th>
                                                <th class="col-md-1 bg-light">QTY</th>
                                                <th class="w-auto bg-light">SATUAN</th>
                                                @if($ppbje->ppbje_type == 'asset')
                                                <th class="bg-light">STOCK / PO</th>
                                                <th class="bg-light">NO. MUTASI / RECEIVING</th>
                                                @else
                                                <th class="bg-light">NOMOR PO</th>
                                                <th class="bg-light">NOMOR RECEIVING</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ppbje_details as $ppbje_detail)
                                            <tr>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ $no++ }}." readonly></td>
                                                <td><input type="text" class="form-control border-0 bg-light" value="{{ strtoupper($ppbje_detail->item->item_name) }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ str_replace('.0', '', number_format($ppbje_detail->quantity, 1, '.', '')) }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ $ppbje_detail->item->unit }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light text-uppercase" name="purchase_number" id="purchaseNumber" value="{{ $ppbje_detail->purchase_number }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light text-uppercase" name="receiving_number" id="receivingNumber" value="{{ $ppbje_detail->receiving_number }}" readonly></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                </div>
                                @if($ppbje->ppbje_status == "menunggu kiriman")
                                    @if($ppbje_detail->receiving_number != NULL)
                                    <div class="col-md-12 mt-2"><span class="badge bg-warning">Note : Ada receiving yang belum selesai.</span></div>
                                    @endif
                                @endif
                                <div class="col-md-12 pt-3">
                                    <p class="border-bottom mt-2"></p>
                                </div>

                                <div class="col-md-6">
                                    @if($ppbje->ppbje_type == 'asset')
                                    <a href="/ppbje-asset{{ encrypt(auth()->user()->division->division_name) }}-{{ encrypt(auth()->user()->position->position_name) }}"><button type="button" class="btn btn-secondary float-start mb-3"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                    @else
                                    <a href="/ppbje-nonAsset{{ encrypt(auth()->user()->division->division_name) }}-{{ encrypt(auth()->user()->position->position_name) }}"><button type="button" class="btn btn-secondary float-start mb-3"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                    @endif
                                </div>
                            </div> <!-- End Card Body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
