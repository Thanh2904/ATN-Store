<?php
require_once('Header.php');
require_once('connection.php');

$c = new Connect();
$dblink = $c->connectToPDO();

if (isset($_GET['id'])){
    
    $pid = $_GET['id'];

    $findSql="SELECT * FROM `product` WHERE `pid` = ? ";
    $re = $dblink->prepare($findSql);
    $valueArray = [ $pid];
    $re->execute($valueArray);
    
    $rows = $re->fetchAll(PDO::FETCH_BOTH);

?>
<br>
      <div class="container"> 
         <div class="row justify-content-center">
      <?php
      foreach ($rows as $row) {
       ?>

            <div class="row gx-5">
              <aside class="col-lg-6">
                <div class="border rounded-4 mb-3 d-flex justify-content-center">
                  <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="./images/">
                    <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit" src="./images/<?=$row['pimage']?>" />
                  </a>
                </div>
              </aside>
              <main class="col-lg-6">
                <div class="ps-lg-3">
                  <h4 class="title text-dark">
                  <?=$row['pname']?>
                  </h4>
                  </div>
                  <div class="mb-3">
                    <span class="h5">&dollar;<?=$row['pprice']?></span>
                    <span class="text-muted">/per box</span>
                  </div>
                  <p>
                  <?=$row['pinfo']?>
                  </p>
                  <hr />

                    <div class="col-md-4 col-6 mb-3">
                        <!-- <label class="mb-2 d-block">Quantity</label>
                        <div class="input-group mb-3" style="width: 170px;">
                
                            <input type="text" class="form-control text-center border border-secondary" placeholder="<?=$row['pquan']?>" />
                
                        </div>                      -->
                        <a href="cart.php?id=<?=$row['pid']?>" class="btn btn-primary shadow-0"> <i class="me-1 fa fa-shopping-basket"></i> Add to cart </a>
                    </div>                   
                </div>  
              </main>
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