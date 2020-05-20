create  laravel-dompdf

1).  composer require barryvdh/laravel-dompdf

2). add this code in config/app.php

	'providers' => [
	....
	Barryvdh\DomPDF\ServiceProvider::class,
],
'aliases' => [

	'PDF' => Barryvdh\DomPDF\Facade::class,
]

3). add route for controller in  routes/web.php

	Route::get('generate-pdf','PDFController@generatePDF');

4). command to link public folder to storage

	php artisan storage:link

5). make controller  PDFController 

  add this in controller => use PDF;

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


6). file will store in storage folder


7). get pdf by using

 	public function display(){

  		 echo  '<a href='.asset('storage/'.'pdf/invoice_15899522642115699053.pdf').'> click</a>';
    }

8. path of pdf is 

  http://localhost:8000/storage/pdf/invoice_15899522642115699053.pdf



note ==> not need to add  public  in pdf line 
