@extends('layouts.app')

@section('title', 'Capturar Cancelaciones')

@section('content')
    @livewire('tesones.cancelacion-manager', ['teson' => $teson])
@endsection
