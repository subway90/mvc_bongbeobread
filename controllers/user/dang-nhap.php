<?php

# [AUTHOR]
// Kiểm tra đã đăng nhập chưa
if(!empty($_SESSION['user'])) route('trang-chu');

# [MODEL]
model('user','user');

# [VARIABLE]
    $username = '';
    $return_checkout_page = false; // trạng thái quay lại trang thanh toán

# [HANDLE]
// Kiểm tra xem có quay lại trang thanh toán không
if(isset($_arrayURL[1]) && $_arrayURL[1] && $_arrayURL[1] == 'thanh-toan') $return_checkout_page = true;

if(isset($_POST['login'])) {
    // lấy thông tin từ form
    $username = clear_input($_POST['username']);
    $password = clear_input($_POST['password']);

    // Bắt validate
    if(!$username) toast_create('danger','Vui lòng nhập username');
    else {
        if(!$password) toast_create('danger','Vui lòng nhập mật khẩu');
        else{
            // Thực hiện lấy thông tin trên database
            $get_user = pdo_query_one(
                'SELECT username, password FROM user WHERE username = "'.$username.'"'
            );
            // Kiểm tra
            if(!$get_user) toast_create('danger','Tài khoản này không tồn tại');
            else {
                // Đăng nhập thành công
                if(md5($password) == $get_user['password']) {
                    
                    $_SESSION['user'] = get_one_user_by_username($get_user['username']);
                    // Tạo token remember
                    $token_remember = create_uuid();
                    // Lưu token remember vào database
                    pdo_execute(
                        'UPDATE user SET token_remember ="'.$token_remember.'" WHERE username ="'.$_SESSION['user']['username'].'"'
                    );
                    // Lưu token remember vào cookie (thời hạn là 1 tháng)
                    setcookie('token_remember', $token_remember, time() + (86400 * 30));
                    // Thông báo toast
                    toast_create('success','<i class="bi bi-check-circle me-2"></i> Đăng nhập thành công');
                    // Chuyển hướng trang thanh toán (nếu có)
                    if($return_checkout_page) {
                        route('thanh-toan');
                    }
                    // Chuyển hướng theo role
                    if($_SESSION['user']['name_role'] == 'admin') {
                        header('Location: '.URL.'admin');
                        exit;
                    }else {
                        header('Location: '.URL);
                        exit;
                    }
                    
                }
                // Đăng nhập thất bại
                else toast_create('danger','Mật khẩu không chính xác !');
            }
        }
    }

    



}

# [DATA]
$data = [
    'username' => $username,
    'return_checkout_page' => $return_checkout_page
];

# [RENDER VIEW]
view('user','Đăng nhập','login',$data);