<?php
class UserModel extends connectDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserById($id_user)
    {
        $id_user = mysqli_real_escape_string($this->con, $id_user);
        $sql = "SELECT * FROM users WHERE id_user = '$id_user'";
        $result = mysqli_query($this->con, $sql);
        if ($result) {
            return mysqli_fetch_assoc($result);
        }
        return null;
    }

    public function isManager($id_user)
    {
        $user = $this->getUserById($id_user);
        if ($user) {
            if (isset($user['vaitro'])) {
                return $user['vaitro'] == 'quanly' || $user['vaitro'] == 'admin';
            }
            if (isset($user['role'])) {
                return $user['role'] == 'quanly' || $user['role'] == 'admin' || $user['role'] == 'manager';
            }
            // Nếu không có cột vaitro/role, mặc định không phải quản lý
            return false;
        }
        return false;
    }
}
?>

