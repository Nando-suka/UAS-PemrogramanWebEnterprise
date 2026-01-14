@extends('layouts.app')

@section('title', 'Selamat Datang - SleepyPanda')

@section('content')

<div class="welcome-text">
    Mulai untuk masuk atau mendaftar untuk melihat analisa tidur mu.
</div>

<div class="d-grid gap-3">
    <a href="{{ route('login') }}" class="btn-entry-primary">Masuk</a>
    <a href="{{ route('register') }}" class="btn-entry-outline">Daftar</a>
</div>

@endsection

@push('styles')
<style>
    .d-grid.gap-3 { max-width: 320px; margin: 18px auto 0; }

    .btn-entry-primary,
    .btn-entry-outline {
        display: block;
        width: 100%;
        padding: 10px 14px;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        text-decoration: none;
        box-shadow: none;
        transition: transform .12s ease, box-shadow .12s ease;
    }

    .btn-entry-primary {
        background: linear-gradient(180deg, #1FAFA8 0%, #0EA5A3 100%);
        color: #ffffff;
        border: none;
    }

    .btn-entry-primary:active,
    .btn-entry-primary:focus {
        transform: translateY(1px);
    }

    .btn-entry-outline {
        background: #ffffff;
        color: #0EA5A3;
        border: 2px solid rgba(14,165,163,0.12);
    }

    .btn-entry-outline:active,
    .btn-entry-outline:focus {
        transform: translateY(1px);
    }
</style>
@endpush
