<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jual extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_jual';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "tampil_penjualan";
    protected $guarded = [];
}
