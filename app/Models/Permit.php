<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    use HasFactory;
    protected   $table      = 'tbl_permit_application';
    public      $timestamps = false;

    protected $fillable     = [
        'job_title_a',
        'advance_deposit_a',
        'streetname_b',
        'distance_b',
        'damage_method_b',
        'damage_rate_per_unit_b',
        'total_cost_b',
        'road_repair_descriptioon_c',
        'repair_perunit_chages_c',
        'total_road_repair_cost_c',
        'applicant_id',
        'contractor_id',
        'owner_id'
    ];
}
