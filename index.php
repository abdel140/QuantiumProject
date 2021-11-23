<?php
    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'test_certificate') {
            $is_quantum_proof = test_certificate_size($_FILES['certificate']['size']);
        }
    }

    function test_certificate_size(int $certificatesize): bool {
        if ($certificatesize >= 65534) {
            return true;
        } else {
            return false;
        }
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
    <span class="divider horizontal"></span>

    <form class="card" action="index.php?action=test_certificate" method="post" enctype="multipart/form-data">
        <input id="file-input" type="file" name="certificate" onchange="this.form.submit();">
        <label for="file-input">Upload HTTPS Certificate</label>
    </form>

<?php
    if (!empty($is_quantum_proof)) {
        if ($is_quantum_proof) {
?>
            <div class="card">
                <h1>YOU ARE QUANTUM PROOF</h1>
                <img id="gif" src="assets/bravo.gif" alt="People applause">
            </div>
<?php
        } else {
?>
            <div class="card">
                <h1>HOW TO BE QUANTUM PROOF ?</h1>
                <p></p>
            </div>
<?php
        }
    }
?>
</div>

<footer>
    <h1>Do you want more informations ?</h1>

    <div class="footer-infos">

    </div>

    <span class="divider vertical"></span>

    <div class="footer-img">
        <img src="assets/epsi.png" alt="Logo of EPSI school">
        <img src="assets/hep.png" alt="Logo of HEP group">
    </div>
</footer>
</body>
