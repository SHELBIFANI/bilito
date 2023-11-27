<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel as FilamentPanel;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mobile',
        'password',
        'name',
        'image',
        'national_code',
        'gender',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $visible = [
        'mobile',
        'name',
        'national_code',
        'image_url',
        'gender',
    ];

    protected $appends = [
        'image_url',
    ];

    public function getImageUrlAttribute()
    {
        return url('storage/' . $this->image);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function canAccessPanel(FilamentPanel $panel): bool
    {
        // Add your logic here
        if ($this->email === 'f.n.raiat@gmail.com') {
            return true;
        }
        // Return a boolean value indicating whether the user can access the panel
        return false;
    }
}
