<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;
    protected $table='outlet';
    protected $primaryKey='id';
    protected $fillable=[
    	'nama','alamat','telp'
    ];
    public function Paket()
    {
        return $this->hasMany(Paket::class);
    }
}
