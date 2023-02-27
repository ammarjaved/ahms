<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class work_info extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = "work_info";

    protected $fillable = [
        'company' , 'work_address' ,'work_contact', 'person_incharge' ,'pd_id'
    ];
}
