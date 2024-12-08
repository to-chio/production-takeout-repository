<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    // use HasFactory;
    
    public function posts() {

        return $this -> hasMany('App\Models\Post');
    }


    protected $fillable = [
        'shop_name'
    ];

    public $timestamps = false;

    /**
     * shopの登録
     * 
     * @param $shop_name
     * @return int
     */
    public static function storeShop($shop_name) {

        $shop = self::create(['shop_name' => $shop_name]);

        return $shop -> id;
    }

    /**
     * shop名の上書き
     * 
     * @param string $shop_name
     */
    public function updateShopName($shop_name) {

        $this -> shop_name = $shop_name;
        $this -> save();
    }
}
