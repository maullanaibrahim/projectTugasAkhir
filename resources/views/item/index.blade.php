@extends('layouts.main')

@section('content')

   @if(session()->has('success'))
   <div class="alert alert-light alert-dismissible fade show w-auto position-fixed end-0 text-success" style="margin-right:30px;" role="alert">
      <i class="bi bi-check-circle me-1"></i>
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>
   @endif
   
   <div class="pagetitle">
      <h1>{{ $path }}</h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item active">{{ $path }}</li>
         </ol>
      </nav>
   </div><!-- End Page Title -->

   <section class="section dashboard">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <div class="col-12">
                  <div class="card top-selling overflow-auto">
                     <div class="card-body pt-3">

                        <a href="/items/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>

                        <table class="table datatable">
                           <thead class="bg-light" style="height: 45px;">
                              <tr>
                                 <th scope="col">PREVIEW</th>
                                 <th scope="col">NAMA ITEM</th>
                                 <th scope="col">HARGA</th>
                                 <th scope="col">SATUAN</th>
                                 <th scope="col">SUPPLIER</th>
                                 <th scope="col">JENIS ITEM</th>
                                 <th scope="col">AKSI</th>
                              </tr>
                           </thead>
                           <tbody class="text-uppercase">
                              @foreach($items as $item)
                              <tr>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $item->preview }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $item->nama_item }}</td>
                                 <td class="text-capitalize" style="font-size:13px;">{{ number_format($item->harga,2,',','.')." IDR" }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $item->satuan }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $item->supplier->nama_supplier }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $item->jenis_item }}</td>
                                 <td style="font-size:13px;">
                                    <a href="#{{ $item->id }}"><button class="btn btn-secondary btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                    <form action="/items/{{ $item->id }}" method="post" class="d-inline">
                                       @method('delete')
                                       @csrf
                                       <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus item {{ strtoupper($item->nama_item) }}?')"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>

                     </div> <!-- End Card Body -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

@endsection