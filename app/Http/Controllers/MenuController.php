<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function isComplete(){

    }

    public function list(){
        $menus = Menu::all();
        return view(
            'menus.list',
            compact('menus')
        );
    }

    public function showCreateView(){
        return view(
            'menus.create'
        );
    }

    public function show($id){
        
    }
    


}
