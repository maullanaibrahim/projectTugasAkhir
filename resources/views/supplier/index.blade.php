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

                        <a href="/suppliers/create"><button type="button" class="btn btn-primary position-relative float-start me-2" style="margin-top: 6px"><i class="bi bi-plus-lg me-1"></i> Tambah</button></a>

                        <table class="table datatable">
                           <thead class="bg-light" style="height: 45px;">
                              <tr>
                                 <th scope="col">KODE</th>
                                 <th scope="col">NAMA SUPPLIER</th>
                                 <th scope="col">PIC</th>
                                 <th scope="col">KONTAK</th>
                                 <th scope="col">ALAMAT</th>
                                 <th scope="col">PKP</th>
                                 <th scope="col">TOP</th>
                                 <th scope="col">AKSI</th>
                              </tr>
                           </thead>
                           <tbody class="text-uppercase">
                              @foreach($suppliers as $supplier)
                              <tr>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $supplier->kode_supplier }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $supplier->nama_supplier }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $supplier->pic_supplier }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $supplier->kontak_supplier }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $supplier->alamat_supplier }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $supplier->pkp }}</td>
                                 <td class="text-uppercase" style="font-size:13px;">{{ $supplier->top }}</td>
                                 <td style="font-size:13px;">
                                    <a href="#{{ $supplier->id }}"><button class="btn btn-secondary btn-sm"><i class="bi bi-pencil-square"></i></button></a>
                                    <form action="/suppliers/{{ $supplier->id }}" method="post" class="d-inline">
                                       @method('delete')
                                       @csrf
                                       <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus supplier {{ strtoupper($supplier->nama_supplier) }}?')"><i class="bi bi-trash-fill"></i></button>
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