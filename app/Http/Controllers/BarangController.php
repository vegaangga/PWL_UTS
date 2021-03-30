<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$mahasiswa=Mahasiswa::all()->paginate(1);
        // Mengambil semua isi tabel
        $posts=Barang::orderBy('kode_barang','asc')->paginate(5);
        return view('barang.index',compact('posts'))->with('i',(request()->input('page',1)-1)*5);
    }

    /*
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['id_barang'=>'required',
        'kode_barang'=>'required',
        'nama_barang'=>'required',
        'kategori_barang'=>'required',
        'harga'=>'required',
        'qty'=>'required',
        ]);
        //fungsieloquentuntukmenambahdata
        Barang::create($request->all());
        //jikadataberhasilditambahkan,akankembalikehalamanutama
        return redirect()->route('barang.index')->with('success','Barang Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode_barang)
    {
        $barang=Barang::find($kode_barang);
        return view('barang.detail',compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_barang)
    {
        $barang=Barang::find($kode_barang);
        return view('barang.edit',compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_barang)
    {
        $request->validate(['id_barang'=>'required',
        'kode_barang'=>'required',
        'nama_barang'=>'required',
        'kategori_barang'=>'required',
        'harga'=>'required',
        'qty'=>'required',
        ]);
        Barang::find($kode_barang)->update($request->all());
        return redirect()->route('barang.index')->with('success','Barang Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_barang)
    {
        Barang::find($kode_barang)->delete();
        return redirect()->route('barang.index')->with('success','Barang Berhasil  Dihapus');
    }

    public function cari (Request $request)
    {

        $cari = $request -> get ('cari');
        $post = DB::table('barang')
        ->where('nama','like','%'.$cari.'%')->paginate(5)
        ->orWhere();
        return view('barang.index',['posts' => $post]);

         /*
        // 2 variabel
        $posts = Mahasiswa::when($request->keyword, function ($query) use ($request) {
            $query->where('nama', 'like', "%{$request->keyword}%")
                ->orWhere('nim', 'like', "%{$request->keyword}%");
        })->paginate(5);
        return view('mahasiswas.index',compact('posts'));


        $posts = Barang::query()->paginate(5);
        if(request()->has('kode_barang')) {
            $posts->where('kode_barang', 'like', request('kode_barang'));
        }
        if(request()->has('nama_barang')) {
            $posts->where('nama_barang', 'like', request('nama_barang'));
        }
        // and so on
        // for fields like PRICE and METERS, you need to user orWhere()

        return view('barang.index',compact('posts'));;
*/

    }

}