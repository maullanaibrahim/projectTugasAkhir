@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">2023</a></li>
                                    <li><a class="dropdown-item" href="#">2022</a></li>
                                    <li><a class="dropdown-item" href="#">2021</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">{{ $title }} <span>| 2023</span></h5>
                                <!-- Button for create new ppbje -->
                                <a href="{{ Request::is('ppbje-asset'.$id) ? '/ppbje-asset/'.$id.'/create' : '/ppbje-nonAsset/'.$id.'/create' }}"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-circle me-1"></i> Buat PPBJe</button></a>

                                <!-- Showing data from ppbjes table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">TANGGAL</th>
                                            <th scope="col">NOMOR PPBJe</th>
                                            <th scope="col">BEBAN BIAYA</th>
                                            <th scope="col">TOTAL BIAYA</th>
                                            <th scope="col">KEBUTUHAN</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($ppbjes as $ppbje)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($ppbje->ppbje_approval->updated_at)); }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $ppbje->ppbje_number }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $ppbje->cost->cost_name }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ "IDR ".number_format($ppbje->cost_total,2,',','.') }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($ppbje->date_of_need)); }}</td>
                                            @if($ppbje->ppbje_status == "selesai")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-success">{{ $ppbje->ppbje_status }}</td>
                                            @elseif($ppbje->ppbje_status == "berlangsung")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-warning">{{ $ppbje->ppbje_status }}</td>
                                            @elseif($ppbje->ppbje_status == "cek asset")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-warning">{{ $ppbje->ppbje_status }}</td>
                                            @elseif($ppbje->ppbje_status == "belum disetujui")
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-secondary">{{ $ppbje->ppbje_status }}</td>
                                            @else
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-danger">{{ $ppbje->ppbje_status }}</td>
                                            @endif
                                            <td style="font-size:13px;">
                                                <!-- Button for look detail PPBJe -->
                                                <a href="/ppbje-{{ $sendurl }}{{ $id }}/{{ $ppbje->id }}"><button class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-text-fill"></i></button></a>
                                                @if($ppbje->maker_division != auth()->user()->division->division_name)
                                                @else
                                                <!-- Button for canceling PPBJe -->
                                                <form action="/ppbje-{{ $sendurl}}{{ $id }}/{{ $ppbje->id }}/update" method="post" class="d-inline">  
                                                @csrf
                                                    <!-- Sending URL definition (Asset or Non Asset). -->
                                                    <div class="col-md-3" hidden>
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $sendurl }}">
                                                            <input type="text" class="form-control" name="ppbje_status" id="ppbje_status" value="batal">
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan PPBJe {{ $ppbje->ppbje_number}}?')"><i class="bi bi-x-circle"></i></button>
                                                </form>
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