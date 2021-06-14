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
            </div>
            <div class="card-body">
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
                <!-- Chat Iframe -->

                <!-- Chat Message -->
                <div class="form-group">
                    <textarea id="message" class="form-control" placeholder="Pesan disini..."></textarea>
                    <button class="btn btn-block btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection