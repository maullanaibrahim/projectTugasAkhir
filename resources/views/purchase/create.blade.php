@extends('layouts.secondary')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body pb-0">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-cart-plus me-2"></i>{{ $title }}</h5>

                                <!-- Showing form input new supplier -->
                                <form class="row g-3 mb-3" action="/purchases{{ encrypt(auth()->user()->position->position_name) }}" method="POST">
                                    @csrf
                                    <input type="text" name="chief" value="{{ $chiefPrc->employee_name }}" hidden>
                                    <input type="text" name="manager" value="{{ $mgrPrc->employee_name }}" hidden>
                                    <input type="text" name="senior_manager" value="{{ $srManager->employee_name }}" hidden>
                                    <input type="text" name="direktur" value="{{ $direktur->employee_name }}" hidden>

                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="purchase_number" id="poNumber" value="PO{{ sprintf('%07d', $po_number); }}" readonly>
                                            <label for="poNumber">Nomor PO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="supplier_id" id="supplierID" value="{{ old('supplier_id', $supplier->id) }}" readonly>
                                            <label for="supplierID">Supplier ID</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="supplier_name" id="namaSupplier" value="{{ old('supplier_name', $supplier->supplier_name) }}" readonly>
                                            <label for="namaSupplier">Nama Supplier</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="cost_id" id="costID" value="{{ old('cost_id', $ppbje->cost->id) }}" readonly>
                                            <label for="costID">Cost ID</label>
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
                                            <input type="text" class="form-control text-uppercase bg-light" name="jenis_po" id="jenisPO" value="{{ old('jenis_po', $ppbje->ppbje_type) }}" readonly>
                                            <label for="jenisPO">Jenis PO</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="maker" id="poMaker" value="{{ old('purchase_maker', auth()->user()->first_name) }}" readonly>
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
                                                <td hidden><input name="ppbje_detail_id[]" value="{{ $ppbje_detail->id }}"></td>
                                                <td class="text-uppercase text-center">{{ number_format($ppbje_detail->quantity,0,',','.') }}</td>
                                                <td hidden><input name="quantity[]" value="{{ $ppbje_detail->quantity }}"></td>
                                                <td class="text-uppercase text-center">{{ $ppbje_detail->item->unit }}</td>
                                                <td hidden><input name="unit[]" value="{{ $ppbje_detail->item->unit }}"></td>
                                                <td class="text-uppercase text-center"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($ppbje_detail->price,2,'.',',') }}</div></td>
                                                <td hidden><input name="price[]" value="{{ $ppbje_detail->price }}"></td>
                                                <td class="text-uppercase text-center"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($ppbje_detail->discount,2,'.',',') }}</div></td>
                                                <td hidden><input name="discount[]" value="{{ $ppbje_detail->discount }}"></td>
                                                <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($ppbje_detail->price_total,2,'.',',') }}</div></td>
                                                <td hidden><input name="price_total[]" value="{{ $ppbje_detail->price_total }}"></td>
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
                                                    <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($ppn,2,'.',',') }}</div></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" class="text-uppercase text-end pe-3 w-auto"><b>GRAND TOTAL</b></td>
                                                    <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($costTotal+$ppn,2,'.',',') }}</div></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="border-bottom mt-2 mb-0">Keterangan</p>
                                    </div>

                                    <div class="col-md-3" hidden>
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="purchase_total" id="purchaseTotal" value="{{ old('purchase_total', $costTotal+$ppn) }}" readonly>
                                            <label for="purchaseTotal">Grand Total</label>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control" name="ppbje_id" id="ppbjeID" value="{{ old('ppbje_id', $ppbje->id) }}" hidden>
                                    <div class="col-md-3">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-uppercase bg-light" name="ppbje_number" id="ppbjeNumber" value="{{ old('ppbje_number', $ppbje->ppbje_number) }}" readonly>
                                            <label for="ppbjeNumber">Nomor PPBJe</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-floating">
                                            <input type="text" class="form-control text-capitalize @error('shipping_address') is-invalid @enderror" name="shipping_address" id="shippingAddress" value="{{ old('shipping_address') }}" placeholder="" required>
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
                                            <input type="date" class="form-control @error('shipping_date') is-invalid @enderror" name="shipping_date" id="shippingDate" value="{{ old('shipping_date') }}" required>
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
                                            <input type="text" class="form-control text-capitalize @error('receiver_pic') is-invalid @enderror" name="receiver_pic" id="receiverPIC" value="{{ old('receiver_pic') }}" placeholder="" required>
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
                                            <textarea class="form-control text-uppercase @error('purchase_note') is-invalid @enderror" placeholder="" name="purchase_note" id="purchaseNote" style="height: 100px;">{{ old('purchase_note') }}</textarea>
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
                                        @if($ppbje->ppbje_type == "ASSET")
                                        <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                        @else
                                        <a href="/ppbje-nonAsset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                        @endif
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