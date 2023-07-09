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
                                <a href="{{ Request::is('ppbje-asset') ? '/ppbje-asset/create' : '/ppbje-nonAsset/create' }}"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-file-earmark-plus me-1"></i> Buat PPBJe</button></a>

                                <!-- Showing data from ppbjes table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">TANGGAL</th>
                                            <th scope="col">NOMOR PPBJe</th>
                                            <th scope="col">BEBAN BIAYA</th>
                                            <th scope="col">TGL. KEBUTUHAN</th>
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
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-warning">{{ $ppbje->date_of_need }}</td>
                                            <td class="text-uppercase" style="font-size:13px;"><span class="badge bg-warning">{{ $ppbje->ppbje_note }}</td>
                                            <td style="font-size:13px;">
                                                <!-- Button for look up the data -->
                                                <a href="/ppbje-detail{{ $ppbje->id }}"><button class="btn btn-outline-primary btn-sm"><i class="bi bi-eye-fill"></i></button></a>
                                                <!-- Button for delete data -->
                                                <form action="/ppbje-delete{{ $ppbje->id }}" method="post" class="d-inline">  
                                                    <!-- Sending URL definition (Asset or Non Asset). -->
                                                    <div class="col-md-3" hidden>
                                                        <div class="form-floating">
                                                            <input type="text" class="form-control" name="sendUrl" id="sendUrl" value="{{ $sendurl }}">
                                                            <label for="sendUrl">Send URL</label>
                                                        </div>
                                                    </div>
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-outline-warning btn-sm" onclick="return confirm('Yakin ingin membatalkan PPBJe {{ $ppbje->ppbje_number}}?')"><i class="bi bi-trash-fill"></i></button>
                                                </form>
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