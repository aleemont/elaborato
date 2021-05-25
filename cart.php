<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="author" content="Alessandro Monticelli">
    <meta name="description" content="I tuoi prodotti high-tech preferiti, da Elettro-Shop">
    <meta name="robots" content="all | none | index | noindex | follow | nofollow">
    <meta name="dc.language" content="ita" scheme="RFC1766">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/colors.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>ElettroShop</title>
</head>
<body>
    <nav class="navbar navbar-default bg-primary">
        <div class="navbar-brand">
          <a href="index.php" class="h3">Elettro-Shop</a>
        </div>
    </nav>
    <!--Inizializzo la connessione al DB -->
    <?php
      $user = "root";
      $pass = "Ale-26062002";
      try {
        $dbh = new PDO('mysql:host=localhost;dbname=elaborato', $user, $pass);
      } catch (PDOException $e) {
        print "Errore nella connessione al DataBase!: " . $e->getMessage() . "<br/>";
        die();
      }
    ?>
    <div class="container">
      <div class="d-flex align-items-center justify-content-center">
        <div class="w-100 m-5 bg-primary" style="height:60vh;">
            <div class="row p-4">
                <div class="col-10 bg-secondary">
                    
                </div>
                <div class="col-2 bg-success">
                    <div class="row">
                        <div class="col-6">
                        
                        </div>
                        <div class="col-6">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</body>
</html>