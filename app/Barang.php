<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'barangs';
    protected $dates = ['deleted_at'];

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
