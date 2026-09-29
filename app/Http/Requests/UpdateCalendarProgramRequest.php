<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalendarProgramRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tahun' => 'required|integer|min:2000|max:2100',
            'penanggung_jawab' => 'required|string|max:100',
            'uraian_kegiatan' => 'required|string',
            'deskripsi' => 'nullable|string',
            'anggaran' => 'nullable|numeric|min:0',
            'bulan' => 'required|array|min:1',
            'bulan.*' => 'integer|min:1|max:12',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'required|in:aktif,nonaktif',
        ];
    }
}
