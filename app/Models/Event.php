<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory , SoftDeletes;
    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }
    protected $fillable = [
        'name',
        'slug',
        'headline',
        'description',
        'star-time',
        'location',
        'duration',
        'is_populer',
        'photos',
        'category_id',
        'type'
    ];

    protected $casts = [
        'star_time' => 'datetime',
        'photos' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

   public function getStartFromAttribute()
   {
       return $this->tickets()->orderBy('price')->first()->price;
   }

   public function getThumbnailAttribute()
   {
       $photos = $this->photos;

       if ($photos && !empty($photos)) {
           return Storage::url($photos[0]);
       }

       return asset('assets/images/event-1.webp');
   }

   public function scopeWithCategory($query, $category)
   {
       return $query->where('category_id', $category);
   }

   public function scopeUpcoming($query)
   {
       return $query->orderBy('star_time', 'asc')->where('star_time', '>=', now());
   }

   public function scopeFetch($query, $slug)
   {
       return $query->with(['category', 'tickets'])
           ->withCount('tickets')
           ->where('slug', $slug)
           ->firstOrFail();
   } 

}
