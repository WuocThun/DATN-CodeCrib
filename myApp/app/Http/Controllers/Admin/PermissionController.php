<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{

    public function add_permisission(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|unique:permissions',
        ], [
            'name.unique' => 'Tên quyền đã có',
            'name.required' => 'Vui lòng nhập quyền vào',
        ]);

        // Không cần gọi lại $request->all(), dùng dữ liệu đã validate
        $permission = new Permission();
        $permission->name = $data['name']; // Dùng $data['name'] đã được validate
        $permission->save();

        return redirect()->back()->with('status','Thêm quyền thành công');
}

    public function permission($id)
    {
        $user                    = User::find($id);
        $permission              = Permission::all();
        $name_roles              = $user->roles->first()->name;
        $get_permission_via_role = $user->getPermissionsViaRoles();

        return view('admin.content.permissions.assgin_permission',
            compact('user', 'permission', 'name_roles',
                'get_permission_via_role'));
    }

    public function insert_permission(Request $request, $id)
    {
        $data = $request->all();
        $user    = User::find($id);
        $role_id = $user->roles->first()->id;
        $role    = Role::find($role_id);
        $role->syncPermissions($data['permission']);
        $get_permission_via_role = $user->getPermissionsViaRoles();

        return redirect()->back()
                         ->with('status', 'Thêm quyền cho user trò thành công',
                             compact('get_permission_via_role'));
    }

    public function insert_roles(Request $request, $id)
    {

        $data = $request->all();
        $user = User::find($id);
        $user->syncRoles($data['role']);

        return redirect()->back()->with('status', 'Thêm vai trò thành công');
    }

    public function assgin($id)
    {

        $user             = User::find($id);
        $permission       = Permission::all();
        $role             = Role::orderBy('id', 'desc')->get();
        $name_roles       = $user->roles->first();
        $all_collum_roles = $user->roles->first();
        return view('admin.content.permissions.assgin',
            compact('user', 'role', 'all_collum_roles', 'name_roles',
                'permission'));
    }

    public function getAllUser()
    {

        $user = User::with('roles','permissions')->get();

        return view('admin.content.permissions.index', compact('user'));
    }

    public function getAssgin()
    {
        //        dd(Auth::user()->hasRole($role))
        $users = User::all(); // Lấy danh sách người dùng với vai trò của
        $roles = Role::all();

        return view('admin.content.permissions.assign_roles',
            compact('users', 'roles',));
    }

    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->assignRole($request->role);

        return redirect()->back()
                         ->with('success', 'Role assigned successfully!');
    }

    public function revokeRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->removeRole($request->role);

        return redirect()->back()
                         ->with('success', 'Role revoked successfully!');
    }

    public function index()
    {
        $user = User::orderBy('id', 'desc')->get();

        return view('admin.content.permissions.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.content.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data           = $request->all();
        $user           = new User();
        $user->password = Hash::make($data['password']);
        $user->email    = $data['email'];
        $user->name     = $data['name'];
        $user->cardIdNumber     = $data['cardIdNumber'];
        $user->save();

        return redirect()->back()->with('status', 'Thêm user Thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
