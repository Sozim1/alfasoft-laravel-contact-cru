@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">{{ __('messages.contact.list') }}</h1>

            <div class="d-flex gap-2">
                @auth
                    <a href="{{ route('contacts.export') }}" class="btn btn-outline-primary shadow-sm">
                        <i class="bi bi-download"></i> {{ __('messages.contact.csv') }}
                    </a>
                @endauth

            @auth
                <a href="{{ route('contacts.create') }}" class="btn btn-success shadow-sm">
                    <i class="bi bi-plus-lg"></i> {{ __('messages.contact.create') }}
                </a>
            @endauth
            </div>
        </div>

        {{-- Mensagem de sucesso --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Lista de contatos --}}
        @if($contacts->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle shadow-sm rounded">
                    <thead class="table-light">
                    <tr>
                        <th scope="col">{{ __('messages.contact.name') }}</th>
                        <th scope="col">{{ __('messages.contact.contact') }}</th>
                        <th scope="col">{{ __('messages.contact.email') }}</th>
                        <th scope="col" class="text-end">{{ __('messages.contact.actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($contacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->contact }}</td>
                            <td>{{ $contact->email }}</td>
                            <td class="text-end">
                                <a href="{{ route('contacts.show', $contact) }}" class="btn btn-sm btn-outline-info me-1">
                                    {{ __('messages.contact.view') }}
                                </a>

                                @auth
                                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-sm btn-outline-warning me-1">
                                        {{ __('messages.contact.edit') }}
                                    </a>

                                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('{{ __('messages.contact.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            {{ __('messages.contact.delete') }}
                                        </button>
                                    </form>
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info text-center">
                {{ __('messages.contact.no_contacts') }}
            </div>
        @endif
    </div>
@endsection
