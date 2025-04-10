@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">
            <i class="bi bi-pencil-square me-2"></i> {{ __('messages.contact.edit') }}
        </h1>

        @if ($errors->any())
            <div class="alert alert-danger shadow-sm">
                <strong>{{ __('messages.contact.errors') }}:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('contacts.update', $contact) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('messages.contact.name') }}:</label>
                        <input type="text" name="name" id="name" class="form-control" required minlength="6"
                               value="{{ old('name', $contact->name) }}">
                    </div>

                    <div class="mb-3">
                        <label for="contact" class="form-label">{{ __('messages.contact.contact') }} ({{ __('messages.contact.digits') }} 9):</label>
                        <input type="text" name="contact" id="contact" class="form-control" required pattern="\d{9}"
                               value="{{ old('contact', $contact->contact) }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('messages.contact.email') }}:</label>
                        <input type="email" name="email" id="email" class="form-control" required
                               value="{{ old('email', $contact->email) }}">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> {{ __('messages.contact.cancel') }}
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-pencil-square"></i> {{ __('messages.contact.save_changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
