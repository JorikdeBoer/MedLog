<?php

// Controller of the Export section
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Entry;
use App\Illness;
use Calendar;
use PDF;

class ExportController extends Controller
{
    // authentication requirement
    public function __construct()
    {
        $this->middleware('auth');
    }

    // function to show export page
    public function index()
    {
        $user = Auth::user();
      	$illnesses = $user->diary->illnesses->sortBy('illness', SORT_REGULAR, false);
        return view('export.export',  compact('illnesses'));
    }

    // function to export complete diary
    public function getPDF()
    {
        $user = Auth::user();
        $entries = $user->diary->entries()
          ->orderBy('timespan_date', 'ASC')
          ->orderBy('timespan_time', 'ASC')
          ->with('symptomes')
          ->with('medicines')
          ->get();
        $pdf=PDF::loadView('export.dagboek', ['entries'=>$entries ]);
        return $pdf->download('dagboek.pdf');
    }

    // function to export diary pages of certain illness
    public function getillnessPDF(Request $request)
    {
        $user = Auth::user();
        $illnesses = $user->diary->illnesses;
        $illness_name = $request->input('illness');
        $entries = $user->diary->entries()
          ->where('illness', $illness_name)
          ->orderBy('timespan_date', 'ASC')
          ->orderBy('timespan_time', 'ASC')
          ->with('symptomes')
          ->with('medicines')
          ->get();
        $pdf=PDF::loadView('export.dagboek', ['entries'=>$entries]);
        return $pdf->download('dagboek.pdf');
    }

    // function to export diary in certain period
    public function getperiodPDF(Request $request)
    {
        $user = Auth::user();
        $from_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $entries = $user->diary->entries()
          ->where('timespan_date', '>=' ,$from_date)
          ->orderBy('timespan_date', 'ASC')
          ->orderBy('timespan_time', 'ASC')
          ->with('symptomes')
          ->with('medicines')
          ->get();
        $pdf=PDF::loadView('export.dagboek', ['entries'=>$entries ]);
        return $pdf->download('dagboek.pdf');
    }
}
