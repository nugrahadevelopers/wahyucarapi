<?php

namespace App\Http\Controllers\Api;

use App\Mobil;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function create(Request $request)
    {
        $mobil = new Mobil;
        $mobil->user_id = Auth::user()->id;
        $mobil->nama_mobil = $request->nama_mobil;
        $mobil->harga_mobil = $request->harga_mobil;
        $mobil->tipe_mobil = $request->tipe_mobil;
        $mobil->merek_mobil = $request->merek_mobil;
        $mobil->varian_mobil = $request->varian_mobil;
        $mobil->tahun_mobil = $request->tahun_mobil;
        $mobil->mesin_mobil = $request->mesin_mobil;
        $mobil->warna_mobil = $request->warna_mobil;
        $mobil->kapasitas_mobil = $request->kapasitas_mobil;

        if ($request->photo_mobil != '') {
            $photo = time() . '.jpg';
            file_put_contents('storage/cars/' . $photo, base64_decode($request->photo_mobil));
            $mobil->photo_mobil = $photo;
        }

        $mobil->save();
        $mobil->user;
        return response()->json([
            'success' => true,
            'message' => 'Uploaded',
            'mobil' => $mobil
        ]);
    }

    public function update(Request $request)
    {
        $mobil = Mobil::find($request->id);
        if (Auth::user()->id != $request->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized Access'
            ]);
        }

        $mobil->nama_mobil = $request->nama_mobil;
        $mobil->harga_mobil = $request->harga_mobil;
        $mobil->tipe_mobil = $request->tipe_mobil;
        $mobil->merek_mobil = $request->merek_mobil;
        $mobil->varian_mobil = $request->varian_mobil;
        $mobil->tahun_mobil = $request->tahun_mobil;
        $mobil->mesin_mobil = $request->mesin_mobil;
        $mobil->warna_mobil = $request->warna_mobil;
        $mobil->kapasitas_mobil = $request->kapasitas_mobil;

        if ($request->photo_mobil != '') {
            $photo = time() . 'jpg';
            file_put_contents('storage/cars/' . $photo, base64_decode($request->photo_mobil));
            $mobil->photo_mobil = $photo;
        }

        $mobil->update();
        return response()->json([
            'success' => true,
            'message' => 'Edited'
        ]);
    }

    public function delete(Request $request)
    {
        $mobil = Mobil::find($request->id);
        if (Auth::user()->id != $request->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized Access'
            ]);
        }

        if ($mobil->photo_mobil != '') {
            Storage::delete('public/cars/' . $mobil->photo_mobil);
        }

        $mobil->delete();
        return response()->json([
            'success' => true,
            'message' => 'Deleted'
        ]);
    }

    public function showMobil()
    {
        $mobil = Mobil::where('tipe_mobil', 'Baru')->with('user')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'mobil' => $mobil
        ]);
    }

    public function showMobilBekas()
    {
        $mobil = Mobil::where('tipe_mobil', 'Bekas')->with('user')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'mobil' => $mobil
        ]);
    }

    public function mobilKu()
    {
        $mobil = Mobil::where('user_id', Auth::user()->id)->with('user')->orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true,
            'mobil' => $mobil
        ]);
    }

    public function getMobil(Request $request)
    {
        $mobil = Mobil::where('id', $request->id)->with('user')->get();
        return response()->json([
            'success' => true,
            'mobil' => $mobil
        ]);
    }
}
