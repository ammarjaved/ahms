<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OwnerInfo extends Model
{
    use HasFactory;
    protected $table = 'tbl_owner_info';
    public $timestamps = false;

    protected $fillable =[ 
        'phone',
        'fax',
        'company_name',
        'address',
        'email'
    ];
}
