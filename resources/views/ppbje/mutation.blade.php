@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
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
                                                <th class="col-md-2 bg-light">STOCK / PO</th>
                                                <th class="bg-light">NOMOR MUTASI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ppbje_details as $ppbje_detail)
                                            <tr>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ $no++ }}." readonly></td>
                                                <td><input type="text" class="form-control border-0 bg-light" value="{{ strtoupper($ppbje_detail->item->item_name) }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ str_replace('.0', '', number_format($ppbje_detail->quantity, 1, '.', '')) }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ $ppbje_detail->item->unit }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center bg-light" value="{{ strtoupper($ppbje_detail->purchase_number) }}" readonly></td>
                                                <td><input type="text" class="form-control border-0 text-center text-uppercase" name="receiving_number" id="rcvNumber" placeholder="Tulis Nomor Mutasi..." required></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                     </table>
                                </div>
                                <div class="col-md-12 pt-3">
                                    <p class="border-bottom mt-2"></p>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                                    <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                                    <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}"><button type="button" class="btn btn-secondary float-start mb-3"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                </div>
                            </div> <!-- End Card Body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
