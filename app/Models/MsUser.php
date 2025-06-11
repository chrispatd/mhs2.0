<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MsUser extends Authenticatable
{
    use Notifiable;

    protected $table      = 'ms_user';
    protected $primaryKey = 'user_id';
    public    $incrementing = true;
    public    $timestamps   = true;

    protected $fillable = [
        'role_id',
        'role_access_id',
        'employee_id',
        'teacher_code',
        'code_type',
        'is_homeroomteacher',
        'is_super_user',
        'is_score_spiritual',
        'is_score_sosial',
        'ppdb_access',
        'email',
        'username',           // ← pastikan ini ada
        'password',
        'active_semester_id',
        'active_school_year_id',
        'last_login',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Relasi ke MsEmployee.
     */
    public function employee()
    {
        return $this->belongsTo(MsEmployee::class, 'teacher_code', 'teacher_code');
    }

    public function initials(): string
    {
        // Jika kamu punya kolom 'name' di ms_user, pakai itu; 
        // kalau tidak, gunakan 'username'
        $fullName = $this->name ?? $this->username;

        // Pecah kata, ambil huruf pertama tiap kata, ambil maksimal 2
        $letters = collect(explode(' ', trim($fullName)))
            ->map(fn($part) => strtoupper(substr($part, 0, 1)))
            ->take(2)
            ->implode('');

        return $letters;
    }
    /**
     * Accessor `name` — ambil dari employee.name, fallback ke username.
     */
    public function getNameAttribute(): string
    {
        return $this->employee
            ? $this->employee->name
            : ($this->username ?? '');
    }
}
