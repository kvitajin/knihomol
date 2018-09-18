<?php
/**
 * User: kvitajin
 * Date: 14.8.18
 * Time: 0:14
 */
?>
<md-card>
    <md-list>
    <?php
    session_start();
    $stav=$database->getAllStav();
    //print_r($stav);
    echo "<br>";
    $_SESSION['old']=array();
    echo "<form action='setStav.php' method='post'>";
    $i=0;
    foreach ( $stav as $value){
        $_SESSION['old'[$value['nazev']]]=$value['stav'];           //presype multidiemnzionalni pole do jmeno=>stav
        echo $value['id_kniha'] . " - " . $value['stav'];
        if ($value["stav"]==1){
            require ("mamOpt.php");
        }else{
            require ("chciOpt.php");
        }
        echo " - " .htmlentities($value["nazev"], ENT_QUOTES) . "\t" ."<br>";
        $i++;
    }
    echo "</form>"
    //echo "<br><br>";
    //print_r($old);
    ?>
    </md-list>
</md-card>