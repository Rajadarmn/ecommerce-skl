<?php

namespace App\Models;

use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transaction extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'code',
        'event_id',
        'name',
        'email',
        'status',
        'fee_price',
        'unique_price',
        'total_price',
        'payment_method'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
