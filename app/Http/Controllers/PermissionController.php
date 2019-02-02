<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Validator;

class PermissionController extends Controller
{
    //
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function addPermission(Request $request)
    {
        if ($request->isMethod('post')) {
            $v = Validator::make($request->all(), [
                'name' => 'unique:permissions,name'
            ],
                [
                    'name.unique' => 'Định danh đã tồn tại'
                ]
            );
            if ($v->fails()) {
                return redirect()->back()->withErrors($v->errors());
            }
            $this->permission->create([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);
            return redirect('/admin/view-permissions')->with(['flash_message' => 'success', 'message' => 'Thêm thành công.']);
        }
        return view('admin.pages.add_permission');
    }

    public function viewPermission()
    {
        $permissions = $this->permission->all();
        return view('admin.pages.view_permission', compact('permissions'));
    }

    public function editPermission(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $this->permission->where('id', $id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);
            return redirect()->back()->with(['flash_message' => 'success', 'message' => 'Sửa thành công.']);
        }
        $permission = $this->permission->findOrfail($id);
        return view('admin.pages.edit_permission', compact('permission'));
    }

    public function deletePermission($id){
        $this->permission->findOrfail($id)->delete();
        return redirect()->back()->with(['flash_message' => 'success', 'message' => 'Xóa thành công.']);
    }
}
