<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Awan Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background-color: #0E0E10;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .card {
            background: #1F1F23;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            width: 350px;
        }
        h1 {
            color: #FF5E9D;
            margin-bottom: 1.5rem;
            font-weight: 600;
            text-align: center;
        }
        .input-group {
            margin-bottom: 1rem;
        }
        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #B9B9B9;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 6px;
            background: #26262B;
            color: #fff;
        }
        input:focus {
            outline: 2px solid #FF5E9D;
        }
        button {
            background-color: #FF5E9D;
            color: #fff;
            border: none;
            padding: 0.8rem 0;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: 600;
            margin-top: 1rem;
        }
        button:hover {
            background-color: #D24C85;
        }
        .text-link {
            margin-top: 1rem;
            color: #B9B9B9;
            font-size: 0.9rem;
            text-align: center;
        }
        a {
            color: #FF5E9D;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>Daftar Akun Baru</h1>

            <form method="POST" action="/register">
                @csrf
                <!-- Nama -->
                <div class="input-group">
                    <label for="name">Nama Lengkap</label>
                    <input id="name" type="text" name="name" required placeholder="Masukkan nama Anda">
                </div>

                <!-- Email -->
                <div class="input-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" required placeholder="Masukkan email Anda">
                </div>

                <!-- Password -->
                <div class="input-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required placeholder="Masukkan password Anda">
                </div>

                <!-- Confirm Password -->
                <div class="input-group">
                    <label for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Ulangi password Anda">
                </div>

                <!-- Submit Button -->
                <button type="submit">Daftar</button>
            </form>

            <div class="text-link">
                Sudah punya akun? <a href="/login">Login Sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>
