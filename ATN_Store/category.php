<?php
require_once('Header.php');
require_once('connection.php');
$c = new Connect();
$dblink = $c->connectToPDO();

if (isset($_GET['id'])){
    
    $cid = $_GET['id'];

    $sql = "SELECT * FROM `product` WHERE pcatid = ?";

    $re = $dblink->prepare($sql);
    $valueArray = [ $cid];
    $re->execute($valueArray);
    $rows = $re->fetchAll(PDO::FETCH_BOTH);
    
    
?>
      <div class="container"> 
         <div class="row justify-content-center">
<?php
    foreach ($rows as $row) {
    
?>
       <div class="col-md-4">
      <div class="card h-100 shadow-sm">
        <a href="#">
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