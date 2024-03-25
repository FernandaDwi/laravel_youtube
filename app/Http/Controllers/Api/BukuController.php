<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use illuminate\support\facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Buku::orderBy('judul','asc')->get();
        return response()->json([
           'status'=>true,
           'message'=>'Data ditemukan',
           'data'=>$data

        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $databuku = new Buku;

        $rules = [

            'judul'=>'required',
            'pengarang'=>'required',
            'tanggal_publikasi'=>'required|date'
        ];
           $validator = Validator::make($request->all(),$rules);
           if($validator->fails()) {
               return response()->json([
                  'status'=>false,
                  'message'=>'gagal memasukan data',
                  'data'=>$validator->erorrs()
               ]);
           }


        $databuku->judul = $request->judul;
        $databuku->pengarang = $request->pengarang;
        $databuku->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $dataBuku->save();

        return response()->json([
            'status' => true,
            'message' => 'sukses memasukan data'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Buku::find($id);
        if($data){
            return response()->json([
               'status'=>true,
               'message' => 'Data ditemukan',
               'data'=>$data

            ],200);
        }else{

            return response()->json([
                'status'=>false,
                'message'=>'Data tidak ditemukan'
            ]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $databuku = Buku::find($id);
        if(empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

        $rules = [

            'judul'=>'required',
            'pengarang'=>'required',
            'tanggal_publikasi'=>'required|date'
        ];
           $validator = Validator::make($request->all(),$rules);
           if($validator->fails()) {
               return response()->json([
                  'status'=>false,
                  'message'=>'gagal melakukan update data',
                  'data'=>$validator->erorrs()
               ]);
           }


        $databuku->judul = $request->judul;
        $databuku->pengarang = $request->pengarang;
        $databuku->tanggal_publikasi = $request->tanggal_publikasi;

        $post = $dataBuku->save();

        return response()->json([
            'status' => true,
            'message' => 'sukses melakukan update data'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $databuku = Buku::find($id);
        if(empty($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ],404);
        }

       
        $post = $dataBuku->delete();

        return response()->json([
            'status' => true,
            'message' => 'sukses melakukan delete data'
        ]);
    }
}
