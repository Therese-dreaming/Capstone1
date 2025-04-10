<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function show()
    {
        return view('signup');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        // Generate 6-digit verification code
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode,
            'verification_code_expires_at' => now()->addMinutes(15),
        ]);
    
        try {
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'diocesansaintmartha@gmail.com';
            $mail->Password = 'gatdekuqaumytymt';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            $mail->setFrom('diocesansaintmartha@gmail.com', 'Santa Marta Parish');
            $mail->addAddress($user->email, $user->name);
            
            $mail->isHTML(true);
            $mail->Subject = 'Verify Your Email Address';
            $mail->Body = "
                <h2>Welcome to Santa Marta Parish!</h2>
                <p>Your verification code is:</p>
                <h1 style='color: #0d5c2f; font-size: 32px; letter-spacing: 5px;'>{$verificationCode}</h1>
                <p>This code will expire in 15 minutes.</p>
                <p>If you didn't create an account, please ignore this email.</p>
            ";
    
            $mail->send();
            auth()->login($user);
            return redirect()->route('verification.notice')->with('success', 'Please check your email for the verification code.');
            
        } catch (Exception $e) {
            // Add error logging
            \Log::error('Email sending failed: ' . $e->getMessage());
            return back()->with('error', 'Error sending verification email: ' . $e->getMessage());
        }
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string|size:6'
        ]);

        $user = auth()->user();

        if (!$user || !$user->verification_code) {
            return back()->with('error', 'Invalid verification code.');
        }

        if ($user->verification_code_expires_at < now()) {
            return back()->with('error', 'Verification code has expired. Please request a new one.');
        }

        if ($user->verification_code !== $request->code) {
            return back()->with('error', 'Invalid verification code.');
        }

        $user->email_verified_at = now();
        $user->verification_code = null;
        $user->verification_code_expires_at = null;
        $user->save();

        return redirect()->route('landing')
            ->with('success', 'Email verified successfully!');
    }

    public function resend(Request $request)
    {
        $user = auth()->user();
        
        if ($user->email_verified_at) {
            return redirect()->route('landing');
        }

        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->verification_code = $verificationCode;
        $user->verification_code_expires_at = now()->addMinutes(15);
        $user->save();

        // Resend email with new code...
        // (Similar email sending code as in register method)

        return back()->with('success', 'Verification code resent!');
    }
}
