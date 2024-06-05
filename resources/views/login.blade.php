<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
        }

        .login-container {
            display: flex;
            width: 60%;
            height: 60%;
            max-width: 100%; /* Membuat lebar maksimum */
            height: 100vh; /* Mengisi tinggi seluruh halaman */
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-image {
            flex: 1 ;
            width: 300px; /* Atur lebar sesuai kebutuhan */
            background-size: cover;
            background-position: center;
            height: 100%; /* Mengisi tinggi seluruh halaman */
        }

        .login-form {
            flex:1 auto; /* Mengatur lebar formulir agar tidak 50-50 */
            display: flex; /* Menjadikan konten flex */
            flex-direction: column; /* Membuat konten menjadi kolom */
            justify-content: center; /* Menyusun konten secara vertikal */
            padding: 100px;
            background-color: #fff;
            max-width: 800px; /* Menetapkan lebar maksimum formulir */
        }

        .login-form .info {
            text-align:left;
            margin-bottom: 80px;
            margin-top: 100px;
        }

        .login-form .info a {
            font-family: 'Nunito Sans', sans-serif;
            font-size: 48px;
            font-weight: bold;
            color: #424874;
            display: block; /* Membuat tautan menjadi blok */
            margin-bottom: 50px;
        }

        .login-form h2 {
            margin-bottom: 20px;
            color: #424874;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 20px;
            box-sizing: border-box;
        }

        .login-form input[type="checkbox"]{
            margin-bottom: 10px;
            color:#424874;
        }

        .login-form label {
            margin-bottom: 10px;
        }

        .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #424874;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #2c2e63;
        }
       
        .password-container {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 37%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .toggle-password:hover {
            color: #666; /* Warna ketika ikon dihover */
        }
    </style>
</head>
<body>
    <div class="login-container">
        {{-- <img src="{{asset('adminlte/dist/img/RTplakat.jpg')}}" class="login-image"> --}}
        <img src="{{asset('adminlte/dist/img/rt.webp')}}" class="login-image">
        </div>
        <div class="login-form">
            
            <div class="info">
                <a class="d-block">Sistem Informasi<br>RT Online</a>
            </div>
            <h2>Masuk</h2>
            @if ($errors->any())
                <div class="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{url('dashboard')}}" method="POST">
                @csrf
                <input type="text" name="family_number" placeholder="Nomor Kartu Keluarga" required>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="Sandi" required>
                    <i class="toggle-password fas fa-eye-slash"></i>
                </div>
                <input type="checkbox" name="remember"> Ingatkan Saya
                <button type="submit">Masuk</button>
            </form>
        </div>
        
    </div>
</body>
</html>
<script>
    document.querySelector('.toggle-password').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      // Ubah ikon mata
      this.classList.toggle('fa-eye');
      this.classList.toggle('fa-eye-slash');
    });
</script>

