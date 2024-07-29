<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DelivaryLocation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'delivary_location';
    protected $guarded = [];
}
