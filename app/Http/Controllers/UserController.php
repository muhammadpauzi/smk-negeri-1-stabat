<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query();
        $searchKeyword = request('search');

        if ($searchKeyword) {
            $users = $users
                ->where('name', 'LIKE',  "%$searchKeyword%")
                ->orWhere('username', 'LIKE',  "%$searchKeyword%")
                ->orWhere('email', 'LIKE',  "%$searchKeyword%")
                ->orWhere('role', 'LIKE',  "%$searchKeyword%");
        }

        return view('users.index', [
            "title" => "Users",
            "users" => $users->latest()->paginate(20)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = ['admin', 'editor'];
        return view('users.create', [
            "title" => "Create New User",
            "roles" => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|alpha_dash|max:256|unique:users',
            'email' => 'required|email|max:256|unique:users',
            'role' => 'required|in:admin,editor',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ];

        if (App::environment() != 'local')
            $roles['password'] = [
                'required',
                'string',
                'min:5',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ];


        $validatedData = $request->validate($rules);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route("users.index")->with('success', 'New user has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->isSuperadmin()) return abort(403, "You can edit user with role Superadmin.");

        $roles = ['admin', 'editor'];
        return view('users.edit', [
            "title" => "Edit User",
            "user" => $user,
            "roles" => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($user->isSuperadmin()) return abort(403, "You can edit user with role Superadmin.");

        $rules = [
            'name' => 'required|max:255',
            'username' => 'required|alpha_dash|max:256',
            'email' => 'required|email|max:256',
            'role' => 'required|in:admin,editor',
        ];

        if ($user->username !== $request->username) $rules['username'] .= '|unique:users';
        if ($user->email !== $request->email) $rules['email'] .= '|unique:users';

        $validatedData = $request->validate($rules);

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // prevent if superadmin delete his own user account
        if ($user->isSuperadmin()) return abort(403, "You can delete user with role Superadmin.");
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User has been deleted.');
    }
}
