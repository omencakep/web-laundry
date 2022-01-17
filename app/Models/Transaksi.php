<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table='transaksi';
    protected $primaryKey='id';
    protected $fillable=[
    	'id_outlet','id_member','tgl', 'batas_waktu','tgl_bayar','status','dibayar'
    ];
}
