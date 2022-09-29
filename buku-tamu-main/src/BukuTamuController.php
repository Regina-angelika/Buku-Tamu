<?php
namespace Bageur\BukuTamu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bageur\BukuTamu\model\buku_tamu;
use Validator;

class BukuTamuController extends Controller
{

    public function index(Request $request)
    {
       $query = buku_tamu::datatable($request);
       return $query;
    }

    public function store(Request $request)
    {
        $rules    = [
            'nama'      => 'required',
            'nomor'     => 'required',
            'email'     => 'required',
            'pesan'     => 'required',
            'captcha'   => 'required|captcha_api:'. request('key') . ',flat'
        ];

        $messages = [
        ];

        $attributes = [
        ];
        $validator = Validator::make($request->all(), $rules,$messages,$attributes);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response(['status' => false ,'error'    =>  $errors->all()], 200);
        }else{
            $buku_tamu              = new buku_tamu;
            $buku_tamu->nama        = $request->nama;
            $buku_tamu->nomor       = $request->nomor;
            $buku_tamu->email       = $request->email;
            $buku_tamu->pesan       = $request->pesan;
            $buku_tamu->save();
            return response(['status' => true ,'text'    => 'has input'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return buku_tamu::findOrFail($id);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          $delete = buku_tamu::findOrFail($id);
          $delete->delete();
          return response(['status' => true ,'text'    => 'has deleted'], 200);
    }
}
