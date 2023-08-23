@extends('layouts.secondary')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-4">
                                <div class="border-bottom mb-3 pb-3">
                                    <a href="/purchases{{ encrypt(auth()->user()->position->position_name) }}"><button type="button" class="btn btn-outline-secondary shadow-sm"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                    <a href="#"><button type="button" class="btn btn-outline-success shadow-sm ms-1"><i class="bi bi-printer-fill me-1"></i> Cetak</button></a>

                                    @if($purchase->purchase_status == "belum disetujui")
                                    <div class="badge bg-secondary float-end text-uppercase px-3">{{ $purchase->purchase_status }}</div>
                                    @elseif($purchase->purchase_status == "menunggu kiriman")
                                    <div class="badge bg-primary float-end text-uppercase px-3">{{ $purchase->purchase_status }}</div>
                                    @elseif($purchase->purchase_status == "sudah diterima")
                                    <div class="badge bg-success float-end text-uppercase px-3">{{ $purchase->purchase_status }}</div>
                                    @elseif($purchase->purchase_status == "tidak disetujui")
                                    <div class="badge bg-danger float-end text-uppercase px-3">{{ $purchase->purchase_status }}</div>
                                    @endif
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <img class="w-50" style="margin-left:-8px;" src="../dist/img/logo/logo2.png" alt="">
                                    </div>
                                    <div class="col-md-6 pt-4 text-center" style="font-size:20px">
                                        <p><b>PURCHASE ORDER (PO)</b></p>
                                        <p style="margin-top:-25px;"><b>{{ strtoupper($purchase->cost->company_name) }}</b></p>
                                    </div>
                                </div>
                                <div class="row" style="height:25px;font-size:18px;">
                                    <div class="col-md-6">
                                        <p><span style="margin-right: 20px;">Nomor PO </span><span style="margin-right: 15px;">:</span> {{ $purchase->purchase_number }}</p>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2 ps-3">
                                        <p><span style="margin-right: 18px;">Diajukan Untuk </span>: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{ strtoupper($purchase->ppbje->cost->cost_name) }}</p>
                                    </div>
                                </div>
                                <div class="row" style="font-size:18px;">
                                    <div class="col-md-6">
                                        <p><span style="margin-right: 15px;">Tanggal PO </span><span style="margin-right: 15px;">:</span> {{ date('d F Y', strtotime($purchase->created_at)) }}</p>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2 ps-3">
                                        <p><span style="margin-right: 47px;">Dibuat Oleh </span>: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{ strtoupper($purchase->purchase_maker) }}</p>
                                    </div>
                                </div>

                                <p class="border-bottom"></p>

                                <div class="row" style="height:25px;font-size:18px;">
                                    <div class="col-md-6">
                                        <p><span style="margin-right: 40px;">Supplier </span><span style="margin-right: 15px;">:</span> {{ strtoupper($purchase->supplier->supplier_name) }}</p>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-2 ps-3">
                                        <p><span style="margin-right: 93px;float:left;">Alamat </span>: </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p>{{ ucwords($purchase->supplier->supplier_address) }}</p>
                                    </div>
                                </div>
                                <div class="row" style="height:25px;font-size:18px;">
                                    <div class="w-auto me-5">
                                        <p><span style="margin-right: 51px;">Kontak </span><span style="margin-right: 15px;">:</span> {{ $purchase->supplier->supplier_contact }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <p><span style="margin-right: 15px;">TOP </span>: {{ $purchase->supplier->term }}</p>
                                    </div>
                                </div>
                                <div class="row" style="height:25px;font-size:18px;">
                                    <div class="col-md-6">
                                        <p><span style="margin-right: 17px;">Expired PO </span><span style="margin-right: 15px;">:</span> {{ date('d F Y', strtotime($purchase->purchase_expired)) }}</p>
                                    </div>
                                </div>
                                <div class="row" style="font-size:18px;">
                                    <div class="col-md-6">
                                        @if($purchase->ppbje->ppbje_type == "asset")
                                        <p><span style="margin-right: 65px;">Asset </span><span style="margin-right: 15px;">:</span> <i class="bi bi-check2"></i></p>
                                        @else
                                        <p><span style="margin-right: 65px;">Asset </span>: </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <p class="border-bottom">Detail Barang</p>
                                        
                                    <table class="table table-bordered w-100">
                                        <thead>
                                            <tr class="text-center bg-light">
                                                <th colspan="2">Barang</th>
                                                <th rowspan="2" class="align-middle">Qty</th>
                                                <th rowspan="2" class="align-middle">Satuan</th>
                                                <th rowspan="2" class="align-middle">Harga Satuan</th>
                                                <th rowspan="2" class="align-middle">Diskon</th>
                                                <th rowspan="2" class="align-middle">Total Harga</th>
                                            </tr>    
                                            <tr class="text-center bg-light">
                                                <th>Kode</th>
                                                <th class="col-md-4">Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-uppercase">
                                            @foreach($purchase_details as $purchase_detail)
                                            <tr style="height:60px;">
                                                <td class="text-uppercase text-center">{{ $purchase_detail->ppbje_detail->item->item_code }}</td>
                                                <td class="text-uppercase">{{ $purchase_detail->ppbje_detail->item->item_name }}</td>
                                                <td class="text-uppercase text-center">{{ number_format($purchase_detail->quantity,0,',','.') }}</td>
                                                <td class="text-uppercase text-center">{{ $purchase_detail->unit }}</td>
                                                <td class="text-uppercase text-center"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($purchase_detail->price,2,'.',',') }}</div></td>
                                                <td class="text-uppercase text-center"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($purchase_detail->discount,2,'.',',') }}</div></td>
                                                <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($purchase_detail->price_total,2,'.',',') }}</div></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td colspan="6" class="text-uppercase bg-light text-end pe-3 w-auto"><b>SUB TOTAL</b></td>
                                                <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($costTotal,2,'.',',') }}</div></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-uppercase bg-light text-end pe-3 w-auto"><b>PPN (11%)</b></td>
                                                @if($purchase->supplier->tax == "PPN")
                                                <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($costTotal*11/100,2,'.',',') }}</div></td>
                                                @else
                                                <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format(0,2,'.',',') }}</div></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="text-uppercase bg-light text-end pe-3 w-auto"><b>GRAND TOTAL</b></td>
                                                <td class="text-uppercase text-center w-auto"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($purchase->purchase_total,2,'.',',') }}</div></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row" style="font-size:16px;">
                                    <div class="col-md-12">
                                        <p><span style="margin-right: 5px;">No.PPBJe </span><span style="margin-right: 5px;">:</span> {{ $purchase->ppbje->ppbje_number }}</p>
                                    </div>
                                </div>
                                <div class="row" style="height:25px;font-size:16px;">
                                    <div class="col-md-12">
                                        <p><span style="margin-right: 5px;">Mohon dikirim ke </span>: {{ ucwords($purchase->shipping_address) }}</p>
                                    </div>
                                </div>
                                <div class="row" style="height:25px;font-size:16px;">
                                    <div class="col-md-12">
                                        <p><span style="margin-right: 5px;">Tanggal </span>: {{ date('d F Y', strtotime($purchase->shipping_date)) }}</p>
                                    </div>
                                </div>
                                <div class="row" style="height:25px;font-size:16px;">
                                    <div class="col-md-12">
                                        <p><span style="margin-right: 5px;">PIC </span>: {{ ucwords($purchase->receiver_pic) }}</p>
                                    </div>
                                </div>
                                <div class="row" style="height:15px;"></div>
                                <div class="row" style="height:25px;font-size:16px;">
                                    <div class="col-md-4">
                                        <p><span style="margin-right: 5px;">Keterangan </span>: </p>
                                    </div>
                                </div>
                                <div class="row mb-3" style="font-size:16px;">
                                    <div class="col-md-12">
                                        <p class="mb-0">1. PO ini sah tanpa di bubuhi tanda tangan.</p>
                                        <p class="mb-0">2. Pihak Konohagakure tidak menerima kenaikan harga setelah terbit PO.</p>
                                        <p class="mb-0">3. Pihak Konohagakure akan membayar netto terkecil antara PO dan Faktur.</p>
                                        <p class="mb-0">4. Mohon sertakan PO ini ketika pengiriman barang.</p>
                                    </div>
                                </div>
                                <div class="row" style="font-size:16px;">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr class="bg-light">
                                                    @if($purchase->purchase_status == "belum disetujui")
                                                    <td colspan="5" style="font-size:14px;">MENUNGGU PERSETUJUAN</td>
                                                    @elseif($purchase->purchase_status == "menunggu kiriman")
                                                    <td colspan="5" style="font-size:14px;">DISETUJUI OLEH :</td>
                                                    @elseif($purchase->purchase_status == "sudah diterima")
                                                    <td colspan="5" style="font-size:14px;">DISETUJUI OLEH :</td>
                                                    @else
                                                    <td colspan="5" style="font-size:14px;">TIDAK DISETUJUI</td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td class="col-md-2" style="font-size:14px;">
                                                        <p class="fw-bold mb-4">STAFF PROCUREMENT</p>
                                                        <p class="m-0"><span style="margin-right: 13px;">Nama </span>: {{ strtoupper($purchase->purchase_maker) }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Tanggal </span>: {{ date('d-M-Y', strtotime($purchase->created_at)) }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Catatan </span>:</p>
                                                    </td>
                                                    <td class="col-md-2" style="font-size:14px;">
                                                        <p class="fw-bold mb-4">CHIEF</p>
                                                        <p class="m-0"><span style="margin-right: 13px;">Nama </span>: {{ strtoupper($purchase->purchase_approval->chief) }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Tanggal </span>: {{ $purchase->purchase_approval->date1 }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Catatan </span>: {{ $purchase->purchase_approval->note1 }}</p>
                                                    </td>
                                                    @if($purchase->purchase_total > 2000000)
                                                    <td class="col-md-2" style="font-size:14px;">
                                                        <p class="fw-bold mb-4">MANAGER</p>
                                                        <p class="m-0"><span style="margin-right: 13px;">Nama </span>: {{ strtoupper($purchase->purchase_approval->manager) }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Tanggal </span>: {{ $purchase->purchase_approval->date2 }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Catatan </span>: {{ $purchase->purchase_approval->note2 }}</p>
                                                    </td>
                                                    @elseif($purchase->purchase_total > 5000000)
                                                    <td class="col-md-2" style="font-size:14px;">
                                                        <p class="fw-bold mb-4">SENIOR MANAGER</p>
                                                        <p class="m-0"><span style="margin-right: 13px;">Nama </span>: {{ strtoupper($purchase->purchase_approval->senior_manager) }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Tanggal </span>: {{ $purchase->purchase_approval->date3 }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Catatan </span>: {{ $purchase->purchase_approval->note3 }}</p>
                                                    </td>
                                                    @elseif($purchase->purchase_total > 10000000)
                                                    <td class="col-md-2" style="font-size:14px;">
                                                        <p class="fw-bold mb-4">DIREKTUR</p>
                                                        <p class="m-0"><span style="margin-right: 13px;">Nama </span>: {{ strtoupper($purchase->purchase_approval->direktur) }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Tanggal </span>: {{ $purchase->purchase_approval->date4 }}</p>
                                                        <p class="m-0"><span style="margin-right: 2px;">Catatan </span>: {{ $purchase->purchase_approval->note4 }}</p>
                                                    </td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>

                                        @if(auth()->user()->position->position_name == "Chief")
                                            @if($purchase->purchase_approval->status1 == "belum disetujui")
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:14px;">
                                                            <!-- Button for Agree this PPBJe -->
                                                            <form action="/purchases/{{ $purchase->id }}" method="post" class="d-inline">  
                                                                @csrf
                                                                <!-- Sending URL definition (Asset or Non Asset). -->
                                                                <input type="text" class="form-control" name="status" id="status" value="menyetujui" hidden>
                                                                <input type="text" class="form-control" name="note" id="agreeNote" hidden>
                                                                <input type="text" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                <button class="btn btn-success btn-sm" style="width:15%"><i class="bi bi-check-circle"></i> Setuju</button>
                                                            </form>
                                                            <!-- Button for Disagree this PPBJe -->
                                                            <form action="/purchases/{{ $purchase->id }}" method="post" class="d-inline">  
                                                                @csrf
                                                                <!-- Sending URL definition (Asset or Non Asset). -->
                                                                <input type="text" class="form-control" name="status" id="status" value="tidak menyetujui" hidden>
                                                                <input type="text" class="form-control" name="note" id="disagreeNote" hidden>
                                                                <input type="text" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                <button class="btn btn-danger btn-sm" style="width:15%"><i class="bi bi-x-circle"></i> Tidak Setuju</button>
                                                            </form>
                                                            <input type="text" class="form-control form-control-sm d-inline" style="width:68%;margin-left:12px;" name="approval_note" id="approvalNote" placeholder="Tulis catatan...">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @else
                                            @endif
                                        @else
                                        @endif

                                        @if(auth()->user()->position->position_name == "Manager")
                                            @if($purchase->purchase_approval->status1 == "menyetujui")
                                                @if($purchase->purchase_approval->status2 == "belum disetujui")
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td style="font-size:14px;">
                                                                <!-- Button for Agree this PPBJe -->
                                                                <form action="/purchases/{{ $purchase->id }}" method="post" class="d-inline">  
                                                                    @csrf
                                                                    <!-- Sending URL definition (Asset or Non Asset). -->
                                                                    <input type="text" class="form-control" name="status" id="status" value="menyetujui" hidden>
                                                                    <input type="text" class="form-control" name="note" id="agreeNote" hidden>
                                                                    <input type="text" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                    <button class="btn btn-success btn-sm" style="width:15%"><i class="bi bi-check-circle"></i> Setuju</button>
                                                                </form>
                                                                <!-- Button for Disagree this PPBJe -->
                                                                <form action="/purchases/{{ $purchase->id }}" method="post" class="d-inline">  
                                                                    @csrf
                                                                    <!-- Sending URL definition (Asset or Non Asset). -->
                                                                    <input type="text" class="form-control" name="status" id="status" value="tidak menyetujui" hidden>
                                                                    <input type="text" class="form-control" name="note" id="disagreeNote" hidden>
                                                                    <input type="text" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                    <button class="btn btn-danger btn-sm" style="width:15%"><i class="bi bi-x-circle"></i> Tidak Setuju</button>
                                                                </form>
                                                                <input type="text" class="form-control form-control-sm d-inline" style="width:68%;margin-left:12px;" name="approval_note" id="approvalNote" placeholder="Tulis catatan...">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @else
                                                @endif
                                            @else
                                            @endif
                                        @else
                                        @endif

                                        @if(auth()->user()->position->position_name == "Senior Manager")
                                            @if($purchase->purchase_approval->status2 == "menyetujui")
                                                @if($purchase->purchase_approval->status3 == "belum disetujui")
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td style="font-size:14px;">
                                                                <!-- Button for Agree this PPBJe -->
                                                                <form action="/purchases/{{ $purchase->id }}" method="post" class="d-inline">  
                                                                    @csrf
                                                                    <!-- Sending URL definition (Asset or Non Asset). -->
                                                                    <input type="text" class="form-control" name="status" id="status" value="menyetujui" hidden>
                                                                    <input type="text" class="form-control" name="note" id="agreeNote" hidden>
                                                                    <input type="text" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                    <button class="btn btn-success btn-sm" style="width:15%"><i class="bi bi-check-circle"></i> Setuju</button>
                                                                </form>
                                                                <!-- Button for Disagree this PPBJe -->
                                                                <form action="/purchases/{{ $purchase->id }}" method="post" class="d-inline">  
                                                                    @csrf
                                                                    <!-- Sending URL definition (Asset or Non Asset). -->
                                                                    <input type="text" class="form-control" name="status" id="status" value="tidak menyetujui" hidden>
                                                                    <input type="text" class="form-control" name="note" id="disagreeNote" hidden>
                                                                    <input type="text" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                    <button class="btn btn-danger btn-sm" style="width:15%"><i class="bi bi-x-circle"></i> Tidak Setuju</button>
                                                                </form>
                                                                <input type="text" class="form-control form-control-sm d-inline" style="width:68%;margin-left:12px;" name="approval_note" id="approvalNote" placeholder="Tulis catatan...">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @else
                                                @endif
                                            @else
                                            @endif
                                        @else
                                        @endif

                                        @if(auth()->user()->position->position_name == "Direktur")
                                            @if($purchase->purchase_approval->status3 == "menyetujui")
                                                @if($purchase->purchase_approval->status4 == "belum disetujui")
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td style="font-size:14px;">
                                                                <!-- Button for Agree this PPBJe -->
                                                                <form action="/purchases/{{ $purchase->id }}" method="post" class="d-inline">  
                                                                    @csrf
                                                                    <!-- Sending URL definition (Asset or Non Asset). -->
                                                                    <input type="text" class="form-control" name="status" id="status" value="menyetujui" hidden>
                                                                    <input type="text" class="form-control" name="note" id="agreeNote" hidden>
                                                                    <input type="text" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                    <button class="btn btn-success btn-sm" style="width:15%"><i class="bi bi-check-circle"></i> Setuju</button>
                                                                </form>
                                                                <!-- Button for Disagree this PPBJe -->
                                                                <form action="/purchases/{{ $purchase->id }}" method="post" class="d-inline">  
                                                                    @csrf
                                                                    <!-- Sending URL definition (Asset or Non Asset). -->
                                                                    <input type="text" class="form-control" name="status" id="status" value="tidak menyetujui" hidden>
                                                                    <input type="text" class="form-control" name="note" id="disagreeNote" hidden>
                                                                    <input type="text" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                    <button class="btn btn-danger btn-sm" style="width:15%"><i class="bi bi-x-circle"></i> Tidak Setuju</button>
                                                                </form>
                                                                <input type="text" class="form-control form-control-sm d-inline" style="width:68%;margin-left:12px;" name="approval_note" id="approvalNote" placeholder="Tulis catatan...">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                @else
                                                @endif
                                            @else
                                            @endif
                                        @else
                                        @endif
                                    </div>
                                </div>
                            </div> <!-- End Card Body -->
                        </div><!-- End card top-selling -->
                    </div> <!-- End col-12 -->
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div><!-- End row -->
    </section>

    <script>
        $(document).ready(function(){
            $('#approvalNote').keyup(function(){
                var note = $(this).val();
                $('#agreeNote').val(note);
                $('#disagreeNote').val(note);
            });
        });
    </script>
@endsection