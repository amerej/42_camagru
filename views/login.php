<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" lang="en">
        <meta name="viewport" content="width=device-width, maximum-scale=1">
        <title>Camagru - Login</title>
        <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Pacifico|Passion+One|Raleway" rel="stylesheet" type="text/css">    
        <link rel="stylesheet" type="text/css" href="resources/css/style.css">
    </head>

    <body>
        <section class="login-form">
            <h1>Login</h1>
            <div>
                <form method="POST" action="login.php">
                    <div>
                        <input type="text" name="username" required><br><br>
                        <input type="password" name="password" required><br><br>
                        <div id="submit"><input type="submit" /></div>
                    </div>

                    <div>
                        <span class="password">Forgot <a href="#">password ?</a></span>
                        <span>New user ? <a href="signin.php">sign in</a></span>
                    </div>
                </form>
            </div>
        </section>
    </body>
</html>
