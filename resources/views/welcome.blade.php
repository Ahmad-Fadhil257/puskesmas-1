<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Puskesmas - Layanan Kesehatan</title>
    <meta name="description" content="Solusi layanan kesehatan komprehensif. Konsultasi, dokter spesialis, pemeriksaan kesehatan, dan layanan darurat.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
            background: #ffffff;
        }
    </style>
</head>
<body>

    {{-- Section 1: Layanan Kami --}}
    @include('partials.layanan-kami')

    {{-- Section 2: Dokter Kami --}}
    @include('partials.dokter-kami')

</body>
</html>
