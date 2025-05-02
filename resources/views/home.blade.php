<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Cleanez</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tailwind CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white text-gray-800">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-red-600">Cleanez</div>
            <div>
                <a href="#" class="text-gray-700 hover:text-red-600 font-medium mr-4">Home</a>
                <a href="#" class="text-gray-700 hover:text-red-600 font-medium mr-4">About</a>
                <a href="#" class="text-gray-700 hover:text-red-600 font-medium mr-4">Services</a>
                <a href="#" class="text-white bg-red-600 hover:bg-red-700 font-semibold py-2 px-4 rounded transition">Login</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-red-500 to-red-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to Cleanez</h1>
            <p class="text-lg md:text-xl mb-6">Your trusted platform for scheduling reliable and professional cleaning services.</p>
            <a href="#" class="bg-white text-red-600 hover:text-red-700 font-semibold py-3 px-6 rounded-xl shadow transition">
                Get Started
            </a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-10">Why Choose Cleanez?</h2>
            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-red-600 mb-2">Trusted Cleaners</h3>
                    <p>All our cleaners go through strict background checks and training before joining our team.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-red-600 mb-2">Flexible Scheduling</h3>
                    <p>Book your preferred cleaning time and frequency—weekly, bi-weekly, or one-time.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-red-600 mb-2">Secure Payments</h3>
                    <p>Pay online securely and easily, with full transparency and detailed records.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-red-600 text-white py-12">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Ready to make your space sparkle?</h2>
            <p class="mb-6">Join Cleanez today and enjoy hassle-free cleaning at your convenience.</p>
            <a href="#" class="bg-white text-red-600 hover:text-red-700 font-semibold py-3 px-6 rounded-xl shadow transition">
                Sign Up Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white border-t mt-16 py-6 text-center text-sm text-gray-600">
        &copy; {{ date('Y') }} Cleanez. All rights reserved.
    </footer>
</body>
</html>
