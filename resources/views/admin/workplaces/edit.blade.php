@extends('layouts.app')

@section('title', 'Editar Centro de Trabajo')

@section('content')
    @livewire('admin.workplace-form', ['workplace' => $workplace])
@endsection
