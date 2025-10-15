<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'author_id',
        'isbn',
        'publisher',
        'publication_year',
        'pages',
        'description',
        'price',
        'stock',
        'is_available',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'pages' => 'integer',
        'price' => 'decimal:2',
        'stock' => 'integer',
        'is_available' => 'boolean',
    ];

    /**
     * Relasi: Book dimiliki oleh satu Author
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Relasi: Book memiliki banyak Genres (Many-to-Many)
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre')
                    ->withTimestamps();
    }

    /**
     * Scope: Filter buku yang tersedia
     */
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->where('stock', '>', 0);
    }

    /**
     * Accessor: Format harga dengan Rupiah
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}