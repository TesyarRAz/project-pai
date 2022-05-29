<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    
    protected $table = "lap_jurnal";
    protected $guarded = [];

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'no_akun');
    }
}
