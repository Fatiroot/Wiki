<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/wiki/app/routes/../../public/css/auth.css">

</head>
<body>

    <section class="sign-up sign-in d-flex align-item-center justify-content-center">
        <div class="sign-up-container">
            <h1>Login in</h1>
            <form id="form" method="post" action='login' >
            <?php
                session_start();
                if (isset($_SESSION['login_error'])) {
                    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['login_error'] . '</div>';
                    unset($_SESSION['login_error']); 
                }
                ?>
                <label for="form-email">Email</label>
                <div class="form-controls">
                    <input type="text" name="email" id="form-email" placeholder="Your Email" class="input-pd">
                    <small>Error message</small>
                </div>
                <label for="form-password">Password</label>
                <div class="form-controls">
                    <input type="password" name="password" id="form-password" placeholder="at least 8 characters" class="input-pd">
                    <p class="form-control-caracter d-none">Passwords must be at least 8 characters</p>
                    <small>Error message</small>
                </div>
                <span class="text-danger">
              
           </span>   
             <button  name="login" id="submit">Sign in</button>
            </form>
            <p class="signin-link">Don't have an account?<a href="register"> Sign up</a></p>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" ></script>
    <script src="/wiki/app/routes/../../public/js/sign_up.js"></script>

</body>
</html>