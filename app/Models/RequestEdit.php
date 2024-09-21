<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestEdit extends Model
{
    use HasFactory;

    protected $table = 'request';

    protected $fillable = [
        'kelas_id',
        'mahasiswa_id',
        'keterangan',
        'status',   // Include status in fillable
    ];

    protected $attributes = [
        'status' => 'pending', // Set default status to 'pending'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
