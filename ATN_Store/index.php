<?php
require_once('Header.php');
require_once('connection.php');

$sql = "SELECT * FROM `product` ORDER BY `pdate` DESC LIMIT 3";

$c = new Connect();
$dblink = $c->connectToMySQL();

$re = $dblink->query($sql);

if($re->num_rows > 0){
?>

<br>
<div class="container">
    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

      <!-- Indicators/dots -->
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
      </div>

      <!-- The slideshow/carousel -->
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="./img/ATNSlider1.jpg" alt=""  class="d-block" style="width:100%">
        </div>
        <div class="carousel-item">
          <img src="./img/Bagr.jpg" alt="" class="d-block" style="width:100%">
        </div>
        <div class="carousel-item">
          <img src="./img/800xSlider.jpg" alt="" class="d-block" style="width:100%">
        </div>
      </div>

      <!-- Left and right controls/icons -->
      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>
</div>
<br>


<div class="container"> <span align="center"><h1>NEW PRODUCT</h5></span>
  <div class="row justify-content-center">
      <?php
      while($row=$re->fetch_assoc()){
       ?>

    <div class="col-md-4" style="margin-bottom: 20px;">
      <div class="card h-100 shadow-sm">
        <a href="detailpro.php?id=<?=$row['pid']?>">
          <img src="./images/<?=$row['pimage']?>" class="card-img-top" alt="product.title" />
        </a>

        <div class="label-top shadow-sm">
        </div>
        <div class="card-body">
          <div class="clearfix mb-3">
            <span class="float-start badge rounded-pill bg-success"> &dollar;<?=$row['pprice']?></span>
 
           
          </div>
          <h5 class="card-title">
            <a target="_blank" href="detail.php?id=<?=$row['pid']?>">
               <?=$row['pname']?>
            </a>
          </h5>
 
          <div class="d-grid gap-2 my-4">
 
            <a href="cart.php?id=<?=$row['pid']?>" class="btn btn-warning bold-btn">add to cart</a>
 
          </div>
          <div class="clearfix mb-1">
 
            <span class="float-start"><a href="#"><i class="fas fa-question-circle"></i></a></span>
 
            <span class="float-end">
              <i class="far fa-heart" style="cursor: pointer"></i>
 
            </span>
          </div>
        </div>
      </div>
    </div>

<?php
  }
?>
  </div>
</div>
<?php
   }else{
      echo "Not Found";
   } 
?>