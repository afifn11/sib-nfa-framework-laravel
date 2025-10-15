<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relasi: Genre dimiliki oleh banyak Books (Many-to-Many)
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_genre')
                    ->withTimestamps();
    }

    /**
     * Scope: Cari genre berdasarkan nama
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('description', 'like', "%{$search}%");
    }
}