<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items-center justify-content-center">
                    <?php
                        $stm = $dbh->prepare("SELECT * from Prodotto where ID = ?");
                        $stm -> execute([$_GET["prod"]]);
                        $SRC = $stm->fetch(PDO::FETCH_ASSOC);
                        $stm = null;
                    ?>
                    <div class="m-5"><img class="img img-fluid" src="<?php echo $SRC["Immagine"]; ?>" alt = "IMG"/></div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="mt-5">
                        <h1 class="mt-5 text-secondary font-weight-bold"><?php echo $SRC["Nome"] ?></h1>
                        <br>
                        <?php 
                            if($SRC["Larghezza"] != '0.0')
                            {
                        ?>
                            <span>Dimensioni:</span>
                            <ul class ="list-group" style="list-style-type:initial;">
                                <li class="list-group-item">
                                    Larghezza: <?php echo $SRC["Larghezza"]; ?> 
                                </li>
                                <li class="list-group-item">
                                    Altezza: <?php echo $SRC["Profondità"]; ?> 
                                </li>
                                <li class="list-group-item">
                                    Spessore: <?php echo $SRC["Spessore"]; ?> 
                                </li>
                            </ul>
                        <?php 
                            }
                        ?>
                        <span>Caratteristiche Tecniche: </span>
                        <ul class="list-group">
                            <li class="list-group-item">CPU:
                                <ul style="list-style-type:initial;">
                                    <?php
                                        $stm = $dbh->prepare("SELECT * FROM CPU WHERE ID = ?");
                                        $stm->execute([$SRC["CPU"]]);
                                        $CPU = $stm->fetch(PDO::FETCH_ASSOC);
                                        $stm = null;
                                    ?>
                                    <li><?php echo $CPU["Produttore"]." ".$CPU["Serie"]." ".$CPU["Modello"]." ".$CPU["Cores"]." Cores / ".$CPU["Threads"]." Threads"." @ ".$CPU["Frequenza"] ?></li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                GPU:
                                <ul style="list-style-type:initial;">
                                    <?php
                                        $stm = $dbh->prepare("SELECT * FROM GPU WHERE ID = ?");
                                        $stm->execute([$SRC["GPU"]]);
                                        $GPU = $stm->fetch(PDO::FETCH_ASSOC);
                                        $stm = null;
                                        $stm = $dbh->prepare("SELECT Dimensione, Tipo FROM RAM WHERE ID = ?");
                                        $stm -> execute([$GPU["Memoria"]]); 
                                        $mem = $stm->fetch();
                                    ?>
                                    <li><?php echo $GPU["Produttore"]." ".$GPU["Serie"]." ".$GPU["Modello"]." ".$mem[0]."GB - ".$mem[1]?></li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                RAM:
                                <ul style="list-style-type:initial;">
                                    <?php
                                        $stm = $dbh->prepare("SELECT * FROM RAM WHERE ID = ?");
                                        $stm->execute([$SRC["RAM"]]);
                                        $RAM = $stm->fetch(PDO::FETCH_ASSOC);
                                        $stm = null;
                                    ?>
                                    <li><?php echo $RAM["Dimensione"]."GB ".$RAM["Tipo"]?></li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                Disco:
                                <ul style="list-style-type:initial;">
                                    <?php
                                        $stm = $dbh->prepare("SELECT * FROM Disco WHERE ID = ?");
                                        $stm->execute([$SRC["Disco"]]);
                                        $Disco = $stm->fetch(PDO::FETCH_ASSOC);
                                        $stm = null;
                                    ?>
                                    <li><?php echo $Disco["Dimensione"]."GB ".$Disco["Tipo"]." ".$Disco["Modello"];if($Disco["Velocità"]) echo " ".$Disco["Velocità"]."rpm"?></li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                Display:
                                <ul style="list-style-type:initial;">
                                    <?php
                                        $stm = $dbh->prepare("SELECT * FROM Schermo WHERE ID = ?");
                                        $stm->execute([$SRC["Schermo"]]);
                                        $Schermo = $stm->fetch(PDO::FETCH_ASSOC);
                                        $stm = null;
                                    ?>
                                    <li><?php echo $Schermo["Diagonale"]."\" ".$Schermo["Tipo"]." ".$Schermo["Risoluzione"];?></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 d-flex align-items-center justify-content-center">
                    <div class="m-5 p-0">
                        <div class="d-flex justify-content-center">
                            <h2 class="text-primary font-weight-bold mt-2">SOLO:&nbsp;</h2>
                            <h1 class="text-danger font-weight-bold"><?php echo $SRC["Prezzo"];?>€</h1>
                        </div>
                       
                        <a href="./order.php?order=<?php echo $SRC["ID"]; ?>" class="btn btn-primary w-100 font-weight-bold mb-2" >Acquista ora</a>
                        <button type="button" class="btn btn-secondary w-100 font-weight-bold" style="background-color:orange !important;">Aggiungi al carrello</button>
                    </div>
                </div>
            </div>
            <hr class="mt-4">
            <h3 class="text-primary font-weight-bold mt-2">Prodotti correlati:</h3>
            <div class="row m-md-5">
                <?php
                $id_backup = array(0);
                for($i=0;$i<4;$i++){
                ?>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="card rounded mb-3">
                        <div class="card-header bg-white d-flex justify-content-center p-0">
                            <?php
                                $stm = $dbh->prepare("SELECT COUNT(*) FROM Prodotto WHERE Categoria = ?");
                                $stm->execute([$SRC["Categoria"]]);
                                $nProd = $stm->fetch();
                                $stm = null;
                                while(in_array($id, $id_backup) == true || $_GET["prod"] == $id){
                                    $id = rand(1, $nProd[0]);
                                }
                                array_push($id_backup, $id);
                                $stm = $dbh->prepare("SELECT * FROM Prodotto WHERE ID = ? AND Categoria = ?");
                                $stm->execute([$id, $SRC["Categoria"]]);
                                $prod = $stm->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <a href="product.php?prod=<?php echo $id?>"><img class="img img-fluid" src="<?php echo  $prod["Immagine"];?>" alt="IMG <?php echo $prod["ID"]; ?>" /></a>
                        </div>
                        <div class="card-body p-0">
                            <h6 class="font-weight-bold small-card m-0 p-4"><a class="text-secondary" href="product.php?prod=<?php echo $id?>"><?php echo $prod["Nome"]; ?></a></h6>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-end">
                            <h3 class="text-danger font-weight-bold m-0"><?php echo $prod["Prezzo"]; ?>€</h3>
                            
                        </div>
                    </div>
                </div>
                <?php 
                }
                ?>
            </div>
        </div>

    </body>
</htm>