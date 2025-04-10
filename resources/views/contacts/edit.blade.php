@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Editar Contato</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Erros encontrados:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('contacts.update', $contact) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nome:</label>
                <input type="text" name="name" id="name" class="form-control" required minlength="6"
                       value="{{ old('name', $contact->name) }}">
            </div>

            <div class="mb-3">
                <label for="contact" class="form-label">Contato (9 dígitos):</label>
                <input type="text" name="contact" id="contact" class="form-control" required pattern="\d{9}"
                       value="{{ old('contact', $contact->contact) }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" required
                       value="{{ old('email', $contact->email) }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
