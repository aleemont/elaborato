<?php
include("init.php");
session_start();


$total_price = 0;

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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="stylesheet" href="./assets/css/colors.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>ElettroShop</title>
</head>
<body>
    <nav class="navbar navbar-default bg-primary">
        <div class="navbar-brand">
          <a href="index.php" class="h3">Elettro-Shop</a>
        </div>
        <div class="d-flex align-items-center justify-content-end">
        <?php
          if(!empty($_SESSION["carrello"])) {
          $cart_count = count(array_keys($_SESSION["carrello"]));
          }
        ?>
        <a href="carrello.php"><span class="material-icons" style="color:white;">shopping_cart</span><?php echo $cart_count; ?></a>
        </div>
    </nav>
    <div class="container">
      <div class="card rounded mt-3" style="height: 85vh;  overflow-y:scroll; overflow-x:hidden">
            <div class="container">
                <?php 
                    $count = 0;
                    foreach($_SESSION["carrello"] as $pid){
                        $stm = $dbh->prepare("SELECT * FROM Prodotto WHERE ID = ?");
                        $stm->execute([$pid["ID"]]);
                        $prodotto = $stm->fetch(PDO::FETCH_BOTH);
                ?>
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-lg-3 col-5 mr-3"><img class="img img-fluid" src="<?php echo $prodotto["Immagine"]; ?>"/></div>
                    <div class="pt-5 col-md-2 col-4 mr-3"><h5 class="text-secondary mt-3"><?php echo $prodotto["Nome"] ?></h5></div>
                    <div class="col-md-2 col-4">
                    <form action="" method="POST" class="ml-3 mr-3">
                            <select name="magazzino" class="w-100 mt-5 mb-2 rounded p-2 bg-white">
                                <option disabled selected hidden>Magazzino</option>
                                <option value="1">Milano</option>
                                <option value="2">Genova</option>
                                <option value="3">Bologna</option>
                                <option value="4">Napoli</option>
                                <option value="5">Verona</option>
                                <option value="6">Bari</option>
                            </select>
                            <form method='post' action=''>
                                <select name="quantity" onChange="this.form.submit()" class="w-100 mb-2 rounded p-2 bg-white">
                                    <option value="Quantità" selected disabled>Quantità</option>
                                    <?php
                                        
                                        for($i=1;$i<=20;$i++){
                                    ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i ?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <input type='hidden' name='code' value="<?php echo $pid["ID"]; ?>" />
                                <input type='hidden' name='action' value="change" />
                            </form>
                            <form action="" method="post" class="mb-5 mr-3">
                                <input type='hidden' name='code' value="<?php echo $pid["ID"]; ?>" />
                                <input type='hidden' name='action' value="remove" />
                                <button type='submit' class='btn btn-danger w-100 mr-3'>Rimuovi</button>                            
                            </form>
                        <?php

                             $_SESSION["price"][$pid["ID"]] = $prodotto["Prezzo"];
                             if (isset($_POST['remove']) && $_POST['remove']=="remove"){
                                if(!empty($_SESSION["carrello"])){
                                    foreach($_SESSION["carrello"] as $k=>$v){
                                        if($_POST["id"] == $v["ID"]){
                                            unset($_SESSION["carrello"][$k]);
                                        }
                                    }
                                    if(empty($_SESSION["carrello"]))
                                        unset($_SESSION["carrello"]);
                                    }
                                    header("Location: carrello.php");
                                }
                                if (isset($_POST['action']) && $_POST['action']=="change"){
                                  foreach($_SESSION["carrello"] as &$value){
                                    if($value['ID'] == $_POST["code"]){
                                        $value['quantity'] = $_POST["quantity"];
                                        break; // Stop the loop after we've found the product
                                    }
                                }
                                $_SESSION["price"][$pid["ID"]] = (float)$prodotto["Prezzo"]*$_SESSION["carrello"][$count]["quantity"];
                                      
                                }
                        ?>
                    </div>
                    <div class="col-md-2 col-4">
                        <h5 class="text-secondary mt-1 mr-3">Selezione: &times;<?php echo $_SESSION["carrello"][$count]["quantity"];?>&nbsp;</h5>
                        <h3 class="text-danger font-weight-bold">Totale: <?php echo $_SESSION["price"][$pid["ID"]]; ?>€</h3>
                    </div>
                </div>
                <?php 
                        $count += 1;
                    }
                ?>
                <div class="w-100 d-flex align-items-center justify-content-center">
                    <?php 
                        $total_price = (float)0.0;
                        foreach($_SESSION["price"] as $p){
                            $total_price = (float)$total_price + $p;
                        }?>
                    </div>
                    <div class="bg-white" style="position:sticky; top:0;">
                        <div class="w-100 d-flex align-items-center justify-content-end pr-4">
                            <h2 class="text-secondary font-weight-bold">Totale carrello: <?php echo $total_price; ?>€</h2>
                        </div>
                        
                        <div class="w-100 d-flex align-items-center justify-content-center">
                            <form action="" method="post" class="mb-5">
                                <button type="submit" name ="svuota" value="svuota" class="btn btn-danger mb-1 w-100 mr-1">Svuota carrello</button>
                            </form>
                            <form action="login.php?cart=true" method="post" class="mb-5">
                                <button type="submit" name="compra" value="compra" class="btn bt-orange mb-1 w-100 ml-1">Procedi all'ordine</button>
                            </form>
                        </div>
                        <?php
                            if (isset($_POST['svuota']) && $_POST['svuota']=="svuota"){
                                if(!empty($_SESSION["carrello"])){
                                    unset($_SESSION["carrello"]);
                                    header("location: carrello.php");
                                }
                                header("location: carrello.php");
                            }
                        ?>
                    </div>
            </div>
      </div>
    </div>
</body>
</html>

