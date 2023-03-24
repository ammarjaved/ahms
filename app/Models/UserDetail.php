<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    public $table = 'personal_detail';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'permanent_address', 'current_address',  'gender',  'age' ,'phone_no', 'emergency_no', 'relegion', 'nationality', 'email',
         'passport_no' ,'visa', 'created_by', 'passport_expiry' ,'visa_expiry','user_image', 'date_of_birth', 'rent_per_month','hire_date','license_plate','last_name'
    ];
}
