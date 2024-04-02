<?php
require_once('Header.php');
require_once('connection.php');

$c = new Connect();
$dblink = $c->connectToPDO();

if (isset($_GET['id'])){
    
    $pid = $_GET['id'];

    $findSql="SELECT `cproid` FROM `cart` WHERE `cproid` = ? and `cuserid` = ?";
    $re = $dblink->prepare($findSql);
    $valueArray = [ $pid,1];
    $stmt = $re->execute($valueArray);

    if ($re->rowCount()==0) {
        $sql= "INSERT INTO `cart`(`cuserid`, `cproid`, `cquantity`, `cdate`) VALUES (?,?,1,CURDATE())";
    }else {
        $sql="UPDATE `cart` SET `cquantity` = `cquantity`+1, `cdate` = CURDATE()  WHERE `cuserid` = ? and `cproid` = ?";
    }
    $re1 = $dblink->prepare($sql);
    $valueArray1 = [ 1,$pid];
    $stmt = $re1->execute($valueArray1);
    
    
}
    $showCartSQL="SELECT `pname`,`pprice`,`pimage`,`cquantity` FROM `cart` c , `product` p WHERE c.cproid = p.pid and `cuserid` = ?";
    $re2 = $dblink->prepare($showCartSQL);
    $valueArray2 = [1];
    $re2->execute($valueArray2);

    $rows = $re2->fetchAll(PDO::FETCH_BOTH);




?>
<section class="bg-light my-5">
  <div class="container">
    <div class="row">
      <!-- cart -->
      <div class="col-lg-9">
        <div class="card border shadow-0">
          <div class="m-4">
            <h4 class="card-title mb-4">Your shopping cart</h4>
            <h6 class="mb-0 text-muted"> <?=$re2->rowCount()?> item(s) </h6>
<?php
    foreach ($rows as $row) {

    
?>
            <div class="row gy-3 mb-4">
              <div class="col-lg-5">
                <div class="me-lg-5">
                  <div class="d-flex">
                    <img src="./images/<?=$row['pimage']?>" class="border rounded me-3" style="width: 96px; height: 96px;" />
                    <div class="">
                      <a href="#" class="nav-link"><?=$row['pname']?></a>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-2 col-sm-6 col-6 d-flex flex-row flex-lg-column flex-xl-row text-nowrap">
                <div class="">
                
                <input type="text" class="form-control text-center border border-secondary" placeholder="14" aria-label="Example text with button addon" aria-describedby="button-addon1" />
                
                </div>
                <div class="">
                  <text class="h6"> <?=$row['pprice']*$row['cquantity']?> </text> <br />
                  <small class="text-muted text-nowrap"> <?=$row['pprice']?> / per item </small>
                </div>
              </div>
              <div class="col-lg col-sm-6 d-flex justify-content-sm-center justify-content-md-start justify-content-lg-center justify-content-xl-end mb-2">
                <div class="float-md-end">
                  <!-- <a href="#!" class="btn btn-light border px-2 icon-hover-primary"><i class="fas fa-heart fa-lg px-1 text-secondary"></i></a> -->
                  <a href="#"><p class="btn btn-light border text-danger icon-hover-danger">Remove</p></a>
                </div>
              </div>
            </div>
<?php
    }
?>
          
        </div>
      </div>
      <!-- cart -->
<?php

    $SUM="SELECT SUM(p.pprice*c.cquantity) as `Sum` FROM `cart` c , `product` p WHERE c.cproid = p.pid and `cuserid` = ?";
    $re3 = $dblink->prepare($SUM);
    $valueArray3 = [1];
    $re3->execute($valueArray3);

    $rows1 = $re3->fetchAll(PDO::FETCH_BOTH);
?>
      <!-- summary -->
      <div class="col-lg-3">
        <div class="card shadow-0 border">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <p class="mb-2">Total price:</p>
<?php
  foreach ($rows1 as $row) {
?>              
              <p class="mb-2"><?=$row['Sum']?></p>
<?php
  }
?>              
            </div>

            <div class="mt-3">
              <a href="#" class="btn btn-success w-100 shadow-0 mb-2"> Make Purchase </a>
              <a href="index.php" class="btn btn-light w-100 border mt-2"> Back to shop </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

if($pageWasRefreshed ) {
  header("location: cart.php?id=0");
}
?>
