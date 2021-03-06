<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Bewertung;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     * 
     */

    public function getAuthPassword()
    {
        return $this->passwort;
    }

    protected $table = 'benutzer';
    public $timestamps = false;
    protected $fillable = [
        'passwort',
        'admin',
        'anzahlfehler',
        'anzahlanmeldungen',
        'letzteanmeldung',
        'letzterfehler',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'passwort',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin(){
        return $this->admin;
    }
    
    public function getName(){
        return $this->email;
    }
    public function getEmail(){
        return $this->email;
    }

    public function bewertungen(){
        return $this->hasMany(Bewertung::class, 'user_id');
    }
}
