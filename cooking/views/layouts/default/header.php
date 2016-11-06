<?php

$name = 'Потребител';

if(isset($_SESSION['name'])) {
  $name = $_SESSION['name'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="/cooking/resources/css/styles.css">
    <title><?= $this->title ?></title>
</head>
<body>
<header><a href="/cooking"><img id="logo" src="/cooking/resources/images/logo.png"></a></header>
<div id="message-box"></div>
<nav>
    <ul id="main-nav">
        <li><a href="/cooking/articles/">Статии</a>
            <?php if(isset($_SESSION['name'])) { ?>
            <ul class="drop-menu">
                <li><a href="/cooking/articles/create">Нова статия</a></li>
            </ul>
            <? } ?>
        </li>
        <li>Рецепти
            <ul class="drop-menu">
                <li><a href="">Добави</a></li>
            </ul>
        </li>
        <li>Любими
            <ul class="drop-menu">
                <li><a href="">Рецепти</a></li>
                <li><a href="">Снимки</a></li>
                <li><a href="">Статии</a></li>
            </ul>
        </li>
        <li>Gluposti
            <ul class="drop-menu">
                <li><a href="">Drugi glyposti</a></li>
                <li><a href="">Oshte glyposti</a></li>
                <li><a href="">Ebahti glypostite</a></li>
                <li><a href="">Glyposti po Level</a></li>
            </ul>
        </li>
        <li>Снимки</li>
        <li><?php echo $name ?>
            <ul id="user-box" class="drop-menu">
                <?php if(!isset($_SESSION['name'])) { ?>
                    <li><a href="/cooking/users/login">Вход</a></li>
                    <li><a href="/cooking/users/register">Регистрация</a></li>
               <?php } else {?>
                   <li><a href="/cooking/page-editor">Настройки</a></li>
                    <li><a href="/cooking/users/logout">Изход</a></li>
                <?php } ?>
            </ul>
        </li>
    </ul>
</nav>
<main>