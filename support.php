<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hỗ trợ</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #3487b6;
            /* Màu nền xanh */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            background-color: #fcf8f6;
            /* Màu nền trắng cho nội dung */
        }

        .content {
            flex: 1;
        }

        
    </style>
</head>

<body>
<div class="content-wrapper " style="background-color: #fcf8f6; margin: 30px; padding: 0; ">
       
        <?php include 'includes/header.php'; ?>
    
        <h1 class="text-center mb-4">Hỗ trợ người dùng</h1>
        <div class="row w-100 m-4">
            <div class="col-md-5 d-flex flex-column justify-content-center align-items-start ">
                <h2>Liên hệ</h2>
                <p>Tên: Hồ Bảo Trí</p>
                <p><i class="fas fa-phone"></i> Điện thoại: 0345334311</p>
                <p><i class="fab fa-facebook"></i> <a href="https://www.facebook.com/hatanminh1512"
                        target="_blank">Facebook</a></p>
                <p><i class="fas fa-comments"></i> Zalo: 0345334311</p>
            </div>
            <div class="col-md-6 ">
                <form action="index.html" method="POST">
                    <div class="form-group">
                        <label for="userName">Tên người dùng</label>
                        <input type="text" class="form-control" id="userName" name="userName" required>
                    </div>
                    <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="userMessage">Tin nhắn</label>
                        <textarea class="form-control" id="userMessage" name="userMessage" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Gửi</button>
                </form>
            </div>
            
        </div>
        
            <?php include 'includes/footer.php'; ?>
        
</div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>