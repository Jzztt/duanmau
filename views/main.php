<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Home' ?></title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= BASE_URL ?>">
                <b>Quản lý</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($action ?? '/') == '/' ? 'active' : '' ?>" href="<?= BASE_URL ?>">
                            <i class="bi bi-house-door"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($action ?? '', 'category') !== false) ? 'active' : '' ?>" 
                           href="<?= BASE_URL ?>?action=category-index">
                            <i class="bi bi-tags"></i> Thể loại
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($action ?? '', 'product') !== false) ? 'active' : '' ?>" 
                           href="<?= BASE_URL ?>?action=product-index">
                            <i class="bi bi-box-seam"></i> Sản phẩm
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-3 mb-3"><?= $title ?? 'Home' ?></h1>

        <div class="row">
            <?php
            if (isset($view)) {
                require_once PATH_VIEW . $view . '.php';
            }
            ?>
        </div>
    </div>

</body>

</html>