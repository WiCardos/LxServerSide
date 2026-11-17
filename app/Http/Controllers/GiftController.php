<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GiftController extends Controller
{
    //Função interna para obter todas as prendas por utilizador.
    protected function getAllGifts()
    {
        $gifts = DB::table('gifts')
            ->join('users', 'users.id', '=', 'gifts.user_id')
            ->select('gifts.*', 'users.name as user_name')
            ->get();

        return $gifts;
    }

    //Função que devolve todas as prendas, e todos os users.
    public function allGifts()
    {
        $gifts = $this->getAllGifts();
        // dd($gifts);

        //Para escolher o user associado a createGift()
        $users = DB::table('users')->get();

        return view('gifts.allgifts', compact('gifts', 'users'));
    }

    //Função que cria uma prenda.
    public function createGift(Request $request)
    {
        // dd($request->all());
        //Valida
        $request->validate([
            'name' => 'required|string|max:100',
            'expected_value' => 'required|numeric|min:0',
            'spent_value' => 'nullable|numeric|min:0',
            'user_id' => 'required',
        ]);

        //Insere na BD
        DB::table('gifts')->insert([
            'name' => $request->name,
            'expected_value' => $request->expected_value,
            'spent_value' => $request->spent_value,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('gifts.all')->with('message', 'Prenda adicionada com sucesso!');
    }

    //Para ver uma prenda por id
    public function editGift($id)
    {
        $gift = DB::table('gifts')
            ->where('id', $id)
            ->first();

        //Caso se queira assignar a prenda a um novo user.
        $users = DB::table('users')->get();

        return view('gifts.editgift', compact('gift', 'users'));
    }

    //Para atualizar uma prenda
    public function updateGift(Request $request)
    {
        // dd($request->all());
        //Validação
        $request->validate([
            'name' => 'required|string|max:100',
            'expected_value' => 'required|numeric|min:0',
            'spent_value' => 'nullable|numeric|min:0',
            'user_id' => 'required',
        ]);

        //Insere
        DB::table('gifts')
            ->where('id', $request->id)
            ->update([
                'name' => $request->name,
                'expected_value' => $request->expected_value,
                'spent_value' => $request->spent_value,
                'user_id' => $request->user_id,
            ]);

        return redirect()->route('gifts.all')->with('message', 'Prenda actualizada com sucesso!');
    }

    //Para apagar uma prenda por id
    public function deleteGift($id)
    {
        DB::table('gifts')
            ->where('id', $id)
            ->delete();

        // return redirect()->route('gifts.all')->with('message', 'Prenda apagada com sucesso!');
        return back()->with('message', 'Prenda apagada com sucesso!');
    }
}
