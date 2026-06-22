<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Models\setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = setting::all()->pluck('value', 'key');

        return view('dashboard.admin.setting', compact('settings'));
    }
    public function update(Request $request)
    {
        $data = $request->all();
        // dd( $request->all());

        // ======================
        // General Settings
        // ======================
        $this->set('site_name', $data['site_name'] ?? null);
        $this->set('site_email', $data['site_email'] ?? null);
        $this->set('site_phone', $data['site_phone'] ?? null);
        $this->set('address', $data['address'] ?? null);
        $this->set('maintenance_mode', $request->has('maintenance_mode') ? 1 : 0);


        // Social Media

        $this->set('facebook', $data['facebook'] ?? null);
        $this->set('instagram', $data['instagram'] ?? null);
        $this->set('whatsapp', $data['whatsapp'] ?? null);



        // Logo Upload

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            $this->set('logo', $path);
        }

        return back()->with('success', 'Settings updated successfully');
    }
    private function set($key, $value)
    {
        Setting::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
