
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="header.css">
	<link rel="shortcut icon" href="../img/icon.png">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<?php
	$con = mysqli_connect("localhost", "root", "", "pj1");
  //Mở kết nối csdl
	if(isset($_SESSION["email"]) ){
		$email = $_SESSION["email"];
  //Tạo câu query
		$search = "";
		if (isset($_GET["search"])) {
			$search = $_GET["search"];
		}
		$sql = "SELECT * FROM customer WHERE email_kh = '$email' ";

	  //Chạy query
		$result = mysqli_query($con, $sql);
		if($result != null){
			$user = mysqli_fetch_assoc($result);
			var_dump($user);exit;
			
		}

  //Đóng kết nối csdl

	}
	mysqli_close($con);
	?>

	<div id="header">
		<div id="top">
			<div id="topLeft"><p>CHÀO MỪNG BẠN ĐẾN VỚI SIÊU THỊ THÚ CƯNG | email: petshoppj1@gmail.com</p></div>
			<div id="topRight">
				<ul class="dropdown">
					<?php if(!isset($_SESSION["email"])){ ?>

						<li class="dropdown-item"><a href="dang_nhap_kh.php"><i class="fa fa-user"></i><span>Đăng nhập</span></a></li>
						<li class="dropdown-item"><a href="dang_ki.php"><i class="fa fa-user"></i><span>Đăng kí</span></a></li>

					<?php } else { ?> 

						
						<li class="dropdown-item">
							<a href="tai_khoan_kh.php?id=<?php echo $user["ten_kh"]?>"><i class="fa fa-user-circle"></i><?=$user['ten_kh'] ?></a>
						</li>
						<li class="dropdown-item">
							<a href="dang_xuat_kh.php"><i class="fa fa-user-circle"></i>Đăng xuất </a>
						</li>
						

					<?php } ?>
				</ul>
			</div>
			<div id="trong"></div>
		</div>

		<div id="center">
			<div id="menu">
				<form action="search.php" method="get">
					<div id="logo">
						<img src="../img/logo2.jpg">
					</div>

					<div id="search-text">
						<input t7 ype="text" name="search" placeholder="Search">
						<button id="search-btn">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
				
			</div>


			<div id="menu1">
				<ul>
					<li><a href="xem_gio_hang.php"><i class="fa fa-shopping-cart"></i><span>Giỏ hàng</span></a></li>
					<li><a href="xem_gio_hang.php"><i class="fas fa-phone-square-alt"></i><span>Liên hệ 0122345</span> </a></li>
				</ul>
			</div>		
		</div>

		<div id="bottom">
			<ul>
				<li><a href="trangchu.php">TRANG CHỦ</a></li>
				<li><a href="#">GIỚI THIỆU</a></li>
				
				<li><a href="#">DÀNH CHO CHÓ</a>
					<li><a href="#">DÀNH CHO MÈO</a></li>
					<li><a href="#">ĐỒ DÙNG CHÓ MÈO</a></li>
				</ul>
			</div>
		</div>
	</body>
	</html>