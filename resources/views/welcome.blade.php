<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GasFaster – Fast & Reliable Gas Cylinder Delivery in Dar es Salaam</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            padding-bottom: 70px; /* Prevent content hiding under bottom nav */
        }
        .hero-bg {
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('{{ asset('img/background.jpg') }}');
            background-size: cover;
            background-position: center 30%;
            background-attachment: fixed;
        }
        .hover-scale { transition: transform 0.3s ease; }
        .hover-scale:hover { transform: scale(1.03); }
        .feature-icon { 
            transition: all 0.4s ease; 
        }
        .feature-card:hover .feature-icon { 
            transform: translateY(-5px) scale(1.1);
            background: linear-gradient(135deg, #000000 0%, #333333 100%);
        }
        .btn-primary {
            background: linear-gradient(135deg, #111827 0%, #000000 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .btn-primary:active {
            transform: translateY(0);
        }
        .badge-pulse {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.8; }
            100% { opacity: 1; }
        }
        .delivery-badge {
            background: linear-gradient(90deg, #10B981 0%, #059669 100%);
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-black to-gray-900 text-white text-center py-2.5 text-sm font-medium">
        🚚 Free Delivery on Orders Above 50,000 TZS | ⚡ Same-Day Delivery in Dar es Salaam
    </div>

    <!-- Header / Navigation -->
    <header class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="/" class="flex items-center space-x-3">
                    <div class="bg-black text-white p-2.5 rounded-lg">
                        <i class="fas fa-fire text-2xl"></i>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">GasFaster</h1>
                </a>

                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#products" class="text-gray-700 hover:text-black font-medium transition">Shop</a>
                    <a href="#how-it-works" class="text-gray-700 hover:text-black font-medium transition">How It Works</a>
                    <a href="#testimonials" class="text-gray-700 hover:text-black font-medium transition">Reviews</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-black font-medium transition">Login</a>
                        <a href="{{ route('register') }}" class="btn-primary text-white px-6 py-2.5 rounded-lg font-semibold">Sign Up Free</a>
                    @else
                        <a href="{{ route('home') }}" class="btn-primary text-white px-6 py-2.5 rounded-lg font-semibold">My Account</a>
                    @endguest
                </nav>

                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="md:hidden text-gray-800 focus:outline-none">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden bg-white border-t py-4 px-4 space-y-4">
                <a href="#products" class="block text-gray-800 py-2">Shop</a>
                <a href="#how-it-works" class="block text-gray-800 py-2">How It Works</a>
                <a href="#testimonials" class="block text-gray-800 py-2">Reviews</a>
                @guest
                    <a href="{{ route('login') }}" class="block text-gray-800 py-2">Login</a>
                    <a href="{{ route('register') }}" class="block btn-primary text-white py-3 rounded-lg text-center font-semibold">Sign Up</a>
                @else
                    <a href="{{ route('home') }}" class="block btn-primary text-white py-3 rounded-lg text-center font-semibold">My Account</a>
                @endguest
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-bg text-white py-20 md:py-28 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold leading-tight mb-6">
                Fast & Safe Gas Delivery<br class="hidden md:block">Right to Your Doorstep
            </h1>
            <p class="text-xl md:text-2xl mb-10 max-w-3xl mx-auto opacity-90">
                Quality LPG  safe, reliable, convenient.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-5 mb-12">
                <a href="@guest {{ route('register') }} @else #products @endguest"
                   class="bg-white text-black px-10 py-5 rounded-xl font-bold text-lg hover:bg-gray-100 transition shadow-xl btn-primary">
                    Order Now →
                </a>
                <a href="#how-it-works"
                   class="border-2 border-white/90 text-white px-10 py-5 rounded-xl font-bold text-lg hover:bg-white/10 transition">
                    <i class="fas fa-play-circle mr-2"></i>How It Works
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="flex flex-wrap justify-center gap-6 text-sm md:text-base">
                <div class="flex items-center bg-black/40 px-4 py-2 rounded-full">
                    <i class="fas fa-users text-green-400 mr-2"></i>
                    <span>500+ Happy Customers</span>
                </div>
                <div class="flex items-center bg-black/40 px-4 py-2 rounded-full">
                    <i class="fas fa-shield-check text-green-400 mr-2"></i>
                    <span>Safety Certified</span>
                </div>
                <div class="flex items-center bg-black/40 px-4 py-2 rounded-full">
                    <i class="fas fa-star text-yellow-400 mr-2"></i>
                    <span>4.9/5 Rating</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Showcase (MOVED UP - Users want to see products first!) -->
    <section id="products" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready for Delivery Today</h2>
                <p class="text-gray-600 text-lg">Popular gas cylinders with same-day delivery</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $demoProducts = [
                        ['name' => '6kg Gas Cylinder', 'price' => 45000, 'size' => '6kg', 'image' => 'img/orxy.jpg'],
                        ['name' => '13kg Gas Cylinder', 'price' => 83000, 'size' => '13kg', 'image' => 'img/taifa.jpg'],
                        ['name' => '22.5kg Gas Cylinder', 'price' => 23000, 'size' => '22.5kg', 'image' => 'img/lake.png'],
                        ['name' => 'Gas Regulator + Hose', 'price' => 23000, 'size' => 'Standard', 'image' => 'img/cam.jpg'],
                    ];
                @endphp

                @foreach ($demoProducts as $product)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover-scale border border-gray-100">
                        <div class="relative">
                            <img loading="lazy" src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-56 object-cover">
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $product['name'] }}</h3>
                            <p class="text-sm text-gray-600 mb-3">{{ $product['size'] }}</p>
                            
                            <div class="flex items-baseline mb-5">
                                <span class="text-2xl font-bold text-black">{{ number_format($product['price'], 0) }} TZS</span>
                                <span class="text-sm text-gray-500 ml-2">incl. delivery</span>
                            </div>
                            
                            <a href="@guest {{ route('register') }} @else {{ route('home') }} @endguest"
                               class="block btn-primary text-white py-3.5 rounded-lg text-center font-medium">
                                <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="@guest {{ route('register') }} @else {{ route('home') }} @endguest"
                   class="inline-block btn-primary text-white px-10 py-4 rounded-xl font-bold text-lg">
                    View All Products <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- How It Works - Simplified -->
    <section id="how-it-works" class="py-20 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">How GasFaster Works</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="text-center">
                    <div class="feature-icon w-20 h-20 bg-black text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg">
                        <span class="font-bold text-white">1</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Order Online</h3>
                    <p class="text-gray-600">Select your cylinder size and delivery time in 2 minutes</p>
                </div>
                
                <!-- Step 2 (Highlighted) -->
                <div class="text-center relative">
                    <div class="absolute -inset-4 bg-white rounded-2xl shadow-xl -z-10"></div>
                    <div class="feature-icon w-20 h-20 bg-gradient-to-r from-black to-gray-800 text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg">
                        <span class="font-bold">2</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">We Deliver Fast</h3>
                    <p class="text-gray-600">Our certified team delivers in under 2 hours with live tracking</p>
                </div>
                
                <!-- Step 3 -->
                <div class="text-center">
                    <div class="feature-icon w-20 h-20 bg-black text-white rounded-full flex items-center justify-center mx-auto mb-6 text-3xl shadow-lg">
                        <span class="font-bold">3</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Safe & Pay</h3>
                    <p class="text-gray-600">Safety check, install, pay securely via M-Pesa or cash</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Why Choose GasFaster?</h2>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div class="feature-card p-6 rounded-2xl border border-gray-100 hover:border-gray-200 transition">
                    <div class="feature-icon w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mb-6 text-2xl">
                        <i class="fas fa-truck-fast"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Fastest in Dar</h3>
                    <p class="text-gray-600">Guaranteed 2-hour delivery or your money back*</p>
                </div>
                
                <div class="feature-card p-6 rounded-2xl border border-gray-100 hover:border-gray-200 transition">
                    <div class="feature-icon w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mb-6 text-2xl">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">100% Safe</h3>
                    <p class="text-gray-600">PES certified cylinders with trained delivery experts</p>
                </div>
                
                <div class="feature-card p-6 rounded-2xl border border-gray-100 hover:border-gray-200 transition">
                    <div class="feature-icon w-16 h-16 bg-gray-900 text-white rounded-full flex items-center justify-center mb-6 text-2xl">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">24/7 Support</h3>
                    <p class="text-gray-600">Call, WhatsApp, or chat anytime for assistance</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials - Simplified -->
    <section id="testimonials" class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Loved by Dar es Salaam</h2>
                <p class="text-gray-600 text-lg">Trusted by hundreds of homes & businesses</p>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 max-w-3xl mx-auto">
                <div class="flex items-center mb-8">
                    <div class="w-16 h-16 bg-gray-200 rounded-full overflow-hidden mr-6">
                        <img loading="lazy" src="{{ asset('img/cam.jpg') }}" alt="Customer" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="text-xl font-bold">Amina J.</h4>
                        <p class="text-gray-600">Kinondoni • Regular Customer</p>
                        <div class="mt-2 text-yellow-500">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <span class="text-gray-700 font-medium ml-2">5.0</span>
                        </div>
                    </div>
                </div>
                <p class="text-gray-800 text-xl italic mb-6">
                    "I run a small restaurant in Kinondoni. GasFaster has saved me so much time and stress. The 2-hour delivery is REAL! Their staff always checks for safety. 100% recommended!"
                </p>
                <div class="flex justify-between items-center">
                    <div class="text-gray-500 text-sm">
                        <i class="fas fa-calendar-alt mr-2"></i>Ordered 5 times this month
                    </div>
                    <div class="text-green-600 font-semibold">
                        <i class="fas fa-check-circle mr-2"></i>Verified Customer
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="bg-gradient-to-r from-gray-900 to-black text-white py-20">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <div class="inline-flex items-center bg-black/30 px-6 py-2 rounded-full mb-8">
                <i class="fas fa-bolt text-yellow-400 mr-2"></i>
                <span class="font-medium">Limited Time Offer</span>
            </div>
            
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Get Your First Cylinder Today</h2>
            <p class="text-xl mb-10 opacity-90 max-w-2xl mx-auto">
                Join thousands in Dar es Salaam enjoying hassle-free gas delivery. First order gets a <span class="text-green-400 font-bold">free safety hose</span>!
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="@guest {{ route('register') }} @else {{ route('home') }}#products @endguest"
                   class="bg-white text-black px-12 py-5 rounded-xl font-bold text-lg hover:bg-gray-100 transition shadow-2xl">
                    <i class="fas fa-shopping-basket mr-2"></i>Start Ordering Now
                </a>
                <a href="tel:+255123456789"
                   class="border-2 border-white/50 text-white px-10 py-5 rounded-xl font-bold text-lg hover:bg-white/10 transition">
                    <i class="fas fa-phone-alt mr-2"></i>Call Us: +255 123 456 789
                </a>
            </div>
            
            <p class="mt-8 text-gray-400 text-sm">
                *2-hour delivery guarantee applies to main Dar es Salaam areas during business hours
            </p>
        </div>
    </section>

    <!-- Simplified Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-8 md:mb-0">
                    <div class="flex items-center mb-4">
                        <div class="bg-white text-black p-3 rounded-lg mr-3">
                            <i class="fas fa-fire text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-white">GasFaster</h3>
                    </div>
                    <p class="text-sm">Fast, safe & reliable LPG delivery in Dar es Salaam</p>
                </div>
                
                <div class="text-center md:text-right">
                    <div class="flex space-x-6 mb-4 justify-center md:justify-end">
                        <a href="#" class="text-gray-400 hover:text-white text-xl transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white text-xl transition">
                            <i class="fas fa-phone-alt"></i>
                        </a>
                    </div>
                    <p class="text-sm">support@gasfaster.co.tz • +255 123 456 789</p>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
                © {{ date('Y') }} GasFaster. All rights reserved. Dar es Salaam, Tanzania
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation -->
    <nav class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50 shadow-lg">
        <div class="flex justify-around py-3">
            <a href="/" class="flex flex-col items-center text-gray-700">
                <i class="fas fa-home text-xl"></i>
                <span class="text-xs mt-1">Home</span>
            </a>
            <a href="#products" class="flex flex-col items-center text-gray-700">
                <i class="fas fa-fire text-xl"></i>
                <span class="text-xs mt-1">Shop</span>
            </a>
            <a href="tel:+255123456789" class="flex flex-col items-center text-gray-700">
                <i class="fas fa-phone text-xl"></i>
                <span class="text-xs mt-1">Call</span>
            </a>
            <a href="@guest {{ route('register') }} @else {{ route('home') }} @endguest" class="flex flex-col items-center text-gray-700">
                <i class="fas fa-user text-xl"></i>
                <span class="text-xs mt-1">Account</span>
            </a>
        </div>
    </nav>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if(targetId === '#') return;
                
                const targetElement = document.querySelector(targetId);
                if(targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>