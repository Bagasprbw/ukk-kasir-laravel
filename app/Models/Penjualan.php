<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function detailPenjualan(){
        return $this->hasMany(detailPenjualan::class, 'kode_penjualan');
    }
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public static function boot(){
        parent::boot();
        self::creating(function($transaksi){
            $latestKdTransaksi = self::latest('kode_transaksi')->firstOrNew([]);
            $currentNumber = (int) substr($latestKdTransaksi->kode_transaksi, 2);
            $transaksi->kode_transaksi = 'TR-' . str_pad(++$currentNumber, 4, '0', STR_PAD_LEFT);
        });
    }
}
