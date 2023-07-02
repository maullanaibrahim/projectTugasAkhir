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
                        
                        <form class="row g-3 mb-3" action="/employees" method="POST">
                           @csrf
                           <div class="col-md-2">
                              <div class="form-floating">
                                 <input type="text" class="form-control bg-light" name="nik" id="nik" value="E{{ $count }}" readonly>
                                 <label for="nik">NIK</label>
                              </div>
                           </div>
                           
                           <div class="col-md-4">
                              <div class="form-floating">
                                 <input type="text" class="form-control text-uppercase @error('employee_name') is-invalid @enderror" name="employee_name" id="employee_name" placeholder="Nama Karyawan" value="{{ old('employee_name') }}" required>
                                 <label for="employee_name">Nama Karyawan</label>
                                 @error('employee_name')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-floating">
                                 <select class="form-select @error('position_id') is-invalid @enderror" name="position_id" id="position_id" value="{{ old('position_id') }}" aria-label="Position">
                                    <option selected disabled>Pilih Jabatan..</option>
                                    @foreach($positions as $position)
                                    <option value="{{ $position->id }}">{{ strtoupper($position->nama_jabatan) }}</option>
                                    @endforeach
                                 </select>
                                 <label for="jabatan">Jabatan</label>
                                 @error('position_id')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>

                           <div class="col-md-3">
                              <div class="form-floating">
                                 <select class="form-select @error('cost_id') is-invalid @enderror" name="cost_id" id="cost_id" value="{{ old('cost_id') }}" aria-label="Cost">
                                    <option selected disabled>Pilih Cabang / Divisi..</option>
                                    @foreach($costs as $cost)
                                    <option value="{{ $cost->id }}">{{ strtoupper($cost->cost_name) }}</option>
                                    @endforeach
                                 </select>
                                 <label for="cost">Cabang / Divisi</label>
                                 @error('cost_id')
                                 <div class="invalid-feedback">
                                    {{ $message }}
                                 </div>
                                 @enderror
                              </div>
                           </div>
                           
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-primary float-end ms-2"><i class="bi bi-save2 me-1"></i> Simpan</button>
                              <button type="reset" class="btn btn-warning float-end ms-2"><i class="bi bi-trash me-1"></i> Reset</button>
                              <a href="/employees"><button type="button" class="btn btn-secondary float-start"><i class="bi bi-arrow-return-left me-1"></i> Kembali</button></a>
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