<?php 
class Login extends controller{
    public function Get_data(){
        $data = [];
        $this->view('login_view', $data);
    }

    /**
     * Xử lý đăng nhập
     */
    public function processLogin()
    {
        $error = '';
        
        // Kiểm tra nếu có POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            
            // Validate input
            if (empty($username) || empty($password)) {
                $error = 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!';
            } else {
                // Gọi model để xác thực
                $userModel = $this->model('UserModel');
                $user = $userModel->authenticate($username, $password);
                
                if ($user) {
                    // Đăng nhập thành công - redirect đến Home/Get_data/id_user
                    $id_user = $user['id_user'];
                    header("Location: /baitaplon/Home/Get_data/" . urlencode($id_user));
                    exit();
                } else {
                    $error = 'Tên đăng nhập hoặc mật khẩu không đúng!';
                }
            }
        } else {
            // Nếu không phải POST request, redirect về trang đăng nhập
            header("Location: /baitaplon/Login/Get_data");
            exit();
        }
        
        // Nếu có lỗi, hiển thị lại form với thông báo lỗi
        $data = [
            'error' => $error
        ];
        $this->view('login_view', $data);
    }
}
?>