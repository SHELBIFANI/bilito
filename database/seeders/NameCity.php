<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\City;
use Illuminate\Database\Seeder;

class NameCity extends Seeder
{
    protected $cities = [
        ['name' => 'تهران'],
        ['name' => 'شیراز'],
        ['name' => 'اصفهان'],
        ['name' => 'مشهد'],
        ['name' => 'ارومیه'],
        ['name' => 'تبریز'],
        ['name' => 'مراغه'],
        ['name' => 'خوی'],
        ['name' => 'ماکو'],
        ['name' => 'اردبیل'],
        ['name' => 'پارس آباد'],
        ['name' => 'کاشان'],
        ['name' => 'ایلام'],
        ['name' => 'بوشهر'],
        ['name' => 'عسلویه'],
        ['name' => 'شهرکرد'],
        ['name' => 'بیرجند'],
        ['name' => 'سبزوار'],
        ['name' => 'اهواز'],
        ['name' => 'آبادان'],
        ['name' => 'دزفول'],
        ['name' => 'بندر ماهشهر'],
        ['name' => 'زنجان'],
        ['name' => 'کرمان'],
        ['name' => 'سیرجان'],
        ['name' => 'رفسنجان'],
        ['name' => 'شاهرود'],
        ['name' => 'زهدان'],
        ['name' => 'چابهار'],
        ['name' => 'یاسوج'],
        ['name' => 'رشت'],
        ['name' => 'گرگان'],
        ['name' => 'خرم آباد'],
        ['name' => 'سمنان'],
        ['name' => 'زابل'],
        ['name' => 'کرمانشاه'],
        ['name' => 'ساری'],
        ['name' => 'رامسر'],
        ['name' => 'اراک'],
        ['name' => 'هرزمزگان'],
        ['name' => 'بندرعباس'],
        ['name' => 'کیش'],
        ['name' => 'قشم'],
        ['name' => 'همدان'],
        ['name' => 'یزد'],
    ];

    public function run(): void
    {
        foreach($this->cities as $city) {
           $savedCity = City::create($city);
           $savedCity->addMediaFromUrl('https://picsum.photos/200/300')->toMediaCollection('cities');
        }
    }
}
