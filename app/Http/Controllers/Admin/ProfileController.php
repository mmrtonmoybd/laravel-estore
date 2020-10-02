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
use App\Admin;

class ProfileController extends Controller
{
    public function index(Admin $id) {
    dd($id);
    }
    
    public function showForm(Admin $id) {
    	//show form for update
    	$this->AuthRizeCheck($id);
    	dd($id);
    }
    
    public function update(Request $request, Admin $id) {
    	$this->AuthRizeCheck($id);
    	dd($id);
    }
    
    private function AuthRizeCheck(Admin $admin) {
    	return $this->authorize('adminAuthorize', $admin);
    }
}