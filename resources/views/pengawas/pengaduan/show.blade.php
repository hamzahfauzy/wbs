@extends('layouts.app')

@section('content')
<style>
.form-group label {
    font-weight:bold;
}
</style>
<div class="row">
    <div class="col-12 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    Detail Pengaduan - {{$pengaduan->judul}}
                </div>

                <div class="card-tools">
                    @if($pengaduan->riwayat->status != 'Di Arsipkan')
                    @if($pengaduan->riwayat->status == 'Baru')
                    <a href="{{route('pengawas.pengaduan.update-status',['pengaduan'=>$pengaduan->id,'status'=>'Di Proses'])}}" class="btn btn-sm btn-success" onclick="if(confirm('Proses pengaduan ini ?')){return true}else{return false}">Proses</a>
                    @endif
                    @if($pengaduan->riwayat->status == 'Di Proses')
                    <a href="{{route('pengawas.pengaduan.update-status',['pengaduan'=>$pengaduan->id,'status'=>'Selesai'])}}" class="btn btn-sm btn-success" onclick="if(confirm('Selesaikan pengaduan ini ?')){return true}else{return false}">Selesai</a>
                    @endif
                    <a href="{{route('pengawas.pengaduan.update-status',['pengaduan'=>$pengaduan->id,'status'=>'Di Arsipkan'])}}" class="btn btn-sm btn-danger" onclick="if(confirm('Arsipkan pengaduan ini ?')){return true}else{return false}">Arsipkan</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if($msg = Session::get('success'))
                <div class="alert alert-success">
                    {{$msg}}
                </div>
                @endif
                <div class="form-group">
                    <label for="">Status</label>
                    <p>{!!$pengaduan->status_label!!}</p>
                </div>

                <div class="form-group">
                    <label for="">Nama</label>
                    <p>{!!$pengaduan->label_nama!!}</p>
                </div>

                <div class="form-group">
                    <label for="">Alamat</label>
                    <p>{{$pengaduan->pengadu->alamat??''}}</p>
                </div>

                <div class="form-group">
                    <label for="">Judul Pengaduan</label>
                    <p>{{$pengaduan->judul}}</p>
                </div>

                <div class="form-group">
                    <label for="">Uraian Pengaduan</label>
                    <p>{{$pengaduan->deskripsi}}</p>
                </div>

                <div class="form-group">
                    <label for="">Pihak yang diduga terlibat</label>
                    <ul>
                        @foreach($pengaduan->pihaks as $pihak)
                        <li>{{$pihak->nama}} ({{$pihak->jabatan}})</li>
                        @endforeach
                    </ul>
                </div>

                <div class="form-group">
                    <label for="">Lampiran</label>
                    <ul>
                        @foreach($pengaduan->buktis as $bukti)
                        <li>{{$bukti->deskripsi}} (<a href="{{Storage::url($bukti->file_url)}}" target="_blank">Buka File</a>)</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-header">
                Obrolan
            </div>
            <div class="card-body">
            </div>
        </div>
    </div>
</div>
@endsection