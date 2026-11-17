@extends('layouts.fo')

@section('content')
@if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <h2>Adicionar Prenda de Natal</h2>
    <form method="POST" action="{{ route('gifts.create') }}" class="mb-5">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-3">
                <label class="form-label">Nome da Prenda *</label>
                <input required type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-3 mb-3">
                <label class="form-label">Pessoa *</label>
                <select required name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                    <option value="">Selecione uma pessoa</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Valor Previsto (€) *</label>
                <input required type="number" step="0.01" name="expected_value" value="{{ old('expected_value') }}" class="form-control @error('expected_value') is-invalid @enderror">
                @error('expected_value')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-2 mb-3">
                <label class="form-label">Valor Gasto (€)</label>
                <input type="number" step="0.01" name="spent_value" value="{{ old('spent_value') }}" class="form-control @error('spent_value') is-invalid @enderror">
                @error('spent_value')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-2 mb-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Inserir</button>
            </div>
        </div>
    </form>

    <h2>Prendas de Natal</h2>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Prenda</th>
                <th>Pessoa</th>
                <th>Valor Previsto</th>
                <th>Valor Gasto</th>
                <th>Diferença</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gifts as $gift)
                @php
                    $diff = !is_null($gift->spent_value) ? ($gift->expected_value - $gift->spent_value) : null;
                @endphp
                <tr>
                    <td>{{ $gift->id }}</td>
                    <td>{{ $gift->name }}</td>
                    <td>{{ $gift->user_name }}</td>
                    <td>{{ number_format($gift->expected_value, 2) }} €</td>
                    <td>{{ !is_null($gift->spent_value) ? number_format($gift->spent_value, 2) . ' €' : '-' }}</td>
                    <td>
                        @if (!is_null($diff))
                            @if ($diff < 0)
                                <span class="text-danger fw-bold">{{ number_format($diff, 2) }} € (Mais caro)</span>
                            @elseif ($diff > 0)
                                <span class="text-success fw-bold">+{{ number_format($diff, 2) }} € (Mais barato)</span>
                            @else
                                <span>0.00 €</span>
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('gifts.edit', $gift->id) }}" class="btn btn-info">Editar</a>
                        <a href="{{ route('gifts.delete', $gift->id) }}" class="btn btn-danger" onclick="return confirm('Tem a certeza?')">Apagar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div class="text-center mt-4">
        <img src="{{ asset('imgs/pweasdontbwakouwgwoupapawt.png') }}" alt="Prendas de Natal" class="img-fluid" style="max-width: 400px;">
    </div> --}}
@endsection
