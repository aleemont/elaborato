<?php
    if(!session_id()) session_start();

    $user = "root";
    $pass = "Ale-26062002";
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
    <link rel="stylesheet" href="./assets/css/colors.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>ElettroShop</title>
</head>
<body class="bg-white">
    <nav class="navbar navbar-default bg-primary">
        <div class="navbar-brand">
          <a href="index.php" class="h3">Elettro-Shop</a>
        </div>
    </nav>
    <!--Inizializzo la connessione al DB -->
    <?php
        try {
            $dbh = new PDO('mysql:host=localhost;dbname=elaborato', $user, $pass);
      } catch (PDOException $e) {
        print "Errore nella connessione al Database!: " . $e->getMessage() . "<br/>";
        die();
      }
    ?>
    <h1 class="text-primary font-weight-bold">Ordine Confermato</h1>
     <div class="d-flex align-items-center justify-content-center" >
        
        <div class="container bg-success p-5" style="height:85vh; min-width:75%; overflow-y:scroll; border:1px solid black;">
            <?php
                foreach($_SESSION["carrello"] as $elemento){ 
                    $stm = $dbh->prepare("SELECT * FROM Prodotto WHERE ID = ?");
                    $stm->execute([$elemento["ID"]]);
                    $prodotto = $stm->fetch(PDO::FETCH_ASSOC);                
            ?>
            <div class="row" style="border-bottom:1px solid black;">
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                    <img class="img m-3" src="<?php echo $prodotto["Immagine"]; ?> ">
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                    <h3 class="font-weight-bold text-primary"><?php echo $prodotto["Nome"]; ?></h3>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 pt-5 pb-0 mb-0">
                    <h5 class="text-secondary mt-5 mr-2">Selezione: &times;<?php $qty = (int)($_SESSION["price"][$prodotto["ID"]]/$prodotto["Prezzo"]); echo $qty; ?>&nbsp;</h5>
                    <h3 class="text-danger font-weight-bold">Totale: <?php echo $_SESSION["price"][$prodotto["ID"]]; ?>€</h3>
                </div>
            </div>
        <?php
                }
        ?>
        </div>
    </div>
</div>
        </div>        
    </div>
</body>
</html>
