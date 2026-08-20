@extends('layouts.app')

@section('title', config('app.name') . ' - Melayani Kesehatan Masyarakat')

@section('content')

    <!-- Hero Section -->
    @include('landing-page.hero-section')

    <!-- Info Cards Section -->
    @include('landing-page.info-cards-section')

    <!-- About / Tentang Kami Section -->
    @include('landing-page.about-section')


    <!-- Seksi berikutnya akan ditambahkan di sini secara modular -->

@endsection
