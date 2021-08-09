
<!DOCTYPE html>
<html>
<head>
	<title>Quản lý Sản Phẩm</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="../../image/icon.jpg">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="style.css">
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">


	
</head>
<body>
	<?php
		include("../Project1/connect/open.php");
			$search = "";
		    $limit = 4;
		    $start = 0;
		    // Viết câu sql đếm tổng sản phẩm
		    $sqlDemSp = "SELECT COUNT(*) AS tongSoSp FROM products";
		    $resultDemSp = mysqli_query($con, $sqlDemSp);
		    $demSp = mysqli_fetch_array($resultDemSp);
		    // Lấy tổng số trang 
		    $tongTrang = ceil($demSp["tongSoSp"] / $limit);
		    if (isset($_GET["trang"])) {
		      $trang = $_GET["trang"];
		      $start = ($trang - 1) * $limit;
		    }
			$search = "";
			if(isset($_GET["search"])){
				$search = $_GET["search"];
			}
			$products = "SELECT * FROM products  WHERE name LIKE '%$search%' OR brand LIKE '%$search%' OR name LIKE '%$search%' LIMIT $start,$limit ";
			$resultsql = mysqli_query($con , $products);
			if($resultsql != null){
				$num = mysqli_num_rows($resultsql);
			}
			$category = "SELECT * FROM category";
			$resultCate = mysqli_query($con , $category);
				
		include("../Project1/connect/close.php");
				
	?>

	<div class="wrapper">
    
        <?php 

        include("sidebar.php");
        ?>
	
	<div class="content">
	
		<div class="row">
			<form>
				<input type="text" name="search" placeholder ="Search..." value="<?php if (isset($_GET["search"])) {
                                              echo $_GET["search"];
                                            } ?>">
				<button class="btn btn"><i class="fa fa-search"></i></button>

			</form>
			
		</div>

		<div class="content_content">
			<?php  
			if(isset($search) && isset($num)){
					if($search != ""){
						echo "Tìm thấy $num kết quả liên qua tới '$search...'";
					}	
			}
			if(isset($_GET["err"])){
				echo "<strong>Bạn không được cấp quyền thực hiện thao tác này!</strong>";
			}		
			?>
				<h2 class="text-center">Quản Lý Sản Phẩm</h2>
			<?php
				if($resultsql != null){
			while($products = mysqli_fetch_array($resultsql) ) { ?>
				<div class="product_show">
					<div class="image_product">
						<img src="../project1/upload/<?php echo $products["image"] ?>" style="width : 250px; height: 300px">
					</div>
					<div class="info_product">
						<div class="info_detail">
							<h1><?php echo $products["name"]; ?></h1>
						</div>
						<div class="info_detail">
							<h4>
								<?php
								include("../Project1/connect/open.php");
									$category = "SELECT category.id_category,category.name, products.id_category FROM category JOIN products ON  category.id_category = products.id_category WHERE category.id_category = ".$products["id_category"];
									
									$result_cate = mysqli_query($con , $category);
									
									if($result_cate != null){
									while($category = mysqli_fetch_array($result_cate) ) { 
										echo "Thể loại:".$category["name"]."<br>" ;
										break;
									}}
								include("../Project1/connect/close.php");
								?>
							</h4>
							
						</div>
						<div class="info_detail">
							<h4><?php echo "Thương hiệu:".$products["brand"] ?></h4>
						</div>
						<div class="info_detail" style="color: #ed5f07;">
							<?php echo "Giá tiền:".number_format($products["price"], 0, '.',',')." VNĐ"; ?>
						</div>
						<div class="info_detail">
							<?php echo "Số lượng:".$products["amount"] ?>
						</div>

						<div class="info_detail">
							<a href="update.php?id=<?php echo $products['id_products']?>">
									<button>SỬA</button>
							</a>
							<a href="delete.php?id=<?php echo $products['id_products']?>" onclick="return confirm('ARE YOU SURE?')">
									<button>XÓA</button>
							</a>
						</div>
					</div>
				</div>
			<?php }} ?>
				
			<div class="page">
                    <?php 
                        // Hiển thị danh sách trang
                        for ($i = 1; $i <= $tongTrang; $i++) {
                            if(isset($search)){
                    ?>
                            <a href="?search=<?php echo $search; ?>&trang=<?php echo $i; ?>">
                            <?php echo $i; ?>
                            </a>
                    <?php
                        }}
                    ?>    
            </div>
		</div>
	</div>
	</div>
</body>
</html>