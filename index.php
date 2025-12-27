<?php
// index.php
session_start();

// 1. Kết nối CSDL
require_once __DIR__ . '/app/config/ConnectDB.php';

// 2. Lấy tham số controller và action từ URL
// Hỗ trợ cả 2 cách:
// - index.php?controller=home&action=index
// - /Home hoặc /Home/Index (qua .htaccess -> index.php?url=Home hoặc index.php?url=Home/Index)
$controllerName = 'home';
$action = 'index';

if (isset($_GET['url'])) {
    // Xử lý URL dạng /Home hoặc /Home/Index
    $url = trim($_GET['url'], '/');
    $urlParts = explode('/', $url);
    $controllerName = strtolower($urlParts[0] ?? 'home');
    $action = strtolower($urlParts[1] ?? 'index');
} else {
    // Xử lý URL dạng index.php?controller=home&action=index
    $controllerName = isset($_GET['controller']) ? strtolower($_GET['controller']) : 'home';
    $action = isset($_GET['action']) ? strtolower($_GET['action']) : 'index';
}

// 3. Điều hướng (Routing)
switch (strtolower($controllerName)) {
    case 'home':
        require_once __DIR__ . '/app/controllers/Home.php';
        $controller = new Home($conn);
        
        if ($action == 'index') {
            $user_id = $_GET['user_id'] ?? null;
            $controller->Get_data($user_id); // Truyền user_id nếu có
        } elseif ($action == 'detail') {
            $id = $_GET['id'] ?? 0;
            $user_id = $_GET['user_id'] ?? '';
            $controller->detail_Sanpham($id, $user_id);
        }
        break;

    case 'login':
        require_once __DIR__ . '/app/controllers/Login.php';
        $controller = new Login($conn);
        
        if ($action == 'index') {
            $controller->Get_data();
        } elseif ($action == 'process') {
            $controller->processLogin();
        }
        break;

    case 'user':
        require_once __DIR__ . '/app/controllers/User.php';
        $controller = new User($conn);
        
        if ($action == 'profile') {
            $id = $_GET['id'] ?? 0;
            $loggedInId = $_GET['user_id'] ?? '';
            $controller->Profile($id, $loggedInId);
        } elseif ($action == 'update') {
            $controller->Update();
        }
        break;

    case 'auth':
         // Xử lý logout...
         if ($action == 'logout') {
             session_destroy();
             header("Location: index.php");
         }
         break;

    default:
        echo "404 - Controller not found";
        break;
}
?>