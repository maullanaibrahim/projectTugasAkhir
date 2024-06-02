<div class="print-area d-none">
    <table class="table table-bordered border-secondary mt-3">
        <thead class="text-center">
            <tr style="font-size:20px;">
                <td class="col-1" rowspan="2"><img src="../../dist/img/logo.png" class="rounded float-start" style="width:80px;height:80px"></td>
                <td colspan="5" class="bg-light"><b>FORM RECEIVING PURCHASE ORDER</b></td>
            </tr>
            <tr style="background-color:#fff;">
                <td colspan="2" style="text-align:left">No. Receiving : {{ $receiving->receiving_number }}</td>
            </tr>
        </thead>
    </table>
    <table class="table table-bordered border-secondary">
        <tbody class="text-uppercase" style="font-size:13px;">
            <tr>
                <td class="col-3 bg-light"><center>Beban Biaya :</center></td>
                <td class="col-4 bg-light"><center>Supplier :</center></td>
                <td class="col-3 bg-light"><center>No. Invoice / Surat Jalan :</center></td>
                <td class="col-2 bg-light"><center>Status Receiving :</center></td>
            </tr>
            <tr>
                <td class="align-middle"><center><h6><b>{{ $receiving->purchase->cost->cost_name }}</b></h6></center></td>
                <td class="align-middle"><center><h6><b>{{ $receiving->purchase->supplier->supplier_name }}</b></h6></center></td>
                <td class="align-middle"><center><h6><b>{{ $receiving->invoice_number }}</b></h6></center></center></td>
                @if($receiving->receiving_status == "selesai")
                <td class="text-uppercase" style="font-size:18px;"><center><span class="badge bg-success"><b>{{ $receiving->receiving_status }}</b><span></center></td>
                @else
                <td class="text-uppercase" style="font-size:18px;"><center><span class="badge bg-warning"><b>{{ $receiving->receiving_status }}</b><span></center></td>
                @endif
            </tr>
        </tbody>
    </table>

    <div class="col-12">
        <p class="border-bottom border-secondary">Detail Barang</p>
        <table class="table table-bordered border-secondary w-auto m-0">
            <thead>
                <tr class="text-center">
                    <th class="bg-light"><b>NO.</b></td>
                    <th class="col-5 bg-light">NAMA BARANG</th>
                    <th class="col-1 bg-light">QTY</th>
                    <th class="col-2 bg-light">SATUAN</th>
                    <th class="col-2 bg-light">NOMOR PO</th>
                    <th class="col-2 bg-light">NOMOR PPBJe</th>
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

    <div class="col-12 mt-3">
        <p class="border-bottom border-secondary"></p>
    </div>

    <div class="col-8">
        <p>*Catatan Receiving : {{ $receiving->receiving_note }}</p>
    </div>
    <div class="col-6">
        <table class="table table-bordered border-secondary">
            <tbody class="text-uppercase" style="font-size:13px;">
                <tr>
                    <td class="col-3 bg-light"><center>Penerima</center></td>
                    <td class="col-3 bg-light"><center>Pengirim</center></td>
                </tr>
                <tr style="height:100px">
                    <td class="align-middle"></td>
                    <td class="align-middle"></td>
                </tr>
                <tr>
                    <td class="align-middle"><center>{{ $receiving->recipient }} ({{ $receiving->division_name }})</center></td>
                    <td class="align-middle"></td>
                </tr>
                <tr>
                    <td class="align-middle"><center>{{ date('d F Y', strtotime($receiving->created_at)) }}</center></td>
                    <td class="align-middle"><center>{{ date('d F Y', strtotime($receiving->created_at)) }}</center></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>