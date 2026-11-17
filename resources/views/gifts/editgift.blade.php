@extends('layouts.fo')

@section('content')
    <h2>Editar Prenda: {{ $gift->name }}</h2>

    <form method="POST" action="{{ route('gifts.update') }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $gift->id }}">

        <div class="mb-3">
            <label class="form-label">Nome da Prenda *</label>
            <input required type="text" name="name" value="{{ $gift->name }}" class="form-control @error('name') is-invalid @enderror">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Pessoa *</label>
            <select required name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @if($user->id == $gift->user_id) selected @endif>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Valor Previsto (€) *</label>
            <input required type="number" step="0.01" name="expected_value" value="{{ $gift->expected_value }}" class="form-control @error('expected_value') is-invalid @enderror">
            @error('expected_value')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Valor Gasto (€)</label>
            <input type="number" step="0.01" name="spent_value" value="{{ $gift->spent_value }}" class="form-control @error('spent_value') is-invalid @enderror">
            @error('spent_value')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('gifts.all') }}" class="btn btn-secondary">Voltar</a>
    </form>
@endsection
