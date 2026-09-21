<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengadaan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_paket',
        'nilai_pagu',
        'tahun',
        'tahap',
        'penyedia',
        'no_kontrak',
        'tanggal_kontrak',
        'deskripsi',
        'file_path',
        'file_name',
        'status',
        'published_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'nilai_pagu' => 'decimal:2',
            'tahun' => 'integer',
            'tanggal_kontrak' => 'date',
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

    public function scopeByTahap($query, $tahap)
    {
        return $query->where('tahap', $tahap);
    }

    public function scopeByTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    public function getFormattedPaguAttribute(): ?string
    {
        if (!$this->nilai_pagu) return null;
        return 'Rp ' . number_format($this->nilai_pagu, 0, ',', '.');
    }

    public function getTahapLabelAttribute(): string
    {
        return match ($this->tahap) {
            'rencana' => 'Rencana',
            'pemilihan' => 'Pemilihan',
            'pelaksanaan' => 'Pelaksanaan',
            default => $this->tahap,
        };
    }
}
