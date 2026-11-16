<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function allTasks() {

        // $tasksFromDB = DB::table('tasks')
        // ->join('users', 'tasks.user_id', '=', 'users.id')
        // ->select('users.name as user_name' , 'tasks.name as task_name','tasks.description','tasks.due_at', 'tasks.status')
        // ->get();

        $tasksFromDB = $this->getAllTasks();
        // dd($tasksFromDB);

        return view('tasks.alltasks', compact('tasksFromDB'));
    }

    protected function getAllTasks(){
        // $tasks= DB::table('tasks')
        // ->join('users', 'tasks.user_id', 'users.id')
         $tasks= Task::join('users', 'tasks.user_id', 'users.id')
        ->select('tasks.id', 'users.name as user_name' , 'tasks.name as task_name','tasks.description','tasks.due_at', 'tasks.status')
        ->get();

        return $tasks;
    }

    public function editTasks($id){
        $taskInfo = Task::where('id', $id)->select('id', 'name', 'description', 'due_at', 'status')->first();
        // dd($taskInfo);
        return view('tasks.edittask', compact('taskInfo'));
    }

    public function storeTask(Request $request){
        // dd($request->all());
        $request->validate([
            'task_name' => 'max:50|string|required',
            'user_id' =>'required|exists:users,id'
        ]);

        //depois de validados, inserir na bd
        Task::insert([
            'user_id'=>$request->user_id,
            'name'=>$request->task_name,
            'description'=>$request->description
        ]);

        return redirect()->route('tasks.all')->with('message', 'task adicionada com sucesso!');

    }

    public function addTasks(){
        $users = $this->getAllUsers();
        return view('tasks.addtasks', compact('users'));
    }

    private function getAllUsers(){
        $users = User::select('id','name')->get();
        return $users;
    }
}
