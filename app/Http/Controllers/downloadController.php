<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class downloadController extends Controller
{
    public function download($id){
        $data = DB::table('entries')->where('id', $id)->first();
        $filepath = storage_path("app/public/{$data->upload}");
        return Response()->download($filepath);
    }
}
