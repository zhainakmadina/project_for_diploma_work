<?php

session_start();

if(isset($_GET['logout'])) {
    unset($_SESSION['user']);
}

if(!isset($_SESSION['user'])) {
    header('Location: /signin');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Import Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;700&display=swap" rel="stylesheet">

    <!-- Import CSS -->
    <link rel="stylesheet" href="assets/css/general.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Import JS -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>

    <title>Diplom</title>
</head>
<body>
    <header>
        <div class="header container">
            <h2>Sitemaps</h2>
            <div class="logo"><img src="assets/img/logo.png" alt=""></div>
            <div class="user">
                <div id="refresh"><i class="fa-solid fa-arrows-rotate"></i></div>
                <div id="user">
                    <div class="submenu">
                        <div><a href="#"><i class="fa-solid fa-gear"></i> Configuration</a></div>
                        <div><a href="?logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></div>
                    </div>
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>
    </header>
    <div class="divider">
        <div class="left-menu">
            <ul>
                <li><i class="fa-solid fa-gauge"></i>Dashboard</li>
                <li class="arrow"><span><i class="fa-solid fa-angle-right"></i>Organizations</span>
                    <ul>
                        <li><i class="fa-solid fa-building"></i>Websites</li>
                    </ul>
                </li>
                <li class="arrow"><span><i class="fa-solid fa-angle-right"></i>Lighthouse</span>
                    <ul>
                        <li><i class="fa-solid fa-globe"></i>Lighthouse</li>
                        <li><i class="fa-solid fa-square-poll-vertical"></i>Results</li>
                    </ul>
                </li>
                <li class="arrow"><span><i class="fa-solid fa-angle-right"></i>Extractor</span>
                    <ul>
                        <li><i class="fa-solid fa-sitemap"></i>Sitemap</li>
                        <li><i class="fa-solid fa-image"></i>Images, Links, Header</li>
                        <li><i class="fa-solid fa-crosshairs"></i>Yake</li>
                    </ul>
                </li>
                <li><i class="fa-solid fa-shield-halved"></i>Security</li>
            </ul>
        </div>
        <div class="content-wp">
            <div class="content">
                <?php
                    $page = $_GET['page'];
                    require_once($_SERVER["DOCUMENT_ROOT"].'/pages/'.$page.'.php')
                ?>
            </div>
        </div>
    </div>
</body>
</html>