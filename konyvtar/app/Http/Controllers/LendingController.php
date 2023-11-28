<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LendingController extends Controller
{
    public function index()
    {
        return Lending::all();
    }

    public function show($user_id, $copy_id, $start)
    {

        $lending = LendingController::show($user_id, $copy_id, $start);
        return $lending[0];
    }

    public function destroy($user_id, $copy_id, $start)
    {
        LendingController::show($user_id, $copy_id, $start)->delete();
        //Lending::find($id)->delete();
        //még nem llétezik
        //  return redirect('/User/list');
    }

      public function update(Request $request, $user_id, $copy_id, $start)
    {
        $lending = LendingController::show($user_id, $copy_id, $start);
        //CSAK PATCH!
        $lending->end = $request->end;
        $lending->extension = $request->extension;
        $lending->notice = $request->notice;
        $lending->save();
        //  return redirect('/User/list');
    }

    public function store(Request $request)
    {
        $lending = new Lending();
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
        $lending->save();
        // return redirect('/User/list');
    }

    public function lendingUser()
    {
        //bejelentkezett felhasználó:
        $user = Auth::user();
        $lendings = Lending::with('user')->where('user_id', '=', $user->id)->get();
        return $lendings;
    }

    public function booksatuser()
    {
        $user = Auth::user();
        $books = DB::table('lendings as l')
        ->join('copies as c', 'l.copy_id', '=' , 'c.copy_id')
        ->join('books as b', 'c.book_id', '=', 'b.book_id')
        ->select('b.title', 'b.author')
        ->where('l.user_id', '=', $user->id)
        ->whereNull('l.end')
        ->get();
        return $books;
    }

    public function lengthen($copy_id, $start){
        $user = Auth::user();
        DB::table('lendings')
        ->where('copy_id', $copy_id)
        ->where('start', $start)
        ->where('user_id', $user->id)
        ->update(['extension' => 1]);
    }
}
