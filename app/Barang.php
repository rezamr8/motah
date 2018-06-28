<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'barangs';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nama_barang', 'jumlah', 'satuan', 'harga'];

    public function stokkeluars()
    {
        return $this->hasMany('App\StokKeluar');
    }

    public function stokmasuks()
    {
        return $this->hasMany('App\StokMasuk');
    }
    
}
