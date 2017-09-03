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
        <div>
            <h3>Sign in</h3>
            <form action="signin.php">
                <div class="container">
                    <label>Username</label><br>
                    <input type="text" name="username" required><br>
                    <label>Email</label><br>
                    <input type="text" name="email" required><br>
                    <label>Password</label><br>
                    <input type="password" name="password" required><br>
                    <button type="submit">Sign in</button>
                    <div>
                        <span>Already user ? <a href="login.php">login</a></span>
                    </div>

                    <?php if (isset($_GET['username']) && $_GET['username'] == 'exists') : ?>
                        <p>Username already exists ! Choose another.</p>
                    <?php endif; ?>
                    <?php if (isset($_GET['email']) && $_GET['email'] == 'exists') : ?>
                        <p>Email already exists ! Choose another.</p>
                    <?php endif; ?>
                    <?php if (isset($_GET['password']) && $_GET['password'] == 'weak') : ?>
                        <p>Password too weak ! Need at least 8 characters, must include one number and one letter.</p>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </body>
</html>
