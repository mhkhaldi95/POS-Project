<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pruduct extends Model
{
    use \Dimsav\Translatable\Translatable;

    public $translatedAttributes = ['name','description'];
    protected $fillable=['purchase_price','sale_price','stoke','image'];

    protected $guarded = array();

    public function category(){
        return $this->hasOne('App\Category','id','category_id');
    }
    protected $appends=['image_path','profit_percent'];

    public function getImagePathAttribute(){
        return asset('/uploads/image_product/'.$this->image);
    }
    public function getProfitPercentAttribute(){
        $profit = $this->sale_price-$this->purchase_price;
        $profit = $profit*100/$this->purchase_price;
        return number_format($profit,'2');
    }
}
