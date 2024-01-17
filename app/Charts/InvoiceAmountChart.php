<?php

namespace App\Charts;

use App\Models\ItemInvoice;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class InvoiceAmountChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $year = date('Y');
        $dataMonth = [];
        $dataTotalAmount = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $totalAmount = ItemInvoice::whereYear('created_at', $year)
                ->whereMonth('created_at', $i)
                ->sum('total_value');
        
            $dataMonth[] = Carbon::create()->month($i)->format('F');
            $dataTotalAmount[] = $totalAmount;
        }
        
        return $this->chart->lineChart()
            ->setTitle('Amount Invoice')
            ->addData('Total Amount', $dataTotalAmount)
            ->setColors(['#5DDAB4', '#ff6384'])
            ->setFontColor('#5DDAB4')
            ->setXAxis($dataMonth);
    }
}
