<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AllUserController extends Controller
{
    public function index()
    {
        $users = User::paginate(5);

        return view('admin.users.index', compact('users'));
    }

    public function pagination(Request $request)
    {
        $users = User::latest()->paginate(5);
        return view('admin.users.pagination_users', compact('users'))->render();
    }

    public function searchuser(Request $request)
    {
        $users = User::where('name', 'like', '%'.$request->search_string.'%')
        ->orderBy('id', 'DESC')
        ->paginate(5);
        if($users->count() >= 1){
            return view('admin.users.pagination_users', compact('users'))->render();
        }else{
            return response()->json(['status'=>'nothing_found']);
        }
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }

    public function assignRole(Request $request, User $user)
    {
        foreach ($request->role as $value) {
        if ($user->hasRole($value['name'])) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($value['name']);
    }
        return back()->with('message', 'Role assigned.');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }

    public function givePermission(Request $request, User $user)
    {
        foreach ($request->permission as $value) {
        if ($user->hasPermissionTo($value['name'])) {
            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($value['name']);
    }
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission does not exists.');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('message', 'you are admin.');
        }
        $user->delete();

        return back()->with('message', 'User deleted.');
    }

}
