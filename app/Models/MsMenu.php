<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class MsMenu extends Model
{
    use HasFactory;

    protected $table = 'ms_menu';

    protected $fillable = [
        'name',
        'route',
        'icon',
        'order',
    ];
}
