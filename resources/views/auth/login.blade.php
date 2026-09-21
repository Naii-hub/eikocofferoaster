<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Kopi Mesin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        coffee: { 50: '#fdf8f0', 100: '#f9edd9', 500: '#db7f2e', 600: '#cd6624', 700: '#ab4d1f', 800: '#8a3e20' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-coffee-50 to-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white p-8 rounded-2xl shadow-2xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-br from-coffee-500 to-coffee-700 rounded-2xl mx-auto flex items-center justify-center mb-4 shadow-lg animate-pulse">
                <i class="fas fa-mug-hot text-white text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">Login Admin</h1>
            <p class="text-gray-500 text-sm mt-2">Silakan masuk untuk mengelola dashboard</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded mb-6 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-5">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-coffee-500 focus:border-transparent transition-all" placeholder="admin@kopimesin.id">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-semibold mb-2">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-coffee-500 focus:border-transparent transition-all" placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-coffee-600 to-coffee-700 text-white font-bold py-3.5 rounded-xl hover:shadow-lg hover:from-coffee-700 hover:to-coffee-800 transition-all transform hover:-translate-y-0.5">
                Masuk ke Dashboard
            </button>
        </form>
    </div>
</body>
</html>