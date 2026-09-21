<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keberatan;
use Illuminate\Http\Request;

class KeberatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Keberatan::with('respondedBy')->latest();

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

        $keberatan = $query->paginate(15)->withQueryString();

        return view('admin.keberatan.index', compact('keberatan'));
    }

    public function show(Keberatan $keberatan)
    {
        $keberatan->load(['respondedBy', 'permohonan']);
        return view('admin.keberatan.show', compact('keberatan'));
    }

    public function review(Keberatan $keberatan)
    {
        try {
            if ($keberatan->status !== 'submitted') {
                return back()->with('error', 'Keberatan hanya bisa ditinjau dari status diajukan.');
            }

            $keberatan->update(['status' => 'reviewing']);

            return back()->with('success', 'Keberatan sedang ditinjau.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status keberatan: ' . $e->getMessage());
        }
    }

    public function respond(Request $request, Keberatan $keberatan)
    {
        $request->validate([
            'response' => 'required|string|max:2000',
        ]);

        try {
            if (!in_array($keberatan->status, ['submitted', 'reviewing'])) {
                return back()->with('error', 'Keberatan hanya bisa ditanggapi dari status diajukan atau ditinjau.');
            }

            $keberatan->update([
                'status' => 'responded',
                'response' => $request->response,
                'responded_by' => auth()->id(),
                'responded_at' => now(),
            ]);

            return back()->with('success', 'Tanggapan keberatan berhasil dikirim.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menanggapi keberatan: ' . $e->getMessage());
        }
    }

    public function resolve(Keberatan $keberatan)
    {
        try {
            if (!in_array($keberatan->status, ['submitted', 'reviewing', 'responded'])) {
                return back()->with('error', 'Keberatan tidak bisa diselesaikan dari status saat ini.');
            }

            $keberatan->update(['status' => 'resolved']);

            return back()->with('success', 'Keberatan berhasil diselesaikan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyelesaikan keberatan: ' . $e->getMessage());
        }
    }
}
