<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        return view('superadmin.dashboard', [
            'companiesCount' => Company::count(),
            'adminsCount'    => User::where('role', 'Admin')->count(),
            'membersCount'   => User::where('role', 'Member')->count(),
            'urlsCount'      => ShortUrl::count(),
            'hitsCount'      => (int) ShortUrl::sum('hits'),
        ]);
    }

    // ---------- Companies ----------
    public function companies()
    {
        return view('superadmin.companies', [
            'companies' => Company::withCount('users')->latest()->get(),
        ]);
    }

    public function storeCompany(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:companies,name'],
        ]);

        Company::create($request->only('name'));

        return back()->with('success', 'Company created successfully.');
    }

    // ---------- Invite ----------
    public function invite()
    {
        return view('superadmin.invite', [
            'companies' => Company::orderBy('name')->get(),
        ]);
    }

    public function storeInvite(Request $request)
    {
        $data = $request->validate([
            'name'       => ['required', 'string', 'max:255'],
            'email'      => ['required', 'email', 'unique:users,email'],
            'role'       => ['required', Rule::in(['Admin', 'Member'])],
            'company_id' => ['required', 'exists:companies,id'],
        ]);

        $password = Str::random(8);

        $user = User::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'password'   => Hash::make($password),
            'role'       => $data['role'],
            'company_id' => $data['company_id'],
        ]);

        return back()
            ->with('success', "Invited {$user->name}. Temp password: {$password}")
            ->with('wa_link', $this->waLink($user, $password));
    }

    // ---------- URLs ----------
    public function urls()
    {
        return view('superadmin.urls', [
            'urls' => ShortUrl::with(['user', 'company'])->latest()->get(),
        ]);
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
