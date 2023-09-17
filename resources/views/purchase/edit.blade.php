@extends('layouts.third')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-pencil-square me-2"></i>{{ $title }}</h5>

                                <!-- Showing form input new supplier -->
                                <form class="row g-3 mb-3" action="/purchases/{{ $purchase->id }}" method="POST">
                                    @method('put')
                                    @csrf

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="purchase_number" id="poNumber" value="{{ old('purchase_number', $purchase->purchase_number) }}" readonly>
                                            <label for="poNumber">Nomor PO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="supplier_name" id="namaSupplier" value="{{ old('supplier_name', $purchase->supplier->supplier_name) }}" readonly>
                                            <label for="namaSupplier">Nama Supplier</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="cost_name" id="costName" value="{{ old('cost_name', $purchase->cost->cost_name) }}" readonly>
                                            <label for="costName">Beban Biaya</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="jenis_po" id="jenisPO" value="{{ old('jenis_po', $purchase->ppbje->ppbje_type) }}" readonly>
                                            <label for="jenisPO">Jenis PO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="purchase_maker" id="poMaker" value="{{ old('purchase_maker', $purchase->maker) }}" readonly>
                                            <label for="poMaker">Pembuat PO</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <p class="border-bottom ">Detail Barang</p>
                                        
                                        <table class="table table-bordered w-100 bg-light mb-0">
                                            <thead>
                                                <tr class="text-center">
                                                    <th colspan="2">Barang</th>
                                                    <th rowspan="2" class="align-middle">Qty</th>
                                                    <th rowspan="2" class="align-middle">Satuan</th>
                                                    <th rowspan="2" class="align-middle">Harga Satuan</th>
                                                    <th rowspan="2" class="align-middle">Diskon</th>
                                                    <th rowspan="2" class="align-middle">Total Harga</th>
                                                </tr>    
                                                <tr class="text-center">
                                                    <th>Kode</th>
                                                    <th class="col-md-4">Nama</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-uppercase">
                                                @foreach($ppbje_details as $ppbje_detail)
                                                <tr style="height:60px;">
                                                    <td class="text-uppercase text-center">{{ $ppbje_detail->item->item_code }}</td>
                                                    <td class="text-uppercase">{{ $ppbje_detail->item->item_name }}</td>
                                                    <td class="text-uppercase text-center">{{ number_format($ppbje_detail->quantity,0,',','.') }}</td>
                                                    <td class="text-uppercase text-center">{{ $ppbje_detail->item->unit }}</td>
                                                    <td class="text-uppercase text-center"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($ppbje_detail->price,2,'.',',') }}</div></td>
                                                    <td class="text-uppercase text-center"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($ppbje_detail->discount,2,'.',',') }}</div></td>
                                                    <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($ppbje_detail->price_total,2,'.',',') }}</div></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td colspan="6" class="text-uppercase text-end pe-3 w-auto"><b>SUB TOTAL</b></td>
                                                    <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($costTotal,2,'.',',') }}</div></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" class="text-uppercase text-end pe-3 w-auto"><b>PPN (11%)</b></td>
                                                    @if($purchase->supplier->tax == "PPN")
                                                    <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($costTotal*11/100,2,'.',',') }}</div></td>
                                                    @else
                                                    <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format(0,2,'.',',') }}</div></td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td colspan="6" class="text-uppercase text-end pe-3 w-auto"><b>GRAND TOTAL</b></td>
                                                    <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($purchase->purchase_total,2,'.',',') }}</div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="border-bottom mt-2 mb-0">Keterangan</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="ppbje_number" id="ppbjeNumber" value="{{ old('ppbje_number', $purchase->ppbje->ppbje_number) }}" readonly>
                                            <label for="ppbjeNumber">Nomor PPBJe</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-capitalize @error('shipping_address') is-invalid @enderror" name="shipping_address" id="shippingAddress" value="{{ old('shipping_address', $purchase->shipping_address) }}" placeholder="" required>
                                            <label for="shippingAddress">Alamat Kirim</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('shipping_address')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="date" class="form-control @error('shipping_date') is-invalid @enderror" name="shipping_date" id="shippingDate" value="{{ old('shipping_date', $purchase->shipping_date) }}" required>
                                            <label for="shippingDate">Tgl Kirim</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('shipping_date')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-capitalize @error('receiver_pic') is-invalid @enderror" name="receiver_pic" id="receiverPIC" value="{{ old('receiver_pic', $purchase->receiver_pic) }}" placeholder="" required>
                                            <label for="receiverPIC">PIC Penerima</label>

                                            <!-- Showing notification error for input validation -->
                                            @error('receiver_pic')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <textarea class="form-control text-uppercase @error('purchase_note') is-invalid @enderror" placeholder="" name="purchase_note" id="purchaseNote" style="height: 100px;">{{ old('purchase_note', $purchase->purchase_note) }}</textarea>
                                            <label for="purchaseNote">Catatan (Opsional)</label>
                                            
                                            <!-- Showing notification error for input validation -->
                                            @error('purchase_note')
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
                                        <a href="/purchases{{ encrypt(auth()->user()->position->position_name) }}"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                    </div>
                                </form><!-- End floating Labels Form -->
                            </div> <!-- End Card Body -->
                        </div><!-- End card top-selling -->
                    </div> <!-- End col-12 -->
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div><!-- End row -->
    </section>
@endsection