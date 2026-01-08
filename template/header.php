<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $title ?? "MyBooks"; ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
 .nav-link {
  color: white !important;
}

</style>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">

    <!-- Logo -->
    <a class="navbar-brand fw-bold" href="index.php">
      📚 MyBooks
    </a>

    <!-- Mobile Button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="mainmenu">

      <!-- Left Menu -->
      <ul class="navbar-nav ms-auto">

        <li class="nav-item">
          <a class="nav-link" href="publisher_list.php">🔗Publishers</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="books.php">Books</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="cart.php">
            🛒 Cart
          </a>
        </li>

      </ul>

    </div>

  </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
