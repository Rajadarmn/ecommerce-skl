<?php

namespace Database\Seeders;
use Faker\Factory;
use App\Models\category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use PHPUnit\Event\Telemetry\Duration;

use function Ramsey\Uuid\v1;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(int $eventCount = 20, int $ticketCount=5): void
    {
        //if category empty run categoryseeder

        if(Category::count()== 0){
            $this->call(CategorySeeder::class);
        }

        //insert data using faker php
        $faker= Factory::create();
        //membuat event berdasarkan eventcount
        for($i=0; $i <$eventCount; $i++){
        //create event
        $event = Event::create([
        'name'=>$faker->sentence(2),
        'slug'=>$faker->slug(2), 
        'headline'=>$faker->sentence(7),
        'description'=>$faker->paragraph(1),
        'star_time'=>$faker->dateTimeBetween('+immoth','+6month'),
        'location'=>$faker->address,
        'duration'=>$faker->numberBetween(1,10),
        'category_id'=>Category::inRandomOrder()->first()->id,
        'type'=>$faker->randomElement(['online','offline']),
        'is_populer' =>$faker->boolean(20),

        
           ]);
        //membuat tiket berasarkan tiketcount
        for($j = 0; $j <$ticketCount; $j++){
            $event->ticket()->create([
            'name'=>$faker->sentence(2),
            'price'=>$faker->numberBetween(10,100),
            'quality'=>$faker->numberBetween(10,100),
            'max_buy'=>$faker->numberBetween(1,10),
            ]);
        }

        }
    }
}
