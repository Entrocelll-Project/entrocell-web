<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/milligram.min.css">
    <link rel="stylesheet" href="assets/css/main.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <title>Entrocell - Login Page</title>
</head>
<body>
    <section class="loginMain">
        <div class="login-form">

            <img src="assets/img/vectorized-white.png" alt="">
    
            <form method="post" id="loginForm">
                <input type="text" id="username" name="username" placeholder="Username" class="u-full-width">
                
                <input type="password" id="password" name="password" placeholder="Password" class="u-full-width">
                
                <div class="login-button-container">
                    <input type="submit" value="Login" class="login-button button-primary u-full-width">
                </div>
            </form>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(e) {
                e.preventDefault(); // Sayfanın yeniden yüklenmesini engelle

                // Form verilerini al
                var username = $('#username').val();
                var password = $('#password').val();

                // AJAX isteği gönder
                $.ajax({
                    type: 'POST',
                    url: 'functions.php',
                    data: { action: 'login', username: username, password: password },
                    success: function(response) {
                        if (response === 'OK') {
                            Swal.fire({
							  title: "Başarılı!",
							  text: "Başarıyla giriş yaptınız!",
							  icon: "success"
							}).then(function (){ window.location.href="dashboard.php";});
                        } else {
                            Swal.fire({
							  title: "Başarısız!",
							  text: "Giriş başarısız!",
							  icon: "error"
							});
                        }
                    },
                    error: function() {
                        alert('Bir hata oluştu.');
                    }
                });
            });
        });
    </script>
</body>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>
