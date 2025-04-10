@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Detalhes do Contato</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $contact->name }}</h5>
                <p class="card-text"><strong>Contato:</strong> {{ $contact->contact }}</p>
                <p class="card-text"><strong>Email:</strong> {{ $contact->email }}</p>
            </div>
        </div>

        <div class="mt-4">
            @auth
                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">Editar</a>

                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Excluir</button>
                </form>
            @endauth

            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
@endsection
