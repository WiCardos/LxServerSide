@extends('layouts.fo')

@section('content')
    <img src="{{ asset('imgs/LetTheLaravelErrosBegin.png') }}" alt="Laravel Exploding with errors">
    {{-- @if (isset($courseName))
        <h5>Olá {{ $courseName }}</h5>
    @else
        <h5>Olá user</h5>
    @endif --}}
    <h5>Olá {{isset($courseName)? $courseName : 'user' }}</h5>
    <h6>O contacto é o {{$contactInfo['name']}} - {{$contactInfo['contact']}}</h6>
    <h4>Olha aqui a info do CESAE: </h4>
    <ul>
        <li>Name: {{$cesaeInfo['name']}}</li>
        <li>Address: {{$cesaeInfo['address']}}</li>
        <li>Email: {{$cesaeInfo['email']}}</li>
    </ul>
    <h5>Alunos da turma</h5>
    <ul>
        @if(@isset($students))
            @foreach ($students as $std)
                <li>{{$std}}</li>
            @endforeach
        @endif
    </ul>
    <h5>Funcionalidades da nossa app</h5>
    <ul>
        <li><a href="{{ route('welcome') }}">Welcome Page</a></li>
        <li><a href="{{ route('users.all') }}">Utilizadores</a></li>
        <li><a href="{{ route('users.add') }}">Adicionar Utilizador</a></li>
        <li><a href="{{ route('tasks.all') }}">Tasks</a></li>
        <li><a href="{{ route('tasks.add') }}">Adicionar Task</a></li>
        <li><a href="{{ route('gifts.all') }}">Prendas de Natal</a></li>
    </ul>
@endsection
