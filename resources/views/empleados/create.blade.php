@extends('layouts.app')

@section('title', 'Nuevo empleado - Jelou Moda')

@push('styles')
    <style>
        .page-wrapper { max-width: 700px; margin: 2rem auto; padding: 1.5rem; }
        .page-wrapper h1 { font-size: 1.4rem; margin-bottom: 1rem; }

        .form-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            padding: 1.5rem;
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem 1.2rem;
        }
        .form-full { grid-column: 1 / -1; }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            margin-bottom: 0.3rem;
        }
        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.4rem 0.6rem;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 0.9rem;
        }
        .form-actions {
            margin-top: 1.5rem;
            display: flex;
            gap: 0.6rem;
        }
        .btn-primary {
            background: #e63946;
            color: #fff;
            padding: 0.5rem 1.2rem;
            border-radius: 999px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
        }
        .btn-primary:hover { background: #c72733; }
        .btn-cancel {
            padding: 0.5rem 1rem;
            border-radius: 999px;
            border: 1px solid #ccc;
            text-decoration: none;
            font-size: 0.9rem;
            color: #333;
            background: #fff;
        }
        .error-text {
            color: #e63946;
            font-size: 0.75rem;
        }
    </style>
@endpush

@section('content')
    <div class="page-wrapper">
        <h1>Registrar nuevo empleado</h1>

        <div class="form-card">
            <form action="{{ route('empleados.store') }}" method="POST">
                @include('empleados._form', ['btnText' => 'Guardar empleado'])
            </form>
        </div>
    </div>
@endsection
