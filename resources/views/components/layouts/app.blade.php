<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SITERKENAL</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite('resources/css/app.css')
    @livewireStyles

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
    <link rel="icon" href="{{ asset('icon.png') }}">
</head>
<body class="bg-gradient-to-r from-blue-900 to-blue-500 text-slate-800"><div>
    <!-- Navbar / Sidebar -->
    
    {{ $slot }}
</div>
</body>
