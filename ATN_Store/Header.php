<html>
    <head>
        <title>ATN</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="CSS.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <link rel="shortcut icon" href="./img/icon_shi.ico">
    </head>
    <body>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
                <!-- Logo -->
                <a href="index.php" class="navbar-brand">
                    <img src="./img/ATN.jpg" style="width:50px" alt="">
                </a>
                <!-- button toggler -->
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navmenu">
                    <!---left -->
                    <div class="navbar-nav" >
                        <a href="allproduct.php" class="nav-link">All Product</a>
                        <a href="cart.php" class="nav-link">Cart</a>
<?php
require_once('connection.php');
    $sql_c = "SELECT * FROM `category`";
    $sql_b = "SELECT * FROM `branch`";

    $c = new Connect();
    $dblink = $c->connectToMySQL();

   $re_c = $dblink->query($sql_c);
   $re_b = $dblink->query($sql_b);

   if($re_c->num_rows > 0){
      
?>
                        <div class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> Categories</a>
                            <div class ="dropdown-menu"> 
<?php
      while($row=$re_c->fetch_assoc()){
       ?>
                                    <li><a href="category.php?id=<?=$row['cid']?> "><?php echo$row["cname"]; ?></a></li>
<?php 
      }}
?>
<?php            
                    if (isset($_COOKIE['cc_usr'])&&$_COOKIE['cc_usr']=='admin'){
?>
                                    <li><a href="addcategory.php">&plus; New</a></li>
<?php 
    }
?> 
                        </div>
                    </div>
<?php 
        if($re_b->num_rows > 0){
  
  ?>
                          <div class="dropdown">
                              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> Branch</a>
                              <div class ="dropdown-menu"> 
  <?php
        while($row=$re_b->fetch_assoc()){
         ?>
                                      <li><a href="branch.php?id=<?=$row['bid']?> "><?php echo$row["bname"]; ?></a></li>
  <?php 
        }}
  ?>
  <?php            
                      if (isset($_COOKIE['cc_usr'])&&$_COOKIE['cc_usr']=='admin'){
  ?>
                                      <li><a href="addcategory.php">&plus; New</a></li>
  <?php 
      }
  ?> 
                              </div>
                          </div>
                    </div>

<!-- Search -->
<div>

</div>


                    <!-- Right -->
<?php            
                    if (isset($_COOKIE['cc_usr'])){
?>
                    <div class="navbar-nav ms-auto">
                        <a href="#" class="nav-link">Welcom, <?=$_COOKIE['cc_usr']?></a>
                        <a href="logout.php" class="nav-link">LogOut</a>
                    </div>
<?php
                    }else{
?>
                    <div class="navbar-nav ms-auto">
                        <a href="Login.php" class="nav-link">Login</a>
                        <a href="Register.php" class="nav-link">Register</a>
                    </div>
<?php
                    }
?>
                </div>
            </div>
        </nav>