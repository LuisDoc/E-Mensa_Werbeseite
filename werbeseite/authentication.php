
<?php
/**
 * Praktikum DBWT. Autoren:
 * Luis, Diniz Do Carmo, 3275829
 * Nilusche, Liyanaarachchi, 3272466
 */

?>

<!DOCTYPE html>
<html lang=de dir="ltr">
<head>
    <!-- Einstellung Charset -->
    <meta charset="utf-8">
    <!-- Titel der Webseite unter Tabs-->
    <title>Ihre E-Mensa</title>
    <!-- Einbindung von Stylesheet und fonts/sources-->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
</head>
<body>
<?php
    
    include ("includes/header.inc.php");
?>




<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <form action="includes/signup.inc.php" method="POST">
            <h2 class="text-left" >SIGN UP</h2>
                <div class="container">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="submit" class="btn btn-danger">Signup</button>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-lg-6">
            <form action="includes/login.inc.php" method="POST">
            <h2 class="text-left" >LOGIN IN</h2>
                <div class="container">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email"  placeholder="email" >
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control"name="password"  placeholder="password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="submit" class="btn btn-danger">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>   
</div>


</body>
</html>
