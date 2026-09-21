<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaftarInformasiPublik extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'daftar_informasi_publik';

    protected $fillable = [
        'title',
        'slug',
        'category',
        'jenis_informasi',
        'uraian_informasi',
        'sumber_informasi',
        'media_informasi',
        'jkd',
        'file_path',
        'file_name',
        'status',
        'created_by',
    ];

    protected function casts(): array
    {
        return [];
    }

    public function getRouteKeyName(): string
    {
        return 'id';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getCategoryLabelAttribute(): string
    {
        return match ($this->category) {
            'berkala' => 'Berkala',
            'setiap_saat' => 'Setiap Saat',
            'serta_merta' => 'Serta Merta',
            'dikecualikan' => 'Dikecualikan',
            default => $this->category,
        };
    }
}
