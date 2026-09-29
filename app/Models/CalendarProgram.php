<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CalendarProgram extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tahun',
        'penanggung_jawab',
        'uraian_kegiatan',
        'deskripsi',
        'anggaran',
        'urutan',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $appends = [
        'bulan_array',
        'pj_color',
        'formatted_anggaran',
    ];

    protected function casts(): array
    {
        return [
            'tahun' => 'integer',
            'anggaran' => 'decimal:2',
            'urutan' => 'integer',
        ];
    }

    public function months(): HasMany
    {
        return $this->hasMany(CalendarProgramMonth::class, 'calendar_program_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getBulanArrayAttribute(): array
    {
        return $this->months->pluck('bulan')->toArray();
    }

    public function getPjColorAttribute(): string
    {
        $colors = [
            'PAUD' => '#F3B81A',
            'SD' => '#32A852',
            'SMP' => '#2F80ED',
            'SMA' => '#9B51E0',
            'Manajemen' => '#E76F51',
        ];

        return $colors[$this->penanggung_jawab] ?? '#2563eb';
    }

    public function getFormattedAnggaranAttribute(): string
    {
        return 'Rp ' . number_format($this->anggaran, 0, ',', '.');
    }

    public function scopeByTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    public function scopeByPenanggungJawab($query, $pj)
    {
        return $query->where('penanggung_jawab', $pj);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('penanggung_jawab')->orderBy('uraian_kegiatan');
    }
}
