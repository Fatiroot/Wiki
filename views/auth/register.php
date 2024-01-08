<?php
require_once __DIR__ . '/../../vendor/autoload.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" defer></script>
    <link rel="stylesheet" href="/wiki/app/routes/../../public/css/register.css">
</head>
<body>
   

    <section class="sign-up">
        <div class="sign-up-container">
            <h1>Register</h1>
            <form id="form" method="post" action="register" >
                <label for="form-username"> User Name</label>
                <div class="form-controls">
                    <input type="text" name="username" id="form-username" placeholder="Your First and last name" class="input-pd">
                    <small>Error message</small>
                </div>

                <label for="form-email">Email</label>
                <div class="form-controls">
                    <input type="text" name="email" id="form-email" placeholder="Your Email" class="input-pd">
                    <small>Error message</small>
                </div>
                <label for="form-phone">Phone</label>
                <div class="form-controls">
                    <input type="text" name="phone" id="form-phone" placeholder="Your phone" class="input-pd">
                    <small>Error message</small>
                </div>

                <label for="form-password">Password</label>
                <div class="form-controls">
                    <input type="password" name="password" id="form-password" placeholder="at least 8 characters" class="input-pd">
                    <p class="form-control-caracter">Passwords must be at least 8 characters</p>
                    <small>Error message</small>
                </div>

                <label for="form-confirmed-password">Re-enter password</label>
                <div class="form-controls">
                    <input type="password" name="c_password" id="form-confirmed-password" class="input-pd">
                    <small>Error message</small>
                </div>
                <span class="text-danger">
       
</span>
                <button  name="register" id="submit">Register</button>
            </form>
            <p class="signin-link">Already have an account? <a href="login">Sign in</a></p>
        </div>
    </section>

   
    <script src="/wiki/app/routes/../../public/js/sign_up.js"></script>
</body>
</html>