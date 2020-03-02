<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
  protected $fillable = [
    'image', 'name', 'description', 'price', 'category_id'
];
  public function categories()  {
    return $this->belongsTo('App/Categories', 'categories');
  }
}
