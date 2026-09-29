<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalendarProgramMonth extends Model
{
    use HasFactory;

    protected $fillable = [
        'calendar_program_id',
        'bulan',
    ];

    protected function casts(): array
    {
        return [
            'bulan' => 'integer',
        ];
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(CalendarProgram::class, 'calendar_program_id');
    }
}
