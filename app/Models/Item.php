<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'title', 'category_id', 'excerpt', 'content'];

    //protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
