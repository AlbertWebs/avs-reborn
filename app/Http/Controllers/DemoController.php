<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Session;


class DemoController extends Controller
{

    public function importExportView()
    {
    //    Import Excell Documents to DB
       return view('front.import');
    }


    public function export() 
    {
        Session::flash('message', "Export Was Successfull");
        // Downloads The Excel Document with name amani.xlsx
        return Excel::download(new UsersExport, 'amani.xlsx');
    }
}
