@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">
        <span class="h5 mb-4 text-gray-800">Tambah Data FAQ</span>
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
            <form action="{{route('admin.faq.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="" class="font-weight-bold">Question <small class="text-danger">*</small></label>
                    <input type="text" class="form-control" name="question" required placeholder="Question">
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold">Answer <small class="text-danger">*</small></label>
                    <input class="form-control" name="answer" required placeholder="Answer">
                </div>
                <div class="form-group">
                    <label for="" class="font-weight-bold">Order Number<small class="text-danger">*</small></label>
                    <input type="number" class="form-control" name="order_number" required placeholder="Order Number">
                </div>

                <button class="btn btn-outline-primary">Simpan</button>
            </form>

        </li>
    </ul>
</div>


@endsection