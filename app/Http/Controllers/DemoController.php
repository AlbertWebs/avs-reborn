<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Exports\ProductExport;

use Maatwebsite\Excel\Facades\Excel;
use Session;


class DemoController extends Controller
{

    public function importExportView()
    {
       //Import Excell Documents to DB
       return view('front.import');
    }


    public function export()
    {
        Session::flash('message', "Export Was Successfull");
        // Downloads The Excel Document with name amani.xlsx
        return Excel::download(new UsersExport, 'avs.xlsx');
    }

    public function export_products()
    {
        Session::flash('message', "Export Was Successfull");
        // Downloads The Excel Document with name amani.xlsx
        return Excel::download(new ProductExport, 'avs.xlsx');
    }

    public function create_image_link(){
        // fetch products
        $products = \App\Models\Product::all();
        // update products
        foreach($products as $product){
            if($product->image_one == null){
                $product_image_one = $product->thumbnail;
            }else{
                $product_image_one = $product->image_one;
            }
            $priice = $product->price;
            $dollars = $priice / 130;
            $newdollars =  number_format($dollars, 2, '.', '');
            $product->imagelink = 'https://www.amanivehiclesounds.co.ke/uploads/product/'.$product_image_one;
            // product link
            $product->productlink = 'https://www.amanivehiclesounds.co.ke/product/'.$product->slung;
            //update price with .00
            $product->productprice = $newdollars." USD";

            $product->save();
        }

    }

}
