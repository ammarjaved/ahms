<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoApplicant extends Model
{
    use HasFactory;
    protected $table = 'tbl_application';
    public $timestamps = false;
    protected $fillable = [
        'ref_num',
        'cabel_length',
        'type_application',
        'name_of_applicant',
        'company_name',
        'telephone_no',
        'address',
        'parlimen',
        'road_involved',
        'division',
        'created_by',
        'work_type',
    ];
}
