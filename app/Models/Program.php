<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_program',
        'penanggung_jawab',
        'target',
        'jadwal',
        'sumber_anggaran',
        'besaran_anggaran',
        'tahun',
        'jenis',
        'deskripsi',
        'status',
        'published_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'besaran_anggaran' => 'decimal:2',
            'tahun' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeByJenis($query, $jenis)
    {
        return $query->where('jenis', $jenis);
    }

    public function scopeByTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    public function getFormattedAnggaranAttribute(): ?string
    {
        if (!$this->besaran_anggaran) return null;
        return 'Rp ' . number_format($this->besaran_anggaran, 0, ',', '.');
    }
}
