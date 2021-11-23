<?php
function str_ends_with( $haystack, $needle ) {
    $length = strlen( $needle );
    if( !$length ) {
        return true;
    }
    return substr( $haystack, -$length ) === $needle;
}

    if (!empty($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'test_certificate') {
            if (str_ends_with($_FILES['certificate']['name'], '.crt')) {
                $is_quantum_proof = test_certificate_size($_FILES['certificate']['size']);
            } else {
                $wrong_format = true;
            }
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
    <h1>Check if your HTTPS certificate is post-quantum proof or not</h1>
    <p>
        Post-quantum cryptography, also called quantum encryption, is the development of cryptographic
        systems for classical computers that are able to prevent attacks launched by quantum computers.
    </p>

    <span class="divider horizontal"></span>

    <form class="card" action="index.php?action=test_certificate" method="post" enctype="multipart/form-data">
        <input id="file-input" type="file" name="certificate" onchange="this.form.submit();">
        <label for="file-input">Upload HTTPS Certificate</label>

<?php
        if (!empty($wrong_format) && $wrong_format) {
?>
        <span class="error">The certificate file format must be .crt</span>
<?php
        }
?>
    </form>

<?php
    if (!empty($is_quantum_proof)) {
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

<footer>
    <h1>Do you want more informations ?</h1>
    <div class="footer-infos">
        <ul>
            <li><a href="https://www.ibm.com/thought-leadership/institute-business-value/report/exploring-quantum-financial">Quantum computing in finance</a></li>
            <li><a href="https://quantumxc.com/blog/quantum-computing-impact-on-cybersecurity/">Threats of quantum computing</a></li>
        </ul>
    </div>

    <span class="divider vertical"></span>

    <div class="footer-img">
        <img src="assets/epsi.png" alt="Logo of EPSI school">
        <img src="assets/hep.png" alt="Logo of HEP group">
    </div>
</footer>
</body>
