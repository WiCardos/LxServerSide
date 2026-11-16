<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function allUsers() {

        $usersWDB = $this->loadUsersWDB();
        // dd($usersWDB);

        // $usersFromDB = DB::table('users')
        $usersFromDB = User::select('id', 'name','address','email', 'nif')
        // ->select()
        // ->where('id',3)
        // ->first(); //Para trazer só um get.
        ->get(); //Traz um array de dados, mesmo que seja só 1 registo.

        // dd($usersFromDB);

        return view('users.allusers', compact('usersWDB', 'usersFromDB'));
    }

    public function addUsers() {

        return view('users.addusers');
    }

    private function loadUsersWDB(){
        $usersWithoutDB = [
            ['id'=>1, 'name' => 'Sara', 'email' => 'sara@gmail.com'],
            ['id'=>2, 'name' => 'Bruno', 'email' => 'Bruno@gmail.com'],
            ['id'=>3, 'name' => 'Marco', 'email' => 'Marco@gmail.com'],
            ['id'=>4, 'name' => 'António', 'email' => 'António@gmail.com'],
        ];
        return $usersWithoutDB;
    }

    public function deleteUsers($id){
        Task::where('user_id',$id)->delete();
        User::where('id', $id)->delete();

        return back();

    }

    public function editUsers($id){
        $userInfo = User::where('id', $id)->select('name', 'email', 'id', 'address', 'nif')->first();
        // dd($userInfo);
        return view('users.edituser', compact('userInfo'));
    }

    public function storeUser(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        //depois de validados, inserir na bd
        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        return redirect()->route('users.all')->with('message', 'utilizador adicionado com sucesso!');

    }

    public function updateUser(Request $request){

        $request->validate([
            'name' =>'required|max:50'
        ]);

        User::where('id', $request->id)->update([
            'name'=> $request->name,
            'address'=> $request->address,
            'nif'=> $request->nif,
        ]);

        return redirect()->route('users.all')->with('message', 'user actualizado com sucesso!');

    }
}
