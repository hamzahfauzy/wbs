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
        <div class="card">
            <div class="card-body text-center">

                <h4 class="text-center">Hal yang sering ditanyakan :</h4>
            </div>
        </div>
        @forelse($faqs as $faq)

        <div id="accordion">
            <div class="card">
                <div class="card-header" id=".{{$faq->id}}.">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            {{$faq->question}}
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby=".{{$faq->id}}." data-parent="#accordion">
                    <div class="card-body">
                        {{$faq->answer}}
                    </div>
                </div>
            </div>
        </div>
        @empty
        @endforelse
    </div>
</div>
@endsection