<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pengaduans = Pengaduan::get();
        $filter = isset($_GET['filter']) ? $_GET['filter'] : 'Semua Data';
        if($filter != 'Semua Data')
            $pengaduans = $pengaduans->filter(function($item) use ($filter){
                return $item->riwayat->status == $filter;
            });

        return view('admin.pengaduan.index',compact('pengaduans','filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view('admin.pengaduan.show',compact('pengaduan'));
    }

    public function updateStatus(Pengaduan $pengaduan, $status)
    {
        $user = JwtSession::user();
        $pengaduan->riwayat->create([
            'pengaduan_id' => $pengaduan->id,
            'updated_by'   => $user->nama,
            'role'         => $user->role->name,
            'status'       => $status
        ]);

        return redirect()->route('admin.pengaduan.show',$pengaduan->id)->with('success','Pengaduan berhasil di update');
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
