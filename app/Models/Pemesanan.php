<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'no_pesan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "pemesanan";
    protected $guarded = [];

    public function pembelian()
    {
        return $this->hasOne(Pembelian::class, 'no_pesan');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'no_akun');
    }
}
