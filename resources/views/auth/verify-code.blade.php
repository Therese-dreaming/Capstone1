<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email | Santa Marta Parish</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white min-h-screen">
    <div class="h-[50px] bg-[#0d5c2f] w-full"></div>
    
    <div class="min-h-[calc(100vh-50px)] p-5 flex items-center justify-center">
        <div class="w-[600px] text-center">
            <h1 class="text-4xl font-bold mb-4">Verify Your Email</h1>
            <p class="mb-6">We've sent a verification code to your email address. Please enter the code below:</p>
            
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verification.verify') }}" class="mb-4">
                @csrf
                <div class="mb-4">
                    <input type="text" name="code" placeholder="Enter 6-digit code" required 
                        class="w-[200px] p-3 border border-[#0d5c2f] rounded text-center text-2xl tracking-wider"
                        maxlength="6" pattern="\d{6}">
                </div>
                
                <button type="submit" 
                    class="w-[200px] p-3 bg-[#0d5c2f] text-white rounded cursor-pointer text-base font-bold hover:bg-[#0d5c2f]/90 block mx-auto">
                    Verify Email
                </button>
            </form>

            <form method="POST" action="{{ route('verification.resend') }}" class="mt-4">
                @csrf
                <button type="submit" class="text-[#0d5c2f] underline">
                    Resend verification code
                </button>
            </form>
        </div>
    </div>
</body>
</html>