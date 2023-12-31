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
                        @if(auth()->user()->position->position_name == "Manager")
                            @include('partials.dashboardOther')
                        @else
                            @include('partials.dashboardAsset')
                        @endif
                    @elseif(auth()->user()->division->division_name == "Konohagakure")
                        @include('partials.dashboardApprover')
                    @else
                        @include('partials.dashboardOther')
                    @endif
                </div> <!-- End row -->
            </div> <!-- End col-lg-12 -->
        </div> <!-- End row -->
    </section>
   
@endsection