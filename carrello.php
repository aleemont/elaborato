<?php
session_start();

if(isset($_SESSION["carrello"])){
    $total_price = 0;
}
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
        <table class="table table-hover">
            <tbody>
                <?php 
                    $count = 0;
                    $c = 0;
                    foreach($_SESSION["carrello"] as $pid){
                        $count = $count+1;
                        $stm = $dbh->prepare("SELECT * FROM Prodotto WHERE ID = ?");
                        $stm->execute([$pid["ID"]]);
                        $prodotto = $stm->fetch(PDO::FETCH_BOTH);
                    
                ?>
                <tr>
                    <td><img class="img" src="<?php echo $prodotto["Immagine"]; ?>"/></td>
                    <td class="pt-5"><h5 class="text-secondary mt-3"><?php echo $prodotto["Nome"] ?></h5>
                    <td>
                        <form action="" method="POST" class="w-100">
                            <input type="number" name="<?php echo $pid["ID"] ?>" min="1" max="20" value="1" step="1" placeholder="Quantità (max. 20)" class="w-100 mt-5 mb-2 rounded p-2">
                            <select name="magazzino" class="w-100 mt-2 mb-2 rounded p-2 bg-white">
                                <option disabled selected hidden>Magazzino</option>
                                <option value="1">Milano</option>
                                <option value="2">Genova</option>
                                <option value="3">Bologna</option>
                                <option value="4">Napoli</option>
                                <option value="5">Verona</option>
                                <option value="6">Bari</option>
                            </select>
                            <input type="submit" name="submit" value="Conferma" class="btn btn-secondary w-100"/>
                        </form>
                        <form action="" method="post" class="mb-5">
                            <input type='hidden' name='id' value="<?php echo $prodotto["ID"]; ?>" />
                            <button type="submit" name ="remove" value="remove" class="btn btn-danger mt-1 w-100">Rimuovi</button>
                        </form>
                        <?php
                            if(!$_POST[$pid["ID"]]){
                                $_POST[$pid["ID"]] = $_SESSION["qty"][$count];
                            }
                                if (isset($_POST['submit'])) {
                                    $_SESSION["qty"][$count] = $_POST[$pid["ID"]];
                                }
                            $_SESSION["price"][$pid["ID"]] = (double)$prodotto["Prezzo"] * $_SESSION["qty"][$count];
                            
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
                                }
                        ?>
                    </td>
                    <td>
                        <h5 class="text-secondary mt-1 mr-3">Selezione: &times;<?php echo $_SESSION["qty"][$count]?>&nbsp;</h5>
                        <h3 class="text-danger font-weight-bold">Totale: <?php echo $_SESSION["price"][$pid["ID"]]; ?>€</h3>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</body>
</html>

