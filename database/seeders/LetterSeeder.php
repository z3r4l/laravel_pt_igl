<?php

namespace Database\Seeders;

use App\Models\CategoryLetter;
use App\Models\ItemLetter;
use App\Models\Letter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryLetter::create([
            'name'  => 'delivery order',
            'code_letter'   => 'DO'
        ]);

       Letter::create([
        'category_letter_id'        => 1,
        'no_letter'                 => 1,
        'shipper_name'              => 'random',
        'shipper_address'           => 'random',
        'consignee_name'            =>'random',
        'consignee_address'         => 'random',
        'consignee_attn'            => 'random',
        'consignee_phone'           =>'random',
        'shipment'                  => 'random',
        'total_gross_weight'        => 123,
        'total_package'             => 123,
       ]);

       ItemLetter::create([
        'id'            => 10,
        'letter_id'     => 1,
        'description'   =>'random',
        'qty'           => 1,
        'dimension'     => 'random',
       ]);
    }
}
