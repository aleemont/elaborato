<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/main.css">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>eShop</title>
</head>
<body>
    <nav class="navbar navbar-default">
        <div class="navbar-brand">
            <a href="#" class="h3">eShop</a>
        </div>
    </nav>
    <div class="container">
      <div class="row mt-3 mb-4">
    <!--Left wrapper start-->
      <div class="container d-none d-lg-block col-lg-3">
        <div class="card rounded">
          <div class="card-header">
            <h2>Filtri di ricerca</h2>
          </div>
          <div class="card-body">
            <span>Tipo di dispositivo:</span>
            <ul>
              <li><input type="checkbox"/> Portatili</li> <!--$prod_type = fetch(Select * from schema_name.table_name)-->
              <li><input type="checkbox"/> Smartphone</li>
              <li><input type="checkbox"/> Tablet</li>
              <li><input type="checkbox"/> Wearable</li>
            </ul>
            <p>Seleziona Caratteristiche:</p>
            <ul>
              <li>Ram
                <ul>
                  <li>
                    <input type="checkbox"/> 4GB  <!--$RAM_array = fetch(Select size from RAM) -->
                  </li>
                  <li>
                    <input type="checkbox"/> 8GB
                  </li>
                  <li>
                    <input type="checkbox"/> 16GB
                  </li>
                  <li>
                    <input type="checkbox"/> 32GB
                  </li>
                  <li>
                    <input type="checkbox"/> 64GB
                  </li>
                </ul>
              </li>
              <li>Cpu
                <ul>
                  <li>
                    <input type="checkbox"/> Intel
                  </li>
                    <ul>
                      <li>
                        <input type="checkbox"/> Core i3  <!--$CPU_array = fetch(Select * from CPU where cpu_brand='intel') -->
                      </li>
                      <li>
                        <input type="checkbox"/> Core i5
                      </li>
                      <li>
                        <input type="checkbox"/> Core i7
                      </li>
                      <li>
                        <input type="checkbox"/> Core i9
                      </li>
                    </ul>
                    <li>
                      <input type="checkbox"/> AMD
                    </li>
                      <ul>
                        <li>
                          <input type="checkbox"/> Ryzen 3  <!--$CPU_array = fetch(Select + from CPU where cpu_brand='amd') -->
                        </li>
                        <li>
                          <input type="checkbox"/> Ryzen 5
                        </li>
                        <li>
                          <input type="checkbox"/> Ryzen 7
                        </li>
                        <li>
                          <input type="checkbox"/> Ryzen 9
                        </li>
                      </ul>
                </ul>
              </li>
              <li>
                Disco
                <ul>
                  <li><input type="checkbox"/> SSD</li> <!--Select + from DISK -->
                  <li><input type="checkbox"/> HDD</li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="card-footer"><input type="submit" name="filter" value="Filtra" class="btn btn-secondary w-100"></div>
        </div>
      </div>
    <!--Left wrapper end-->
    <!--Main wrapper start-->
      <div class="d-block col-md-12 col-lg-9">
        <div class="card rounded">
          <div class="card-header">
            <h2>Prodotti in offerta</h2>
          </div>
          <div class="card-body row">
              <div class="col-md-6">  
                <?php
                  for($i=0; $i<5; $i++){ // $prods = Select COUNT(prod_name) from products / 2; $first_col = $prods/2 for($i=0; $i<$first_col; $i++)
                    echo '
                      <div class="card rounded mt-2 mb-2">
                        <div class="card-header">
                          <img class="img-fluid"src="assets/img/prod.jpg" alt="Laptop"/>
                        </div>
                        <div class="card-body">
                          <h6>Laptop 15" Intel Core i3 8Gb RAM 512GB SSD</h6>  <!--SELECT prod_name FROM products WHERE id=\'$i\'-->
                          <h6 class="list-group p-2">
                            <div class="list-group-item">
                                <span>CPU</span>:                                                       <!--$cpu_id = SELECT cpu FROM products WHERE id=\'$i\'-->
                                <ul>              
                                    <li><span>Intel</span> <span>Core i3</span> <span>11300</span></li> <!--SELECT cpu_brand, cpu_fam, cpu_model FROM CPU WHERE id=\'$cpu_id\'-->
                                    <li><span>4</span> core, <span>4</span> thread @<span>2.2</span>GHz</li> <!--SELECT cpu_cores, cpu_threads, cpu_speed FROM CPU WHERE id=\'$cpu_id\'-->
                                </ul>
                            </div>
                            <div class="list-group-item">
                                <span>RAM</span> 
                                <ul>
                                    <li>Quantità: <span>8</span>GB</li>
                                    <li>Tipo:<span>DDR4</span> @<span>2666</span>MHz</li>
                                </ul>
                            </div>
                            <div class="list-group-item">
                                <span>Disco</span>: 
                                <ul>
                                    <li><span>SSD</span> <span>SATA</span></li>
                                    <li>Dimensione: <span>512</span>GB</li>
                                </ul>
                            </div>
                        </h6>
                        </div>
                        </div>';
                  }
                ?>
              </div>
              <div class="col-md-6">
              <?php
                  for($i=0; $i<5; $i++){  // for($i=$first_col; $i<$prods; $i++)
                    echo '
                      <div class="card rounded mt-2 mb-2">
                        <div class="card-header">
                          <img class="img-fluid"src="assets/img/matebook.jpg" alt="Laptop"/>
                        </div>
                        <div class="card-body">
                          <h6>Laptop 13" AMD Ryzen 5 4600H 16Gb RAM 512GB SSD</h6> <!--SELECT prod_name FROM products WHERE id=\'$i\'-->
                          <h6 class="list-group p-2">
                            <div class="list-group-item">
                                <span>CPU</span>:           <!--$cpu_id = SELECT cpu FROM products WHERE id=\'$i\'-->
                                <ul>
                                    <li><span>AMD</span> <span>Ryzen 5</span> <span>4600H</span></li> <!--SELECT cpu_brand, cpu_fam, cpu_model FROM CPU WHERE id=\'$cpu_id\'-->
                                    <li><span>6</span> core, <span>12</span> thread @<span>3.8</span>GHz</li> <!--SELECT cpu_cores, cpu_threads, cpu_speed FROM CPU WHERE id=\'$cpu_id\'-->
                                </ul>
                            </div>
                            <div class="list-group-item">
                                <span>RAM</span>  <!--$ram_id = SELECT ram FROM products WHERE id=\'$i\'-->
                                <ul>
                                    <li>Quantità: <span>16</span>GB</li>  <!--SELECT ram_size FROM RAM WHERE id=\'$ram_id\'-->
                                    <li>Tipo:<span>DDR4</span> @<span>2666</span>MHz</li>   <!--SELECT ram_type, ram_speed FROM RAM WHERE id=\'$ram_id\'-->
                                </ul>
                            </div>
                            <div class="list-group-item">
                                <span>Disco</span>: 
                                <ul>
                                    <li><span>SSD</span> <span>NVMe</span></li>   <!--$disk_id = SELECT disk FROM products WHERE id=\'$i\' SELECT disk_type FROM RAM WHERE id=\'$disk_id\'--> 
                                    <li>Dimensione: <span>512</span>GB</li>   <!--SELECT disk_size FROM DISK WHERE id=\'$disk_id\'-->
                                </ul>
                            </div>
                        </h6>
                        </div>
                        </div>';
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