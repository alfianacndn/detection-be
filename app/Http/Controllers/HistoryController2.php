<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\History;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;

date_default_timezone_set('Asia/Jakarta');


class HistoryController extends Controller
{
    public function all_history()
    {

$data_history = history::all();
return $data_history;
    }

     public function filter_history(Request $request)
    {

$data_history_filter = history::where('date','=',$request->date)->get();
return $data_history_filter;
    }



   
     public function insert_history(Request $request)
    {
        //validate data
      
            $user= Auth::user();
            $insert = history::create([
                'pic'     => $user->name,
                'classification'   => $request->classification,
                'accuration'   => $request->accuration,
                'date'   => date("d-m-Y"),
                'time' => date("H:i:s"),
            ]);

            if ($insert) {
                return response()->json([
                    'success' => true,
                    'message' => ' Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Disimpan!',
                ], 401);
            }
        
    }
}