<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NameAirline extends Seeder
{
    protected $airlines = [
        [
            'name' => 'ماهان',
            'image' => 'images/mahan-logo.png',
        ],
        [
            'name' => 'کارون',
            'image' => 'images/karon-logo.jpg',
        ],
        [
            'name' => 'سپهران',
            'image' => 'images/sepehran-logo.jpg',
        ],
        [
            'name' => 'معراج',
            'image' => 'images/meraj-logo.jpg',
        ],
        [
            'name' => 'آتا',
            'image' => 'images/ata-logo.png',
        ],
        [
            'name' => 'ساها',
            'image' => 'images/saha-logo.jpg',
        ],
        [
            'name' => 'قشم ایر',
            'image' => 'images/gheshmair-logo.png',
        ],
        [
            'name' => 'تابان',
            'image' => 'images/taban-logo.jpg',
        ],
        [
            'name' => 'کیش ایر',
            'image' => 'images/kishair-logo.jpg',
        ],
        [
            'name' => 'کاسپین',
            'image' => 'images/caspian-logo.png',
        ],
        [
            'name' => 'آسمان',
            'image' => 'images/Aseman-logo.jpg',
        ],
        [
            'name' => 'هما',
            'image' => 'images/iranair-logo.png',
        ],
        [
            'name' => 'ایران ایرتور',
            'image' => 'images/iran-airtour-logo.jpg',
        ],
        [
            'name' => 'زاگرس',
            'image' => 'images/Zagros-logo.png',
        ],
        [
            'name' => 'تفتان',
            'image' => 'images/taftan-logo.jpg',
        ],
        [
            'name' => 'اترک',
            'image' => 'images/atrak-logo.jpg',
        ],
        [
            'name' => 'وارش',
            'image' => 'images/varesh-logo.png',
        ],
        [
            'name' => 'پویا',
            'image' => 'images/poya-logo.png',
        ],
    ];

    public function run(): void
    {
        foreach($this->airlines as $airline) { 
            Airline::create($airline);
        }
    }
}
