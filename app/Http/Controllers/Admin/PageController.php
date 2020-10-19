<?php
/*
Author: Moshiur Rahman Tonmoy
Facebook: https://www.facebook.com/mmrtonmoy
GitHub: https://www.github.com/mmrtonmoybd
About: I am a php, laravel, codeigniter developer.
*/

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.page', [
            'pages' => Page::paginate(config('settings.max_item_per_page')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pageadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|string',
            'info' => 'required|string',
        ]);
        Page::create([
            'title' => $request->input('title'),
            'content' => $request->input('info'),
        ]);

        return redirect()->route('admin.page.list')->with('success', 'Page Create Successfull');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Page $id)
    {
        return view('page', [
            'page' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $id)
    {
        $request->validate([
            'title' => 'required|max:255|string',
            'info' => 'required|string',
        ]);
        $id->title = $request->input('title');
        $id->content = $request->input('info');
        $id->save();

        return redirect()->route('admin.page.list')->with('success', 'Page updated Successfull');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $id)
    {
        $id->delete();

        return redirect()->route('admin.page.list')->with('success', 'Page deleted Successfull');
    }
}
