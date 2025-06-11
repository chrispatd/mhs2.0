<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsEmployee extends Model
{
    protected $table = 'ms_employee';
    protected $primaryKey = 'employee_id';
    public    $incrementing = true;
    public    $timestamps   = true;

    protected $fillable = [
        'position_id',
        'name',
        'email',
        'gender',
        'religion_id',
        'status',
        'phone',
        'address',
        'profile_picture',
        'profile_cover',
        'signature_picture',
        'signature_margin_top',
        'signature_margin_left',
        'description',
        'is_active',
    ];
}
