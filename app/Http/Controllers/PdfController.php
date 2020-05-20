<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Storage;

class PdfController extends Controller
{
    //

     public function generatePDF()
    {
        $data = ['title' => 'Welcome to ItSolutionStuff.com'];

        // this function create pdf 
        $pdf = PDF::loadView('myPDF', $data);
        
       // this contain pdf path which is used to store in database
        $time = time().rand();
         $path = 'invoice_'.$time.'.pdf';

        // this function store pdf in storage /public/pdf folder
        Storage::put($path,$pdf->output());
       Storage::move($path, 'public/pdf/' . $path);

        $path_store_to_database = "pdf/".$path;

      	//this function download 
		return $pdf->download($path);

// this function display pdf in browser
 // return $pdf->stream();
      
    }

    public function display(){

  		 echo  '<a href='.asset('storage/'.'pdf/invoice_1589954999390406453.pdf').'> click</a>';
    }
}
