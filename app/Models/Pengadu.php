<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadu extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
