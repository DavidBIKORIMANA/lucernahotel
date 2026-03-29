<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod; 
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PDFController extends Controller
{
            $users = [];
            $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users

        ]; 

            

        $pdf = PDF::loadView('myPDF', $data);

     

        return $pdf->download('itsolutionstuff.pdf');

    
}
