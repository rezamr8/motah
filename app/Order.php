<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'orders';

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
    protected $fillable = ['jenis_order_id', 'jumlah', 'tgl_beres', 'user_id','no_order','modal','sisa','status'];

    public function barang()
    {
        return $this->hasMany('App\Barang');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jenisorder()
    {
        return $this->belongsTo('App\JenisOrder','jenis_order_id');
    }

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi');
    }

    public function stokmasuk()
    {
        return $this->hasMany('App\StokMasuk');
    }
    
}
