<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Control De Maquinas</title>

    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/style.css">

</head>

<body background="form-wizard-bg.jpg">



    <div class="container">
        <div id="login"></div>

        <div class="row justify-content-center align-items-center min-vh-100">
            <div id="login-box" class="col-12 col-md-8 col-lg-6">
                <center>
                    <img src="Logo-Primario (1).png" style="max-height: 84px;">
                </center>
                <br>
                <h2 class="text-center">ENTRAR</h2>



                <div id="alert">
                </div>
                <form class="row g-3 needs-validation" novalidate id="loginForm" name="loginData">


                    <div class="form-group">
                        <label for="usuario" class="form-label">Usuario</label>
                        <input type="text" id="usuario" placeholder="ingresa tu usuario" name="usuario" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" placeholder="ingresa tu contraseña" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">ACCEDER</button>
                    </div>
                </form>
                <br>

                <!--<p class="text-center"> <a href="../recovery.php">olvidaste tu contraseña</a></p>-->
            </div>
        </div>
    </div>


    <script src="../../js/login.js"></script>
</body>

</html>