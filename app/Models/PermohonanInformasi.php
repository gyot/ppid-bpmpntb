<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermohonanInformasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'permohonan_informasi';

    protected $fillable = [
        'registration_number',
        'nama',
        'nik',
        'email',
        'phone',
        'alamat',
        'informasi_diminta',
        'tujuan_permohonan',
        'cara_memperoleh',
        'cara_mendapatkan',
        'identity_file_path',
        'identity_file_name',
        'status',
        'notes',
        'processed_by',
        'verified_at',
        'processed_at',
        'completed_at',
        'rejected_at',
    ];

    protected function casts(): array
    {
        return [
            'processed_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->registration_number)) {
                $date = now()->format('Ymd');
                $lastNumber = static::whereDate('created_at', today())
                    ->orderBy('id', 'desc')
                    ->value('registration_number');

                $sequence = 1;
                if ($lastNumber) {
                    $sequence = (int) substr($lastNumber, -4) + 1;
                }

                $model->registration_number = 'PPID-' . $date . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'registration_number';
    }

    public function processedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    public function histories(): HasMany
    {
        return $this->hasMany(PermohonanHistory::class, 'permohonan_id');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function isSubmitted(): bool
    {
        return $this->status === 'submitted';
    }

    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }

    public function isProcessing(): bool
    {
        return $this->status === 'processing';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}
