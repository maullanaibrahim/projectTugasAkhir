@extends('layouts.secondary')

@section('content')

   <div class="pagetitle">
      <h1>{{ $path }}</h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard"><i class="bi bi-house-door"></i></a></li>
            <li class="breadcrumb-item">{{ $path }}</li>
            <li class="breadcrumb-item active">{{ $path2 }}</li>
         </ol>
      </nav>
   </div><!-- End Page Title -->

   <section class="section dashboard">
      <div class="row">
         <div class="col-lg-12">
            <div class="row">
               <div class="col-12">
                  <div class="card top-selling overflow-auto">
                     <div class="card-body pb-0">
                        <h5 class="card-title">{{ $title }}</h5>

                        <form class="row g-3 mb-3" action="/suppliers" method="POST">
                           @csrf
                           <div class="col-md-1">
                              <div class="form-floating">
                                 <input type="text" class="form-control bg-light" name="kode_supplier" id="kodeSupplier" value="S{{ $count }}" readonly>
                                 <label for="namaSupplier">Kode</label>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-floating">
                                 <input type="text" class="form-control text-uppercase @error('nama_supplier') is-invalid @enderror" name="nama_supplier" id="namaSupplier" placeholder="Nama Supplier" value="{{ old('nama_supplier') }}" required>
                                 <label for="namaSupplier">Nama Supplier</label>
                                 @error('nama_supplier')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-floating">
                                 <input type="text" class="form-control text-uppercase @error('pic_supplier') is-invalid @enderror" name="pic_supplier" id="picSupplier" placeholder="PIC" value="{{ old('pic_supplier') }}" required>
                                 <label for="picSupplier">PIC</label>
                                 @error('pic_supplier')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-floating">
                                 <input type="text" class="form-control text-uppercase @error('kontak_supplier') is-invalid @enderror" name="kontak_supplier" id="kontak" placeholder="Kontak" value="{{ old('kontak_supplier') }}" required>
                                 <label for="kontak">Kontak</label>
                                 @error('kontak_supplier')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-floating">
                                 <select class="form-select" name="top" id="top" aria-label="State">
                                    <option selected disabled>Pilih TOP..</option>
                                    <option value="14 HARI">14 HARI</option>
                                    <option value="21 HARI">21 HARI</option>
                                    <option value="30 HARI">30 HARI</option>
                                 </select>
                                 <label for="top">TOP</label>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-floating">
                              <select class="form-select" name="pkp" id="pkp" aria-label="State">
                                 <option selected disabled>Pilih PKP..</option>
                                 <option value="YA">YA</option>
                                 <option value="TIDAK">TIDAK</option>
                              </select>
                              <label for="pkp">PKP</label>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-floating">
                                 <textarea class="form-control text-uppercase @error('alamat_supplier') is-invalid @enderror" placeholder="Alamat Supplier" name="alamat_supplier" id="alamatSupplier" style="height: 100px;" required>{{ old('alamat_supplier') }}</textarea>
                                 <label for="alamatSupplier">Alamat Supplier</label>
                                 @error('alamat_supplier')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                              <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                              <a href="/suppliers"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
                           </div>
                        </form><!-- End floating Labels Form -->

                     </div> <!-- End Card Body -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

@endsection