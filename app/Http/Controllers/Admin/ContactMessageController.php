<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $query = ContactMessage::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        if ($request->filled('is_read')) {
            $query->where('is_read', $request->boolean('is_read'));
        }

        $messages = $query->paginate(15)->withQueryString();

        return view('admin.pesan.index', compact('messages'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.pesan.show', compact('message'));
    }

    public function destroy($id)
    {
        try {
            $message = ContactMessage::findOrFail($id);
            $message->delete();

            return redirect()->route('admin.pesan.index')
                ->with('success', 'Pesan berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus pesan: ' . $e->getMessage());
        }
    }

    public function markAsRead($id)
    {
        try {
            $message = ContactMessage::findOrFail($id);
            $message->update(['is_read' => true]);

            return back()->with('success', 'Pesan ditandai sudah dibaca.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui status pesan: ' . $e->getMessage());
        }
    }
}
