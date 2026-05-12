@extends('layouts.app')
@section('title', 'Editar Tesón')
@section('content')
    @livewire('tesones.teson-form', ['id' => $teson->id])
@endsection
@section('js')
    @stack('js')
@endsection
