<?php
$title = "Ohh no!";
$page = "404";
include 'views/layouts/header.php';
?>

<div class="text-center mt-5">
    <div class="error mx-auto" data-text="404">
        <p class="m-0">404</p>
    </div>
    <p class="text-dark mb-5 lead">Không tìm thấy nội dung</p>
    <a href="home.php">← Trở về trang chủ</a>
</div>

<?php
include 'views/layouts/footer.php';
?>