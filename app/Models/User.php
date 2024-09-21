<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
    ];

    /**
     * Get the Kaprodi associated with the user.
     */
    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class);
    }

    /**
     * Get the Dosen associated with the user.
     */
    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    /**
     * Get the Mahasiswa associated with the user.
     */
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }
}
