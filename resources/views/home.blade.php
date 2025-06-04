<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - GasFaster</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
        .cart-badge { transition: transform 0.2s ease; }
        .cart-badge.updated { transform: scale(1.2); }
        .toast { position: fixed; top: 1rem; right: 1rem; z-index: 50; animation: slideIn 0.3s ease-out; }
        .product-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,0.1); }
        .account-nav-item { transition: all 0.2s ease; }
        .account-nav-item.active { border-left: 3px solid #000; font-weight: 600; color: #000; background-color: #f1f5f9; }
        .account-nav-item:hover:not(.active) { background-color: #f1f5f9; }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        .animate-fade-in { animation: fadeIn 0.5s ease-out; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation (unchanged) -->
    <nav class="bg-white shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <span class="text-2xl font-bold text-black">GasFaster</span>
                </a>
                <div class="hidden md:flex flex-1 mx-8">
                    <input type="text" placeholder="Search products..." class="w-full max-w-md border border-gray-300 rounded-l-md p-2 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <button class="bg-black text-white px-4 rounded-r-md hover:bg-gray-800">Search</button>
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}#products" class="text-gray-600 hover:text-black font-medium">Products</a>
                    <a href="{{ route('home') }}#cart" class="relative text-gray-600 hover:text-black font-medium">
                        Cart
                        <span class="cart-badge bg-black text-white text-xs font-bold rounded-full px-2 py-1 absolute -top-2 -right-4">
                            {{ $cartItems->sum('quantity') }}
                        </span>
                    </a>
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-black font-medium">{{ Auth::user()->name }}</button>
                        <div class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg hidden group-hover:block">
                            <a href="{{ route('home') }}#profile" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Profile</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-600 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
            <div class="px-4 py-3 space-y-2">
                <input type="text" placeholder="Search products..." class="w-full border border-gray-300 rounded-md p-2">
                <a href="{{ route('home') }}#products" class="block text-gray-600 hover:text-black">Products</a>
                <a href="{{ route('home') }}#cart" class="block text-gray-600 hover:text-black">
                    Cart
                    <span class="cart-badge bg-black text-white text-xs font-bold rounded-full px-2 py-1">
                        {{ $cartItems->sum('quantity') }}
                    </span>
                </a>
                <a href="{{ route('home') }}#profile" class="block text-gray-600 hover:text-black">Profile</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="block text-gray-600 hover:text-black">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Toast Notification -->
    @if (session('success'))
        <div class="toast bg-green-600 text-white px-4 py-2 rounded-lg shadow-lg">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="toast bg-red-600 text-white px-4 py-2 rounded-lg shadow-lg">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Account Navigation (unchanged) -->
            <aside class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-200 rounded-full p-2">
                                <i class="fas fa-user-circle text-3xl text-gray-600"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>
                    <nav class="divide-y divide-gray-200">
                        <a href="{{ route('home') }}" class="block account-nav-item active p-4 text-gray-600 hover:text-black">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                        <a href="#products" class="block account-nav-item p-4 text-gray-600 hover:text-black">
                            <i class="fas fa-shopping-bag mr-3"></i> Products
                        </a>
                        <a href="#cart" class="block account-nav-item p-4 text-gray-600 hover:text-black">
                            <i class="fas fa-cart-shopping mr-3"></i> Cart
                        </a>
                        <a href="#profile" class="block account-nav-item p-4 text-gray-600 hover:text-black">
                            <i class="fas fa-user mr-3"></i> Profile
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full text-left account-nav-item p-4 text-gray-600 hover:text-black">
                                <i class="fas fa-sign-out-alt mr-3"></i> Logout
                            </button>
                        </form>
                    </nav>
                </div>
            </aside>

            <!-- Main Dashboard -->
            <main class="md:w-3/4 space-y-8">
                <!-- Welcome Card (unchanged) -->
                <div class="bg-white rounded-lg shadow-sm p-6 animate-fade-in">
                    <h2 class="text-2xl font-bold text-gray-900">Welcome, {{ Auth::user()->name }}!</h2>
                    <p class="text-gray-600 mt-1">Manage your account, browse products, and track your orders.</p>
                </div>

                <!-- Products Section (unchanged) -->
                <section id="products" class="bg-white rounded-lg shadow-sm p-6 animate-fade-in">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Products</h3>
                        <a href="#products" class="text-sm text-gray-600 hover:text-black font-medium">View All</a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <div class="product-card bg-white border border-gray-200 rounded-lg overflow-hidden">
                                <div class="relative">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                                    @if ($product->created_at->gt(now()->subDays(7)))
                                        <span class="absolute top-2 left-2 bg-black text-white text-xs font-bold px-2 py-1 rounded">New</span>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold text-gray-900 truncate">{{ $product->name }}</h4>
                                    <p class="text-sm text-gray-500">{{ $product->size }}</p>
                                    <p class="text-lg font-bold text-gray-900 mt-1">{{ number_format($product->price, 2) }} TZS</p>
                                    <form action="{{ route('cart.add') }}" method="POST" class="mt-4 add-to-cart">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="w-full bg-black text-white py-2 rounded-md hover:bg-gray-800 transition-colors">
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>

                <!-- Cart Section -->
                <section id="cart" class="bg-white rounded-lg shadow-sm p-6 animate-fade-in">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Your Cart</h3>
                    @if ($cartItems->isEmpty())
                        <div class="bg-gray-50 p-6 rounded-lg text-center">
                            <i class="fas fa-shopping-cart text-3xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600">Your cart is empty.</p>
                            <a href="#products" class="mt-4 inline-block bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800">Shop Now</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="text-left p-4 text-gray-600 font-medium">Product</th>
                                        <th class="text-left p-4 text-gray-600 font-medium">Size</th>
                                        <th class="text-left p-4 text-gray-600 font-medium">Price</th>
                                        <th class="text-left p-4 text-gray-600 font-medium">Quantity</th>
                                        <th class="text-left p-4 text-gray-600 font-medium">Total</th>
                                        <th class="text-right p-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr class="border-t">
                                            <td class="p-4 flex items-center space-x-4">
                                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-12 h-12 object-cover rounded">
                                                <span>{{ $item->product->name }}</span>
                                            </td>
                                            <td class="p-4">{{ $item->product->size }}</td>
                                            <td class="p-4">{{ number_format($item->product->price, 2) }} TZS</td>
                                            <td class="p-4">
                                                <div class="flex items-center space-x-2">
                                                    <button type="button" class="update-quantity bg-gray-200 text-gray-600 px-2 py-1 rounded hover:bg-gray-300" data-id="{{ $item->id }}" data-action="decrement">-</button>
                                                    <span>{{ $item->quantity }}</span>
                                                    <button type="button" class="update-quantity bg-gray-200 text-gray-600 px-2 py-1 rounded hover:bg-gray-300" data-id="{{ $item->id }}" data-action="increment">+</button>
                                                </div>
                                            </td>
                                            <td class="p-4">{{ number_format($item->product->price * $item->quantity, 2) }} TZS</td>
                                            <td class="p-4 text-right">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="remove-from-cart">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="p-4 bg-gray-50 flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900">Total: {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 2) }} TZS</span>
                                <form action="{{ route('payment.checkout') }}" method="POST" class="initiate-checkout">
                                    @csrf
                                    <button type="submit" class="bg-black text-white px-6 py-2 rounded-md hover:bg-gray-800">Proceed to Checkout</button>
                                </form>
                            </div>
                        </div>
                    @endif
                </section>

                <!-- Profile Section (unchanged) -->
                <section id="profile" class="bg-white rounded-lg shadow-sm p-6 animate-fade-in">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Your Profile</h3>
                    <form action="{{ route('profile.update') }}" method="POST" class="max-w-lg">
                        @csrf
                        <div class="mb-6">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-6">
                            <label for="mobile_phone" class="block text-sm font-medium text-gray-700 mb-1">Mobile Phone</label>
                            <input type="text" name="mobile_phone" id="mobile_phone" value="{{ old('mobile_phone', $user->mobile_phone) }}" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            @error('mobile_phone') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            @error('password') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-6">
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-gray-500">
                        </div>
                        <button type="submit" class="w-full bg-black text-white py-3 rounded-md hover:bg-gray-800 transition-colors">Update Profile</button>
                    </form>
                </section>
            </main>
        </div>
    </div>

    <!-- Footer (unchanged) -->
    <footer class="bg-gray-900 text-gray-300 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">GasFaster</h3>
                    <p class="text-sm">Your trusted source for quality gas products, delivered fast and reliably.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}#products" class="hover:text-white">Products</a></li>
                        <li><a href="{{ route('home') }}#cart" class="hover:text-white">Cart</a></li>
                        <li><a href="{{ route('home') }}#profile" class="hover:text-white">Profile</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-white mb-4">Contact Us</h3>
                    <p class="text-sm">Email: support@gasfaster.ac.tz</p>
                    <p class="text-sm">Phone: +255 123 456 789</p>
                </div>
            </div>
            <div class="mt-8 border-t border-gray-700 pt-4 text-center text-sm">
                © {{ date('Y') }} GasFaster. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        $('#mobile-menu-btn').click(function () {
            $('#mobile-menu').toggleClass('hidden');
        });

        // Update Cart Count
        function updateCartCount() {
            $.get('{{ route('cart.count') }}', function (data) {
                $('.cart-badge').text(data.count).addClass('updated');
                setTimeout(() => $('.cart-badge').removeClass('updated'), 200);
            });
        }

        // Handle Add to Cart
        $('.add-to-cart').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function () {
                    updateCartCount();
                    showToast('Product added to cart!', 'bg-green-600');
                    window.location.hash = 'cart';
                },
                error: function () {
                    showToast('Failed to add product.', 'bg-red-600');
                }
            });
        });

        // Handle Remove from Cart
        $('.remove-from-cart').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function () {
                    updateCartCount();
                    showToast('Product removed from cart!', 'bg-green-600');
                    location.reload();
                },
                error: function () {
                    showToast('Failed to remove product.', 'bg-red-600');
                }
            });
        });

        // Handle Quantity Update
        $('.update-quantity').click(function () {
            const id = $(this).data('id');
            const action = $(this).data('action');
            $.ajax({
                url: '{{ route('cart.update') }}',
                type: 'POST',
                data: { id: id, action: action, _token: '{{ csrf_token() }}' },
                success: function () {
                    updateCartCount();
                    showToast('Cart updated!', 'bg-green-600');
                    location.reload();
                },
                error: function () {
                    showToast('Failed to update cart.', 'bg-red-600');
                }
            });
        });

        // Handle Checkout
        $('.initiate-checkout').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.checkout_url) {
                        window.location.href = response.checkout_url;
                    } else {
                        showToast('Failed to initiate checkout.', 'bg-red-600');
                    }
                },
                error: function () {
                    showToast('Checkout error. Please try again.', 'bg-red-600');
                }
            });
        });

        // Toast Notification
        function showToast(message, bgClass) {
            const toast = $(`<div class="toast ${bgClass} text-white px-4 py-2 rounded-lg shadow-lg">${message}</div>`);
            $('body').append(toast);
            setTimeout(() => toast.fadeOut('slow', () => toast.remove()), 3000);
        }

        // Auto-hide session toast
        setTimeout(() => $('.toast').fadeOut('slow', () => $('.toast').remove()), 3000);

        // Update active nav item
        $(document).ready(function () {
            const hash = window.location.hash || '#dashboard';
            $('.account-nav-item').removeClass('active');
            $(`.account-nav-item[href="${hash}"]`).addClass('active');
        });
    </script>
</body>
</html>