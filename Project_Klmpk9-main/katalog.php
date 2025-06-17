<?php include 'config.php'; ?>
<?php include 'navbar.php'; 
 $no_wa = '6285655202673'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ze Beauty's!</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <style>
    .bg-section {
      background-image: url('img/bg2.png');
      background-size: cover;
      background-position: center;
      color: #582f0e;
      padding: 40px 0;
    }
    .card {
      border: none;
      border-radius: 10px;
      overflow: hidden;
      transition: transform 0.2s ease-in-out;
      height: 300px;
      width: 100%;
    }
    .card:hover {
      transform: scale(1.05);
    }
    .card-img-top {
      width: 100%;
      height: 160px;
      object-fit: contain;
    }
    .card-title {
      font-size: 1.1rem;
      font-weight: bold;
      color: #582f0e;
      margin-bottom: 10px;
    }
    .card-body {
      text-align: center;
      padding: 10px;
    }
    .btn-primary {
      background-color: #582f0e;
      border-color: #582f0e;
      font-size: 0.9rem;
      padding: 5px 10px;
    }
    .btn-primary:hover {
      background-color: #7a4b2e;
      border-color: #7a4b2e;
    }
  </style>
</head>
<body>

<div class="bg-section">
  <div class="container">
    <h1 class="text-center font-italic bold py-3">Catalog Products</h1>
    <div class="row">
      <?php
      $sql = "SELECT * FROM kategori_produk";
      $result = $conn->query($sql);

      if (!$result) {
        echo "<div class='col-12'><p class='text-center text-danger'>Error: " . $conn->error . "</p></div>";
      } else {
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<div class='col-sm-6 col-md-4 col-lg-3 mb-4 d-flex align-items-stretch'>";
echo "  <div class='card shadow-sm'>";
echo "    <img src='uploads/" . htmlspecialchars($row["urlgambar"]) . "' class='card-img-top' alt='Kategori'>";
echo "    <div class='card-body'>";
echo "      <h5 class='card-title'>" . htmlspecialchars($row["nama"]) . "</h5>";
echo "      <p class='text-muted'>Mulai dari Rp " . number_format($row["harga"], 0, ',', '.') . "</p>";
$pesan = "Permisi, kami Kostumers Ze Beauty's ingin membeli produk sebagai berikut : " . 
          $row["nama"] . " dengan harga Rp " . number_format($row["harga"], 0, ',', '.') . 
          ". Mohon konfirmasi ketersediaan dan proses pembelian. Terima kasih.";
$link_wa = "https://wa.me/$no_wa?text=" . urlencode($pesan);
echo "      <a href='" . $link_wa . "' target='_blank' class='btn btn-primary'>Buy Now</a>";
echo "    </div>";
echo "  </div>";
echo "</div>";

          }
        } else {
          echo "<div class='col-12'><p class='text-center'>Belum ada kategori produk.</p></div>";
        }
      }

      $conn->close();
      ?>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
