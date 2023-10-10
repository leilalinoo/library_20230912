<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;

class LendingController extends Controller
{
    public function index(){
        return Lending::all();
    }

    public function show($id){
        return Lending::find($id);
    }

    public function destroy($id){
        Lending::find($id)->delete();
        //még nem llétezik
      //  return redirect('/User/list');
    }

    public function update(Request $request, $id){
        $lending = Lending::find($id);
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
        $lending->save();
      //  return redirect('/User/list');
    }

    public function store(Request $request){
        $lending = new Lending();
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
        $lending->save();
       // return redirect('/User/list');
    }


    
}
