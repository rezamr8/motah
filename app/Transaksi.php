<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transaksis';

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
    protected $fillable = ['user_id', 'order_id', 'barang_id', 'jumlah','harga'];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

    public function barang()
    {
        return $this->belongsTo('App\Barang');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}
