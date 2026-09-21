<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        $query = Faq::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $faqs = $query->orderBy('sort_order')->paginate(15)->withQueryString();

        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        try {
            $maxOrder = Faq::max('sort_order') ?? 0;

            Faq::create([
                'question' => $validated['question'],
                'answer' => $validated['answer'],
                'category' => $validated['category'] ?? null,
                'sort_order' => $maxOrder + 1,
                'is_active' => $request->boolean('is_active', true),
            ]);

            return redirect()->route('admin.faq.index')
                ->with('success', 'FAQ berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan FAQ: ' . $e->getMessage());
        }
    }

    public function show(Faq $faq)
    {
        return view('admin.faq.show', compact('faq'));
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        try {
            $faq->update([
                'question' => $validated['question'],
                'answer' => $validated['answer'],
                'category' => $validated['category'] ?? null,
                'is_active' => $request->boolean('is_active', true),
            ]);

            return redirect()->route('admin.faq.index')
                ->with('success', 'FAQ berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui FAQ: ' . $e->getMessage());
        }
    }

    public function destroy(Faq $faq)
    {
        try {
            $faq->delete();

            return redirect()->route('admin.faq.index')
                ->with('success', 'FAQ berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus FAQ: ' . $e->getMessage());
        }
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order' => 'required|array',
            'order.*' => 'integer|exists:faqs,id',
        ]);

        try {
            foreach ($request->order as $index => $faqId) {
                Faq::where('id', $faqId)->update(['sort_order' => $index]);
            }

            return response()->json(['success' => true, 'message' => 'Urutan FAQ berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal memperbarui urutan.'], 500);
        }
    }

    public function toggleActive(Faq $faq)
    {
        try {
            $faq->update(['is_active' => !$faq->is_active]);

            $status = $faq->is_active ? 'diaktifkan' : 'dinonaktifkan';
            return back()->with('success', "FAQ berhasil {$status}.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah status FAQ: ' . $e->getMessage());
        }
    }
}
