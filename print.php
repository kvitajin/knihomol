<?php
/**
 * Created by PhpStorm.
 * User: kvitajin
 * Date: 7.8.18
 * Time: 22:50
 */
foreach ($tmp as $row) {
    $autor = $row[0];
    $kniha = $row[1];
    if ($autor !== $autorPrev) {
        ?>
        <md-list class="md-headline">

        <?php
        echo "<br><b>" . htmlentities($autor, ENT_QUOTES) . "</b>" ;
        ?>

        </md-list>
        <?php
    }
    ?>
    <md-list-item-default class="md-headline">
        <div class="odksok">

        <?php
    echo   "-" .htmlentities($kniha, ENT_QUOTES) . "<br>";
    ?>
        </div>
    </md-list-item-default>
    <?php
    $autorPrev = $autor;

}