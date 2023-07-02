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

                        <form class="row g-3 mb-3" action="/divisions" method="POST">
                           @csrf
                           <div class="col-md-4">
                              <div class="form-floating">
                                 <input type="text" class="form-control text-uppercase @error('nama_divisi') is-invalid @enderror" name="nama_divisi" id="namaDivisi" placeholder="Nama Divisi" value="{{ old('nama_divisi') }}" required>
                                 <label for="namaDivisi">Nama Divisi</label>
                                 @error('nama_divisi')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-floating">
                                 <select class="form-select @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" aria-label="Lokasi">
                                    <option selected disabled>Pilih Lokasi..</option>
                                    <option value="GRIYA CENTER">GRIYA CENTER</option>
                                    <option value="KOPO CENTER">KOPO CENTER</option>
                                    <option value="DISTRIBUTION CENTER">DISTRIBUTION CENTER</option>
                                 </select>
                                 <label for="lokasi">Lokasi</label>
                                 @error('lokasi')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-floating">
                                 <textarea class="form-control text-uppercase @error('alamat') is-invalid @enderror" placeholder="Alamat" name="alamat" id="alamat" style="height: 100px;">{{ old('alamat') }} </textarea>
                                 <label for="alamat">Alamat</label>
                                 @error('alamat')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                              <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                              <a href="/divisions"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
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