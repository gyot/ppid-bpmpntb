<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regulasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'nomor',
        'pembuat',
        'kategori',
        'tanggal',
        'deskripsi',
        'status_berlaku',
        'file_path',
        'file_name',
        'link_eksternal',
        'status',
        'published_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    public function getKategoriLabelAttribute(): string
    {
        return match ($this->kategori) {
            'uu' => 'Undang-Undang',
            'pp' => 'Peraturan Pemerintah',
            'perma' => 'Peraturan MA',
            'perki' => 'Peraturan KI',
            'permendikbud' => 'Permendikbud',
            'lainnya' => 'Lainnya',
            default => $this->kategori,
        };
    }
}
