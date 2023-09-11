@extends('layouts.secondary')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-3">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-tags-fill me-2"></i>{{ $title }}</h5>

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
                                                <th class="col-md-1 bg-light">SATUAN</th>
                                                <th class="bg-light">KETERANGAN</th>
                                                <th class="bg-light">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ppbje_details as $ppbje_detail)
                                            <tr>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ $no++ }}." readonly></td>
                                                <td><input type="text" class="form-control border-0 bg-light" value="{{ strtoupper($ppbje_detail->item->item_name) }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ $ppbje_detail->quantity }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ $ppbje_detail->item->unit }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light text-uppercase" name="purchase_number" id="purchaseNumber" value="{{ $ppbje_detail->purchase_number }}" readonly></td>
                                                <td class="text-center">
                                                    @if($ppbje->ppbje_note == 'cek stock')
                                                        @if($ppbje_detail->purchase_number == NULL)
                                                        <div class="container">
                                                            <!-- Tombol untuk menandai stock asset -->
                                                            <form action="/ppbje-asset/{{ $ppbje_detail->id }}/update-stock" method="post" class="d-inline">  
                                                                @csrf
                                                                <input type="text" class="form-control" name="note" id="note" value="stock asset" hidden>
                                                                <button class="btn btn-primary"><i class="bi bi-tags-fill me-1"></i> Stock</button>
                                                            </form>
                                                        </div>
                                                        @else
                                                        <div class="container">
                                                            <!-- Tombol untuk menandai stock asset -->
                                                            <form action="/ppbje-asset/{{ $ppbje_detail->id }}/update-stock" method="post" class="d-inline">  
                                                                @csrf
                                                                <input type="text" class="form-control" name="note" id="note" value="stock asset" hidden>
                                                                <button class="btn btn-primary" disabled><i class="bi bi-tags-fill me-1"></i> Stock</button>
                                                            </form>
                                                        </div>
                                                        @endif
                                                    @elseif($ppbje->ppbje_note == 'beli')
                                                    <div class="container">
                                                        <!-- Tombol untuk menandai stock asset -->
                                                        <form action="/ppbje-asset/{{ $ppbje_detail->id }}/update-stock" method="post" class="d-inline">  
                                                            @csrf
                                                            <input type="text" class="form-control" name="note" id="note" value="stock asset" hidden>
                                                            <button class="btn btn-primary" disabled><i class="bi bi-tags-fill me-1"></i> Stock</button>
                                                        </form>
                                                    </div>
                                                    @elseif($ppbje->ppbje_note == 'stock asset')
                                                    <div class="container">
                                                        <!-- Tombol untuk menandai stock asset -->
                                                        <form action="/ppbje-asset/{{ $ppbje_detail->id }}/update-stock" method="post" class="d-inline">  
                                                            @csrf
                                                            <input type="text" class="form-control" name="note" id="note" value="stock asset" hidden>
                                                            <button class="btn btn-primary" disabled><i class="bi bi-tags-fill me-1"></i> Stock</button>
                                                        </form>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <p class="border-bottom mt-2"></p>
                                </div>

                                <div class="col-md-12">
                                @if($ppbje->ppbje_type == "ASSET")
                                        <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                        @else
                                        <a href="/ppbje-nonAsset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                        @endif
                                    <!-- Tombol untuk menandai beli -->
                                    @if($ppbje->ppbje_note == 'beli')
                                    <form action="/ppbje-asset/{{ $ppbje_detail->id }}/update-stock" method="post" class="d-inline float-end">  
                                        @csrf
                                        <input type="text" class="form-control" name="note" id="note" value="beli" hidden>
                                        <button class="btn btn-danger" disabled><i class="bi bi-cart me-1"></i> Beli</button>
                                    </form>
                                    @elseif($ppbje->ppbje_note == 'cek stock')
                                    <form action="/ppbje-asset/{{ $ppbje_detail->id }}/update-stock" method="post" class="d-inline float-end">  
                                        @csrf
                                        <input type="text" class="form-control" name="note" id="note" value="beli" hidden>
                                        <button class="btn btn-danger"><i class="bi bi-cart me-1"></i> Beli</button>
                                    </form>
                                    @elseif($ppbje->ppbje_note == 'stock asset')
                                        <form action="/ppbje-asset/{{ $ppbje_detail->id }}/update-stock" method="post" class="d-inline float-end">  
                                            @csrf
                                            <input type="text" class="form-control" name="note" id="note" value="beli" hidden>
                                            <button class="btn btn-danger" disabled><i class="bi bi-cart me-1"></i> Beli</button>
                                        </form>
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