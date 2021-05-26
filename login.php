<?php 
    if(!session_id()) session_start();
?>

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
    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--CSS-->
    <link rel="stylesheet" href="./assets/css/colors.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>ElettroShop</title>
</head>
<body class="d-flex align-items-center justify-content-center pt-5">
    <nav class="navbar navbar-default bg-primary w-100" style="position:absolute; top:0px;">
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
        print "Errore nella connessione al Database!: " . $e->getMessage() . "<br/>";
        die();
      }
    ?>
    <div class="container rounded mt-5">
    <h1 class="text-secondary ml-5 font-weight-bold">Dati di pagamento</h1>
    <form action="order_confirmation.php?order=<?php echo $_GET['order']?>" method="POST" class="ml-5">
        <input type="text" name="nome" placeholder="Nome" class="p-2 m-1 rounded w-md-25 w-sm-75 " required/>
        <input type="text" name="cognome" placeholder="Cognome" class="p-2 m-1 rounded w-md-25 w-sm-75" required/><br>
        <input type="text" name="codFis" placeholder="Codice Fiscale" class="p-2 m-1 rounded w-50 " required/><br>
        <input type="email" name="email" placeholder="email" class="p-2 m-1 rounded w-md-50 w-wm-75 " required/><br>
        <input type="text" name="address" placeholder="Via" class="p-2 m-1 rounded w-md-50 w-sm-75 " required/><br>
        <input type="text" name="nCivico" placeholder="N.Civico" class="p-2 mr-0 mt-1 ml-1 rounded w-25" required/>
        <input type="text" name="cap" placeholder="CAP" class="p-2 ml-0 mt-1 mr-1 mb-1 rounded" style="width:24.5%;"required/><br>
        <input type="text" name="card" placeholder="N.Carta (XXXX-XXXX-XXXX-XXXX)" class="p-2 m-1 rounded w-md-50 w-75 " required/><br>
        <input type="text" name="cap" placeholder="CVV" class="p-2 m-1 rounded w-md-50 w-75 " required/><br>
        <input type="text" name="cap" placeholder="Nome Intestatario" class="p-2 m-1 rounded w-md-50 w-75 " required/><br>
        <input type="submit" name="submit" value="Invia" class=" ml-1 mt-2 btn btn-secondary w-md-50 w-75 "/><br>
        <div class="m-1 d-flex justify-content-end w-md-50 w-75 " style="font-size:23px;">
            <i class="fa fa-cc-amex m-1"></i>
            <i class="fa fa-cc-mastercard m-1"></i>
            <i class="fa fa-cc-paypal m-1"></i>
            <i class="fa fa-cc-visa m-1"></i>
            <i class="fa fa-credit-card m-1"></i>
        </div>
    </form>
    </div>
</body>
</html>