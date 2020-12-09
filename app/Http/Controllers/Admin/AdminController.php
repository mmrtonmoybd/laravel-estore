<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\AdminInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'order' => 'string|regex:/[A-Za-z0-9 ]$/i',
        ]);
        $column = 'id';
        $order = 'desc';
        if ('older' == $request->order) {
            $column = 'id';
            $order = 'asc';
        }

        return view('admin.admins', [
            'admins' => Admin::orderBy($column, $order)->paginate(\App\Models\Setting::getValue('item_per_page')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.asminadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|max:255',
            'address' => 'required|string',
            'mobile' => 'required|numeric',
            'password' => 'required|confirmed|min:7|string',
            'status' => 'required|numeric|max:1',
        ]);

        $admin = Admin::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'isAdmin' => $request->input('status'),
        ]);

        AdminInfo::create([
            'address' => $request->input('address'),
            'mobile' => $request->input('mobile'),
            'admin_id' => $admin->id,
            'ip' => '127.0.0.1',
        ]);

        return redirect()->route('admin.admin.list')->with('success', 'Admin is created!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $id)
    {
        if (Auth::guard('admin')->user()->id !== $id->id) {
            return view('admin.adminupdate', [
                'admin' => $id,
            ]);
        }

        return redirect()->route('admin.admin.list')->with('success', 'Current user can not be updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $id)
    {
        if (Auth::guard('admin')->user()->id !== $id->id) {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|max:255',
                'address' => 'required|string',
                'mobile' => 'required|numeric',
                'facebook' => 'required|url',
                'password' => 'confirmed',
                'status' => 'required|numeric|max:1',
            ]);

            $id->name = $request->input('name');
            $id->email = $request->input('email');
            $id->isAdmin = $request->input('status');
            if (!empty($request->input('password'))) {
                $id->password = Hash::make($request->input('password'));
            }
            $id->save();
            $info = AdminInfo::find($id->id);
            $info->mobile = $request->input('mobile');
            $info->address = $request->input('address');
            $info->facebook = $request->input('facebook');
            $info->save();

            return redirect()->route('admin.admin.list')->with('success', 'Admin is updated!');
        }

        return redirect()->route('admin.admin.list')->with('success', 'Current user can not be updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $id)
    {
        if (Auth::guard('admin')->user()->id !== $id->id) {
            $id->delete();

            return redirect()->route('admin.admin.list')->with('success', 'Admin is deleted');
        }

        return redirect()->route('admin.admin.list')->with('success', 'Current admin can not be deleted');
    }
}
