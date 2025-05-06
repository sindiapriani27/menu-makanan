<?php 
require 'proses/init.php'; 

if (isset($_SESSION['is_login'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="vendor/bootstrap4/css/bootstrap.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <title>Login | Resto⭐5</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #8f6ed5, #b8c0ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 40px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.18);
            width: 100%;
            max-width: 400px;
            color: #fff;
        }

        .glass-card h1 {
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-control {
            background-color: rgba(255,255,255,0.2);
            border: none;
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .form-control:focus {
            background-color: rgba(255,255,255,0.25);
            box-shadow: none;
            border: none;
            color: #fff;
        }

        label {
            font-weight: 500;
        }

        .btn-my-color {
            background: #ffffff;
            color: #6c63ff;
            border: none;
            width: 100%;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .btn-my-color:hover {
            background: #6c63ff;
            color: #fff;
        }

        .navbar {
            display: none;
        }

        @media (max-width: 576px) {
            .glass-card {
                margin: 20px;
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="glass-card">
        <h1>Login</h1>
        <form action="proses/login_proses.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
            </div>
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="showPass">
                <label class="custom-control-label" for="showPass">Lihat password</label>
            </div>
            <button type="submit" class="btn btn-my-color" name="login">Login</button>
        </form>
    </div>

    <!-- Jquery -->
    <script src="vendor/Jquery/jquery-3.5.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="vendor/bootstrap4/js/bootstrap.min.js"></script>

    <!-- Show Password Toggle -->
    <script>
        document.getElementById("showPass").addEventListener("change", function () {
            const passwordInput = document.getElementById("password");
            passwordInput.type = this.checked ? "text" : "password";
        });
    </script>
</body>
</html>
