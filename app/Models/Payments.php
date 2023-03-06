<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    public $table = 'payments';

    protected $fillable = [
        'name',
        'due_payment',
        'total_payed',
        'balance',
        'created_by'
    ];
}
