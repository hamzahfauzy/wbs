@extends('layouts.app')

@section('content')
<style>
.form-group label {
    font-weight:bold;
}
</style>
<div class="row">
    <div class="col-12 col-md-7 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="card-title">
                    Detail Pengaduan - {{$pengaduan->judul}}
                </div>

                <div class="card-tools">
                    @if($pengaduan->riwayat->status != 'Di Arsipkan')
                    @if($pengaduan->riwayat->status == 'Baru')
                    <a href="{{route('admin.pengaduan.update-status',['pengaduan'=>$pengaduan->id,'status'=>'Di Proses'])}}" class="btn btn-sm btn-success" onclick="if(confirm('Proses pengaduan ini ?')){return true}else{return false}">Proses</a>
                    @endif
                    @if($pengaduan->riwayat->status == 'Di Proses')
                    <a href="{{route('admin.pengaduan.update-status',['pengaduan'=>$pengaduan->id,'status'=>'Selesai'])}}" class="btn btn-sm btn-success" onclick="if(confirm('Selesaikan pengaduan ini ?')){return true}else{return false}">Selesai</a>
                    @endif
                    <a href="{{route('admin.pengaduan.update-status',['pengaduan'=>$pengaduan->id,'status'=>'Di Arsipkan'])}}" class="btn btn-sm btn-danger" onclick="if(confirm('Arsipkan pengaduan ini ?')){return true}else{return false}">Arsipkan</a>
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
                <!-- Chat Iframe -->

                <!-- Chat Message -->
                <div class="form-group">
                    <textarea id="message" class="form-control" placeholder="Pesan disini..."></textarea>
                    <button class="btn btn-block btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-5 grid-margin stretch-card mx-auto">
        <div class="card">
            <div class="card-header">
                Obrolan
            </div>
            <div class="card-body chat-content" style="height:350px;overflow:auto;">
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <textarea id="message" class="form-control" placeholder="Pesan disini..."></textarea>
                    <button class="btn btn-block btn-success" onclick="sendMsg(this)">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
function sendMsg(el)
{
    el.disabled = true
    el.innerHTML = 'Mengirim'
    var message = document.querySelector('#message')

    fetch('{{route('admin.send-msg',$pengaduan->id)}}',{
        method: 'post',
        body: JSON.stringify({
            'messages': message.value
        }),
        headers: {
            'Content-Type': 'application/json',
            "X-CSRF-Token": csrfToken
        }
    })
    .then(response => response.json())
    .then(response => {
        if(response.status == 'success')
        {
            el.innerHTML = 'Terkirim'
            message.value = ''
        }
        else
        {
            el.innerHTML = 'Gagal Terkirim'
        }

        setTimeout(e => {
            el.disabled = false
            el.innerHTML = 'Submit'
        })
    })
}

setInterval(e => {
    fetch('{{route('admin.conversation',$pengaduan->id)}}')
    .then(res => res.json())
    .then(res => {
        var chatContent = ''
        res.forEach(r => {
            chatContent += `<div class="talk-bubble ${r.replied_by==null?'left-top':'right-top'}">
                    <div class="talktext">
                        <b>${r.replied_by==null?r.pengaduan.pengadu.nama:'Anda'}</b><br>
                        <p>${r.messages}</p>
                    </div>
                </div>`;
        })
        document.querySelector('.chat-content').innerHTML = chatContent
    })
},2000)
</script>
@endsection