<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'photo',
        'is_auction',
        'auction_start_date',
        'auction_end_date',
        'is_negotiable',
        'negotiation_price',
    ];
}
