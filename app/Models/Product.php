<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
class Product extends Model
{
    use Translatable;
//    use HasUserStamps;
//    use SoftDeletes;
//    use HasFactory;
    public $guarded = [];
    public $translatedAttributes = ['name','description'];
    protected  $appends=['image_path','profit_percent'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getImagePathAttribute()
    {
        return asset('uploads/product_images/' . $this->image);
    }

    public function getProfitPercentAttribute()
    {
        $profit=$this->sale_price-$this->purchase_price;
        $profit_percent=$profit * 100 / $this->purchase_price;
        return number_format($profit_percent,2);
    }
}


