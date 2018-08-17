<?php
/**
 * Created by PhpStorm.
 * User: kvitajin
 * Date: 9.8.18
 * Time: 11:43
 */?>
<md-card>
    <form action="zpracuj.php" method="post"style="text-align: center">
        <input type="text" name="autor" placeholder="Autor"required><br>
        <input type="text" name="kniha" placeholder="Jméno knihy" required><br>
        <select name="stav" ><br>
            <option value="1">Mám</option>
            <option value="2">Chci</option>
        </select><br><br>
        <input type="submit" value="Přidat">
        <input type="reset" value="Vyčistit pole">

    </form>
</md-card>

