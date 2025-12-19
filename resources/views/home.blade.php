@extends('adminlte::page')

@section('title', 'Dashboard - RetroVault')

@section('content_header')
<h1 class="retro-title"><i class="fas fa-archive"></i> Dashboard</h1>
@stop

@section('content')
<p class="retro-subtitle">Welcome to RetroVault - Your Modern Retro Management System.</p>
@stop

@section('css')
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Space+Grotesk:wght@300;400;500;600;700&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
<style>
    :root {
        --cream: #F5F0E8;
        --burgundy: #8B2942;
        --mustard: #D4A12A;
        --charcoal: #2C2C2C;
    }

    .content-wrapper {
        background-color: var(--cream) !important;
    }

    .content-header {
        background-color: var(--cream) !important;
    }

    .retro-title {
        font-family: 'DM Serif Display', serif !important;
        color: var(--charcoal) !important;
    }

    .retro-title i {
        color: var(--burgundy);
        margin-right: 10px;
    }

    .retro-subtitle {
        color: var(--charcoal);
        font-family: 'Space Grotesk', sans-serif;
    }
</style>
@stop

@section('js')
<script>
    console.log("RetroVault - Modern Retro Management System");
</script>
@stop