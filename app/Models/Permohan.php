<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohan extends Model
{
    use HasFactory;
    protected $table = 'tbl_applicant_info';
    public $timestamps = false;
    protected $fillable = [
        'cabel_length',
        'type_application',
        'name_of_applicant',
        'company_name',
        'telephone_no',
        'address',
        'parlimen',
        'road_involved',
        'division'
    ];
}
