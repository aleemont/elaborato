<?php
session_start();
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
<body class="bg-success">
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
    <div class="d-flex align-items-center justify-content-center" style="min-height:85vh; min-width:100%" id="main">
        <div class="container bg-white p-5">
            <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                        <?php
                            $_SESSION["order"] = $_GET["order"];
                            $stm = $dbh->prepare("SELECT * from Prodotto where ID = ?");
                            $stm -> execute([$_SESSION["order"]]);
                            $SRC = $stm->fetch(PDO::FETCH_ASSOC);
                            $stm = null;
                        ?>
                        <div class="m-5"><img class="img img-fluid" src="<?php echo $SRC["Immagine"]; ?>" alt = "IMG"/></div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <h2 class="mt-5 text-primary font-weight-bold"><?php echo $SRC["Nome"] ?></h2>
                        <br>
                        <?php 
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
                    <div class="col-lg-4 col-md-12 col-sm-12 d-flex align-items-start justify-content-center">
                        <div class="row">
                            <div class="col-12">
                                <form action="" method="POST" class="w-100 mb-5">
                                    <input type="number" name="quantità" min="1" max="20" value="1" step="1" placeholder="Quantità (max. 20)" class="w-100 mt-5 mb-2 rounded p-2">
                                    <input type="submit" name="submit" value="Conferma" class="btn btn-secondary w-100"/>
                                </form>
                            </div>
                            <?php
                                $qty = 1;
                                if (isset($_POST['submit'])) {
                                    $_SESSION["qty"] =  $_POST["quantità"];
                                }
                                $_SESSION["prezzo"] = (double)$SRC["Prezzo"] * $_SESSION["qty"]; 
                            ?>
                            
                            <div class="col-12 mt-3 d-flex justify-content-end">
                            <?php if(isset($qty))
                            { ?>    
                                <h4 class="text-secondary mt-1 mr-3">Selezione: &times;<?php echo $_SESSION["qty"]?>&nbsp;</h4>
                                <h3 class="text-danger font-weight-bold">Totale: <?php echo $_SESSION["prezzo"]; ?>€</h3>
                            </div>
                            <div class="col-12 mt-4 d-flex align-items-end justify-content-end">
                                <form action="" method="POST" class="w-100">
                                    <input type="submit" name="ordina" value="Checkout" class="btn bt-orange w-100" onSubmit="showDialog()"/>
                                </form>
                                <?php
                            } else{
                                exit("Si è verificato un errore imprevisto, per favore ricarica la pagina. Se l'errore persiste contatta l'Assistenza");
                            }
                            ?>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php
            if (isset($_POST['ordina'])){
                
        ?>
       <div class="d-flex align-items-center justify-content-center" style="position:absolute; top:6.1%; min-height:100vh; min-width:100%">
        <div class="container bg-success p-5 w-100" style="min-height:65rem">
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
                        if(isset($qty))
                        { 
                    ?>    
                    <h4 class="text-secondary mt-1 mr-3">Selezione: &times;<?php echo $_SESSION["qty"]?>&nbsp;</h4>
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
        <?php
            }
        ?>
        </div>
        
    </div>
    <script>
        function showDialog() {
            document.getElementById("main").style.display=none;
        }
    </script>
</body>
</html>