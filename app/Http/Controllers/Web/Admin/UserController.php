<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->string('q')->toString();
        $role = $request->string('role')->toString();

        $users = User::query()
            ->when($q, fn($qry) =>
                $qry->where(function($w) use ($q){
                    $w->where('name','like',"%$q%")
                      ->orWhere('email','like',"%$q%");
                })
            )
            ->when($role === 'admin', fn($qry) => $qry->where('is_admin', true))
            ->when($role === 'user', fn($qry) => $qry->where('is_admin', false))
            ->orderByDesc('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users','q','role'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:6',
            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_admin'  => 'nullable|boolean',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['is_admin'] = $request->boolean('is_admin');

        User::create($data);
        return redirect()->route('admin.users.index')->with('success','User created.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,'.$user->id,
            'password'  => 'nullable|string|min:6',
            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'is_admin'  => 'nullable|boolean',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $data['is_admin'] = $request->boolean('is_admin');

        $user->update($data);
        return redirect()->route('admin.users.index')->with('success','User updated.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error','You cannot delete yourself.');
        }
        $user->delete();
        return back()->with('success','User deleted.');
    }
}
