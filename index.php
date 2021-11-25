<?php
$is_quantum_proof = 0;

if (!function_exists("str_ends_with")) {
    function str_ends_with( $haystack, $needle ) {
        $length = strlen( $needle );
        if( !$length ) {
            return true;
        }
        return substr( $haystack, -$length ) === $needle;
    }
}

    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'test_certificate') {
            if (str_ends_with($_FILES['certificate']['name'], '.crt')) {
                $string = array();
                exec("openssl x509 -noout -text -in ".$_FILES['certificate']['tmp_name']." | grep Public-Key",$string);
                $string = $string[0];
                preg_match('/\d+/',$string,$stringfound);
                $is_quantum_proof = test_certificate_size($stringfound[0]);
            } else {
                $wrong_format = true;
            }
        }
    }

    function test_certificate_size(int $certificatesize) {
        if ($certificatesize > 4096) {
            return 1;
        } else {
            return -1;
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
    <link rel="stylesheet" type="text/css" href="main.css">
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
            <h1><a href="/">POST-QUANTUM CHECKER</a></h1>
        </div>
    </nav>
</header>

<div class="container">
    <div class="main-wrapper">
        <div class="top-text-description">
            <p>
                Check if your HTTPS certificate is post-quantum proof or not</p><p>
                Post-quantum cryptography, also called quantum encryption, is the development of cryptographic
                systems for classical computers that are able to prevent attacks launched by quantum computers.
            </p>
        </div>

        <hr class="separator-header">

        <div class="upload-area">
            <form class="card" action="index.php?action=test_certificate" method="post" enctype="multipart/form-data">
                <input id="file-input" type="file" name="certificate" onchange="this.form.submit();">
<?php
                if (!empty($wrong_format) && $wrong_format) {
?>
                    <span class="error">The certificate file format must be .crt</span>
<?php
                }
?>
                <label class="center" for="file-input"><i class="fas fa-upload"></i>Upload HTTPS Certificate
                <?php
                if ($is_quantum_proof > 0) {
?>
                     <i class="fa fa-check" aria-hidden="true"></i>
<?php
                }elseif ($is_quantum_proof < 0) {
?>
                    <i class="fa fa-times" aria-hidden="true"></i>
<?php
                }
?>
                </label>
            </form>
        </div>

<?php
        if ($is_quantum_proof > 0) {
?>
            <div class="card-result-sucess">
                <h1>YOU ARE QUANTUM PROOF</h1>
                <img id="gif" src="assets/bravo.gif" alt="People applause">
            </div>
<?php
        } elseif ($is_quantum_proof < 0) {
?>
            <div class="card-result-error">
                <h1>HOW TO BE QUANTUM PROOF ?</h1>
                <p>
                    During the 1980s, scientists speculated that if computers could take advantage of the unique
                    properties of quantum mechanics, they could perform complicated computations much faster than
                    classical, binary computers. It quickly became clear that a quantum computer, taking advantage
                    of quantum properties such as superposition and Entanglement, could complete certain types of
                    complex calculations in a matter of hours -- even though it would take a classical computer several
                    years to complete the same calculation.
                </p>

                <h2>Pre-quantum vs. quantum vs. post-quantum cryptography</h2>
                <p>
                    Quantum computers use the laws of quantum mechanics to process information in quantum bits (qubits).
                    Because each qubit can be a combination of 0s and 1s, a quantum computer can process variables
                    exponentially faster than a classical, binary computer. Pre-quantum cryptography uses a specific
                    type of cipher called an algorithm to transform human-readable data into secret code. The challenge
                    of pre-quantum cryptography is to make encryption ciphers easy to understand but difficult to
                    reverse engineer. In contrast, quantum cryptography relies on the physical properties of atoms and
                    uses geometric ciphers to transform human-readable data into unbreakable secret code. A major
                    challenge of post-quantum cryptography is that quantum physics is still an emerging scientific
                    field of study, and prototypes for quantum computers are very expensive to build and operate.
                </p>

                <button onclick="location.href='generate.php'">Generate a post-quantum certificate</button>
            </div>
    <?php
        }
    ?>
    </div>
</div>

<footer class="row">
    <div class="col-8 information-footer">
        <h5>Do you want more </br> informations ?</h5>
        <div class="container">
            <h5><a class="information-footer-list" href="https://www.ibm.com/thought-leadership/institute-business-value/report/exploring-quantum-financial">Quantum computing in finance</a></h5></li>
            <h5><a class="information-footer-list" href="https://quantumxc.com/blog/quantum-computing-impact-on-cybersecurity/">Threats of quantum computing</a><h5></li>
        </div>
    </div>
    <div class="footer-logos col-4">
        <div class="row">
            <div class="col-2">
                <div class="separator-footer"></div>
            </div>
            <div class="col-5" align="center">
                <img src="assets/epsi.png" alt="Logo of EPSI school">
            </div>
            <div class="col-5 mx-auto" align="center">
                <img src="assets/hep.png" alt="Logo of HEP group">
            </div>
        </div>
    </div>
</footer>
</body>
</html>
