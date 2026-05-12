@extends('layouts.app')
@section('title', 'Crear Tesón')
@section('content')
    @livewire('tesones.teson-form')
@endsection
@section('js')
    @stack('js')
@endsection
