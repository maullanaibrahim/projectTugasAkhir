@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @if(auth()->user()->division->division_name == "Procurement")
                    @include('partials.dashboardPrc')
                    @elseif(auth()->user()->division->division_name == "Asset Management")
                    @include('partials.dashboardAsset')
                    @else
                    @include('partials.dashboardOther')
                    @endif
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div> <!-- End row -->
    </section>
   
@endsection