<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceModel extends Model
{
    use HasFactory;
    protected $table = "member_account";
    // public $timestamps = false;

    protected $fillable =[
        'personal_detail_id_fk',
        'balance',
        'name_member'
    ];

}
