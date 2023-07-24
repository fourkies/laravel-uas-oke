<?php

namespace App\Http\Controllers;

use App\Models\riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class mahasiswaController extends Controller
{

    function __construct()
    {
        $this->_tipe = 'mahasiswa';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = riwayat::where('tipe',  $this->_tipe)->orderBy('tgl_akhir','desc')->get();
        return view('dashboard.mahasiswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('judul' , $request->judul);
        Session::flash('name' , $request->name);
        Session::flash('info1' , $request->info1);
        Session::flash('info2' , $request->info2);
        Session::flash('info3' , $request->info3);
        Session::flash('tgl_mulai' , $request->tgl_mulai);
        Session::flash('tgl_akhir' , $request->tgl_akhir);
        $request->validate(
            [
                'judul' => 'required',
                'name' => 'required',
                'info1' => 'required',
                'tgl_mulai' => 'required',
                
            ],[
                'judul.required' => 'Nama Mahasiswa wajib diisi',
                'name.required' => 'Universitas wajib diisi',
                'info1.required' => 'Nama Fakultas wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai wajib diisi',
            ]
            );

            $data = [
                'judul' => $request->judul,
                'name' => $request->name,
                'info1' => $request->info1,
                'info2' => $request->info2,
                'info3' => $request->info3,
                'tipe' =>  $this->_tipe,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_akhir' => $request->tgl_akhir,
            ];
            riwayat::create($data);

            return redirect()->route('mahasiswa.index')->with('success', 'Berhasil menambahkan data Mahasiswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = riwayat::where('id',$id)->where('tipe',$this->_tipe)->first();
        return view('dashboard.mahasiswa.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'judul' => 'required',
                'name' => 'required',
                'info1' => 'required',
                'tgl_mulai' => 'required',
                
            ],[
                'judul.required' => 'Nama Mahasiswa wajib diisi',
                'name.required' => 'Universitas wajib diisi',
                'info1.required' => 'Fakultas wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai wajib diisi',
                
            ]
            );

            $data = [
                'judul' => $request->judul,
                'name' => $request->name,
                'info1' => $request->info1,
                'info2' => $request->info2,
                'info3' => $request->info3,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_akhir' => $request->tgl_akhir,
               
            ];
            riwayat::where('id', $id)->update($data);

            return redirect()->route('mahasiswa.index')->with('success', 'Berhasil Update Data Mahasiswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        riwayat::where('id', $id)->where('tipe', $this->_tipe)->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Berhasil Delete Data Mahasiswa');
    }
}
