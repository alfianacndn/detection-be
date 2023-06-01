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
    public function history()
    {

$history = history::all();
return $history;
    }

     public function history_bydate(Request $request)
    {

$history_bydate = history::where('date','>=',$request->start_date)->where('date','<=',$request->end_date)->where('time','>=',$request->start_time)->where('time','<=',$request->end_time)->get();

return $history_bydate;

    }

     public function history_bytime(Request $request)

    {

$history_bytime = history::where('date','=',date("Y-m-d"))->whereBetween('time',[$request->start_time,$request->end_time])->get();

return $history_bytime;

    }

     public function history_bysearch(Request $request)
    {

$history_bysearch = history::where('pic', 'LIKE', '%' . $request->input_search . '%')->orwhere('date', 'LIKE', '%' . $request->input_search . '%')->orwhere('classification', 'LIKE', '%' . $request->input_search . '%')->orwhere('accuration', 'LIKE', '%' . $request->input_search . '%')->orwhere('time', 'LIKE', '%' . $request->input_search . '%')->get();
return $history_bysearch;


    }



   
     public function insert_history(Request $request)
    {
        //validate data
      
            $user= Auth::user();
            $insert = history::create([
                'pic'     => $user->name,
                'classification'   => $request->classification,
                'accuration'   => $request->accuration,
                'date'   => date("Y-m-d"),
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