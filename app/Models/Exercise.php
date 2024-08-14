<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'muscle',
        'info'
    ];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false){
            $query
                ->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('muscle', 'like', '%' . request('search') . '%');

        }
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
