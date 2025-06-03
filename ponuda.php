<?php
$knjige = simplexml_load_file('knjige.xml') or die('Ne mogu učitati XML datoteku.');
?>

<!DOCTYPE html>
<html lang="hr">
<head>
  <meta charset="UTF-8">
  <title>Ponuda knjiga</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-img-top {
      height: 250px;
      object-fit: contain;
    }
  </style>
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
          <li class="nav-item"><a class="nav-link active" href="ponuda.php">Ponuda</a></li>
          <li class="nav-item"><a class="nav-link" href="onama.html">O nama</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
        </ul>
        
      </div>
    </div>
  </nav>
<div class="container py-5">
  <h1 class="text-center mb-5">Ponuda knjiga</h1>
  
  <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($knjige->knjiga as $knjiga): ?>
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="<?= htmlspecialchars($knjiga->slika) ?>" class="card-img-top" alt="Naslovnica knjige">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($knjiga->naslov) ?></h5>
            <p class="card-text"><strong>Autor:</strong> <?= htmlspecialchars($knjiga->autor) ?></p>
            <p class="card-text"><?= htmlspecialchars($knjiga->opis) ?></p>
          </div>
          <div class="card-footer bg-white border-top-0">
            <p class="text-end fw-bold text-primary mb-0">
              <?= number_format((float)$knjiga->cijena, 2) ?> €
            </p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>
  <footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">© 2025 Knjižara Leptir. Sva prava pridržana.</p>
  </footer>

</body>
</html>
