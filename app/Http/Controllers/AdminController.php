<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function dashboard()
    {
        $cid = auth()->user()->company_id;

        return view('admin.dashboard', [
            'company'      => auth()->user()->company,
            'adminsCount'  => User::where('company_id', $cid)->where('role', 'Admin')->count(),
            'membersCount' => User::where('company_id', $cid)->where('role', 'Member')->count(),
            'urlsCount'    => ShortUrl::where('company_id', $cid)->count(),
            'hitsCount'    => (int) ShortUrl::where('company_id', $cid)->sum('hits'),
        ]);
    }

    public function company()
    {
        $company = auth()->user()->company()->with('users')->firstOrFail();
        return view('admin.company', compact('company'));
    }

    // ---------- Invite ----------
    public function invite()
    {
        return view('admin.invite');
    }

    public function storeInvite(Request $request)
    {
        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role'  => ['required', Rule::in(['Admin', 'Member'])],
        ]);

        $password = Str::random(8);

        $user = User::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'password'   => Hash::make($password),
            'role'       => $data['role'],
            'company_id' => auth()->user()->company_id,
        ]);

        return back()
            ->with('success', "Invited {$user->name}. Temp password: {$password}")
            ->with('wa_link', $this->waLink($user, $password));
    }

    // ---------- URLs ----------
    public function urls()
    {
        return view('admin.urls', [
            'urls' => ShortUrl::with(['user', 'company'])
                ->where('company_id', auth()->user()->company_id)
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

    private function waLink(User $user, string $password): string
    {
        $text = "Hi {$user->name}, you have been invited as {$user->role}.\n"
            . "Login URL: " . url('/login') . "\n"
            . "Email: {$user->email}\n"
            . "Password: {$password}";

        return 'https://wa.me/?text=' . urlencode($text);
    }
}
