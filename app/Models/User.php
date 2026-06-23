<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'weight',
        'height',
        'profile_photo',
        'plan_id',
        'membership_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function getMembershipStatusAttribute()
    {
        if (!$this->membership_expires_at) {
            return ['text' => 'Sin membresía', 'color' => 'secondary', 'icon' => 'bi-clock'];
        }

        $now = now();
        $expires = \Carbon\Carbon::parse($this->membership_expires_at);
        $daysLeft = $now->diffInDays($expires, false);

        if ($daysLeft < 0) {
            return ['text' => 'Vencida', 'color' => 'danger', 'icon' => 'bi-x-circle'];
        } elseif ($daysLeft <= 7) {
            return ['text' => 'Por vencer ('.$daysLeft.' días)', 'color' => 'warning', 'icon' => 'bi-exclamation-triangle'];
        } else {
            return ['text' => 'Activa', 'color' => 'success', 'icon' => 'bi-check-circle'];
        }
    }
}