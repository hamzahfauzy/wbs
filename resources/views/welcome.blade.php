@extends('layouts.app')

@section('content')
@if($user)
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <span class="h5 mb-4 text-gray-800">WBS Kab. Labuhanbatu Utara</span>
            </div>
            <div class="card-body">
                Hai, {{$user->nama}}. Selamat Datang di WBS Kab. Labuhanbatu Utara
            </div>
        </div>
    </div>
</div>
@endif
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
        <div class="accordion accordion-bordered pt-4" id="accordion-2" role="tablist">
            <h4 class="text-center pb-3">Hal yang sering ditanyakan :</h4>
            @foreach($faqs as $key => $value)
            <div class="card">
                <div class="card-header" role="tab" id="heading-{{$value->id}}">
                    <h6 class="mb-0">
                        <a data-toggle="collapse" href="#collapse-{{$value->id}}" aria-expanded="false" aria-controls="collapse-{{$value->id}}" class="collapsed">
                            {{$value->question}}
                        </a>
                    </h6>
                </div>
                <div id="collapse-{{$value->id}}" class="collapse" role="tabpanel" aria-labelledby="heading-{{$value->id}}" data-parent="#accordion-2" style="">
                    <div class="card-body">
                        <p class="mb-0">{{$value->answer}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection