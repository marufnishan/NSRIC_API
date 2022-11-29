<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(5);
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => 'required']);

        Permission::create($validated);
        return response()->json([
            'status'=>'success',
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate(['name' => 'required']);
        $permission->update($validated);

        return response()->json([
            'status'=>'success',
        ]);
    }

    public function pagination(Request $request)
    {
        $permissions = Permission::latest()->paginate(5);
        return view('admin.permissions.pagination_permission', compact('permissions'))->render();
    }

    public function searchpermission(Request $request)
    {
        $permissions = Permission::where('name', 'like', '%'.$request->search_string.'%')
        ->orderBy('id', 'DESC')
        ->paginate(5);
        if($permissions->count() >= 1){
            return view('admin.permissions.pagination_permission', compact('permissions'))->render();
        }else{
            return response()->json(['status'=>'nothing_found']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return response()->json([
            'status'=>'success',
        ]);
    }
}
