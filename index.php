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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Post-Quantum checker</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/QuantiumProject/main.css">
    <!-- Bootstrap tags -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- FontAwsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <nav>
        <div class="nav-top">
            <h1>POST-QUANTIUM CHECKER</h1>
        </div>
    </nav>
</header>

<div class="container">
    <div class="main-wrapper">
        <div class="top-text-description">
            <p>Check if your HTTPS certficate is post-quantum proof or not.</p>
        </div>
        <hr class="separator-header">
        <form action="index.php?action=test_certificate" method="post" enctype="multipart/form-data">
            <div class="upload-area">
                <input id="file-input" type="file" name="certificate" onchange="this.form.submit();" >
                <i class="fas fa-upload"></i>
                <label for="file-input">Upload HTTPS Certificate</label>
            </div>
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
</div>

<footer class="row">
    <div class="col-8 information-footer">
        <h5 class="">Do you want more </br> informations ?</h5>
    </div>
    <div class="footer-logos col-4">
        <div class="row">
            <div class="col-2">
                <div class="separator-footer"></div>
            </div>
            <div class="col-5" align="center">
                <img src="QuantiumProject/assets/epsi.png" alt="Logo of EPSI school">
            </div>
            <div class="col-5 mx-auto" align="center">
                <img src="QuantiumProject/assets/hep.png" alt="Logo of HEP group">
            </div>
        </div>
    </div>
</footer>
</body>
</html>