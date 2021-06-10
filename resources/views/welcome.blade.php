@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <a href="{{route('guest.create')}}" class="text-decoration-none">
                    <button class="btn btn-primary">
                        <i class="ti-pencil-alt icon-lg mb-0 mb-md-3 mb-xl-0 mr-3"></i>
                        <span>
                            BUAT PENGADUAN
                        </span>
                    </button> 
                </a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body text-center">
                <a href="{{route('guest.index')}}" class="text-decoration-none">
                    <button class="btn btn-warning">
                        <i class="ti-search icon-md mb-0 mb-md-3 mb-xl-0 mr-3"></i>
                        <span>
                            CEK PENGADUAN
                        </span>
                    </button> 
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <h4 class="text-center">Hal yang sering ditanyakan :</h4>
    </div>
</div>
@endsection