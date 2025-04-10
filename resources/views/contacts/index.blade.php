@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Lista de Contatos</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @auth
            <a href="{{ route('contacts.create') }}" class="btn btn-primary mb-3">Adicionar Contato</a>
        @endauth

        @if($contacts->count())
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->contact }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>
                            <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-info">Ver</a>

                            @auth
                                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-warning">Editar</a>

                                <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Excluir</button>
                                </form>
                            @endauth
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Nenhum contato encontrado.</p>
        @endif
    </div>
@endsection
