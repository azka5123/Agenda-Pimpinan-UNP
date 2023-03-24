@extends('front.layout.app')

@section('title', 'Agenda Pimpinan UNP')

@section('main_content')
    {{-- searchbar --}}
    <livewire:user-data>
        <div class="container-fluid" id="calendar"></div>
    @endsection
