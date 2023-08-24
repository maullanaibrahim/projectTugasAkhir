@extends('layouts.main')

@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card top-selling overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title border-bottom mb-3"><i class="bi bi-boxes me-2"></i>{{ $title }}</h5>

                                <!-- Button for create new item -->
                                @can('procurement')
                                <a href="/items/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>
                                @endcan

                                <!-- Showing data from items table -->
                                <table class="table datatable">
                                    <thead class="bg-light" style="height: 45px;">
                                        <tr>
                                            <th scope="col">KODE</th>
                                            <th scope="col">NAMA ITEM</th>
                                            @can('procurement')
                                            <th scope="col">HARGA</th>
                                            <th scope="col">DISC</th>
                                            @endcan
                                            <th scope="col">SATUAN</th>
                                            @can('procurement')
                                            <th scope="col">SUPPLIER</th>
                                            @endcan
                                            <th scope="col">JENIS ITEM</th>
                                            @can('procurement')
                                            <th scope="col">UPDATE</th>
                                            <th scope="col">AKSI</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody class="text-uppercase">
                                        @foreach($items as $item)
                                        <tr>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $item->item_code }}</td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ $item->item_name }}</td>
                                            @can('procurement')
                                            <td class="text-uppercase" style="font-size:13px;"><div class="float-start ms-2">IDR</div><div class="float-end me-2">{{ number_format($item->price,2,'.',',') }}</div></td>
                                            <td class="text-uppercase" style="font-size:13px;">{{ number_format($item->discount,2,'.',',') }}%</td>
                                            @endcan
                                            <td class="text-uppercase" style="font-size:13px;">{{ $item->unit }}</td>
                                            @can('procurement')
                                            <td class="text-uppercase" style="font-size:13px;">{{ $item->supplier->supplier_name }}</td>
                                            @endcan
                                            <td class="text-uppercase" style="font-size:13px;">{{ $item->item_type }}</td>
                                            @can('procurement')
                                            <td class="text-uppercase" style="font-size:13px;">{{ date('d-M-Y', strtotime($item->updated_at)) }}</td>
                                            <td style="font-size:13px;">
                                                <!-- Button for edit data -->
                                                <a href="/items/{{ $item->id }}/edit"><button class="btn btn-success btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                                <!-- Button for delete data
                                                <form action="/items/{{ $item->id }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus item {{ strtoupper($item->item_name) }}?')"><i class="bi bi-trash-fill"></i></button>
                                                </form> -->
                                            </td>
                                            @endcan
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div> <!-- End Card Body -->
                        </div> <!-- End card top-selling -->
                    </div> <!-- End col-12 -->
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div> <!-- End row -->
    </section>
@endsection