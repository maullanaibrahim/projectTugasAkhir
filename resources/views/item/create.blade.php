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

                        <form class="row g-3 mb-3" action="/items" method="POST">
                           @csrf
                           <div class="col-md-1">
                              <div class="form-floating">
                                 <input type="text" class="form-control text-uppercase bg-light" name="kode_item" id="kodeItem" value="A{{ $count }}" readonly required>
                                 <label for="kodeItem">Kode</label>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-floating">
                                 <input type="text" class="form-control text-uppercase @error('nama_item') is-invalid @enderror" name="nama_item" id="namaItem" placeholder="Nama Item" value="{{ old('nama_item') }}" required>
                                 <label for="namaItem">Nama Item</label>
                                 @error('nama_item')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-floating">
                                 <input type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" placeholder="Harga Item" value="{{ old('harga') }}" required>
                                 <label for="harga">Harga</label>
                                 @error('harga')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="form-floating">
                                 <select class="form-select @error('satuan') is-invalid @enderror" name="satuan" id="satuan" aria-label="State" required>
                                    <option selected disabled>Pilih Satuan..</option>
                                    <option value="PCS">PCS</option>
                                    <option value="BUAH">BUAH</option>
                                    <option value="LITER">LITER</option>
                                    <option value="JERIGEN">JERIGEN</option>
                                    <option value="UNIT">UNIT</option>
                                 </select>
                                 <label for="satuan">Satuan</label>
                                 @error('satuan')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-floating">
                                 <select class="form-select @error('supplier_id') is-invalid @enderror" name="supplier_id" id="supplier" aria-label="State" required>
                                    <option selected disabled>Pilih Supplier..</option>
                                    @foreach($suppliers as $s)
                                    <option class="text-uppercase" value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                                    @endforeach
                                 </select>
                                 <label for="supplier">Supplier</label>
                                 @error('supplier_id')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-floating">
                                 <select class="form-select @error('jenis_item') is-invalid @enderror" name="jenis_item" id="jenisItem" aria-label="State" required>
                                    <option selected disabled>Pilih Jenis Item..</option>
                                    <option value="ASSET">ASSET</option>
                                    <option value="NON ASSET">NON ASSET</option>
                                 </select>
                                 <label for="jenisItem">Jenis Item</label>
                                 @error('jenis_item')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-4">
                              <p style="font-size:12px;margin-bottom:2px;">Gambar Item</p>
                              <div class="col-sm-12">
                                 <input class="form-control @error('preview') is-invalid @enderror" type="file" accept="image/png, image/gif, image/jpeg" name="preview" id="formFile" value="{{ old('preview') }}">
                                 @error('preview')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                              <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                              <a href="/items"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
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