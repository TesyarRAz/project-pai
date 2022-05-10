<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $akun = Akun::All();
        $setting = Setting::All();

        return view('admin.setting.index', [
            'akun' => $akun,
            'setting' => $setting
        ]);
    }

    public function store(Request $request)
    {
        $kode = $request->kode;
        $akun = $request->akun;

        foreach ($akun as $key) {
            $input['no_akun'] = $akun[$key];

            Setting::find($kode[$key])->update($input);
        }

        alert('Setting akun telah ditentukan');

        return to_route('setting.index');
    }
}
