<!DOCTYPE html>
<html>
<?php error_reporting(E_ALL);?>

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="theme-color" content="#009688">

	<link rel="manifest" href="manifest.json">

	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="application-name" content="Knihomol">
	<meta name="apple-mobile-web-app-title" content="Knihomol">
	<meta name="msapplication-navbutton-color" content="#009688">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="msapplication-starturl" content="/">

	<link rel="icon" type="image/svg+xml" href="img/book.svg">
	<link rel="apple-touch-icon" type="image/svg+xml" href="img/book.svg">

	<title>Knihomol</title>
	<link rel="stylesheet" href="https://unpkg.com/vue-material@beta/dist/vue-material.min.css">
	<link rel="stylesheet" href="css/md-knihomol.css">
	<link rel="stylesheet" href="css/styl.css">
    <?php
    // Enforce the use of HTTPS
    header("Strict-Transport-Security: max-age=31536000; includeSubDomains");
    // Prevent Clickjacking
    header("X-Frame-Options: SAMEORIGIN");
    // Block Access If XSS Attack Is Suspected
    header("X-XSS-Protection: 1; mode=block");
    // Prevent MIME-Type Sniffing
    header("X-Content-Type-Options: nosniff");
    // Referrer Policy
    header("Referrer-Policy: no-referrer-when-downgrade");
    require_once ("favicon.php");
    ?>
</head>

<body>
<?php
require_once ("Database.php");
$database= new Database();
$database->pripojPDO();
session_start();
//echo $_SESSION["passwd"] . "<br>";
?>
	<div id="knihomol" class="page-container md-layout-column" v-cloak>
		<md-toolbar class="md-primary">
			<md-button class="md-icon-button" v-on:click="showNavigation = true">
				<img src="img/menu.svg">
			</md-button>

			<h2 class="md-title">Knihomol &beta;</h2>
		</md-toolbar>


		<div class="generator" v-if="typ_generatoru === 0">
			<md-card>
                <md-title>
                    <div id="cisla_d">Mám</div>
                    <br>
                </md-title>
				<md-list>
                    <?php
					$tmp=$database->get("Own");
                    $autorPrev=NULL;
                    require ("print.php");
                    $tmp=NULL;
                    ?>
				</md-list>
			</md-card>
		</div>

		<div class="generator" v-else-if="typ_generatoru === 1">
            <md-card>
                <md-title>
                    <div id="cisla_d">Chci</div>
                    <br>
                </md-title>
                <md-list>
                    <?php
                    $tmp=$database->get("Wish");
                    //print_r($tmp);

                    $autorPrev=NULL;
                    require ("print.php");
                    $tmp=NULL;
                    ?>
                </md-list>
            </md-card>
		</div>

        <div class="generator" v-else-if="typ_generatoru === 2">
            <md-card>
            <?php
            if(!isset($_SESSION["passwd"])){
                echo"<md-headline>Musíš se přihlásit</md-headline>";
            }
            else {
                require_once ("add.php");
            }
            ?>
            </md-card>
        </div>
        <div class="generator" v-else-if="typ_generatoru === 3">
            <?php
            if(isset($_SESSION["passwd"])){
                echo" prdel";
                }
            else{?>
            <md-card style="text-align: center;">
                <md-title class="md-headline">
                    Zadej heslo: <br>
                </md-title>
                <md-title class="md-textarea">

                <form action="log.php" method="post">
                    <input type="password" name="passwd" placeholder="Heslo" required ><br>
                    <input type="submit" value="Přihlaš">
                </form>
                </md-title>
                <?php
            }
                ?>
        </div>
        <div class="generator" v-else-if="typ_generatoru === 4">
            <md-card>
                <?php
                if(!isset($_SESSION["passwd"])){
                    echo"<md-headline>Musíš se přihlásit</md-headline>";
                }
                else {
                    require_once ("stav.php");
                }
                ?>
            </md-card>
        </div>


		<md-drawer class="md-left" ref="leftSidenav" :md-active.sync="showNavigation">
			<md-toolbar class="md-large">
				<div class="md-transparent" md-elevation="0">
					<span class="md-title">Dostupné akce</span>
				</div>
			</md-toolbar>
			<md-list>
				<md-list-item v-on:click="typ_generatoru = 0">
					<md-icon><img src="img/book.svg"></md-icon><span class="md-list-item-text">Mám</span>
				</md-list-item>
				<md-list-item v-on:click="typ_generatoru = 1">
					<md-icon><img src="img/hearth.svg"></md-icon><span class="md-list-item-text">Chci</span>
				</md-list-item>
                <?php
                //print_r($_SESSION);
                if (isset($_SESSION["passwd"])){
                    require ("odhlas.php");
                }else {
                    require ("prihlas.php");
                }?>



			</md-list>
		</md-drawer>
	</div>
	<script src="https://unpkg.com/vue@2.5.16/dist/vue.min.js"></script>
	<script src="https://unpkg.com/vue-material@beta/dist/vue-material.min.js"></script>
	<script src="js/appka.js"></script>
	<script src="js/prvky.js"></script>
</body>
</html>
