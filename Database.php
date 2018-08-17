<?php
/**
 * User: kvitajin
 * Date: 2.8.18
 * Time: 11:48
 */

class Database {
    private $pdo;

    function pripojPDO(){
        $dsn='mysql:dbname=knihomol_www3_cz;host=95.168.204.247;charset=utf8';
        $username='knihomol.www3.cz';
        $passwd='6xg1C75fDm';
        $dbName='far';


        try {
            $this->pdo = new PDO($dsn, $username, $passwd);
            $this->pdo->exec("PRAGMA journal_mode = wal;");
            $this->pdo->exec("PRAGMA foreign_keys = ON;");
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        //return $pdo;
    }

    function autorInDatabase($autor){
        $stmt = $this->pdo->prepare('SELECT EXISTS(SELECT autor.id_autor FROM autor WHERE jmeno=(:jmeno))');
        $stmt->bindValue(':jmeno', $autor);

        $stmt->execute();
        /*echo "ahoj";
        print_r($tmp=);*/
        return ($stmt->fetchColumn === '1');
    }
    function setAutor($autor){
        if ($this->autorInDatabase($autor)){
            return;
        }
        echo"setAutor";
        $sql = 'INSERT INTO autor(jmeno) VALUES (:jmeno)';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':jmeno' => ucfirst($autor),
        ));
        return;
    }
    function getAutorID($autor){
        $sql = "SELECT autor.id_autor FROM autor WHERE autor.jmeno=(:jmeno)";
        $statement = $this->pdo->prepare($sql);

        $statement->bindValue(':jmeno', ucfirst($autor));
        $statement->execute();

        if ($id = $statement->fetchColumn()) {
            return $id;
        } else {
            throw new Exception("Author " . $autor . "is not in DB");
        }
    }
    function setBook($autor, $kniha, $stav){
        $this->setAutor($autor);
        echo "tu";
        $idAutor=$this->getAutorID($autor);
        echo "autorID: " . $idAutor;
        $sql= "INSERT INTO kniha(nazev, stav, ck_id_autor) VALUES (:nazev, :stav, :id_autor)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':nazev' => ucfirst($kniha),
            ":stav" => $stav,
            ":id_autor" => $idAutor,
        ));
    }
    function getAllStav(){
        $sql = "SELECT kniha.nazev, kniha.stav FROM kniha ORDER BY kniha.nazev";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();

        if ($stav = $statement->fetchAll()) {
            return $stav;
        } else {
            throw new Exception("Any book in DB");
        }
    }

    function setStav($kniha, $stav){
        $sql= "UPDATE kniha SET stav=(:stav) WHERE nazev=(:nazev)";
        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':nazev' => $kniha,
            ":stav" => $stav,
        ));
    }
    /*function getWishLite(){
        $sql = "SELECT knihomol.kniha.nazev 
                  FROM knihomol.kniha WHERE stav=(:stav)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':stav', 2);
        $statement->execute();
        $i=0;
        echo "0";
        while ($own[$i] = $statement->fetch(PDO::FETCH_ASSOC)) {
            $i++;
        }
        if(!$i){
            throw new Exception("Any book owned");
        }
        return $own;
    }
    function getWish(){
        $sql = "SELECT `knihomol`.`autor`.`jmeno`, `knihomol`.`kniha`.`nazev`, `knihomol`.`kniha`.`stav` 
                  FROM `knihomol`.`kniha` INNER JOIN `knihomol`.`autor` 
                  ON `knihomol`.`kniha`.`ck_id_autor`=`knihomol`.`autor`.`id_autor` 
                  WHERE `stav`=2 ";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $tmp=$statement->fetchAll();
        if($tmp){
            return $tmp;
        }else {
            throw new Exception("Noting on wishlist");
        }
    }*/
    function get($wat) {
        if ($wat === "Wish") $co = 2;
        else if ($wat === "Own") $co = 1;
        else {
            throw new Exception("nevim, co po me chces vypsat");
        }
        $sql = "SELECT `autor`.`jmeno`, `kniha`.`nazev`, `kniha`.`stav` 
                  FROM `kniha` INNER JOIN `autor` 
                  ON `kniha`.`ck_id_autor`=`autor`.`id_autor` 
                  WHERE `stav`=$co 
                  ORDER BY `autor`.`jmeno`, `kniha`.`nazev`";
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        $tmp = $statement->fetchAll();
        if ($tmp) {
            return $tmp;
        } else {
            throw new Exception("Noting on" . $wat ."list");
        }
    }
}