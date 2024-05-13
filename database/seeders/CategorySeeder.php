<?php

namespace Database\Seeders;

use App\Models\category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories =[

        [
            'name'=>'Movies',
              'icons'=> null
        ],
        [
            'name'=>'Game',
              'icons'=> null
        ],
        [
            'name'=>'Sport',
              'icons'=> null
        ],
        [
            'name'=>'Learning',
              'icons'=> null
        ]
            ];
// insert data to table categories
            foreach($categories as $category){
                category::create([
                'name'=>$category['name'],
                'icons'=>$category['icons'],
            ]);
        }
    }
}
