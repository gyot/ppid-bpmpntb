<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanHistory;
use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function index(Request $request)
    {
        $query = PermohonanInformasi::with('processedBy')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $permohonan = $query->paginate(15)->withQueryString();

        return view('admin.permohonan.index', compact('permohonan'));
    }

    public function show(PermohonanInformasi $permohonan)
    {
        $permohonan->load(['processedBy', 'histories.officer']);
        return view('admin.permohonan.show', compact('permohonan'));
    }

    public function verify(PermohonanInformasi $permohonan)
    {
        try {
            if ($permohonan->status !== 'submitted') {
                return back()->with('error', 'Permohonan hanya bisa diverifikasi dari status diajukan.');
            }

            $permohonan->update([
                'status' => 'verified',
                'verified_at' => now(),
                'processed_by' => auth()->id(),
            ]);

            PermohonanHistory::create([
                'permohonan_id' => $permohonan->id,
                'status' => 'verified',
                'notes' => 'Permohonan telah diverifikasi oleh petugas.',
                'officer_id' => auth()->id(),
            ]);

            return back()->with('success', 'Permohonan berhasil diverifikasi.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memverifikasi permohonan: ' . $e->getMessage());
        }
    }

    public function process(PermohonanInformasi $permohonan)
    {
        try {
            if (!in_array($permohonan->status, ['submitted', 'verified'])) {
                return back()->with('error', 'Permohonan hanya bisa diproses dari status diajukan atau terverifikasi.');
            }

            $permohonan->update([
                'status' => 'processing',
                'processed_at' => now(),
                'processed_by' => auth()->id(),
            ]);

            PermohonanHistory::create([
                'permohonan_id' => $permohonan->id,
                'status' => 'processing',
                'notes' => 'Permohonan sedang dalam proses.',
                'officer_id' => auth()->id(),
            ]);

            return back()->with('success', 'Permohonan sedang diproses.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses permohonan: ' . $e->getMessage());
        }
    }

    public function complete(Request $request, PermohonanInformasi $permohonan)
    {
        try {
            if ($permohonan->status !== 'processing') {
                return back()->with('error', 'Permohonan hanya bisa diselesaikan dari status sedang diproses.');
            }

            $data = [
                'status' => 'completed',
                'completed_at' => now(),
                'processed_by' => auth()->id(),
            ];

            $historyNotes = 'Permohonan telah selesai diproses.';

            if ($request->hasFile('jawaban_file')) {
                $request->validate([
                    'jawaban_file' => 'nullable|file|max:10240|mimes:pdf,doc,docx',
                ]);

                $file = $request->file('jawaban_file');
                $fileName = 'jawaban_' . $permohonan->registration_number . '_' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads/permohonan/jawaban', $fileName, 'public');
                $data['notes'] = ($permohonan->notes ? $permohonan->notes . "\n" : '') . 'File jawaban: ' . $file->getClientOriginalName();
                $historyNotes .= ' File jawaban telah diunggah.';
            }

            if ($request->filled('notes')) {
                $data['notes'] = ($data['notes'] ?? ($permohonan->notes ?? '')) . "\n" . $request->notes;
            }

            $permohonan->update($data);

            PermohonanHistory::create([
                'permohonan_id' => $permohonan->id,
                'status' => 'completed',
                'notes' => $historyNotes,
                'officer_id' => auth()->id(),
            ]);

            return back()->with('success', 'Permohonan berhasil diselesaikan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyelesaikan permohonan: ' . $e->getMessage());
        }
    }

    public function reject(Request $request, PermohonanInformasi $permohonan)
    {
        $request->validate([
            'notes' => 'required|string|max:1000',
        ]);

        try {
            if (in_array($permohonan->status, ['completed', 'rejected'])) {
                return back()->with('error', 'Permohonan tidak bisa ditolak dari status saat ini.');
            }

            $permohonan->update([
                'status' => 'rejected',
                'rejected_at' => now(),
                'processed_by' => auth()->id(),
                'notes' => ($permohonan->notes ? $permohonan->notes . "\n" : '') . 'DITOLAK: ' . $request->notes,
            ]);

            PermohonanHistory::create([
                'permohonan_id' => $permohonan->id,
                'status' => 'rejected',
                'notes' => 'Permohonan ditolak. Alasan: ' . $request->notes,
                'officer_id' => auth()->id(),
            ]);

            return back()->with('success', 'Permohonan berhasil ditolak.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menolak permohonan: ' . $e->getMessage());
        }
    }
}
