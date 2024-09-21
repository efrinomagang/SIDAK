<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;
    protected $table ='dosen';

    protected $fillable = [
        'user_id',
        'kelas_id',
        'kode_dosen',
        'nip',
        'name',
    ];

    /**
     * Get the user associated with the Dosen.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the class associated with the Dosen (if they are wali kelas).
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Dosen can manage many students if they are wali kelas.
     */
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'kelas_id', 'kelas_id');
    }
}
