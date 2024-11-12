<?php
session_start();
include 'config.php';

// Menangani permintaan pencarian
$search_query = "";
if (isset($_GET['query'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['query']);
}

// Query untuk menampilkan produk berdasarkan pencarian
$query = "SELECT * FROM productstrend WHERE name LIKE '%$search_query%'";
$result = mysqli_query($conn, $query);

// Query untuk Men Collection
$queryMen = "SELECT * FROM productstrend WHERE category='trend' AND gender='man'";
$resultMen = mysqli_query($conn, $queryMen);

// Query untuk Women Collection
$queryWomen = "SELECT * FROM productstrend WHERE category='trend' AND gender='woman'";
$resultWomen = mysqli_query($conn, $queryWomen);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neocult Indonesia - Trendy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
          body {
    font-family: Arial, sans-serif;
    color: #333;
}

header .navbar-brand img {
    width: 80px;
    height: auto;
}

@media (max-width: 768px) {
    .user-actions .icon {
        font-size: 18px;
    }

    header .navbar-nav .nav-link {
        font-size: 14px;
        margin: 5px 0;
    }
}

nav {
    background: #fff;
    flex-grow: 1;
}

nav ul {
    list-style: none;
    display: flex;
    justify-content: center;
    padding-left: 0;
}

nav ul li {
    margin: 0 10px;
    position: relative;
}

nav ul li a {
    text-decoration: none;
    color: #8B4513;
    font-weight: bold;
    transition: color 0.3s;
}

nav ul li a:hover {
    color: #c9ad93;
}

.user-actions {
    display: flex;
    align-items: center;
    margin-right: 50px;
}

.user-actions .icon {
    text-decoration: none;
    color: #8B4513;
    font-size: 20px;
    margin-left: 20px;
    transition: color 0.3s;
}

.user-actions .icon:hover {
    color: #c9ad93;
}

.user-actions .cart-count {
    background: #c9ad93;
    color: #fff;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 14px;
    vertical-align: top;
    margin-left: 5px;
}

.navbar-brand img {
    width: 100px;
    height: auto;
}

.hero {
    position: relative;
    height: 50vh;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 20px;
    background: url('images/oce6.jpg') no-repeat center center/cover;
    animation: fadeIn 2s ease-in-out;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
}

.hero-text {
    position: relative;
    z-index: 2;
    color: #fff;
    max-width: 80%;
    text-align: center;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.shop-now {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    color: #fff;
    background-color: #333;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.shop-now:hover {
    background: #b08d79;
}

/* Style untuk Produk */
.product {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    text-align: center;
    padding: 20px;
    transition: transform 0.3s ease;
    position: relative;
    height: 100%;
}

.product:hover {
    transform: scale(1.05);
}

.product img {
    max-width: 100%;
    height: auto;
    border-bottom: 1px solid #eee;
    margin-bottom: 20px;
}

.product h2 {
    font-size: 1.25rem;
    color: #333;
    margin: 10px 0;
}

.product p {
    color: #777;
    font-size: 1rem;
    margin: 10px 0;
}

.product-content {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-buttons {
    display: flex;
    gap: 10px;
    justify-content: center;
    margin-top: 10px;
}

/* Tombol Beli Sekarang */
.btn-buy {
    display: inline-block;
    padding: 8px 16px;
    color: #fff;
    background-color: #A2C2E6; /* Biru pastel */
    text-decoration: none;
    border-radius: 50px;
    font-weight: 500;
    transition: background-color 0.3s ease;
    margin-top: 10px;
}

.btn-buy:hover {
    background-color: #7EA7D1; /* Warna biru pastel lebih gelap saat hover */
}

/* Tombol Keranjang dengan Ikon Troli */
.btn-cart {
    display: inline-block;
    padding: 8px 16px;
    color: #fff;
    background-color: #F4B6C2; /* Pink pastel */
    text-decoration: none;
    border-radius: 50px;
    font-weight: 500;
    transition: background-color 0.3s ease;
    margin-top: 10px;
    font-size: 18px;
}

.btn-cart i {
    font-size: 16px;
}

.btn-cart:hover {
    background-color: #E798A7; /* Warna pink pastel lebih gelap saat hover */
}

.wishlist-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 24px;
    color: #ccc;
    cursor: pointer;
    transition: color 0.3s;
    display: none;
}

.product:hover .wishlist-icon {
    display: block;
}

.wishlist-icon.active {
    color: #FFB6C1;
}

/* Struktur Layout */
.section-title {
    font-size: 2rem;
    color: #333;
    margin-bottom: 0;
    text-align: center;
    position: relative;
}

.section-title::after {
    content: '';
    width: 60px;
    height: 4px;
    background: #333;
    display: block;
    margin: 10px auto;
    border-radius: 2px;
}

.section-paragraph {
    font-size: 1.5rem;
    color: #333;
    text-align: center;
    margin-top: 5px;
    margin-bottom: 5px;
}

.product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    width: 100%;
    max-width: 1200px;
}

footer {
    background: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    position: relative;
    bottom: 0;
    width: 100%;
}

/* Style untuk Form Pencarian */
.search-form {
    display: none;
    position: absolute;
    top: 90px;
    right: 20px;
    background-color: #fff;
    padding: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 4px;
    z-index: 1000;
}

.search-form form {
    display: flex;
    align-items: center;
}

.search-form input[type="text"] {
    flex: 1;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 5px;
}

.search-form button {
    background-color: #8B4513;
    color: #fff;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
}

.search-form button:hover {
    background-color: #c9ad93;
}

    </style>
</head>

<body>

<body>
    <div class="container-wrapper">
        <!-- Header Section -->
        <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="UAS_MANIES.PHP">
                <img src="images/svt.png" alt="Brand Logo" width="80" height="auto">
            </a>
            
            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="LATEST.PHP">LATEST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="trend.php">TRENDY</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            TIMELESS
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="pakaianklasik.php">Classic Clothes</a></li>
                            <li><a class="dropdown-item" href="sepatuklasik.php">Classic Shoes</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="grafik.php">GRAPHICS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aksesoris.php">ACCESSORIES</a>
                    </li>
                </ul>

                <!-- User Actions: Search and Account -->
                <div class="d-flex align-items-center">
                    <a href="#" class="icon mx-2"><i class="fas fa-search"></i></a>
                    <a href="#" class="icon mx-2"><i class="fas fa-user"></i></a>
                </div>
            </div>
        </div>
    </nav>
</header>


<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1>TRENDY</h1>
        <p>TRENDS IN FALL 24 FROM NEOCULT</p>
    </div>
</section>

<!-- Men Collection -->
<section class="products container">
    <h1 class="section-title text-center mb-5">Men Collection</h1>
    <div class="product-grid">
        <?php
        if ($resultMen && mysqli_num_rows($resultMen) > 0) {
            while ($row = mysqli_fetch_assoc($resultMen)) {
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>Rp ' . number_format($row["price"], 0, ',', '.') . '</p>';
                echo '<div class="product-buttons">';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=productstrend" class="btn btn-buy">Beli Sekarang</a>';
                echo '<a href="tambah_keranjang.php?id=' . $row["id"] . '&category=productstrend" class="btn btn-cart"><i class="fas fa-shopping-cart"></i></a>';
                echo '</div>';
                echo '<i class="bi bi-heart wishlist-icon" data-product-id="' . $row["id"] . '" data-category="trend"></i>';
                echo '</div>';
            }
        } else {
            echo "<p>Produk tidak ditemukan untuk kategori Men.</p>";
        }
        ?>
    </div>
</section>

<!-- Women Collection -->
<section class="products container">
    <h1 class="section-title text-center mb-5">Women Collection</h1>
    <div class="product-grid">
        <?php
        if ($resultWomen && mysqli_num_rows($resultWomen) > 0) {
            while ($row = mysqli_fetch_assoc($resultWomen)) {
                echo '<div class="product">';
                echo '<img src="images/' . $row["image"] . '" alt="' . $row["name"] . '">';
                echo '<h2>' . $row["name"] . '</h2>';
                echo '<p>Rp ' . number_format($row["price"], 0, ',', '.') . '</p>';
                echo '<div class="product-buttons">';
                echo '<a href="beli.php?id=' . $row["id"] . '&category=productstrend" class="btn btn-buy">Beli Sekarang</a>';
                echo '<a href="tambah_keranjang.php?id=' . $row["id"] . '&category=productstrend" class="btn btn-cart"><i class="fas fa-shopping-cart"></i></a>';
                echo '</div>';
                echo '<i class="bi bi-heart wishlist-icon" data-product-id="' . $row["id"] . '" data-category="trend"></i>';
                echo '</div>';
            }
        } else {
            echo "<p>Produk tidak ditemukan untuk kategori Women.</p>";
        }
        ?>
    </div>
</section>



<!-- Footer -->
<footer class="text-center mt-5" style="background-color:#b6dcec;">
    <div class="container p-4">
        <section class="mb-4">
            <!-- Social Media Links -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
            <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
        </section>

        <!-- Newsletter Signup -->
        <section class="mb-4">
            <form action="">
                <div class="row d-flex justify-content-center">
                    <div class="col-auto">
                        <p class="pt-2"><strong>Sign up for our newsletter</strong></p>
                    </div>
                    <div class="col-md-5 col-12">
                        <div class="form-outline mb-4">
                            <input type="email" id="form5Example2" class="form-control" />
                            <label class="form-label" for="form5Example2">Email address</label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-4">Subscribe</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Image Gallery -->
        <section class="mb-4">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu6.jpg" class="img-fluid rounded" alt="Gallery Image 1" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu1.jpg" class="img-fluid rounded" alt="Gallery Image 2" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu5.jpg" class="img-fluid rounded" alt="Gallery Image 3" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu3.jpg" class="img-fluid rounded" alt="Gallery Image 4" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu4.jpg" class="img-fluid rounded" alt="Gallery Image 5" />
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <img src="images/gu2.jpg" class="img-fluid rounded" alt="Gallery Image 6" />
                </div>
            </div>
        </section>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2020 Copyright: <a class="text-dark" href="UAS_MANIES.PHP">CARAT.com</a>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
<script>
    function toggleSearchForm() {
        const searchForm = document.getElementById('searchForm');
        if (searchForm.style.display === 'none' || searchForm.style.display === '') {
            searchForm.style.display = 'block';
        } else {
            searchForm.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const wishlistIcons = document.querySelectorAll('.wishlist-icon');

        wishlistIcons.forEach(function(icon) {
            icon.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const category = this.getAttribute('data-category');
                const userId = 1;

                fetch('wishlist.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'user_id=' + userId + '&product_id=' + productId + '&category=' + category,
                })
                .then(response => response.text())
                .then(data => {
                    alert(data);
                    this.classList.toggle('active');
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });
</script>
</body>

</html>
