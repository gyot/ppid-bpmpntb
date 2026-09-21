<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keberatan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keberatan';

    protected $fillable = [
        'registration_number',
        'permohonan_id',
        'nama',
        'email',
        'phone',
        'nik',
        'alamat',
        'alasan_keberatan',
        'informasi_terkait',
        'status',
        'response',
        'responded_by',
        'responded_at',
    ];

    protected function casts(): array
    {
        return [
            'responded_at' => 'datetime',
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

                $model->registration_number = 'KBR-' . $date . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'registration_number';
    }

    public function permohonan(): BelongsTo
    {
        return $this->belongsTo(PermohonanInformasi::class);
    }

    public function respondedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responded_by');
    }
}
