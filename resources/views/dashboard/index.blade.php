@extends('layouts.main')
@section('content')
    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    @if(auth()->user()->division->division_name == "Procurement")
                        @if(auth()->user()->position->position_name == "Manager")
                        @include('partials.dashboardApprover')
                        @else
                        @include('partials.dashboardPrc')
                        @endif
                    @elseif(auth()->user()->division->division_name == "Asset Management")
                        @include('partials.dashboardAsset')
                    @elseif(auth()->user()->division->division_name == "Maull Center")
                        @include('partials.dashboardApprover')
                    @else
                        @include('partials.dashboardOther')
                    @endif
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div> <!-- End row -->
    </section>
   
@endsection