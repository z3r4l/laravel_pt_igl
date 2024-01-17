<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\ItemInvoice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invoice::create([
            'no_invoice'    => 1,
            'name'          => 'PT.CHAYA INTERFREIGHT CARGO',
            'address'       => "Komp. Ruko Mega Legenda Extention blok G2 No.20, Baloi Permai, Kota Batam Kepulauan Riau",
            'attn'          => 'Mr.Bigston',
            'vessel'        => 'KM. PENGUIN INDOR',
            'voy'           => 'S4015',
        ]);

        ItemInvoice::create([
            'id'            => 10,
            'invoice_id'    => 1,
            'description'   => 'Pengurusan dokumen undername
            PT.Tridaya Sukses Selaras &
            customs clearance PPFTZ-01 import
            PPFTZ-01 No : 002751
            tgl : 04-01-2024
            Qty : 2 Box
            BL no : s2401005-03',
            'unit' => 'pcs',
            'qty' => 5,
            'rate' => 20000,
            'total_value' => 100000,
        ]);
    }
}
