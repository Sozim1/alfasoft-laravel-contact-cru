@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">
            <i class="bi bi-person-vcard me-2"></i> {{ __('messages.contact.details') ?? 'Detalhes do Contato' }}
        </h1>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $contact->name }}</h5>
                <p class="card-text">
                    <strong>{{ __('messages.contact.contact') }}:</strong> {{ $contact->contact }}
                </p>
                <p class="card-text">
                    <strong>{{ __('messages.contact.email') }}:</strong> {{ $contact->email }}
                </p>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> {{ __('messages.contact.back') }}
            </a>

            @auth
                <div class="d-flex gap-2">
                    <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> {{ __('messages.contact.edit') }}
                    </a>

                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST"
                          onsubmit="return confirm('{{ __('messages.contact.confirm_delete') }}')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            <i class="bi bi-trash"></i> {{ __('messages.contact.delete') }}
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
@endsection
