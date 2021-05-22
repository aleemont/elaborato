<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no, user-scalable=no">
    <!--Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/catalogo.css">
    <title>eShop</title>
</head>
<body>

    <section>
        <nav class="navbar fixed-top mb-2">
            <a class="navbar-brand" href="#">
                <!--<img class="img-responsive" src="#" alt="LOGO"/>-->
                <span>eShop</span>
            </a>
        </nav>
    </section>
    <div class="circle"></div>
    <div class="circle1"></div>
    <div class="circle2"></div>
    <div class="circle3"></div>
    <div class="circle4"></div>
    <div class="circle5"></div>
 <!--   <div class="square"></div>
    <div class="square1"></div>
    <div class="square2"></div> -->
    <div class="container-fluid">
        <div class="row">
        <?php
       for($i=0; $i<12; $i++){ //TODO: $n_prodotti=COUNT * FROM TABLE PRODOTTI for($i=0; $i<$n_prodotti; $i++)
        echo '
                <div class="card-container col-12 col-lg-6 col-xl-3 mt-2 mb-2">
                    <div class="card">
                        <div class="card-header bg-white">
                            <img src="assets/img/prod.jpg" class="img-fluid"/>
                        </div>
                        <div class="card-body">
                            <h3>Notebook HP</h3>
                            <h6 class="list-group p-2">
                                <div class="list-group-item">
                                    <span>CPU</span>: 
                                    <ul>
                                        <li><span>Intel</span> <span>Core i7</span> <span>1135G7</span></li>
                                        <li><span>4</span> core, <span>8</span> thread @<span>3.0</span>GHz</li>
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
                                        <li><span>SSD</span> <span>NVMe</span></li>
                                        <li>Dimensione: <span>512</span>GB</li>
                                    </ul>
                                </div>
                            </h6>
                        </div>
                    </div>
                </div>
                ';
        }
            ?>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>