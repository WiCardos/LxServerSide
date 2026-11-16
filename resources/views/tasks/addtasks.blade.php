@extends('layouts.fo')

@section('content')
    <h1>Adicionar tasks</h1>
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Id</label>
            <select required type="user_id" name="user_id" class="form-select" id="exampleInputEmail1"
                aria-describedby="emailHelp">

                <option selected>Open this select menu</option>
                @foreach ($users as $user)
                    <option value={{$user->id}}>{{$user->name}}</option>
                @endforeach
            </select>
            {{-- <input required type="user_id" name="id" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp"> --}}
        </div>
        @error('user_id')
            <p>Utilizador inválido</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Task Name</label>
            <input required type="text" name="task_name" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        @error('task_name')
            <p>Nome da task inválido</p>
        @enderror

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Description</label>
            <input required type="text" name="description" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        @error('description')
            <p>Descrição inválida</p>
        @enderror

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
