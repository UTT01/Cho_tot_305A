<?php
// $currentView: tên file page (home, ...) được controller truyền sang
// $data: mảng dữ liệu dùng trong các page
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Trang chủ - Chợ Tốt Clone</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Tổng thể giao diện: tông màu dịu, nhẹ mắt */
        body {
            background: #f1f5f9;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #0f172a;
        }

        /* Navbar */
        .navbar {
            background: #ffffffcc;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.02em;
            color: #f59e0b !important;
        }

        /* Form tìm kiếm trên navbar */
        .search-bar {
            background: #f8fafc;
            border-radius: 999px;
            padding: 6px 10px;
            border: 1px solid #e2e8f0;
        }

        .search-bar .form-control,
        .search-bar .form-select {
            border: none;
            background: transparent;
            box-shadow: none !important;
        }

        .search-bar .form-control::placeholder {
            color: #94a3b8;
        }

        .search-bar .btn-search {
            border-radius: 999px;
            padding-inline: 20px;
            font-weight: 600;
        }

        /* Nút màu vàng nhưng giảm độ chói */
        .btn-warning,
        .btn-warning:hover,
        .btn-warning:focus {
            background-color: #facc15;
            border-color: #eab308;
            color: #1f2933;
        }

        /* Thẻ sản phẩm */
        .product-card {
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
            background: #ffffff;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 18px 30px rgba(15, 23, 42, 0.08);
            border-color: #cbd5f5;
        }

        .product-card img {
            border-bottom: 1px solid #e2e8f0;
        }

        .badge-category {
            background-color: #f97316;
            color: #ffffff;
            border-radius: 999px;
            font-weight: 500;
            font-size: 0.75rem;
            padding-inline: 10px;
        }

        /* Tiêu đề khối nội dung chính */
        .page-header-title {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .page-header-title small {
            font-weight: 400;
        }

        /* Nút phân trang */
        .pagination .page-link {
            border-radius: 999px !important;
            margin-inline: 2px;
        }

        .pagination .page-item.active .page-link {
            background-color: #0f172a;
            border-color: #0f172a;
        }

        /* Bo góc & nền nhẹ cho container chính */
        .main-container {
            background: #ffffff;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        }

        @media (max-width: 768px) {
            .search-bar {
                border-radius: 16px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<!-- Thanh navbar trên cùng -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="http://localhost/baitaplon/Home">
            Chợ Tốt Clone
        </a>

        <!-- Form tìm kiếm chính (giữa navbar) -->
        <form class="d-flex flex-grow-1 mx-3 search-bar align-items-center gap-2" method="GET" action="/baitaplon/Home">
            <?php
            $keyword  = isset($data['keyword']) ? $data['keyword'] : '';
            $category = isset($data['category']) ? $data['category'] : '';
            $categories = isset($data['categories']) ? $data['categories'] : [];
            $address  = isset($data['address']) ? $data['address'] : '';
            ?>
            <select class="form-select" name="danhmuc">
                <option value="">Tất cả danh mục</option>
                <?php foreach ($categories as $cat): ?>
                    <option
                        value="<?php echo htmlspecialchars($cat['id_danhmuc']); ?>"
                        <?php echo ($category === $cat['id_danhmuc']) ? 'selected' : ''; ?>
                    >
                        <?php echo htmlspecialchars($cat['ten_danhmuc']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input
                class="form-control"
                type="text"
                name="q"
                placeholder="Tìm kiếm sản phẩm, từ khóa..."
                value="<?php echo htmlspecialchars($keyword); ?>"
            >
            <input
                class="form-control"
                type="text"
                name="diachi"
                placeholder="Tìm theo khu vực / địa chỉ"
                value="<?php echo htmlspecialchars($address); ?>"
            >
            <button class="btn btn-warning btn-search" type="submit">Tìm kiếm</button>
        </form>

        <div class="d-flex">
            <a href="?url=Auth/Login" class="btn btn-outline-secondary me-2">Đăng nhập</a>
            <a href="?url=Auth/Register" class="btn btn-warning">Đăng ký</a>
        </div>
    </div>
</nav>

<!-- Nội dung chính -->
<div class="container my-4">
    <?php
    if (isset($data["page"]) && $data["page"]) {
        if (file_exists("./MVC/Views/Page/".$data["page"].".php")) {
            require_once "./MVC/Views/Page/".$data["page"].".php";
        } else {
            echo '<div class="alert alert-danger">Không tìm thấy page: ' . htmlspecialchars($data["page"]) . '</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Không có trang nào được chọn!</div>';
    }
    ?>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


