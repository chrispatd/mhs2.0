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
        'parent_id'
    ];

    public function submenus()
    {
        return $this->hasMany(MsMenu::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(MsMenu::class, 'parent_id');
    }
}
