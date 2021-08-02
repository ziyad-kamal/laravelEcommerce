<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Nicolaslopezj\Searchable\SearchableTrait;

class Items extends Model
{
    use SearchableTrait;
    use Sluggable;

    protected $searchable=[
        'columns'=>[
            'items.name'    => 10,
            'items.price'   => 10,
            'category.name' => 9,
            'brands.name'   => 9
        ],
        'joins' => [
            'category' => ['category.id','items.category_id'],
            'brands'   => ['brands.id'  ,'items.brand_id'],
        ],
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $table='items';
    protected $fillable=[
                        'name','description' ,'condition','price'
                        ,'date','users_id','photo','approve'
                        ,'category_id','rate','brand_id','slug'
                    ];

    public $timestamps=false;

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id');
    }

    public function users(){
        return $this->belongsTo('App\User','users_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comments','item_id');
    }

    public function orders(){
        return $this->hasMany('App\Models\Orders','item_id');
    }

    public function review(){
        return $this->hasMany('App\Models\Review','item_id');
    }

    public function brands(){
        return $this->belongsTo('App\Models\Brands','brand_id');
    }

}
