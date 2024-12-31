<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'address_line_1',
        'address_line_2',
        'city',
        'postal_code',
        'country',
        'phone_number',
    ];
}
