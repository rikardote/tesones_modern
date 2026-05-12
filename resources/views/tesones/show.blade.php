@extends('layouts.app')
@section('title', 'Ver Tesón #' . $teson->id)
@section('content')
    @livewire('tesones.teson-show', ['id' => $teson->id])
@endsection
