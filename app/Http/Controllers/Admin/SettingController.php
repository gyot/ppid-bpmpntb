<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        try {
            // Handle text settings
            $textFields = [
                'institution_name', 'institution_short_name', 'institution_description',
                'contact_email', 'contact_phone', 'contact_whatsapp', 'contact_fax', 'contact_address',
                'service_hours', 'website_url',
                'social_facebook', 'social_twitter', 'social_instagram', 'social_youtube', 'social_tiktok', 'social_whatsapp',
                'meta_title', 'meta_description', 'footer_text',
                'ppid_head_name', 'ppid_head_position', 'ppid_head_nip',
            ];

            foreach ($textFields as $field) {
                if ($request->has($field)) {
                    Setting::set($field, $request->input($field));
                }
            }

            // Handle logo upload
            if ($request->hasFile('site_logo')) {
                $request->validate([
                    'site_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
                ]);

                $oldLogo = Setting::get('site_logo');
                if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                    Storage::disk('public')->delete($oldLogo);
                }

                $file = $request->file('site_logo');
                $fileName = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/settings', $fileName, 'public');
                Setting::set('site_logo', $path);
            }

            // Handle favicon upload
            if ($request->hasFile('site_favicon')) {
                $request->validate([
                    'site_favicon' => 'nullable|image|mimes:jpg,jpeg,png,svg,ico|max:512',
                ]);

                $oldFavicon = Setting::get('site_favicon');
                if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                    Storage::disk('public')->delete($oldFavicon);
                }

                $file = $request->file('site_favicon');
                $fileName = 'favicon_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/settings', $fileName, 'public');
                Setting::set('site_favicon', $path);
            }

            // Handle header logo upload
            if ($request->hasFile('header_logo')) {
                $request->validate([
                    'header_logo' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:2048',
                ]);

                $oldLogo = Setting::get('header_logo');
                if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                    Storage::disk('public')->delete($oldLogo);
                }

                $file = $request->file('header_logo');
                $fileName = 'header_logo_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/settings', $fileName, 'public');
                Setting::set('header_logo', $path);
            }

            // Handle institution stamp upload
            if ($request->hasFile('institution_stamp')) {
                $request->validate([
                    'institution_stamp' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:1024',
                ]);

                $oldStamp = Setting::get('institution_stamp');
                if ($oldStamp && Storage::disk('public')->exists($oldStamp)) {
                    Storage::disk('public')->delete($oldStamp);
                }

                $file = $request->file('institution_stamp');
                $fileName = 'stamp_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/settings', $fileName, 'public');
                Setting::set('institution_stamp', $path);
            }

            return redirect()->route('admin.settings.index')
                ->with('success', 'Pengaturan berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui pengaturan: ' . $e->getMessage());
        }
    }
}