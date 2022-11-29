<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::whereNotIn('name', ['admin'])->paginate(5);
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);

        return response()->json([
            'status'=>'success',
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role->update($validated);

        return response()->json([
            'status'=>'success',
        ]);
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return response()->json([
            'status'=>'success',
        ]);
    }

    public function givePermission(Request $request, Role $role)
    {
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission not exists.');
    }


    public function pagination(Request $request)
    {
        $roles = Role::latest()->paginate(5);
        return view('admin.roles.pagination_roles', compact('roles'))->render();
    }
    public function searchrole(Request $request)
    {
        $roles = Role::where('name', 'like', '%'.$request->search_string.'%')
        ->orderBy('id', 'DESC')
        ->paginate(5);
        if($roles->count() >= 1){
            return view('admin.roles.pagination_roles', compact('roles'))->render();
        }else{
            return response()->json(['status'=>'nothing_found']);
        }
    }
}
