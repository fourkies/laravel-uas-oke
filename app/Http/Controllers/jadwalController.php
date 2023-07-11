<?php

namespace App\Http\Controllers;

use App\Models\riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class jadwalController extends Controller
{

    function __construct()
    {
        $this->_tipe = 'jadwal';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = riwayat::where('tipe',  $this->_tipe)->orderBy('tgl_akhir','desc')->get();
        // $data = riwayat::where('tipe',  $this->_tipe)->orderBy('tgl_akhir','desc')->get();
        return view('dashboard.jadwal.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.jadwal.create');
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
        // Session::flash('info3' , $request->info3);
        // Session::flash('tgl_mulai' , $request->tgl_mulai);
        // Session::flash('tgl_akhir' , $request->tgl_akhir);
        Session::flash('isi', $request->isi);
        $request->validate(
            [
                'judul' => 'required',
                'name' => 'required',
                'info1' => 'required',
                'info2' => 'required',
                // 'info3' => 'required',
                'tgl_mulai' => 'required',
                'isi' => 'required',
                
            ],[
                'judul.required' => 'Nama Dosen wajib diisi',
                'name.required' => 'Mata kuliah wajib diisi',
                'info1.required' => 'Kelas wajib diisi',
                'info2.required' => 'Jam Mulai wajib diisi',
                // 'info3.required' => 'Jam Akhir wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai wajib diisi',
                'isi.required' => 'Isian tulisan wajib diisi'
            ]
            );

            $data = [
                'judul' => $request->judul,
                'name' => $request->name,
                'info1' => $request->info1,
                'info2' => $request->info2,
                // 'info3' => $request->info3,
                'tipe' =>  $this->_tipe,
                'tgl_mulai' => $request->tgl_mulai,
                // 'tgl_akhir' => $request->tgl_akhir,
                'isi' => $request->isi
            ];
            riwayat::create($data);

            return redirect()->route('jadwal.index')->with('success', 'Berhasil menambahkan data jadwal');
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
        return view('dashboard.jadwal.edit')->with('data', $data);
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
                'info2' => 'required',
                // 'info3' => 'required',
                'tgl_mulai' => 'required',
                'isi' => 'required',
            ],[
                'judul.required' => 'Dosen wajib diisi',
                'name.required' => 'Mata Kuliah wajib diisi',
                'info1.required' => 'Kelas wajib diisi',
                'info2.required' => 'Jam Mulai wajib diisi',
                // 'info3.required' => 'Jam Akhir wajib diisi',
                'tgl_mulai.required' => 'Tanggal Mulai wajib diisi',
                'isi.required' => 'Isian tulisan wajib diisi'
            ]
            );

            $data = [
                'judul' => $request->judul,
                'name' => $request->name,
                'info1' => $request->info1,
                'info2' => $request->info2,
                // 'info3' => $request->info3,
                'tgl_mulai' => $request->tgl_mulai,
                // 'tgl_akhir' => $request->tgl_akhir,
                'isi' => $request->isi
            ];
            riwayat::where('id', $id)->update($data);

            return redirect()->route('jadwal.index')->with('success', 'Berhasil Update Data Jadwal');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        riwayat::where('id', $id)->where('tipe', $this->_tipe)->delete();
        return redirect()->route('jadwal.index')->with('success', 'Berhasil Delete Data Jadwal');
    }
}
