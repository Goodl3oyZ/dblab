<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions'; // Specify the table name

    protected $fillable = ['userId', 'startDate', 'endDate', 'discountPercentage']; // Fillable attributes

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
