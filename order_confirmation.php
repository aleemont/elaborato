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
            print "Errore nella connessione al Database!: " . $e->getMessage() . "<br/>";
            die();
        }
        $stm = $dbh->prepare("SELECT * from Prodotto where ID = ?");
        $stm -> execute([$_SESSION["order"]]);
        $SRC = $stm->fetch(PDO::FETCH_ASSOC);
        $stm = null;
        $stm = $dbh->prepare("SELECT Produttore,Serie,Modello,Cores,Threads,Frequenza FROM CPU WHERE ID = ?");
        $stm->execute([$SRC["CPU"]]);
        $CPU = $stm->fetch(PDO::FETCH_ASSOC);
        $stm = null;
        $stm = $dbh->prepare("SELECT Dimensione,Tipo FROM RAM WHERE ID = ?");
        $stm->execute([$SRC["RAM"]]);
        $RAM = $stm->fetch(PDO::FETCH_ASSOC);
        $stm = null;
        $stm = $dbh->prepare("SELECT Dimensione,Tipo,Modello FROM Disco WHERE ID = ?");
        $stm->execute([$SRC["Disco"]]);
        $Disco = $stm->fetch(PDO::FETCH_ASSOC);
        $stm = null;
    ?>
    <div class="d-flex align-items-center justify-content-center" style="min-height:85vh; min-width:100%">
        <div class="container bg-success p-5">
            <div class="row d-flex justify-content-center">
            <h2 class="col-12">Ordine confermato:</h2>
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                        <div class="m-5"><img class="img img-fluid" src="<?php echo $SRC["Immagine"]; ?>" alt = "IMG"/></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <h2 class="mt-5 text-primary font-weight-bold"><?php echo $SRC["Nome"] ?></h2>
                        <br>
                        <h6 class="text-secondary border border-secondary pt-5 pb-5 pl-2">
                            <?php
                                echo $CPU["Produttore"]." ".$CPU["Serie"]." ".$CPU["Modello"]." ".$CPU["Cores"]."C/".$CPU["Threads"]."T @ ".$CPU["Frequenza"];
                            ?>
                            <br>
                            <?php
                            echo $RAM["Dimensione"]."GB ".$RAM["Tipo"];
                            ?>
                            <br>
                            <?php
                            echo $Disco["Tipo"]." ".$Disco["Dimensione"]."GB";
                            ?>
                        </h6>
                </div>
                <div class="col-12 mt-3 d-flex justify-content-end">
                    <?php
                        if(isset($_SESSION["qty"][$SRC["ID"]]))
                        { 
                    ?>    
                    <h5 class="text-secondary mt-1 mr-3">Selezione: &times;<?php echo $_SESSION["qty"][$SRC["ID"]]?>&nbsp;</h5>
                    <h2 class="text-danger font-weight-bold">Totale: <?php echo $_SESSION["prezzo"]; ?>€</h2>
                </div>
                <div class="col-12 mt-4 d-flex align-items-end justify-content-end">
                    <a href="index.php" class="btn btn-primary mr-1">Torna al catalogo</a>
                    <a href="order.php?order=<?php echo $SRC["ID"]; ?>" class="btn bt-orange">Chiudi</a>
                    <?php
                        } else{
                            exit("Si è verificato un errore imprevisto, per favore ricarica la pagina. Se l'errore persiste contatta l'Assistenza");
                        }
                    ?>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>