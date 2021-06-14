<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bukti;
use App\Models\Pihak;
use App\Models\Pengadu;
use App\Models\Riwayat;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = session('user')??User::where('email',session('otp_auth'))->first();
        $pengadus = $user->pengadus;
        return view('guest.index',compact('pengadus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('guest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'pihaks.nama.*' => 'required',
            'pihaks.jabatan.*' => 'required',
            'lampirans.file.*' => 'required',
            'lampirans.keterangan.*' => 'required',
            'privasi' => 'required',
        ],[
            'pihaks.nama.*.required' => 'Nama Pihak yang Terlibat tidak boleh kosong',
            'pihaks.jabatan.*.required' => 'Jabatan Pihak yang Terlibat tidak boleh kosong'
        ]);

        $files = $request->file('lampirans.file');

        $nomor_hp = session('otp_auth');

        DB::beginTransaction();
        try {
            // check if user exists
            if(session('user'))
                $user = session('user');
            else
            {
                $user = User::create([
                    'name'     => $request->nama,
                    'email'    => $nomor_hp,
                    'password' => $nomor_hp,
                ]);
            }

            // insert into pengaduan
            $pengaduan = Pengaduan::create([
                'judul'     => $request->judul,
                'deskripsi' => $request->deskripsi,
                'privasi'   => $request->privasi
            ]);

            // insert pengadu
            $pengadu   = Pengadu::create([
                'user_id'      => $user->id,
                'pengaduan_id' => $pengaduan->id,
                'nama'         => $request->nama,
                'alamat'       => $request->alamat,
                'nomor_hp'     => $nomor_hp,
            ]);

            // insert riwayat
            Riwayat::create([
                'pengaduan_id' => $pengaduan->id,
                'updated_by'   => $request->nama,
                'role'         => 'Pengadu',
                'status'       => 'Baru'
            ]);

            // insert pihak
            foreach($request->pihaks['nama'] as $key => $pihak)
            {
                Pihak::create([
                    'pengaduan_id' => $pengaduan->id,
                    'nama' => $pihak,
                    'jabatan' => $request->pihaks['jabatan'][$key],
                ]);
            }

            // insert lampiran
            foreach($request->lampirans['keterangan'] as $key => $keterangan)
            {
                $file_url = $files[$key]->store('lampirans');
                $bukti = Bukti::create([
                    'pengaduan_id' => $pengaduan->id,
                    'deskripsi' => $keterangan,
                    'file_url' => $file_url,
                ]);
            }

            DB::commit();
            return redirect()->route('guest.index')->with('success','Pengaduan berhasil disimpan');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
        }
        // return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Pengaduan $pengaduan)
    {
        //
        return view('guest.show',compact('pengaduan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
