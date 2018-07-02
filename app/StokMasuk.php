<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokMasuk extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stok_masuks';

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
    protected $fillable = ['user_id', 'barang_id', 'tgl_beli', 'jumlah'];

    
}
