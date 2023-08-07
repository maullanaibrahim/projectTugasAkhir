@extends('layouts.secondary')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row"> 
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body pt-4">
                                <a href="/ppbje{{ $url }}"><button type="button" class="btn btn-outline-secondary shadow-sm"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                                <a href="/ppbje"><button type="button" class="btn btn-outline-primary shadow-sm ms-1"><i class="bi bi-printer-fill me-1"></i> Cetak</button></a>
                                @if($ppbje->ppbje_status == "belum disetujui")
                                <div class="badge bg-secondary float-end text-uppercase px-3">{{ $ppbje->ppbje_status }}</div>
                                @elseif($ppbje->ppbje_status == "berlangsung")
                                <div class="badge bg-warning float-end text-uppercase px-3">{{ $ppbje->ppbje_status }}</div>
                                @elseif($ppbje->ppbje_status == "selesai")
                                <div class="badge bg-success float-end text-uppercase px-3">{{ $ppbje->ppbje_status }}</div>
                                @elseif($ppbje->ppbje_status == "batal")
                                <div class="badge bg-danger float-end text-uppercase px-3">{{ $ppbje->ppbje_status }}</div>
                                @elseif($ppbje->ppbje_status == "tidak disetujui")
                                <div class="badge bg-danger float-end text-uppercase px-3">{{ $ppbje->ppbje_status }}</div>
                                @endif

                                <table class="table table-bordered mt-3">
                                    <thead class="text-center">
                                        <tr style="font-size:20px;">
                                            <td class="col-1" rowspan="2"><img src="../../dist/img/logo.png" class="rounded float-start" style="width:80px;height:80px"></td>
                                            <td colspan="4" class="bg-light"><b>PERMINTAAN PENGADAAN BARANG / JASA (e)</b></td>
                                        </tr>
                                        <tr style="background-color:#fff;">
                                            <td colspan="2" style="text-align:left">No. PPBJe : {{ $ppbje->ppbje_number }}</td>
                                            <td class="col-3 text-center" colspan="2"><b>{{ $ppbje->maker_division }}</b></td>
                                        </tr>
                                    </thead>
                                </table>

                                <table class="table table-bordered">
                                    <tbody class="text-uppercase" style="font-size:13px;">
                                        <tr>
                                            <td><span style="margin-right: 20px;">Nama Pemohon </span>: {{ $ppbje->applicant_name }}</td>
                                            <td class="col-3 bg-light"><center>Biaya Dibebankan Ke :</center></td>
                                            <td class="col-3 bg-light"><center>Kepada Yth. (PJB Terkait) :</center></td>
                                            <td class="col-2 bg-light"><center>Jenis Barang/Jasa :</center></td>
                                        </tr>
                                        <tr>
                                            <td><span style="margin-right:5px;">Jabatan Pemohon </span>: {{ $ppbje->applicant_position}}</td>
                                            <td rowspan="3" style="padding-top:38px"><center><h6><b>{{ $ppbje->cost->cost_name }}</b></h6></center></td>
                                            @if($ppbje->ppbje_type == "NON ASSET")
                                            <td rowspan="3" style="padding-top:38px"><center><h6><b>Procurement</b></h6></center></td>
                                            @else
                                            <td rowspan="3" style="padding-top:38px"><center><h6><b>Asset Management / Procurement</b></h6></center></td>
                                            @endif
                                            <td rowspan="3" style="padding-top:40px"><center><h6><b>{{ $ppbje->ppbje_type }}</b></h6></center></center></td>
                                        </tr>
                                        <tr>
                                            <td><span style="margin-right: 38px;">NIK Pemohon </span>: {{ $ppbje->applicant_nik }}</td>
                                        </tr>
                                        <tr>
                                            <td><span style="margin-right: 62px;">Dept / Cab </span>: {{ $ppbje->applicant_division }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <thead class="text-center text-uppercase bg-light">
                                        <tr>
                                            <td><b>NO.</b></td>
                                            <td><b>NAMA BARANG / JASA</b></td>
                                            <td><b>QTY</b></td>
                                            <td><b>SATUAN</b></td>
                                            <td><b>HARGA SATUAN</b></td>
                                            <td><b>JUMLAH</b></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ppbje_details as $ppbje_detail)
                                        <tr class="text-center text-uppercase" style="background-color:#fff;">
                                            <td>{{ $no++ }}.</td>
                                            <td class="col-5" style="text-align:left">{{ $ppbje_detail->item->item_name }}</td>
                                            <td>{{ $ppbje_detail->quantity }}</td>
                                            <td>{{ $ppbje_detail->item->unit }}</td>
                                            <td>{{ "IDR " . number_format($ppbje_detail->price,2,',','.') }}</td>
                                            <td>{{ "IDR " . number_format($ppbje_detail->price_total,2,',','.') }}</td>
                                        </tr>
                                        @endforeach
                                        <tr style="background-color:#fff;">
                                            <td colspan="5"><center><b>JUMLAH TOTAL</b></center></td>
                                            <td class="col-2" colspan="2" style="text-align:left"><center><b>{{ "IDR " . number_format($ppbje->cost_total,2,',','.') }}</b></center></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <thead class="text-uppercase text-center fw-bold bg-light">
                                        <tr>
                                            <td class="col-2">TGL. KEBUTUHAN</td>
                                            <td class="col-6">ALASAN PERMINTAAN</td>
                                            <td class="col-4">ATASAN PEMOHON</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-uppercase">
                                            <td class="col-2"><center>{{ date('d-M-Y', strtotime($ppbje->date_of_need));  }}</center></td>
                                            <td class="col-6 py-5" rowspan="3"><center>{{ $ppbje->reason }}</center></td>
                                            <td class="col-4 py-5" rowspan="3"><center>{{ $ppbje->ppbje_approval->chief }}</center></td>
                                        </tr>
                                        <tr class="text-uppercase">
                                            <td class="col-2 fw-bold bg-light"><center>DISERAHKAN KE</center></td>
                                        </tr>
                                        <tr class="text-uppercase">
                                            <td class="col-2"><center>{{ $ppbje->cost->cost_name }}</center></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <thead class="text-uppercase text-center fw-bold bg-light">
                                        <tr>
                                            <td class="col-6">PERSETUJUAN</td>
                                            <td class="col-6">KETERANGAN</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-uppercase">
                                            <td class="col-6 py-3 ps-3">
                                                CHIEF UNIT TERKAIT<br><br>
                                                <p class="ps-5">
                                                    NAMA : {{ $ppbje->ppbje_approval->chief }}<br>
                                                    TGL  : {{ $ppbje->ppbje_approval->date1 }}
                                                </p>
                                            </td>
                                            <td class="col-6 py-3" rowspan="3">
                                            @if($ppbje->ppbje_status == "batal")
                                            <center><b>{{ $ppbje->ppbje_approval->status1 }}</b></center><br>
                                            @elseif(auth()->user()->position->position_name == "Chief")
                                                    @if($ppbje->ppbje_approval->status1 == "belum disetujui")
                                                    <div class="container">
                                                        
                                                        <!-- Button for Agree this PPBJe -->
                                                        <form action="/ppbje{{ $url }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                            @csrf
                                                            <!-- Sending URL definition (Asset or Non Asset). -->
                                                            <input type="text" class="form-control" name="status" id="status" value="menyetujui" hidden>
                                                            <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $url }}" hidden>
                                                            <input type="text" class="form-control" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                            
                                                            <button class="btn btn-success w-25 btn-sm"><i class="bi bi-check-circle"></i> Setuju</button>
                                                        </form>
                                                        <!-- Button for Disagree this PPBJe -->
                                                        <form action="/ppbje{{ $url }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                            @csrf
                                                            <!-- Sending URL definition (Asset or Non Asset). -->
                                                            <input type="text" class="form-control" name="status" id="status" value="tidak menyetujui" hidden>
                                                            <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $url }}" hidden>
                                                            <input type="text" class="form-control" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>

                                                            <button class="btn btn-danger w-25 btn-sm"><i class="bi bi-x-circle"></i> Tidak Setuju</button>
                                                            <textarea class="form-control mt-2" placeholder="Sebutkan alasan terlebih dahulu, jika tidak setuju (optional)" name="note" id="note" style="height: 100px;">{{ old('note') }}</textarea>
                                                        </form>
                                                    </div>
                                                    @else
                                                    <center><b>{{ $ppbje->ppbje_approval->status1 }}</b></center><br>
                                                    <p class="ps-2">
                                                        ALASAN : {{ $ppbje->ppbje_approval->note1 }}
                                                    </p>
                                                    @endif
                                                @else
                                                <center><b>{{ $ppbje->ppbje_approval->status1 }}</b></center><br>
                                                <p class="ps-2">
                                                    ALASAN : {{ $ppbje->ppbje_approval->note1 }}
                                                </p>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    @if($ppbje->cost_total <= 2000000)
                                    <tbody hidden>
                                    @else
                                    <tbody>
                                    @endif
                                        <tr class="text-uppercase">
                                            <td class="col-6 py-3 ps-3">
                                                MANAGER UNIT TERKAIT<br><br>
                                                <p class="ps-5">
                                                    NAMA : {{ $ppbje->ppbje_approval->manager }}<br>
                                                    TGL  : {{ $ppbje->ppbje_approval->date2 }}
                                                </p>
                                            </td>
                                            <td class="col-6 py-3" rowspan="3">
                                            @if(auth()->user()->position->position_name == "Manager")
                                                    @if($ppbje->ppbje_approval->status1 == "menyetujui")
                                                        @if($ppbje->ppbje_approval->status2 == "belum disetujui")
                                                        <div class="container">
                                                            <!-- Button for Agree this PPBJe -->
                                                            <form action="/ppbje{{ $url }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                                @csrf
                                                                <!-- Sending URL definition (Asset or Non Asset). -->
                                                                <input type="text" class="form-control" name="status" id="status" value="menyetujui" hidden>
                                                                <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $url }}" hidden>
                                                                <input type="text" class="form-control" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                
                                                                <button class="btn btn-success w-25 btn-sm"><i class="bi bi-check-circle"></i> Setuju</button>
                                                            </form>
                                                            <!-- Button for Disagree this PPBJe -->
                                                            <form action="/ppbje{{ $url }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                                @csrf
                                                                <!-- Sending URL definition (Asset or Non Asset). -->
                                                                <input type="text" class="form-control" name="status" id="status" value="tidak menyetujui" hidden>
                                                                <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $url }}" hidden>
                                                                <input type="text" class="form-control" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>

                                                                <button class="btn btn-danger w-25  btn-sm"><i class="bi bi-x-circle"></i> Tidak Setuju</button>
                                                                <textarea class="form-control mt-2" placeholder="Sebutkan alasan terlebih dahulu, jika tidak setuju (optional)" name="note" id="note" style="height: 100px;">{{ old('note') }}</textarea>
                                                            </form>
                                                        </div>
                                                        @else
                                                        <center><b>{{ $ppbje->ppbje_approval->status2 }}</b></center><br>
                                                        <p class="ps-2">
                                                            ALASAN : {{ $ppbje->ppbje_approval->note2 }}
                                                        </p>
                                                        @endif
                                                    @else
                                                    <center><b>{{ $ppbje->ppbje_approval->status2 }}</b></center><br>
                                                    <p class="ps-2">
                                                        ALASAN : {{ $ppbje->ppbje_approval->note2 }}
                                                    </p>
                                                    @endif
                                                @else
                                                <center><b>{{ $ppbje->ppbje_approval->status2 }}</b></center><br>
                                                <p class="ps-2">
                                                    ALASAN : {{ $ppbje->ppbje_approval->note2 }}
                                                </p>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    @if($ppbje->cost_total <= 5000000)
                                    <tbody hidden>
                                    @else
                                    <tbody>
                                    @endif
                                        <tr class="text-uppercase">
                                            <td class="col-6 py-3 ps-3">
                                                SENIOR MANAGER<br><br>
                                                <p class="ps-5">
                                                    NAMA : {{ $ppbje->ppbje_approval->senior_manager }}<br>
                                                    TGL  : {{ $ppbje->ppbje_approval->date3 }}
                                                </p>
                                            </td>
                                            <td class="col-6 py-3" rowspan="3">
                                                @if(auth()->user()->position->position_name == "Senior Manager")
                                                    @if($ppbje->ppbje_approval->status2 == "menyetujui")
                                                        @if($ppbje->ppbje_approval->status3 == "belum disetujui")
                                                        <div class="container">
                                                            <!-- Button for Agree this PPBJe -->
                                                            <form action="/ppbje{{ $url }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                                @csrf
                                                                <!-- Sending URL definition (Asset or Non Asset). -->
                                                                <input type="text" class="form-control" name="status" id="status" value="menyetujui" hidden>
                                                                <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $url }}" hidden>
                                                                <input type="text" class="form-control" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                
                                                                <button class="btn btn-success w-25 btn-sm"><i class="bi bi-check-circle"></i> Setuju</button>
                                                            </form>
                                                            <!-- Button for Disagree this PPBJe -->
                                                            <form action="/ppbje{{ $url }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                                @csrf
                                                                <!-- Sending URL definition (Asset or Non Asset). -->
                                                                <input type="text" class="form-control" name="status" id="status" value="tidak menyetujui" hidden>
                                                                <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $url }}" hidden>
                                                                <input type="text" class="form-control" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>

                                                                <button class="btn btn-danger w-25  btn-sm"><i class="bi bi-x-circle"></i> Tidak Setuju</button>
                                                                <textarea class="form-control mt-2" placeholder="Sebutkan alasan terlebih dahulu, jika tidak setuju (optional)" name="note" id="note" style="height: 100px;">{{ old('note') }}</textarea>
                                                            </form>
                                                        </div>
                                                        @else
                                                        <center><b>{{ $ppbje->ppbje_approval->status3 }}</b></center><br>
                                                        <p class="ps-2">
                                                            ALASAN : {{ $ppbje->ppbje_approval->note3 }}
                                                        </p>
                                                        @endif
                                                    @else
                                                    <center><b>{{ $ppbje->ppbje_approval->status3 }}</b></center><br>
                                                    <p class="ps-2">
                                                        ALASAN : {{ $ppbje->ppbje_approval->note3 }}
                                                    </p>
                                                    @endif
                                                @else
                                                <center><b>{{ $ppbje->ppbje_approval->status3 }}</b></center><br>
                                                <p class="ps-2">
                                                    ALASAN : {{ $ppbje->ppbje_approval->note3 }}
                                                </p>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                    @if($ppbje->cost_total <= 10000000)
                                    <tbody hidden>
                                    @else
                                    <tbody>
                                    @endif
                                        <tr class="text-uppercase">
                                            <td class="col-6 py-3 ps-3">
                                                DIREKTUR<br><br>
                                                <p class="ps-5">
                                                    NAMA : {{ $ppbje->ppbje_approval->direktur }}<br>
                                                    TGL  : {{ $ppbje->ppbje_approval->date4 }}
                                                </p>
                                            </td>
                                            <td class="col-6 py-3" rowspan="3">
                                                @if(auth()->user()->position->position_name == "Direktur")
                                                    @if($ppbje->ppbje_approval->status3 == "menyetujui")
                                                        @if($ppbje->ppbje_approval->status4 == "belum disetujui")
                                                        <div class="container">
                                                            <!-- Button for Agree this PPBJe -->
                                                            <form action="/ppbje{{ $url }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                                @csrf
                                                                <!-- Sending URL definition (Asset or Non Asset). -->
                                                                <input type="text" class="form-control" name="status" id="status" value="menyetujui" hidden>
                                                                <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $url }}" hidden>
                                                                <input type="text" class="form-control" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>
                                                                
                                                                <button class="btn btn-success w-25 btn-sm"><i class="bi bi-check-circle"></i> Setuju</button>
                                                            </form>
                                                            <!-- Button for Disagree this PPBJe -->
                                                            <form action="/ppbje{{ $url }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                                @csrf
                                                                <!-- Sending URL definition (Asset or Non Asset). -->
                                                                <input type="text" class="form-control" name="status" id="status" value="tidak menyetujui" hidden>
                                                                <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $url }}" hidden>
                                                                <input type="text" class="form-control" name="position" id="position" value="{{ auth()->user()->position->position_name }}" hidden>

                                                                <button class="btn btn-danger w-25  btn-sm"><i class="bi bi-x-circle"></i> Tidak Setuju</button>
                                                                <textarea class="form-control mt-2" placeholder="Sebutkan alasan terlebih dahulu, jika tidak setuju (optional)" name="note" id="note" style="height: 100px;">{{ old('note') }}</textarea>
                                                            </form>
                                                        </div>
                                                        @else
                                                        <center><b>{{ $ppbje->ppbje_approval->status4 }}</b></center><br>
                                                        <p class="ps-2">
                                                            ALASAN : {{ $ppbje->ppbje_approval->note4 }}
                                                        </p>
                                                        @endif
                                                    @else
                                                    <center><b>{{ $ppbje->ppbje_approval->status4 }}</b></center><br>
                                                    <p class="ps-2">
                                                        ALASAN : {{ $ppbje->ppbje_approval->note4 }}
                                                    </p>
                                                    @endif
                                                @else
                                                <center><b>{{ $ppbje->ppbje_approval->status4 }}</b></center><br>
                                                <p class="ps-2">
                                                    ALASAN : {{ $ppbje->ppbje_approval->note4 }}
                                                </p>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection