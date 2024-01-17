<?php

namespace App\Http\Controllers;

use App\Charts\InvoiceAmountChart;
use App\Models\Company;
use App\Models\ItemInvoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:dashboard-list', ['only' => ['index']]);
    }
    public function index(InvoiceAmountChart $chart){
        $totalAmountMount = ItemInvoice::whereMonth('created_at', date('m'))->sum('total_value');
        $totalAmountYear = ItemInvoice::whereYear('created_at', date('Y'))->sum('total_value');
        $totalCompany = Company::get()->count();
        return view('back.dashboard.index',[
            'chart' => $chart->build(),
            'totalAmountMount'  => $totalAmountMount,
            'totalAmountYear'  => $totalAmountYear,
            'totalCompany'  => $totalCompany,
    ]);
    }
}
