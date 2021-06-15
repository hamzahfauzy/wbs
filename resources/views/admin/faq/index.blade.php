@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <span class="h5 mb-4 text-gray-800">Data FAQ</span>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">

            <a href="{{route('admin.faq.create')}}" class="btn btn-sm btn-primary"><em class="ti-plus"></em> Buat Faq Baru</a>
        </li>
        <li class="list-group-item">
            @if($msg = Session::get('success'))
            <div class="alert alert-success">
                {{$msg}}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Pertanyaan</th>
                            <th>Jawaban</th>
                            <th>Urutan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $key => $faq)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{(strlen($faq->question) > 60 ? substr($faq->question, 0, 60). "..." : $faq->question)}}</td>

                            <td>{{(strlen($faq->answer) > 60 ? substr($faq->answer, 0, 60). "..." : $faq->answer)}}</td>
                            <td>{{$faq->order_number}}</td>
                            <td>
                                <a href="{{route('admin.faq.edit',$faq->id)}}" style="padding:6px; margin-top: -6px; margin-bottom: -6px;" class="btn btn-info" title="Ubah"><em class="ti-pencil"></em></a>
                                <a href="{{route('admin.faq.delete',$faq->id)}}" style="padding:6px; margin-top: -6px; margin-bottom: -6px;" class="btn btn-danger" title="Hapus" onclick="if(confirm('Hapus data ini ?')){return true}else{return false}"><em class="ti-trash"></em></a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="6"><i>Tidak ada data</i></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </li>
    </ul>

</div>

@endsection