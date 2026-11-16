@extends('layouts.fo')

@section('content')
    <h6>Detalhes da task {{ $taskInfo->name }}</h6>
    <p>{{ $taskInfo->description }}</p>
    <p>{{ $taskInfo->due_at }}</p>
    <p>{{ $taskInfo->status }}</p>
@endsection

