@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">
        <span class="h5 mb-4 text-gray-800">Ubah Data FAQ</span>
    </div>
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <a href="{{route('admin.faq.index')}}" class="btn btn-danger btn-sm"><em class="ti-arrow-left"></em> Kembali</a>
        <li class="list-group-item">
            <form action="{{route('admin.faq.update', $faq->id)}}" method="POST">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="" class="font-weight-bold">Question <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" value="{{$faq->question}}" name="question" required placeholder="Question">
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold">Answer <small class="text-danger">*</small></label>
                    <input class="form-control" name="answer" value="{{$faq->answer}}" required placeholder="Answer">
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold">Order Number<small class="text-danger">*</small></label>
                    <input type="number" class="form-control" value="{{$faq->order_number}}" name="order_number" required placeholder="Order Number">
                </div>

                <button class="btn btn-outline-primary">Simpan</button>
            </form>

        </li>
    </ul>
</div>


@endsection