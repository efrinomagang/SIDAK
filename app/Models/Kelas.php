<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'name',
        'jumlah',
    ];

    /**
     * A class has many students.
     */
    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }

public function dosen()
{
    return $this->hasOne(Dosen::class);
}

}
