<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisOrder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'jenis_orders';

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
    protected $fillable = ['nama_order','jenis'];

    public function getFullJenisAttribute()
    {
        return $this->nama_order . ' ' . $this->jenis;
    }

    public function orders()
    {
        return $this->hasMany('App\Order','jenis_order_id');
    }
    
}
