<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable =[
        'name',
        'icons'
    ];

    //relation to event
    public function event()
    {
      return $this->hasMany(Event::class);
    }
    //scope query to sort by the number of event
    public function scopeSortByMostEvents($query)
    {
      return $query->with('events')->orderBy('events_count' , 'desc');
    }
}
