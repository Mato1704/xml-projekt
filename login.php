<?php
$poruka = "";
$korisnikInfo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $lozinka = $_POST['password'] ?? '';

    
    $xml = simplexml_load_file("korisnici.xml") or die("Greška pri učitavanju XML-a.");

    foreach ($xml->korisnik as $korisnik) {
        if (
            (string)$korisnik->username === $username &&
            (string)$korisnik->lozinka === $lozinka
        ) {
            $poruka = "Uspješna prijava!";
            $korisnikInfo = "
                <p><strong>username:</strong> {$korisnik->username}</p>
                <p><strong>password:</strong> {$korisnik->lozinka}</p>
                
            ";
            break;
        }
    }

    if (empty($poruka)) {
        $poruka = "Neispravno korisničko ime ili lozinka.";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Login - XML Provjera</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.html">Knjižara Leptir</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navMenu">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link" href="index.html">Početna</a></li>
          <li class="nav-item"><a class="nav-link" href="ponuda.php">Ponuda</a></li>
          <li class="nav-item"><a class="nav-link" href="onama.html">O nama</a></li>
          <li class="nav-item"><a class="nav-link active" href="login.php">Login</a></li>
        </ul>
      </div>
    </div>
  </nav>

<div class="container py-5" style="max-width: 500px;">
    <h2 class="mb-4 text-center">Prijava korisnika</h2>

    <form method="post" class="border p-4 bg-white shadow-sm rounded">
        <div class="mb-3">
            <label for="username" class="form-label">Korisničko ime</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Lozinka</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Prijavi se</button>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <div class="mt-4 alert <?= $poruka === "Uspješna prijava!" ? 'alert-success' : 'alert-danger' ?>">
            <?= htmlspecialchars($poruka) ?>
        </div>

        <?php if ($korisnikInfo): ?>
            <div class="card mt-3">
                <div class="card-body">
                    <?= $korisnikInfo ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

</body>
</html>
