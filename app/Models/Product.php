<?php

namespace App\Models;

use App\Scopes\ProductScope;
use App\Traits\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Product extends Model
{
    use HasFactory, Sluggable;
    // protected $fillable = ['name', 'slug', 'description', 'img'];

    public function getImgAttribute($value)
    {
        return $value ? $value : '/img/product-img.jpg';
    }
    public function getRecomendedAttribute($value)
    {
        return $value == 1 ? '<i class="fas fa-check"></i>' : '';
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id', 'id'); //? модель с которой надо установить связт, название столбца с внешним ключем, название столбца текущей модели, название столбца связанной модели
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    protected static function booted()
    {
        static::addGlobalScope(new ProductScope);
    }
    public function scopeRecomended($query)
    {
        $query->where('recomended', 1);
    }
    public function scopeLatest($query)
    {
        $query->orderByDesc('created_at');
    }

    public function productRecommended()
    {
        return $this->belongsToMany(Self::class,'product_recommended','product_id','recommended_id');
    }
}
