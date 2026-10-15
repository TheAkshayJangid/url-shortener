<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function dashboard()
    {
        $uid = auth()->id();

        return view('member.dashboard', [
            'urlsCount'  => ShortUrl::where('user_id', $uid)->count(),
            'hitsCount'  => (int) ShortUrl::where('user_id', $uid)->sum('hits'),
            'todayCount' => ShortUrl::where('user_id', $uid)->whereDate('created_at', today())->count(),
            'monthCount' => ShortUrl::where('user_id', $uid)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count(),
        ]);
    }

    public function urls()
    {
        return view('member.urls', [
            'urls' => ShortUrl::with(['company'])
                ->where('user_id', auth()->id())
                ->latest()
                ->get(),
        ]);
    }

    public function storeUrl(Request $request)
    {
        $data = $request->validate([
            'long_url' => ['required', 'url', 'max:2048'],
        ]);

        do {
            $code = Str::random(8);
        } while (ShortUrl::where('short_code', $code)->exists());

        ShortUrl::create([
            'user_id'    => auth()->id(),
            'company_id' => auth()->user()->company_id,
            'short_code' => $code,
            'long_url'   => $data['long_url'],
        ]);

        return back()->with('success', 'Short URL created.');
    }
}
