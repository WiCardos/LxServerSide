@extends('layouts.fo')

@section('content')

@if (session('message'))
<div class="alert alert-success">
    {{session('message')}}
</div>
@endif

    <h1>Aqui vamos carregar todas as tasks</h1>

    <h6>Tasks da base de dados</h6>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">User Name</th>
                <th scope="col">Task Name</th>
                <th scope="col">Description</th>
                <th scope="col">Due at</th>
                <th scope="col">Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasksFromDB as $task)
                <tr>
                    <th scope="row">{{$task->user_name}}</th>
                    <td>{{$task->task_name}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->due_at}}</td>
                    <td>{{$task->status}}</td>
                    <td><a href="{{ route('tasks.edit', $task->id)}}" class="btn btn-info">Ver /  Editar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
