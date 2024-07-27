<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);

        // Default query constraint: pending_process = 1
        $query->where('pendingProcess', 1);

        return $query;
    }

    public  function images():HasMany
    {
        return $this->hasMany(Image::class);
    }
    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
