<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GasFaster - Premium Gas Cylinders Delivery</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .hover-scale {
            transition: transform 0.3s ease-in-out;
        }
        .hover-scale:hover {
            transform: scale(1.03);
        }
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .safety-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: black;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: bold;
        }
        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .hero-section {
            background-image: url('{{ asset('img/lake.png') }}');
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>
<body class="bg-gray-100 antialiased">
    <!-- Announcement Bar -->
    <div class="bg-black text-white text-sm py-2 px-4 text-center">
        <p>🚚 Free delivery on orders above TZS 50,000 | ⚡ Fast & Reliable Delivery Service</p>
    </div>

    <!-- Header -->
    <header class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <div class="bg-black text-white p-2 rounded-lg mr-2">
                            <i class="fas fa-fire text-xl"></i>
                        </div>
                        <h1 class="text-2xl font-bold text-black">GasFaster</h1>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-black hover:text-gray-600 font-medium">Home</a>
                    <a href="/#products" class="text-black hover:text-gray-600 font-medium">Shop</a>
                    <a href="/#about" class="text-black hover:text-gray-600 font-medium">About</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-black hover:text-gray-600 font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-black text-white px-4 py-2 rounded-lg font-medium hover:bg-gray-800 transition">Sign Up</a>
                    @else
                        <a href="{{ route('home') }}#profile" class="text-black hover:text-gray-600 font-medium">Profile</a>
                    @endguest
                </nav>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center space-x-4">
                    <a href="#" class="relative text-black">
                        <i class="fas fa-search"></i>
                    </a>
                    <a href="@guest {{ route('register') }} @else {{ route('home') }}#cart @endguest" class="relative text-black">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge">0</span>
                    </a>
                    <button id="mobile-menu-button" class="text-black">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>

                <!-- Desktop Icons -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="#" class="text-black hover:text-gray-600">
                        <i class="fas fa-search"></i>
                    </a>
                    <a href="@guest {{ route('register') }} @else {{ route('home') }}#profile @endguest" class="relative text-black hover:text-gray-600">
                        <i class="fas fa-user"></i>
                    </a>
                    <a href="@guest {{ route('register') }} @else {{ route('home') }}#cart @endguest" class="relative text-black hover:text-gray-600">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-badge">0</span>
                    </a>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white py-4 px-4 mt-2 rounded-lg shadow-lg">
                <a href="/" class="block py-2 text-black border-b border-gray-200">Home</a>
                <a href="/#products" class="block py-2 text-black border-b border-gray-200">Shop</a>
                <a href="/#about" class="block py-2 text-black border-b border-gray-200">About</a>
                @guest
                    <a href="{{ route('login') }}" class="block py-2 text-black border-b border-gray-200">Login</a>
                    <a href="{{ route('register') }}" class="block py-2 text-black">Sign Up</a>
                @else
                    <a href="{{ route('home') }}#profile" class="block py-2 text-black">Profile</a>
                @endguest
            </div>
        </div>
    </header>

    <!-- Hero Section with Background Image -->
    <section class="hero-section py-32 text-white">
        <div class="container mx-auto px-4 hero-content text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 leading-tight fade-in">Fast Gas Cylinder Delivery</h2>
            <p class="text-xl mb-8 opacity-90 max-w-2xl mx-auto fade-in">We deliver quality gas products quickly and safely to your location.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4 fade-in">
                <a href="@guest {{ route('register') }} @else {{ route('home') }}#products @endguest" class="bg-white text-black px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition shadow-md">Order Now</a>
                <a href="#" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-black transition">Delivery Areas</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg text-center fade-in">
                    <div class="bg-black text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-bolt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Fast Delivery</h3>
                    <p class="text-gray-600">Quick delivery within 2 hours in urban areas.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg text-center fade-in">
                    <div class="bg-black text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Quality Products</h3>
                    <p class="text-gray-600">Only genuine, high-quality gas products.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg text-center fade-in">
                    <div class="bg-black text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-headset text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Reliable Service</h3>
                    <p class="text-gray-600">Consistent, dependable delivery service.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-black mb-12 text-center">Our Products</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @php
                    $productImages = [
                        'img/orxy.jpg',
                        'img/taifa.jpg',
                        'img/lake.png',
                        'img/orxy1.jpg',
                        'img/cam.jpg',
                        'img/taifa.jpg',
                        'img/lake.png',
                        'img/cam.jpg',
                    ];
                    $products = [
                        ['name' => '6kg Gas Cylinder', 'price' => 45000, 'size' => '6kg'],
                        ['name' => '13kg Gas Cylinder', 'price' => 85000, 'size' => '13kg'],
                        ['name' => 'Premium Stove', 'price' => 65000, 'size' => 'Large'],
                        ['name' => 'Standard Stove', 'price' => 35000, 'size' => 'Medium'],
                        ['name' => 'Gas Hose', 'price' => 12000, 'size' => '1.5m'],
                        ['name' => 'Pressure Regulator', 'price' => 18000, 'size' => 'Standard'],
                        ['name' => '22.5kg Cylinder', 'price' => 145000, 'size' => '22.5kg'],
                        ['name' => 'Portable Burner', 'price' => 25000, 'size' => 'Compact'],
                    ];
                @endphp
                @foreach ($productImages as $index => $image)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all hover-scale overflow-hidden relative">
                    @if($index % 2 == 0)
                    <div class="safety-badge" title="Quality Certified">
                        <i class="fas fa-check text-black"></i>
                    </div>
                    @endif
                    <img src="{{ asset($image) }}" alt="{{ $products[$index]['name'] }}" class="w-full h-56 object-cover">
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <h4 class="text-lg font-semibold text-black">{{ $products[$index]['name'] }}</h4>
                            <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded">{{ $products[$index]['size'] }}</span>
                        </div>
                        <p class="text-black font-bold text-lg mb-4">TZS {{ number_format($products[$index]['price'], 0, '.', ',') }}</p>
                        <a href="@guest {{ route('register') }} @else # @endguest" class="w-full bg-black hover:bg-gray-800 text-white py-2 rounded-lg text-sm font-medium transition flex items-center justify-center add-to-cart">
                            <i class="fas fa-cart-plus mr-2"></i>
                            Add to Cart
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-12 text-center">
                <button class="px-6 py-3 border border-black text-black rounded-lg font-medium hover:bg-black hover:text-white transition">
                    View All Products
                </button>
            </div>
        </div>
    </section>

    <!-- Delivery Info Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 fade-in">
                    <img src="{{ asset('img/orxy1.jpg') }}" alt="Delivery Service" class="w-full rounded-lg shadow-md">
                </div>
                <div class="md:w-1/2 md:pl-12 fade-in">
                    <h3 class="text-3xl font-bold text-black mb-4">Our Delivery Service</h3>
                    <p class="text-gray-600 mb-6">We specialize in fast, reliable delivery of gas cylinders and accessories to your location.</p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-black text-white p-2 rounded-full mr-4">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-black">Fast Delivery</h4>
                                <p class="text-gray-600 text-sm">Typically within 2 hours in urban areas</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-black text-white p-2 rounded-full mr-4">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-black">Wide Coverage</h4>
                                <p class="text-gray-600 text-sm">Serving all major neighborhoods</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-black text-white p-2 rounded-full mr-4">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-black">Flexible Scheduling</h4>
                                <p class="text-gray-600 text-sm">Choose delivery time that works for you</p>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="inline-block mt-6 text-black font-medium hover:underline">
                        View delivery areas <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-black mb-12 text-center">What Customers Say</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-sm fade-in">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-300 overflow-hidden mr-4">
                            <img src="{{ asset('img/cam.jpg') }}" alt="Customer" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold">John M.</h4>
                        </div>
                    </div>
                    <p class="text-gray-600">"Fast delivery exactly when promised. The driver was professional and courteous."</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm fade-in">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-300 overflow-hidden mr-4">
                            <img src="{{ asset('img/taifa.jpg') }}" alt="Customer" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold">Sarah K.</h4>
                        </div>
                    </div>
                    <p class="text-gray-600">"Reliable service every time. I never worry about running out of gas anymore."</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm fade-in">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-gray-300 overflow-hidden mr-4">
                            <img src="{{ asset('img/orxy.jpg') }}" alt="Customer" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-semibold">Michael T.</h4>
                        </div>
                    </div>
                    <p class="text-gray-600">"Consistently good service. The delivery is always on time and the products are quality."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-black text-white">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-4">Need Gas Delivery?</h3>
            <p class="text-xl mb-8 max-w-2xl mx-auto opacity-90">Order now for fast, reliable delivery to your location.</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                <a href="@guest {{ route('register') }} @else {{ route('home') }}#products @endguest" class="bg-white text-black px-8 py-3 rounded-lg font-medium hover:bg-gray-100 transition shadow-md">Order Now</a>
                <a href="#" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-medium hover:bg-white hover:text-black transition">Contact Us</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-gray-300 pt-16 pb-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-4">
                        <div class="bg-white text-black p-2 rounded-lg mr-2">
                            <i class="fas fa-fire"></i>
                        </div>
                        <h3 class="text-xl font-bold text-white">GasFaster</h3>
                    </div>
                    <p class="mb-4">Fast, reliable gas cylinder delivery service.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-lg mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="hover:text-white transition">Home</a></li>
                        <li><a href="/#products" class="hover:text-white transition">Shop</a></li>
                        <li><a href="/#about" class="hover:text-white transition">About</a></li>
                        <li><a href="@guest {{ route('register') }} @else {{ route('home') }}#profile @endguest" class="hover:text-white transition">Account</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-lg mb-4">Products</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Gas Cylinders</a></li>
                        <li><a href="#" class="hover:text-white transition">Gas Stoves</a></li>
                        <li><a href="#" class="hover:text-white transition">Accessories</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold text-lg mb-4">Contact Us</h4>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-white"></i>
                            <span>123 Energy Street, Dar es Salaam</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-2 text-white"></i>
                            <span>+255 123 456 789</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-white"></i>
                            <span>info@gasfaster.co.tz</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="pt-8 border-t border-gray-800 text-center text-sm">
                <p>© 2025 GasFaster. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Nav -->
    <div class="md:hidden fixed bottom-0 left-0 right-0 bg-white shadow-lg border-t border-gray-200 py-2 px-4 flex justify-around items-center">
        <a href="/" class="text-black flex flex-col items-center">
            <i class="fas fa-home text-lg"></i>
            <span class="text-xs mt-1">Home</span>
        </a>
        <a href="#" class="text-black flex flex-col items-center">
            <i class="fas fa-search text-lg"></i>
            <span class="text-xs mt-1">Search</span>
        </a>
        <a href="@guest {{ route('register') }} @else {{ route('home') }}#cart @endguest" class="text-black flex flex-col items-center relative">
            <i class="fas fa-shopping-cart text-lg"></i>
            <span class="cart-badge">0</span>
            <span class="text-xs mt-1">Cart</span>
        </a>
        <a href="@guest {{ route('register') }} @else {{ route('home') }}#profile @endguest" class="text-black flex flex-col items-center">
            <i class="fas fa-user text-lg"></i>
            <span class="text-xs mt-1">Account</span>
        </a>
    </div>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Cart counter animation for authenticated users
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                @guest
                    // Allow redirect to /register for unauthenticated users
                    return true;
                @else
                    // Prevent default for authenticated users and update cart badge
                    e.preventDefault();
                    const badge = document.querySelector('.cart-badge');
                    let count = parseInt(badge.textContent);
                    badge.textContent = count + 1;
                    badge.classList.add('animate-ping');
                    setTimeout(() => {
                        badge.classList.remove('animate-ping');
                    }, 500);
                @endguest
            });
        });
    </script>
</body>
</html>