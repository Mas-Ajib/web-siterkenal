<!-- resources/views/admin/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SITERKENAL</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('icon.png') }}">

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .fade-in {
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .pulse-glow {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        .input-focus {
            transition: all 0.3s ease;
        }
        .input-focus:focus {
            transform: scale(1.02);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }
        /* Background gradient: biru tua ke biru muda (tema perbankan profesional, trust dan segar) */
        body {
            background: linear-gradient(135deg, #1e40af 0%, #60a5fa 100%);
            background-attachment: fixed;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl p-8 relative overflow-hidden fade-in">
        <!-- Subtle decorative elements for better look (adjusted to blue tones) -->
        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/20 to-blue-300/20 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-24 h-24 bg-gradient-to-tr from-blue-400/10 to-blue-200/10 rounded-full ml-8 mb-8"></div>
        
        <div class="text-center mb-8 relative z-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2 pulse-glow">Login Admin SITERKENAL</h2>
            <p class="text-gray-600 font-medium">Masuk ke panel administrator dengan aman</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl mb-6 fade-in animation-delay-200">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-6">
            @csrf
            <div class="space-y-2">
                <label for="email" class="block text-gray-700 text-sm font-semibold">
                    Email
                </label>
                <input type="email" id="email" name="email" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-0 input-focus bg-gray-50/50 transition-all duration-300"
                       value="{{ old('email') }}" required autofocus placeholder="Masukkan email Anda">
            </div>

            <div class="space-y-2">
                <label for="password" class="block text-gray-700 text-sm font-semibold">
                    Password
                </label>
                <input type="password" id="password" name="password" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-0 input-focus bg-gray-50/50 transition-all duration-300"
                       required placeholder="Masukkan password Anda">
            </div>

            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-400 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all duration-300 transform hover:scale-105 shadow-lg font-semibold">
                Masuk Sekarang
            </button>
        </form>
        
        <!-- Footer note for better UX -->
        <div class="text-center mt-6 text-xs text-gray-500">
            <p>BNNK Kendal - Sistem Terintegrasi</p>
        </div>
    </div>

    <script>
        // Simple JS for staggered animation on load
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.2}s`;
            });
        });
    </script>
</body>
</html>