<div class="print-area d-none">
    <div class="row mb-3">
        <div class="col-6">
            <img class="w-50" style="margin-left:-8px;" src="../dist/img/logo/logo2.png" alt="">
        </div>
        <div class="col-6 pt-3 text-center" style="font-size:20px">
            <p><b>PURCHASE ORDER (PO)</b></p>
            <p style="margin-top:-25px;"><b>{{ strtoupper($purchase->cost->company_name) }}</b></p>
        </div>
    </div>
    <div class="row" style="height:25px;font-size:18px;">
        <div class="col-6">
            <p><span style="margin-right: 20px;">Nomor PO </span><span style="margin-right: 15px;">:</span> {{ $purchase->purchase_number }}</p>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <p><span style="margin-right: 20px;">Diajukan Untuk </span><span style="margin-right: 15px;">:</span>{{ strtoupper($purchase->ppbje->cost->cost_name) }}</p>
        </div>
    </div>
    <div class="row" style="font-size:18px;">
        <div class="col-6">
            <p><span style="margin-right: 15px;">Tanggal PO </span><span style="margin-right: 15px;">:</span> {{ date('d F Y', strtotime($purchase->created_at)) }}</p>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <p><span style="margin-right: 46px;">Dibuat Oleh </span><span style="margin-right: 15px;">:</span>{{ strtoupper($purchase->maker) }}</p>
        </div>
    </div>

    <p class="border-bottom border-secondary"></p>

    <div class="row" style="height:25px;font-size:18px;">
        <div class="col-6">
            <p><span style="margin-right: 39px;">Supplier </span><span style="margin-right: 15px;">:</span> {{ strtoupper($purchase->supplier->supplier_name) }}</p>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <p><span style="margin-right: 15px;">Alamat </span><span style="margin-right: 15px;">:</span> {{ ucwords($purchase->supplier->supplier_address) }}</p>
        </div>
    </div>
    <div class="row" style="height:25px;font-size:18px;">
        <div class="w-auto me-5">
            <p><span style="margin-right: 48px;">Kontak </span><span style="margin-right: 15px;">:</span> {{ $purchase->supplier->supplier_contact }}</p>
        </div>
        <div class="col-2">
            <p><span style="margin-right: 15px;">TOP </span>: {{ $purchase->supplier->term }}</p>
        </div>
    </div>
    <div class="row" style="height:25px;font-size:18px;">
        <div class="col-6">
            <p><span style="margin-right: 18px;">Expired PO </span><span style="margin-right: 15px;">:</span> {{ date('d F Y', strtotime($purchase->purchase_expired)) }}</p>
        </div>
    </div>
    <div class="row" style="font-size:18px;">
        <div class="col-6">
            @if($purchase->ppbje->ppbje_type == "asset")
            <p><span style="margin-right: 65px;">Asset </span><span style="margin-right: 15px;">:</span> <i class="bi bi-check2"></i></p>
            @else
            <p><span style="margin-right: 61px;">Asset </span>: </p>
            @endif
        </div>
    </div>

    <div class="col-12">
        <p class="border-bottom border-secondary">Detail Barang</p>

        <table class="table table-bordered border-secondary w-100">
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
                    <th class="col-4">Nama</th>
                </tr>
            </thead>
            <tbody class="text-uppercase">
                @foreach($purchase_details as $purchase_detail)
                <tr style="height:60px;">
                    <td class="text-uppercase text-center">{{ $purchase_detail->ppbje_detail->item->item_code }}</td>
                    <td class="text-uppercase">{{ $purchase_detail->ppbje_detail->item->item_name }}</td>
                    <td class="text-uppercase text-center">{{ str_replace('.0', '', number_format($purchase_detail->quantity, 1, '.', '')) }}</td>
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
        <div class="col-12">
            <p><span style="margin-right: 5px;">No.PPBJe </span><span style="margin-right: 5px;">:</span> {{ $purchase->ppbje->ppbje_number }}</p>
        </div>
    </div>
    <div class="row" style="height:25px;font-size:16px;">
        <div class="col-12">
            <p><span style="margin-right: 5px;">Mohon dikirim ke </span>: {{ ucwords($purchase->shipping_address) }}</p>
        </div>
    </div>
    <div class="row" style="height:25px;font-size:16px;">
        <div class="col-12">
            <p><span style="margin-right: 5px;">Tanggal </span>: {{ date('d F Y', strtotime($purchase->shipping_date)) }}</p>
        </div>
    </div>
    <div class="row" style="height:25px;font-size:16px;">
        <div class="col-12">
            <p><span style="margin-right: 5px;">PIC </span>: {{ ucwords($purchase->receiver_pic) }}</p>
        </div>
    </div>
    <div class="row" style="height:15px;"></div>
    <div class="row" style="height:25px;font-size:16px;">
        <div class="col-4">
            <p><span style="margin-right: 5px;">Keterangan </span>: </p>
        </div>
    </div>
    <div class="row mb-3" style="font-size:16px;">
        <div class="col-12">
            <p class="mb-0">1. PO ini sah tanpa di bubuhi tanda tangan.</p>
            <p class="mb-0">2. Pihak Konohagakure tidak menerima kenaikan harga setelah terbit PO.</p>
            <p class="mb-0">3. Pihak Konohagakure akan membayar netto terkecil antara PO dan Faktur.</p>
            <p class="mb-0">4. Mohon sertakan PO ini ketika pengiriman barang.</p>
        </div>
    </div>
    <div class="row" style="font-size:16px;">
        <div class="col-12">
            <table class="table table-bordered border-secondary">
                <tbody>
                    <tr class="bg-light">
                        @if($purchase->purchase_status == "belum disetujui")
                        <td colspan="5" style="font-size:14px;">MENUNGGU PERSETUJUAN</td>
                        @elseif($purchase->purchase_status == "menunggu kiriman")
                        <td colspan="5" style="font-size:14px;">DISETUJUI OLEH :</td>
                        @elseif($purchase->purchase_status == "sudah diterima")
                        <td colspan="5" style="font-size:14px;">DISETUJUI OLEH :</td>
                        @else
                        <td colspan="5" style="font-size:14px;">TIDAK DISETUJUI {{ strtoupper($purchase->approved) }}</td>
                        @endif
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td class="col-2" style="font-size:14px;">
                            <p class="fw-bold mb-4">CHIEF</p>
                            <p class="m-0"><span style="margin-right: 15px;">Nama </span>: {{ strtoupper($purchase->purchase_approval->chief) }}</p>
                            <p class="m-0"><span style="margin-right: 2px;">Tanggal </span>: {{ $purchase->purchase_approval->date1 }}</p>
                            <p class="m-0"><span style="margin-right: 2px;">Catatan </span>: {{ $purchase->purchase_approval->note1 }}</p>
                        </td>
                        @if($purchase->purchase_total > 2000000)
                        <td class="col-2" style="font-size:14px;">
                            <p class="fw-bold mb-4">MANAGER</p>
                            <p class="m-0"><span style="margin-right: 15px;">Nama </span>: {{ strtoupper($purchase->purchase_approval->manager) }}</p>
                            <p class="m-0"><span style="margin-right: 2px;">Tanggal </span>: {{ $purchase->purchase_approval->date2 }}</p>
                            <p class="m-0"><span style="margin-right: 2px;">Catatan </span>: {{ $purchase->purchase_approval->note2 }}</p>
                        </td>
                        @elseif($purchase->purchase_total > 5000000)
                        <td class="col-2" style="font-size:14px;">
                            <p class="fw-bold mb-4">SENIOR MANAGER</p>
                            <p class="m-0"><span style="margin-right: 15px;">Nama </span>: {{ strtoupper($purchase->purchase_approval->senior_manager) }}</p>
                            <p class="m-0"><span style="margin-right: 2px;">Tanggal </span>: {{ $purchase->purchase_approval->date3 }}</p>
                            <p class="m-0"><span style="margin-right: 2px;">Catatan </span>: {{ $purchase->purchase_approval->note3 }}</p>
                        </td>
                        @elseif($purchase->purchase_total > 10000000)
                        <td class="col-2" style="font-size:14px;">
                            <p class="fw-bold mb-4">DIREKTUR</p>
                            <p class="m-0"><span style="margin-right: 15px;">Nama </span>: {{ strtoupper($purchase->purchase_approval->direktur) }}</p>
                            <p class="m-0"><span style="margin-right: 2px;">Tanggal </span>: {{ $purchase->purchase_approval->date4 }}</p>
                            <p class="m-0"><span style="margin-right: 2px;">Catatan </span>: {{ $purchase->purchase_approval->note4 }}</p>
                        </td>
                        @endif
                    </tr>
                </tbody>
            </table>

            <div class="col-12 pb-0">
                <p style="font-size: 12px;">Dicetak Oleh : {{ auth()->user()->first_name }} | Tanggal : {{ date('d-m-Y H:i:s') }} | Source : eProcurement</p>
            </div>
        </div>
    </div>
</div>
