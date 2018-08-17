<?php
/**
 * Created by PhpStorm.
 * User: kvitajin
 * Date: 14.8.18
 * Time: 0:14
 */
?>
<md-card>
    <md-list>
    <?php $stav=$database->getAllStav();
    foreach ( $stav as $value){
        //echo $value['stav'];
        if ($value["stav"]==1){
            require ("mamOpt.php");
        }else{
            require ("chciOpt.php");
        }
        echo " - " .htmlentities($value["nazev"], ENT_QUOTES) . "\t" ."</form> <br>";
    }
    ?>
    </md-list>
</md-card>