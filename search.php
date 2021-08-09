
<?php  
session_start();
	if(isset($_SESSION["Sadmin"]) || isset($_SESSION["admin"])){

	}else{
		header("Location:../account/login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>SnakesShop</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="../../image/icon.jpg">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<?php
		include("../Project1/connect/open.php");
				$search = "";
				if(isset($_GET["search"])){
					$search = $_GET["search"];
				}
				$sql = "SELECT * FROM bill WHERE  (time_buy LIKE '%$search%' OR name_user LIKE '%$search%' OR phone_number_user LIKE '%$search%' OR address_user LIKE '%$search%')";
				$result = mysqli_query($con , $sql);
				if($result != null){
					$num = mysqli_num_rows($result);
				}
				
		include("../Project1/connect/close.php");
				
	?>
	<div class="wrapper">
    
        <?php 

        include("sidebar.php");
        ?>
	
		<div class="content">
			<div class="row">
				<form>
					<input type="date" name="search" placeholder ="Search..." value="<?php if (isset($_GET["search"])) {
												$search = $_GET["search"];
	                                              echo date_format($search , 'Y-m-d');
	                                            } ?>">
					<button class="btn btn"><i class="fa fa-search"></i></button><br>
				</form>
				
			</div>
			<div class="content_content">
				<?php  
				if(isset($search) && isset($num)){
					
						if($search != ""){
						echo "Tìm thấy $num kết quả liên qua tới '$search...'";
						}

					
				}
					
				?>
			
				<h2 class="text-center">Doanh thu</h2>
				
				<table>
					<tr>
						<th>STT </th>
						<th>Tên người mua </th>
						<th>Ngày mua hàng </th>
						<th>Số Điện Thoại </th>
						<th>Địa Chỉ Nhận Hàng </th>
						<th style="color: red;">Giá(VNĐ) </th>
					</tr>
					<tr>
						<td colspan="6"><hr></td>
					</tr>
						
						
					
					<?php  
						$sum = 0;
						$index = 1;
						if($result != null){
					while($bill = mysqli_fetch_array($result) ) { ?>
							
							<tr>
								<td><?php echo $index++ ?></td>

								<td><?php echo $bill["name_user"] ?></td>

								<td><?php echo $bill["time_buy"] ?></td>

								<td><?php echo $bill["phone_number_user"] ?></td>

								<td><?php echo $bill["address_user"] ?></td>

								<td style="color: red;"><?php echo number_format($bill["price"],0,'.',',') ?></td>

							</tr>
							<?php  
                                $sum += $bill["price"];
                            } ?>

					<?php } ?>
					<tr>
						<td colspan="6"><hr></td>
					</tr>
					<tr>
						<td colspan="6" style="color: red;">
							Tổng doanh thu:
							<?php 
								echo number_format($sum,0,'.',',')." VNĐ";
							?>
	 
						</td>
					</tr>
				</table>
			</div>
		</div>		
</body>
</html>