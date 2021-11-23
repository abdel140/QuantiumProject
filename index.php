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

</footer>
</body>
