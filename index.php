<?php
    function test_certificat(string $certificatesignature){
        $certificatelength = strlen($certificatesignature);
        if ($certificatelength >= 65534) {
            return true;
        }else {
            return false;
        }
    }

    function certificate_ok(string $certificatesignature){
        echo("Le string: ".$certificatesignature.(test_certificat($certificatesignature)?" est Quantum-proof":" n'est pas Quantum-proof")."<br>");
    }
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Post-Quantum checker</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" type="text" href="main.css">
</head>
<body>
<nav>
    <h1>Post-Quantum Checker</h1>
</nav>

<div class="main-wrapper">
    <?php
    $string = "abcd";
    certificate_ok($string);
    $filename = "string.txt";
    $file = fopen("string.txt","r");
    $string = fread($file,filesize("string.txt"));
    certificate_ok($string);
    ?>
</div>

<footer>
    <h1>Do you want more informations ?</h1>

    <div class="footer-infos">

    </div>

    <span class="footer-divider"></span>

    <div class="footer-img">
        <img src="assets/epsi.png" alt="Logo of EPSI school">
        <img src="assets/hep.png" alt="Logo of HEP group">
    </div>
</footer>
</body>
