@extends('layouts.role')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <a href="{{route('admin.users.index')}}"><button class="my-3 btn btn-success">Users Index</button></a>
        </div>
        <div class="my-3 col-md-10 ">
            <div class="p-3" style="background-color: #EBEDEF;border: 1px solid #EBEDEF; border-radius: 5px;">
                <div> <b>User Name:</b> {{ $user->name }}</div>
                <div> <b>User Email:</b> {{ $user->email }}</div>
            </div>
        </div>

        <div class="my-3 col-md-10 ">
            <div class="p-3" style="background-color: #EBEDEF;border: 1px solid #EBEDEF; border-radius: 5px;">
                <h2>Roles</h2>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    @if ($user->roles)
                        @foreach ($user->roles as $user_role)
                            <form method="POST"
                            action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                                <button class="btn btn-danger" type="submit">{{ $user_role->name }}</button>
                            </form>
                        @endforeach
                    @endif
                </div>
                <div class="mt-4 p-2">
                    <form  method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="role" >Roles</label>
                            <select class="form-control selectpicker" multiple data-live-search="true" id="role" name="role[][name]" autocomplete="role-name" >
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                        <button type="submit"
                                class="my-3 btn btn-info">Assign</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="my-3 col-md-10 ">
            <div class="p-3" style="background-color: #EBEDEF;border: 1px solid #EBEDEF; border-radius: 5px;">
                <h2>Permissions</h2>
                <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                    @if ($user->permissions)
                    @foreach ($user->permissions as $user_permission)
                            <form method="POST"
                            action="{{ route('admin.users.permissions.revoke', [$user->id, $user_permission->id]) }}"
                            onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                                <button class="btn btn-danger d-inline" type="submit">{{ $user_permission->name }}</button>
                            </form>
                        @endforeach
                    @endif
                </div>
                <div class="mt-4 p-2">
                    <form method="POST" action="{{ route('admin.users.permissions', $user->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="role" >Permissions</label>
                            <select class="form-control selectpicker" multiple data-live-search="true" id="permission" name="permission[][name]" autocomplete="permission-name" >
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('role')
                            <span class="text-red-400 text-sm">{{ $message }}</span>
                        @enderror
                            <button type="submit"
                                class="my-3 btn btn-info">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
