
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SnakesShop</title>
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
</head>
<body>
	<?php
		include("../project1/connect/open.php");
				$search = "";
				if(isset($_GET["search"])){
					$search = $_GET["search"];
				}
				$sql = "SELECT * FROM bill WHERE  (time_buy LIKE '%$search%' OR name_user LIKE '%$search%' OR phone_number_user LIKE '%$search%' OR address_user LIKE '%$search%') AND status = 1";
				$result = mysqli_query($con , $sql);
				if($result != null){
					$num = mysqli_num_rows($result);
				}
				
		include("../project1/connect/close.php");
				
	?>
	
	<div class="wrapper">
	
		<?php 
			include("sidebar.php");
		?>
	
	
		<div class="content">

			<!--  tìm kiếm -->
			<div class="row">
				<form action="search.php" method="get">
					<input type="date" name="search" placeholder ="Search..." value="<?php if (isset($_GET["search"])) {
	                                              echo format_date($_GET["search"] , 'D-m-y');
	                                            } ?>" >
					<button><i class="fa fa-search"></i></button>

				</form>
				
			</div>

			<!--  hiện thị nội dung -->
			<div class="content_content">
				<?php  if(isset($search)){
				if( $search != ""){
					echo "Tìm thấy $num kết quả liên qua tới '$search...'";
					}
				}
				if(isset($_GET["err"])){
					echo "<strong>Bạn không được cấp quyền thực hiện thao tác này!</strong>";
				}
				?>
				<h2 class="text-center">Quản Lý Danh Mục</h2>
				<table>
				<tr>
					<th>STT</th>
					<th width="300px">TÊN DANH MỤC</th>
					<th width="100px"></th>
					<th width="100px"></th>
				</tr>
				<tr>
					<td colspan="4"><hr></td>
				</tr>
				
						
						<tr>
							<td></td>

							<td></td>

							<td>
								<a href="update.php?id=<?php echo $category['id_category']?>"><button class="btn btn-warning" >SỬA</button></a>
							</td>

							<td>
								<a href="" onclick=" return confirm('ARE YOU SURE ?')">
									<button class="btn btn-danger">XÓA</button>
								</a>
							</td>
						</tr>
					
					
				</table>
			</div>
		</div>
	</div>
</body>
</html>