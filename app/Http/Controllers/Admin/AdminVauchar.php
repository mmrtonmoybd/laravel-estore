<?php
/***
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
***/
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vauchar;

class AdminVauchar extends Controller
{
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
        } elseif ('qhigh' == $request->order) {
            $column = 'quantity';
            $order = 'desc';
        } elseif ('qlow' == $request->order) {
            $column = 'quantity';
            $order = 'asc';
        }

        return view('admin.vauchars', [
            'vauchars' => Vauchar::orderBy($column, $order)->paginate(\App\Models\Setting::getValue('item_per_page')),
        ]);
    }

    public function add()
    {
        return view('admin.vaucharadd');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'string|required',
            'quantity' => 'numeric|required|min:1',
            'code' => 'string|max:255|required|unique:vauchars,code',
            'value' => 'numeric|required',
            'vtype' => 'string|required',
        ]);

        if ($request->input('type') == 'user') {
            $request->validate([
                'id' => 'required|numeric|exists:users,id',
            ]);
        } else {
            $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        }

        

        $vauchar = new Vauchar();

        $vauchar->title = $request->input('title');
        $vauchar->type = $request->input('type');
        $vauchar->quantity = $request->input('quantity');
        $vauchar->code = $request->input('code');
        $vauchar->used = 0;
        
        if ($request->input('type') == 'user') {
            $vauchar->user_id = $request->input('id');
        } else {
            $vauchar->product_id = $request->input('id');
        }
        $vauchar->vtype = 'money';
       if ($request->input('vtype') == 'percent') {
            $vauchar->vtype = 'percent';
        }

        $vauchar->vaule = $request->input('value');

       // $vauchar->product_id = $request->input('id');

        $vauchar->save();

        return redirect()->route('admin.vauchar.list')->with('success', 'Vauchar adding is successfull!');
    }

    public function show(Request $request, Vauchar $id)
    {
        return view('admin.vaucharedit', [
            'vauchar' => $id,
        ]);
    }
    public function edit(Request $request, Vauchar $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'string|required',
            'quantity' => 'numeric|required|min:1',
            'code' => 'string|max:255|required|unique:vauchars,code',
            'value' => 'numeric|required',
            'vtype' => 'string|required',
        ]);

        if ($request->input('type') == 'user') {
            $request->validate([
                'id' => 'required|numeric|exists:users,id',
            ]);
        } else {
            $request->validate([
            'id' => 'required|numeric|exists:products,id',
        ]);
        }


        $id->title = $request->input('title');
        $id->type = $request->input('type');
        $id->quantity = $request->input('quantity');
        $id->code = $request->input('code');
        $id->used = 0;
        
        if ($request->input('type') == 'user') {
            $id->user_id = $request->input('id');
        } else {
            $id->product_id = $request->input('id');
        }
        $id->vtype = 'money';
       if ($request->input('vtype') == 'percent') {
            $id->vtype = 'percent';
        }

        $id->vaule = $request->input('value');

       // $vauchar->product_id = $request->input('id');

        $id->save();

        return redirect()->route('admin.vauchar.list')->with('success', 'Vauchar update is successfull!');
    }

    public function delete(Vauchar $id)
    {
        $id->delete();
        return redirect()->route('admin.vauchar.list')->with('success', 'Vauchar delete is successfull!');
    }
}
