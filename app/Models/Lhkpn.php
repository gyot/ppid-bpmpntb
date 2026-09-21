<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lhkpn extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_pejabat',
        'jabatan',
        'nip',
        'periode',
        'file_path',
        'file_name',
        'status',
        'published_at',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'periode' => 'integer',
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
}
