<?php 
    include("init.php");
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
    <div class="container rounded mt-5">
    <h1 class="text-secondary ml-5 font-weight-bold">Dati di pagamento</h1>
    <form action="<?php if(isset($_GET['order']))
                        {
                          echo "order_confirmation.php?order=".$_GET['order'];} 
                            else if(isset($_GET['cart']) && $_GET['cart'] == true)
                            {
                               echo "cart_confirmation.php"; 
                               }?>" method="POST" class="ml-5">
        <input type="text" name="nome" placeholder="Nome" class="p-2 m-1 rounded w-md-25 w-sm-75 " required/><br>
        <input type="text" name="cognome" placeholder="Cognome" class="p-2 m-1 rounded w-md-25 w-sm-75" required/><br>
        <input type="text" name="codFis" placeholder="Codice Fiscale" class="p-2 m-1 rounded w-md-25 w-sm-75 " required/><br>
        <input type="email" name="email" placeholder="email" class="p-2 m-1 rounded w-md-25 w-sm-75 " required/><br>
        <input type="text" name="address" placeholder="Via" class="p-2 m-1 rounded" required/><br>
        <input type="text" name="nCivico" placeholder="N.Civico" class="p-2 mr-0 mt-1 ml-1 rounded" style="width:11%" required/>
        <input type="text" name="cap" placeholder="CAP" class="p-2 ml-0 mt-1 mr-1 mb-1 rounded" style="width:10%" required/><br>
        <input type="text" name="card" placeholder="N.Carta (XXXXYYYYZZZZAAAA)" 
          path="(^4[0-9]{12}(?:[0-9]{3})?$)|(^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$)|(3[47][0-9]{13})|(^3(?:0[0-5]|[68][0-9])[0-9]{11}$)|(^6(?:011|5[0-9]{2})[0-9]{12}$)|(^(?:2131|1800|35\d{3})\d{11}$)"
          class="p-2 m-1 rounded  w-md-25 w-50 " required/><br>
        <input type="text" name="cvv" placeholder="CVV" class="p-2 m-1 rounded" style="width:10%;" required/><br>
        <input type="text" name="card-name" placeholder="Nome Intestatario" class="p-2 m-1 rounded w-md-25 w-50" required/><br>
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