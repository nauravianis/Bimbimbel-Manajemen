<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bimbimbel</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6f5aa8 0%, #3b82f6 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
        }

        .main-container {
            display: flex;
            width: 90%;
            max-width: 1100px;
            min-height: 600px;
            color: white;
            z-index: 1;
        }

        .left-side {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 50px;
        }

        .welcome-text h1 {
            font-size: clamp(32px, 5vw, 48px);
            margin-bottom: 15px;
        }

        .subtitle {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .description {
            font-size: 14px;
            line-height: 1.6;
            opacity: 0.8;
            max-width: 400px;
        }

        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 2;
        }

        .login-card {
            background: white;
            color: #333;
            padding: 40px;
            border-radius: 24px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .login-card h2 {
            font-size: 24px;
            margin-bottom: 8px;
        }

        .trial-text {
            font-size: 13px;
            color: #777;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 15px;
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 14px 20px;
            border: 1px solid #ddd;
            border-radius: 30px;
            outline: none;
            font-size: 14px;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #6f5aa8;
            box-shadow: 0 0 5px rgba(111, 90, 168, 0.3);
        }

        .alert-error {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 10px;
            border-radius: 12px;
            font-size: 12px;
            margin-bottom: 15px;
            text-align: left;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #6f5aa8;
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            margin-bottom: 20px;
            display: block;
        }

        .btn-login:hover {
            background: #5a4891;
            transform: translateY(-2px);
        }

        .footer-text {
            font-size: 13px;
            color: #555;
        }

        .footer-text a {
            color: #6f5aa8;
            text-decoration: none;
            font-weight: 700;
        }

        @media (max-width: 850px) {
            .left-side { display: none; }
            .main-container { 
                justify-content: center; 
                height: auto;
            }
            body { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="left-side">
            <div class="brand">
                <i class="fa-solid fa-square-check"></i>
                <span>Bimbimbel</span>
            </div>
            
            <div class="welcome-text">
                <h1>Hey, Hello!</h1>
                <p class="subtitle">Kelola sistem admin Bimbimbelmu!</p>
                <p class="description">
                    Mari kelola dengan baik dan jujur sistem ini agar pendidikan semakin baik.
                </p>
            </div>
        </div>

        <div class="right-side">
            <div class="login-card">
                <h2>Welcome Back</h2>
                <p class="trial-text">Silahkan login admin bimbimbel.</p>

                @if(session('error'))
                    <div class="alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-error">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                    </div>

                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>