@extends('layouts.app')

@section('title', config('app.name') . ' - Melayani Kesehatan Masyarakat')

@section('content')

    <!-- Hero Section -->
    @include('landing-page.hero-section')

    <!-- Info Cards Section -->
    @include('landing-page.info-cards-section')

    <!-- About / Tentang Kami Section -->
    @include('landing-page.about-section')

    <!-- Nilai-Nilai Kami Section -->
    @include('landing-page.nilai-nilai-section')

    <!-- Layanan Kami Section -->
    @include('partials.layanan-kami')

    <!-- Dokter Kami Section -->
    @include('partials.dokter-kami')

    <!-- Cara Kerja Section -->
    @include('landing-page.cara-section')

    <!-- Testimoni Pasien Section -->
    @include('landing-page.testimoni-section')

    <!-- Blog & Berita Section -->
    @include('landing-page.blog-section')

@endsection
