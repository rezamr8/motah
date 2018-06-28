<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stok_keluars';

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
    protected $fillable = ['barang_id', 'jumlah'];

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }
    
}
