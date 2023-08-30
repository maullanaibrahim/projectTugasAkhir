@extends('layouts.third')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-cart-check me-2"></i>{{ $title }}</h5>

                                <div class="col-md-12">
                                    <p class="border-bottom"></p>
                                </div>
                                
                                <form class="row g-3 mb-3" action="/receivings/{{ $receiving->id }}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="receiving_date" id="receivingDate" value="{{ $dateNow }}" readonly>
                                            <label for="receivingDate">Tanggal</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="receiving_number" id="receivingNumber" value="RCV{{ sprintf('%09d', $rcvNumber); }}" readonly>
                                            <input type="text" name="rcv_id_old" id="rcvIdOld" value="{{ $receiving->id }}" hidden>
                                            <label for="receivingNumber">No. Receiving</label>
                                        </div>
                                    </div>

                                    <input type="text" name="purchase_id" id="poID" value="{{ old('purchase_id', $receiving->purchase_id) }}" hidden>
                                    <input type="text" name="purchase_number" id="poNumber" value="{{ old('purchase_number', $receiving->purchase->purchase_number) }}" hidden>
                                    <input type="text" name="ppbje_id" id="ppbjeID" value="{{ old('ppbje_id', $receiving->ppbje_id) }}" hidden>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="cost_name" id="costName" value="{{ old('cost_name', $receiving->purchase->cost->cost_name) }}" readonly>
                                            <label for="costName">Beban Biaya</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="supplier_name" id="supplierName" value="{{ old('supplier_name', $receiving->purchase->supplier->supplier_name) }}" readonly>
                                            <label for="costName">Supplier</label>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="recipient" id="recipient" value="{{ old('recipient', auth()->user()->first_name) }}" readonly>
                                            <label for="recipient">Penerima</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="division_name" id="divisionName" value="{{ old('division_name', auth()->user()->division->division_name) }}" readonly>
                                            <label for="divisionName">Divisi Penerima</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table table-bordered w-auto m-0">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="bg-light"><b>NO.</b></td>
                                                    <th class="col-md-5 bg-light">NAMA BARANG</th>
                                                    <th class="col-md-1 bg-light">QTY</th>
                                                    <th class="col-md-2 bg-light">SATUAN</th>
                                                    <th class="col-md-2 bg-light">NOMOR PO</th>
                                                    <th class="col-md-2 bg-light">NOMOR PPBJe</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($purchase_details as $purchase_detail)
                                                <tr>
                                                    <td class="text-uppercase text-center">{{ $no++ }}.</td>
                                                    <td class="text-uppercase">{{ $purchase_detail->ppbje_detail->item->item_name }}</td>
                                                    <td class="text-uppercase text-center">{{ str_replace('.0', '', number_format($purchase_detail->quantity, 1, '.', '')) }}</td>
                                                    <td class="text-uppercase text-center">{{ $purchase_detail->unit }}</td>
                                                    <td class="text-uppercase text-center">{{ $purchase_detail->purchase->purchase_number }}</td>
                                                    <td class="text-uppercase text-center">{{ $purchase_detail->purchase->ppbje->ppbje_number }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-12">
                                        <p class="border-bottom mb-0"></p>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-floating">
                                            <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" name="invoice_number" id="invoiceNumber" placeholder="No. Invoice / Surat Jalan" value="{{ old('invoice_number') }}" required>
                                            <label for="invoiceNumber">No. Invoice / Surat Jalan</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('invoice_number')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <select class="form-select" name="receiving_status" id="rcvStatus" required>
                                                <option value="" selected disabled>Pilih Status Receiving..</option>
                                                @if(old('receiving_status', $receiving->receiving_status))
                                                <option selected value="{{ $receiving->receiving_status }}">{{ ucwords($receiving->receiving_status) }}</option>
                                                @if($receiving->receiving_status == "belum selesai")
                                                <option value="selesai">Selesai</option>
                                                @else
                                                <option value="belum selesai">Belum Selesai</option>
                                                @endif
                                                @else
                                                <option value="selesai">Selesai</option>
                                                <option value="belum selesai">Belum Selesai</option>
                                                @endif
                                            </select>
                                            <label for="rcvStatus">Status Receiving</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control text-uppercase @error('receiving_note') is-invalid @enderror" name="receiving_note" id="rcvNote" style="height: 100px;" placeholder="Catatan Receiving">{{ old('receiving_note', $keteranganRevisi.$receiving->receiving_note) }}</textarea>
                                            <label for="rcvNote">Catatan Receiving</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('receiving_note')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <p class="border-bottom mt-2 mb-0"></p>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                                        <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                                        <a href="/receivings"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                    </div>
                                </form><!-- End Input Form -->
                            </div> <!-- End Card Body -->
                        </div> <!-- End card top-selling -->
                    </div> <!-- End col-12 -->
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div><!-- End row -->
    </section>
@endsection