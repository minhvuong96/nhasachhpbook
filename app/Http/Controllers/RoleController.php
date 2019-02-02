<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use DB;

class RoleController extends Controller
{
    //
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function addRole(Request $request)
    {
        if ($request->isMethod('post')) {
            //dd($request->permissions);
            $role = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);
            $role->attachPermission(array($request->permissions));
            return redirect('/admin/view-roles')->with(['flash_message' => 'success', 'message' => 'Thêm chức danh thành công.']);
        }
        $permissions = $this->permission->all();
        return view('admin.pages.add_role', compact('permissions'));
    }

    public function viewRole()
    {
        $roles = $this->role->all();
        return view('admin.pages.view_role', compact('roles'));
    }

    public function editRole(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $this->role->where('id', $id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);
            $roleUpdate = $this->role->find($id);
            DB::table('permission_role')->where('role_id', $id)->delete();
            $roleUpdate->attachPermission(array($request->permissions));
            return redirect()->back()->with(['flash_message' => 'success', 'message' => 'Sửa chức danh thành công.']);
        }
        $role = $this->role->findOrfail($id);
        $permissions = $this->permission->all();
        $permissonsOfRole = DB::table('permission_role')->where('role_id', $id)->get()->pluck('permission_id');
        return view('admin.pages.edit_role', compact('role', 'permissonsOfRole', 'permissions'));
    }

    public function deleteRole($id){
        $role = $this->role->findOrfail($id);
        $role->delete();
        //DB::table('permission_role')->where('role_id', $id)->delete();
        return redirect()->back()->with(['flash_message' => 'success', 'message' => 'Xóa chức danh thành công.']);
    }
}
