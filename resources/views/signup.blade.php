<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create An Account | Church</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white min-h-screen">
    <div class="h-[50px] bg-[#0d5c2f] w-full"></div>
    
    <div class="flex min-h-[calc(100vh-50px)] p-5">
        <div class="flex-1 flex items-center justify-center">
            <div class="w-[600px]">
                <h1 class="text-6xl font-bold mb-8 text-center">Create An Account</h1>
                <form class="flex flex-col items-center">
                    <input type="text" placeholder="Name" required 
                        class="w-[400px] p-3 mb-4 border border-[#0d5c2f] rounded text-base">
                    <input type="email" placeholder="Email" required 
                        class="w-[400px] p-3 mb-4 border border-[#0d5c2f] rounded text-base">
                    <input type="password" placeholder="Password" required 
                        class="w-[400px] p-3 mb-4 border border-[#0d5c2f] rounded text-base">
                    <button type="submit" 
                        class="w-[200px] p-3 bg-[#0d5c2f] text-white rounded cursor-pointer text-base font-bold">
                        SIGNUP
                    </button>
                </form>
                <div class="h-[2px] bg-[#0d5c2f] my-6"></div>
                <p class="text-center text-m">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-[#0d5c2f] no-underline font-bold">LOG IN</a>
                </p>
            </div>
        </div>
        
        <div class="flex-1 flex items-center justify-center">
            <img src="{{ asset('images/login-bg.png') }}" alt="Church" class="w-[60%] h-auto">
        </div>
    </div>
</body>
</html>