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

                        <form class="row g-3 mb-3" action="/branches" method="POST">
                           @csrf
                           <div class="col-md-2">
                              <div class="form-floating">
                                 <input type="text" class="form-control text-uppercase @error('kode_cabang') is-invalid @enderror" name="kode_cabang" id="kodeCabang" placeholder="Kode Cabang" value="{{ old('kode_cabang') }}" required>
                                 <label for="kodeCabang">Kode Cabang</label>
                                 @error('kode_cabang')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>

                           <div class="col-md-4">
                              <div class="form-floating">
                                 <input type="text" class="form-control text-uppercase @error('nama_cabang') is-invalid @enderror" name="nama_cabang" id="namaCabang" placeholder="Nama Cabang" value="{{ old('nama_cabang') }}" required>
                                 <label for="namaCabang">Nama Cabang</label>
                                 @error('nama_cabang')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>

                           <div class="col-md-2">
                              <div class="form-floating">
                                 <select class="form-select @error('wilayah') is-invalid @enderror" name="wilayah" id="wilayah" value="{{ old('wilayah') }}" aria-label="State">
                                    <option selected disabled>Pilih Wilayah..</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                 </select>
                                 <label for="wilayah">Wilayah</label>
                                 @error('wilayah')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>

                           <div class="col-md-2">
                              <div class="form-floating">
                                 <select class="form-select @error('regional') is-invalid @enderror" name="regional" id="regional" value="{{ old('regional') }}" aria-label="State">
                                    <option selected disabled>Pilih Regional..</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                    <option value="E">E</option>
                                    <option value="F">F</option>
                                 </select>
                                 <label for="regional">Regional</label>
                                 @error('regional')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>

                           <div class="col-md-2">
                              <div class="form-floating">
                                 <select class="form-select @error('area') is-invalid @enderror" name="area" id="area" value="{{ old('area') }}" aria-label="State">
                                    <option selected disabled>Pilih Area..</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                 </select>
                                 <label for="area">Area</label>
                                 @error('area')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           
                           <div class="col-md-12">
                              <div class="form-floating">
                                 <textarea class="form-control text-uppercase @error('alamat_cabang') is-invalid @enderror" placeholder="Alamat Cabang" name="alamat_cabang" id="alamatCabang" style="height: 100px;">{{ old('alamat_cabang') }} </textarea>
                                 <label for="alamatCabang">Alamat Cabang</label>
                                 @error('alamat_cabang')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                              <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                              <a href="/branches"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
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