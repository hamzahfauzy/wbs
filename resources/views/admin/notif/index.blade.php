@extends('layouts.app')

@section('content')
<form action="" method="POST">
@csrf
<div class="row">
    <div class="col-12">
        @if($msg = Session::get('success'))
        <div class="alert alert-success">
            {{$msg}}
        </div>
        @endif
    </div>
    <div class="col-12 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-header">
                Field Tersedia
            </div>
            <div class="card-body">
                <code>[nama]</code>
                <code>[alamat]</code>
                <code>[nomor_hp]</code>
                <code>[judul]</code>
                <code>[deskripsi]</code>
            </div>
        </div>
    </div>
    
    <div class="col-12 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-header">
                Notifikasi Pengguna
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Pengaduan Berhasil Masuk</label>
                    <textarea name="user[pengaduan_masuk]" class="form-control" required>{{$notif?$notif[0]->template_text:''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Pengaduan Di Proses</label>
                    <textarea name="user[pengaduan_proses]" class="form-control" required>{{$notif?$notif[1]->template_text:''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Pengaduan Selesai</label>
                    <textarea name="user[pengaduan_selesai]" class="form-control" required>{{$notif?$notif[2]->template_text:''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Pengaduan Di Arsipkan</label>
                    <textarea name="user[pengaduan_arsip]" class="form-control" required>{{$notif?$notif[3]->template_text:''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Chat Baru</label>
                    <textarea name="user[chat_baru]" class="form-control" required>{{$notif?$notif[4]->template_text:''}}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-header">
                Notifikasi Admin
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">Pengaduan Masuk</label>
                    <textarea name="admin[pengaduan_masuk]" class="form-control" required>{{$notif?$notif[5]->template_text:''}}</textarea>
                </div>

                <div class="form-group">
                    <label for="">Chat Baru</label>
                    <textarea name="admin[chat_baru]" class="form-control" required>{{$notif?$notif[6]->template_text:''}}</textarea>
                </div>

            </div>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-success">Submit</button>
    </div>
</div>
</form>
@endsection