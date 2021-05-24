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
    <div class="container-fluid pl-5 pr-5">
      <div class="row mt-3 mb-4">
    <!--Left wrapper start-->
    
      <div class="container d-none d-lg-block col-lg-3">
        <div class="card rounded">
          <div class="card-header border-0 bg-secondary">
            <h2 class="text-white m-1">Filtri di ricerca</h2>
          </div>
          <form>
            <div class="card-body border-0">
              <span>Tipo di dispositivo:</span>
              <ul>
                <?php
                  $stm = $dbh->query("SELECT DISTINCT Categoria FROM Prodotto");
                  $categorie = $stm->fetchAll();
                  foreach($categorie as $categoria){
                ?>
                <li><input type="checkbox" name="cat[]" value="<?php echo $categoria[0];?>"/> <?php 
                  switch($categoria[0]){
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
                    echo "NULL";
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
                      <input type="checkbox" name="ram[]" value="<?php echo $RAM[0];?>" />
                      <?php
                        echo $RAM[0];
                        ?> GB
                    </li>
                  <?php      
                    }
                    if(isset($_GET['ram'])){
                      $rm = $_GET['ram'];
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
                      foreach($produttori as $produttore){
                    ?>
                    <li><input type="checkbox" name="cpu[]" value="<?php echo $produttore[0];?>" /><?php echo $produttore[0]; ?></li>
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
    
                      foreach($dischi as $disco){
                    ?>
                    <li><input type="checkbox" name="disk[]" value="<?php echo $disco[0];?>"/> <?php echo $disco[0]; ?></li>
                    <?php
                      }  
                      $stm = null;
                    ?>
                  </ul>
                </li>
              </ul>
            </div>
            <div class="card-footer border-0 bg-white d-flex"><input type="submit" name="filter" value="Filtra" class="btn btn-secondary w-100"/></div>
          </form>
        </div>
      </div>
    <!--Left wrapper end-->
    <!--Main wrapper start-->
      <div class="d-block col-md-12 col-lg-9">
      <div class="accordion d-md-block d-lg-none mb-3" id="accordion-filter" role="tablist">
        <div class="card rounded">
          <div class="card-header border-0 bg-primary" role="tab" id="heading-filter ?>">
            <h6 class="mb-0 d-flex justify-content-center"> <a data-toggle="collapse" href="#collapse-filter" aria-expanded="false" aria-controls="collapse-filter" data-abc="true" class="collapsed text-white"> Filtri di ricerca </a> </h6>
          </div>
          <div id="collapse-filter" class="collapse bg-white" role="tabpanel" aria-labelledby="heading-filter" data-parent="#accordion-filter" style="">
         
          <div class="card-body border-0">
          <div class="row">
          <div class="col-12">     
          <form>          
            <span>Tipo di dispositivo:</span>
              <ul>
                <?php
                  $stm = $dbh->query("SELECT DISTINCT Categoria FROM Prodotto");
                  $categorie = $stm->fetchAll();
                  foreach($categorie as $categoria){
                ?>
                <li><input type="checkbox" name="cat[]" value="<?php echo $categoria[0];?>"/>
                <?php 
                  switch($categoria[0]){
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
                    echo "NULL";
                    break;
                  }
                ?>
                </li>
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
                      <input type="checkbox" name="ram[]" value="<?php echo $RAM[0];?>" />
                        <?php echo $RAM[0];?> GB
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
                      foreach($produttori as $produttore){
                    ?>
                    <li><input type="checkbox" name="cpu[]" value="<?php echo $produttore[0];?>" /><?php echo $produttore[0]; ?></li>
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
    
                      foreach($dischi as $disco){
                    ?>
                    <li><input type="checkbox" name="disk[]" value="<?php echo $disco[0];?>"/> <?php echo $disco[0]; ?></li>
                    <?php
                      }  
                      $stm = null;
                    ?>
                  </ul>
                </li>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-footer border-0 bg-white d-flex justify-content-center"><input type="submit" name="filter" value="Filtra" class="btn btn-secondary w-75"/></div>
            </form>
          </div>
        </div>
        </div>
        <div class="card rounded">
          <div class="card-header bg-secondary">
            <h2 class="text-white m-1">Prodotti in offerta</h2>
          </div>
          <div class="card-body row p-1 p-md-5">
              <div class="col-12">
                <div class="row">
                  <?php
                    $main_query = "SELECT * FROM Prodotto";
                    $JOIN = " JOIN";
                    if(isset($_GET['ram']) && strpos($main_query, "JOIN") === false){
                      $main_query = $main_query.$JOIN." RAM ON RAM.ID = Prodotto.RAM ";
                      if(isset($_GET['cpu'])){
                        $main_query = $main_query.$JOIN." CPU ON CPU.ID = Prodotto.CPU ";
                      }
                      if(isset($_GET['disk'])){
                        $main_query = $main_query.$JOIN." Disco ON Disco.ID = Prodotto.Disco ";
                      }
                      $main_query = $main_query."WHERE RAM.Dimensione = ".$_GET["ram"][0];
                      if($_GET["ram"][1]){
                        foreach($_GET["ram"] as $k => $v){
                          if($k < 1) continue;
                          $main_query = $main_query." OR RAM.Dimensione = "."'".$v."'";
                        }
                      }
                      if($_GET["cpu"]){
                        $main_query = $main_query." AND CPU.Produttore = "."'".$_GET["cpu"][0]."'";
                        if($_GET["cpu"][1]){
                          foreach($_GET["cpu"] as $k => $v){
                            if($k < 1) continue;
                            $main_query = $main_query." OR CPU.Produttore = "."'".$v."'";
                          }
                        }
                      }
                      if($_GET["disk"]){
                        $main_query = $main_query." AND Disco.Tipo = "."'".$_GET["disk"][0]."'";
                        if($_GET["disk"][1]){
                          foreach($_GET["disk"] as $k => $v){
                            if($k < 1) continue;
                            $main_query = $main_query." OR Disco.Tipo = "."'".$v."'";
                          }
                        }
                      }
                    }

                    if(isset($_GET['cpu']) && strpos($main_query, "JOIN") === false){
                      $main_query = $main_query.$JOIN." CPU ON CPU.ID = Prodotto.CPU ";
                      if(isset($_GET['ram'])){
                        $main_query = $main_query.$JOIN." RAM ON RAM.ID = Prodotto.RAM ";
                      }
                      if(isset($_GET['disk'])){
                        $main_query = $main_query.$JOIN." Disco ON Disco.ID = Prodotto.Disco ";
                      }
                      $main_query = $main_query."WHERE CPU.Produttore = "."'".$_GET["cpu"][0]."'";
                      if($_GET["cpu"][1]){
                        foreach($_GET["cpu"] as $k => $v){
                          if($k < 1) continue;
                          $main_query = $main_query." OR CPU.Produttore = "."'".$v."'";
                        }
                      }
                      if($_GET["ram"]){
                        $main_query = $main_query." AND RAM.Dimesnione = "."'".$_GET["ram"][0]."'";
                        if($_GET["ram"][1]){
                          foreach($_GET["ram"] as $k => $v){
                            if($k < 1) continue;
                            $main_query = $main_query." OR CPU.Produttore = "."'".$v."'";
                          }
                        }
                      }
                      if($_GET["disk"]){
                        $main_query = $main_query." AND Disco.Tipo = "."'".$_GET["disk"][0]."'";
                        if($_GET["disk"][1]){
                          foreach($_GET["disk"] as $k => $v){
                            if($k < 1) continue;
                            $main_query = $main_query." OR Disco.Tipo = "."'".$v."'";
                          }
                        }
                      }
                    }

                    if(isset($_GET['disk']) && strpos($main_query, "JOIN") === false){
                      $main_query = $main_query.$JOIN." Disco ON Disco.ID = Prodotto.Disco ";
                      if(isset($_GET['cpu'])){
                        $main_query = $main_query.$JOIN." CPU ON CPU.ID = Prodotto.CPU ";
                      }
                      if(isset($_GET['ram'])){
                        $main_query = $main_query.$JOIN." RAM ON RAM.ID = Prodotto.RAM ";
                      }
                      $main_query = $main_query."WHERE Disco.Tipo = "."'".$_GET["disk"][0]."'";
                      if($_GET["disk"][1]){
                        foreach($_GET["disk"] as $k => $v){
                          if($k < 1) continue;
                          $main_query = $main_query." OR Disco.Tipo = "."'".$v."'";
                        }
                      }
                      if($_GET["cpu"]){
                        $main_query = $main_query." AND CPU.Produttore = "."'".$_GET["cpu"][0]."'";
                        if($_GET["cpu"][1]){
                          foreach($_GET["cpu"] as $k => $v){
                            if($k < 1) continue;
                            $main_query = $main_query." OR CPU.Produttore = "."'".$v."'";
                          }
                        }
                      }
                      if($_GET["ram"]){
                        $main_query = $main_query." AND RAM.Dimensione = "."'".$_GET["ram"][0]."'";
                        if($_GET["ram"][1]){
                          foreach($_GET["ram"] as $k => $v){
                            if($k < 1) continue;
                            $main_query = $main_query." OR RAM.Dimensione = "."'".$v."'";
                          }
                        }
                      }
                    }
                    $stm = $dbh->query($main_query);
                    $prodotti = $stm->fetchAll(PDO::FETCH_BOTH);
                    $stm = null;
                    if(!$prodotti) exit("<div class='container-fluid d-flex justify-content-center'><div class='row'><h2 class='col-12 ml-4'>OOPS! Nessun prodotto disponibile :(</h2><a href='index.php' class='btn btn-primary col-10 ml-5'>Cancella filtri di ricerca</a></div></div>");
                    foreach($prodotti as $prodotto){
                  ?>
                  <div class="col-lg-4 col-md-6 col-12">
                  <div class="card rounded mr-3 mb-3 w-100">
                    <div class="card-header border-0 bg-white d-flex align-items-center justify-content-center">
                    <a href="product.php?prod=<?php echo $prodotto[0]; ?>"><img class="img img-fluid" src=<?php echo $prodotto["Immagine"]; ?> alt = <?php echo $prodotto["Nome"];?>/></a>
                    </div> 
                    <div class="card-body border-top">
                      <a href="product.php?prod=<?php echo $prodotto[0]; ?>"><?php echo $prodotto["Nome"]."&nbsp;"?></a>
                    </div>
                    <div class="accordion" id="accordion" role="tablist">
                      <div class="card">
                        <div class="card-header border-0 bg-secondary" role="tab" id="heading-<?php echo $prodotto["ID"]; ?>">
                          <h6 class="mb-0"> <a data-toggle="collapse" href="#collapse-<?php echo $prodotto["ID"];?>" aria-expanded="false" aria-controls="collapse-<?php echo $prodotto["ID"];?>" data-abc="true" class="collapsed text-white"> Specifiche Tecniche </a> </h6>
                        </div>
                        <div id="collapse-<?php echo $prodotto["ID"];?>" class="collapse bg-success" role="tabpanel" aria-labelledby="heading-<?php echo $prodotto["ID"];?>" data-parent="#accordion" style="">
                          <div class="card-body border-0">
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
                                $stm = $dbh->prepare("SELECT Produttore,Serie,Modello,Memoria FROM GPU WHERE ID = ?");
                                $stm->execute([$prodotto["GPU"]]);
                                $GPU = $stm->fetch(PDO::FETCH_ASSOC);
                                $stm = null;
                              ?>
                              <span class="text-secondary font-weight-bold">CPU:</span>
                              <div class="list-group p-0">
                                  <div class="list-group-item"><?php echo $GPU["Produttore"]." ".$GPU["Serie"]." ".$GPU["Modello"];?></div>
                                  <div class="list-group-item"><?php 
                                    $stm = $dbh->prepare("SELECT Tipo,Dimensione FROM RAM WHERE ID = ?");
                                    $stm->execute([$GPU["Memoria"]]);
                                    $Mem = $stm->fetch(PDO::FETCH_ASSOC);
                                    $stm = null;
                                    echo "Memoria video: ".$Mem["Dimensione"]."GB ".$Mem["Tipo"];
                                  ?></div>
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
                    <div class="m-3 p-0"> 
                      <div class="d-flex justify-content-center"><h1 class="text-danger font-weight-bold"><?php echo $prodotto["Prezzo"]?>€</h1></div>
                      <button type="button" class="btn btn-primary w-100 font-weight-bold mb-2" >Acquista ora</button>
                      <button type="button" class="btn btn-secondary w-100 font-weight-bold" style="background-color:orange !important;">Aggiungi al carrello</button>
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
