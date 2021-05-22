<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/colors.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <title>eShop</title>
</head>
<body>
    <nav class="navbar navbar-default bg-primary">
        <div class="navbar-brand">
            <a href="#" class="h3">eShop</a>
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
      <div class="row mt-3 mb-4">
    <!--Left wrapper start-->
    
      <div class="container d-none d-lg-block col-lg-3">
        <div class="card rounded">
          <div class="card-header bg-secondary">
            <h2 class="text-white">Filtri di ricerca</h2>
          </div>
          <div class="card-body">
            <span>Tipo di dispositivo:</span>
            <ul>
              <?php
                $stm = $dbh->query("SELECT DISTINCT Categoria FROM Prodotto");
                $categorie = $stm->fetchAll();
              ?>
              <?php 
                foreach($categorie as $categoria){
              ?>
              <li><input type="checkbox"/> <?php 
                switch($categoria["Categoria"]){
                  case 0:
                    echo "Laptop";
                    break;
                  case 1:
                    echo "Smartphone";
                    break;
                  case 2:
                    echo "Tablet";
                    break;
                  default:
                    break;
                }
              ?></li>
              <?php
                }  
                $stm = null;
              ?>
            </ul>
            <p>Seleziona Caratteristiche:</p>
            <ul>
              <li>Ram
                <ul>
                <?php
                    $stm = $dbh->query("SELECT DISTINCT Dimensione FROM RAM ORDER BY Dimensione ASC");
                    $RAMs = $stm->fetchAll();
                    foreach($RAMs as $RAM){
                ?>
                  <li>
                    <input type="checkbox" />
                    <?php echo $RAM["Dimensione"];?> GB
                  </li>
                <?php      
                  }
                  $stm = null;
                ?>
                </ul>
              </li>
              <br />
              <li>Cpu
                <ul>
                  <?php
                      $stm = $dbh->query("SELECT DISTINCT Produttore FROM CPU ORDER BY Produttore ASC");
                      $produttori = $stm->fetchAll();
                  ?>
                        <?php 
                          foreach($produttori as $produttore){
                            ?>
                            <li><input type="checkbox"/> <?php echo $produttore["Produttore"]; ?></li>
                        <?php
                          }
                          $stm = null;
                    ?>
                </ul>
              </li>
              <br />
              <li>
                Disco
                <ul>
                <?php
                      $stm = $dbh->query("SELECT DISTINCT Tipo FROM Disco");
                      $dischi = $stm->fetchAll();
                      $stm = null;
                  ?>
                        <?php 
                          foreach($dischi as $disco){
                            ?>
                            <li><input type="checkbox"/> <?php echo $disco["Tipo"]; ?></li>
                        <?php
                          }  
                          $stm = null;
                    ?>
                </ul>
              </li>
            </ul>
          </div>
          <div class="card-footer bg-white d-flex"><input type="submit" name="filter" value="Filtra" class="btn btn-secondary w-100"></div>
        </div>
      </div>
    <!--Left wrapper end-->
    <!--Main wrapper start-->
      <div class="d-block col-md-12 col-lg-9">
        <div class="card rounded">
          <div class="card-header bg-secondary">
            <h2 class="text-white">Prodotti in offerta</h2>
          </div>
          <div class="card-body row p-1 p-md-5">
              <div class="col-12">
                <div class="row">
                  <?php
                    $stm = $dbh->query("SELECT * FROM Prodotto");
                    $prodotti = $stm->fetchAll(PDO::FETCH_ASSOC);
                    $stm = null;
                    if(!$prodotti) exit("Nessun prodotto disponibile");
                    foreach($prodotti as $prodotto){
                  ?>
                  <div class="col-lg-6 col-12">
                  <div class="card rounded mr-3 mb-3 w-100">
                    <div class="card-header">IMG</div> 
                    <div class="card-body">
                      <?php echo $prodotto["Nome"]."&nbsp;"?>
                    </div>
                    <div class="accordion" id="accordion" role="tablist">
                      <div class="card">
                        <div class="card-header bg-secondary" role="tab" id="heading-<?php echo $prodotto["ID"]; ?>">
                          <h6 class="mb-0"> <a data-toggle="collapse" href="#collapse-<?php echo $prodotto["ID"];?>" aria-expanded="false" aria-controls="collapse-<?php echo $prodotto["ID"];?>" data-abc="true" class="collapsed text-white"> Specifiche Tecniche </a> </h6>
                        </div>
                        <div id="collapse-<?php echo $prodotto["ID"];?>" class="collapse bg-success" role="tabpanel" aria-labelledby="heading-<?php echo $prodotto["ID"];?>" data-parent="#accordion" style="">
                          <div class="card-body">
                            <div class="row">
                              <div class="col-12">
                              <?php 
                                $stm = $dbh->prepare("SELECT Produttore,Serie,Modello,Cores,Threads,Frequenza FROM CPU WHERE ID = ?");
                                $stm->execute([$prodotto["CPU"]]);
                                $CPU = $stm->fetch(PDO::FETCH_ASSOC);
                                $stm = null;
                              ?>
                              <span class="text-secondary font-weight-bold">CPU:</span>
                              <div class="list-group p-0">
                                  <div class="list-group-item"><?php echo $CPU["Produttore"]." ".$CPU["Serie"]." ".$CPU["Modello"];?></div>
                                  <div class="list-group-item"><?php echo $CPU["Cores"]."C/".$CPU["Threads"]."T@".$CPU["Frequenza"]."GHz";?></div>
                              </div>

                              <?php 
                                $stm = $dbh->prepare("SELECT Dimensione,Tipo FROM RAM WHERE ID = ?");
                                $stm->execute([$prodotto["RAM"]]);
                                $RAM = $stm->fetch(PDO::FETCH_ASSOC);
                                $stm = null;
                              ?>
                              <span class="text-secondary font-weight-bold">RAM:</span>
                              <div class="list-group p-0">
                                  <div class="list-group-item"><?php echo $RAM["Dimensione"]." ".$RAM["Tipo"];?></div>
                              </div>

                              <?php 
                                $stm = $dbh->prepare("SELECT Dimensione,Tipo,Modello,Velocità  FROM Disco WHERE ID = ?");
                                $stm->execute([$prodotto["Disco"]]);
                                $Disco = $stm->fetch(PDO::FETCH_ASSOC);
                                $stm = null;
                              ?>
                              <span class="text-secondary font-weight-bold">Disco:</span>
                              <div class="list-group p-0">
                                  <div class="list-group-item"><?php echo $Disco["Tipo"]." ".$Disco["Dimensione"]."GB"." ".$Disco["Modello"];
                            ?></div>
                            
                            <?php 
                                $stm = $dbh->prepare("SELECT Diagonale,Tipo,Risoluzione FROM Schermo WHERE ID = ?");
                                $stm->execute([$prodotto["Schermo"]]);
                                $Schermo = $stm->fetch(PDO::FETCH_ASSOC);
                                $stm = null;
                              ?>
                              <span class="text-secondary font-weight-bold">Display:</span>
                              <div class="list-group p-0">
                                  <div class="list-group-item"><?php echo $Schermo["Diagonale"]."\" ".$Schermo["Tipo"]." ".$Schermo["Risoluzione"];?>
                              </div>                      
                            </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    <div class="m-3 p-0 pl-3"> 
                      <button type="button w-50" class="btn btn-primary font-weight-semibold" >Acquista ora</button>
                      <button type="button w-50" class="btn btn-secondary font-weight-bold" style="background-color:orange !important;">Aggiungi al carrello</button>
                    </div>
                  </div>
                  </div>
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
    <!--Main wrapper end-->
      </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
