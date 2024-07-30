<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory , SoftDeletes;
    protected $guarded = [];
    public function newQuery($excludeDeleted = true)
    {
        $query = parent::newQuery($excludeDeleted);
            if (Auth::user()) {
            
            $role = Auth::user()->getRoleNames() ?? null;
        }

        switch (@$role[0]) {
            case 'vendor':
                $query->where('vendor_id', Auth::id());
                break;

            case 'SuperAdmin':

                break;
            case 'admin':
                break;

            case 'visitor':
                $query->where('pendingProcess', 1);
                break;

            default:
                // Default query constraint for other roles
                $query->where('pendingProcess', 1);
                break;
        }
      
        return $query;
    }

    public  function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
