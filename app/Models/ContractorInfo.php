<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorInfo extends Model
{
    use HasFactory;
    protected $table = 'tbl_contractor_info';
    public $timestamps = false;

    protected $fillable =[ 
        'name',
        'phone',
        'fax',
        'company_name',
        'postcode',
        'state',
        'address',
        'email'
    ];
}
