<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Models\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        } elseif ('low' == $request->order) {
            $column = 'products';
            $order = 'asc';
        } elseif ('high' == $request->order) {
            $column = 'products';
            $order = 'desc';
        }

        return view('admin.category', [
            'categorys' => Categorie::orderBy($column, $order)->paginate(\App\Models\Setting::getValue('item_per_page')),
        ]);
    }

    public function showForm()
    {
        return view('admin.categoryadd');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'info' => 'required|string|max:400',
        ]);
        Categorie::create([
            'name' => $request->input('name'),
            'description' => $request->input('info'),
        ]);

        return redirect()->route('admin.category.list')->with('success', 'Category is created successfull!');
    }

    public function updateForm(Categorie $id)
    {
        return view('admin.categoryupdate', [
            'category' => $id,
        ]);
    }

    public function update(Request $request, Categorie $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'info' => 'required|string|max:400',
        ]);
        $id->name = $request->input('name');
        $id->description = $request->input('info');
        $id->save();

        return redirect()->route('admin.category.list')->with('success', 'Category is updated successfull!');
    }

    public function delete(Categorie $id)
    {
        $id->delete();

        return redirect()->route('admin.category.list')->with('success', 'Category is deleted successfull!');
    }
}
