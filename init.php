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