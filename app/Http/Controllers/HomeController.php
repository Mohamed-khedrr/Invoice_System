<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $check_empty = Invoice::first();
        if (!empty($check_empty)) {
            $unpaid_per = round(Invoice::where('value_status', 3)->sum('total') / Invoice::sum('total') * 100);
            $paid_per = round(Invoice::where('value_status', 1)->sum('total') / Invoice::sum('total') * 100);
            $part_paid_per = round(Invoice::where('value_status', 2)->sum('total') / Invoice::sum('total') * 100);

            $chartjs = app()->chartjs
                ->name('barChartTest')
                ->type('bar')
                ->size(['width' => 400, 'height' => 200])
                ->labels(['الفواتير الغير مدفوعة', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
                ->datasets([
                    [
                        "label" => "نسبة الفواتير",

                        'backgroundColor' => ['#ff003d', '#19e633', '#ff8a00'],
                        'data' => [$unpaid_per, $paid_per, $part_paid_per]
                    ]

                ])
                ->options([]);

            // pie chart
            $chartjs2 = app()->chartjs
                ->name('pieChartTest')
                ->type('pie')
                ->size(['width' => 400, 'height' => 269])
                ->labels(['الفواتير الغير مدفوعى', 'الفواتير المدفوعة', 'الفواتير المدفوعة جزئيا'])
                ->datasets([
                    [
                        'backgroundColor' => ['#ff003d', '#19e633', '#ff8a00'],
                        'hoverBackgroundColor' => ['#ff003d', '#19e633', '#ff8a00'],
                        'data' => [$unpaid_per, $paid_per, $part_paid_per]
                    ]
                ])
                ->options([]);





            return view('home', compact('chartjs', 'chartjs2'));
        } else {
            return view('home');
        }
    }
}
