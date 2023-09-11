@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-file-text me-2"></i>{{ $title }}</h5>
                                <!-- Button for create new ppbje -->
                                @if(auth()->user()->position_id == '1')
                                    <a href="{{ Request::is('ppbje-asset'.$div.'-'.$pos) ? '/ppbje-asset/'.$div.'-'.$pos.'/create' : '/ppbje-nonAsset/'.$div.'-'.$pos.'/create' }}"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-circle me-1"></i> Buat PPBJe</button></a>
                                @else
                                @endif

                                <!-- Showing data from ppbjes table -->
                                <table id="example" class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th>TANGGAL</th>
                                            <th scope="col">DIVISI</th>
                                            <th scope="col">NOMOR PPBJe</th>
                                            <th scope="col">BEBAN BIAYA</th>
                                            <th scope="col">TOTAL BIAYA</th>
                                            <th scope="col">KEBUTUHAN</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ppbjes as $ppbje)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($ppbje->updated_at)) }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $ppbje->maker_division }}</td>
                                            <td style="font-size:13px;">{{ $ppbje->ppbje_number }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $ppbje->cost->cost_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($ppbje->cost_total,2,'.',',') }}</div></td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($ppbje->date_of_need)); }}</td>
                                            @if($ppbje->ppbje_status == "selesai")
                                            <td class="text-capitalize" style="font-size:13px;">
                                                @if($ppbje->ppbje_type == 'asset')
                                                <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @else
                                                <a href="/ppbje-nonAsset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @endif
                                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped bg-success px-2" style="width: 100%">{{ $ppbje->ppbje_status }}</div>
                                                    </div>
                                                </a>
                                            </td>
                                            @elseif($ppbje->ppbje_status == "belum disetujui")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-secondary">{{ $ppbje->ppbje_status }}</td>
                                            @elseif($ppbje->ppbje_status == "berlangsung")
                                                @if($ppbje->ppbje_note == "cek stock")
                                                <td class="text-capitalize" style="font-size:13px;">
                                                    @if($ppbje->ppbje_type == 'asset')
                                                    <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                    @else
                                                    <a href="/ppbje-nonAsset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                    @endif
                                                        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning px-2" style="width: 25%">{{ $ppbje->ppbje_note }}</div>
                                                        </div>
                                                    </a>
                                                </td>
                                                @else
                                                <td class="text-capitalize" style="font-size:13px;">
                                                    @if($ppbje->ppbje_type == 'asset')
                                                    <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                    @else
                                                    <a href="/ppbje-nonAsset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                    @endif
                                                        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning px-2" style="width: 25%">proses buat po</div>
                                                        </div>
                                                    </a>
                                                </td>
                                                @endif
                                            @elseif($ppbje->ppbje_status == "persetujuan po")
                                            <td class="text-capitalize" style="font-size:13px;">
                                                @if($ppbje->ppbje_type == 'asset')
                                                <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @else
                                                <a href="/ppbje-nonAsset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @endif
                                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning px-2" style="width: 50%">{{ $ppbje->ppbje_status }}</div>
                                                    </div>
                                                </a>
                                            </td>
                                            @elseif($ppbje->ppbje_status == "menunggu kiriman")
                                            <td class="text-capitalize" style="font-size:13px;">
                                                @if($ppbje->ppbje_type == 'asset')
                                                <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @else
                                                <a href="/ppbje-nonAsset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @endif
                                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary px-2" style="width: 75%">{{ $ppbje->ppbje_status }}</div>
                                                    </div>
                                                </a>
                                            </td>
                                            @elseif($ppbje->ppbje_status == "batal")
                                            <td class="text-capitalize" style="font-size:13px;">
                                                @if($ppbje->ppbje_type == 'asset')
                                                <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @else
                                                <a href="/ppbje-nonAsset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @endif
                                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped bg-danger px-2" style="width: 100%">{{ $ppbje->ppbje_status }}</div>
                                                    </div>
                                                </a>
                                            </td>
                                            @elseif($ppbje->ppbje_status == "tidak disetujui")
                                            <td class="text-capitalize" style="font-size:13px;">
                                                @if($ppbje->ppbje_type == 'asset')
                                                <a href="/ppbje-asset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @else
                                                <a href="/ppbje-nonAsset/progress{{ encrypt($ppbje->id) }}-{{ encrypt($ppbje->ppbje_type) }}">
                                                @endif
                                                    <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                        <div class="progress-bar progress-bar-striped bg-danger px-2" style="width: 100%">{{ $ppbje->ppbje_status }}</div>
                                                    </div>
                                                </a>
                                            </td>
                                            @endif
                                            <td style="font-size:13px;">
                                                <!-- Button for look detail PPBJe -->
                                                <a href="/ppbje-{{ $sendurl }}{{ $div }}-{{ $pos }}/{{ $ppbje->id }}"><button class="btn btn-outline-secondary btn-sm"><i class="bi bi-file-earmark-text-fill"></i></button></a>
                                                @if($ppbje->maker_division == auth()->user()->division->division_name)
                                                    @if(auth()->user()->position->position_name == "Admin")
                                                        <!-- Button for canceling PPBJe -->
                                                        <form action="/ppbje-{{ $sendurl }}{{ $div }}-{{ $pos }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                            @csrf
                                                            <!-- Sending URL definition (Asset or Non Asset). -->
                                                            <div class="col-md-3" hidden>
                                                                <div class="form-floating">
                                                                    <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $sendurl }}">
                                                                    <input type="text" class="form-control" name="status" id="status" value="batal">
                                                                </div>
                                                            </div>
                                                            @if($ppbje->ppbje_status == "batal")
                                                            <button id="batal" class="btn btn-danger btn-sm" disabled><i class="bi bi-x-circle"></i></button>
                                                            @elseif($ppbje->ppbje_status == "tidak disetujui")
                                                            <button id="batal" class="btn btn-danger btn-sm" disabled><i class="bi bi-x-circle"></i></button>
                                                            @elseif($ppbje->ppbje_status == "menunggu kiriman")
                                                                @if($ppbje->ppbje_note == "beli")
                                                                <button id="batal" class="btn btn-danger btn-sm" disabled><i class="bi bi-x-circle"></i></button>
                                                                @else
                                                                <button id="batal" class="btn btn-danger btn-sm"><i class="bi bi-x-circle"></i></button>
                                                                @endif
                                                            @else
                                                            <button id="batal" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan PPBJe {{ $ppbje->ppbje_number}}?')"><i class="bi bi-x-circle"></i></button>
                                                            @endif
                                                        </form>
                                                    @else
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- End card-body -->
                        </div><!-- End card recent-sales -->
                    </div><!-- End col-12 -->
                </div><!-- End row -->
            </div><!-- End col-lg-12 -->
        </div><!-- End row -->
    </section>
@endsection