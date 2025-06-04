<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GasFaster - Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-gray-100 antialiased">
    <!-- Header -->
    <header class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="/" class="flex items-center">
                <div class="bg-black text-white p-2 rounded-lg mr-2">
                    <i class="fas fa-fire text-xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-black">GasFaster</h1>
            </a>
            <div class="flex space-x-4">
                <a href="{{ route('login') }}" class="text-black hover:text-gray-600 font-medium">Login</a>
                <a href="{{ route('register') }}" class="bg-black text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-800">Sign Up</a>
            </div>
        </div>
    </header>

    <!-- Login Form -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto bg-white rounded-xl shadow-sm p-8 fade-in">
                <h2 class="text-2xl font-bold text-black mb-6 text-center">Log In to Your Account</h2>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-lg text-sm">
                        <ul class="list-disc pl-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-semibold text-black mb-2">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg text-black text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter your email">
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-black mb-2">Password</label>
                        <input type="password" id="password" name="password" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg text-black text-base focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Enter your password">
                    </div>
                    <button type="submit" class="w-full bg-black text-white py-3 rounded-lg text-base font-medium hover:bg-gray-800 transition">
                        Log In
                    </button>
                </form>
                <p class="mt-6 text-center text-sm text-gray-600">
                    Don’t have an account? <a href="{{ route('register') }}" class="text-black font-medium hover:underline">Sign up</a>
                </p>
            </div>
        </div>
    </section>
</body>
</html>