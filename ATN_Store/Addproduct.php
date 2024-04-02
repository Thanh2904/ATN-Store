<?php
require_once('Header.php');
require_once('connection.php');


if (isset($_POST['btnAdd'])){
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pinfo = $_POST['pinfo'];
    $pdate = $_POST['pdate'];
    $pquan = $_POST['pquan'];

    $pcatid = $_POST['CategoryList'];

    $pbid = $_POST['BranchList'];

    $pimgname=str_replace(' ', '-',$_FILES['pimage']['name']);


    $flag = move_uploaded_file($_FILES['pimage']['tmp_name'],'./images/'.$pimgname);
    


    $c = new Connect();
     if($flag){
      $sql= "INSERT INTO `product`(`pname`, `pprice`, `pinfo`, `pimage`, `pquan`, `pcatid`, `pbid` , `pdate`) VALUES (?,?,?,?,?,?,?,?)";
    $dblink = $c->connectToPDO();
    $re = $dblink->prepare($sql);
    $valueArray = [ $pname, $pprice, $pinfo, $pimgname, $pquan, $pcatid, $pbid, $pdate ];
    $stmt = $re->execute($valueArray);
    
    if($stmt) echo "Congrats";
    }else{
        echo "Image is copied failed";
    }


}

?>
<?php
require_once('connection.php');

function bind_Category_List($c){
    $sql = "SELECT * FROM `category`";
    $c = new Connect();
    $dblink = $c->connectToMySQL();
   $re = $dblink->query($sql);
   if($re->num_rows > 0){
    echo"<select name='CategoryList' class='form-control'>
        <option value='0'>Choose category</option>";
        while($row=$re->fetch_assoc()){
            echo"<option value='".$row['cid']."'>".$row['cname']."</option>";
        }	
    echo "</select>";
}}
function bind_Branch_List($c){
    $sql = "SELECT * FROM `branch`";
    $c = new Connect();
    $dblink = $c->connectToMySQL();
   $re = $dblink->query($sql);
   if($re->num_rows > 0){
    echo"<select name='BranchList' class='form-control'>
        <option value='0'>Choose category</option>";
        while($row=$re->fetch_assoc()){
            echo"<option value='".$row['bid']."'>".$row['bname']."</option>";
        }	
    echo "</select>";
}}
?>

        <div class="container">
            <h2> Add New Product</h2>
            <form action="" name="formReg" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="form-group">  
                        <div class="row mb-3">  
                        <label for="" class="col-lg-4">Product Name</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="pname">
                            <br>
                        </div>
                    </div>                            
                    <div class="form-group">    
                        <div class="row mb-3">
                        <label for="" class="col-lg-4">Price</label>
                        <div class="col-lg-8">
                            <input type="number" class="form-control" name="pprice">
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                        <label for="" class="col-lg-4">Discription</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="pinfo">
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                        <label for="" class="col-lg-4">Date</label>
                        <div class="col-lg-8">
                            <input type="date" class="form-control" name="pdate">
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                        <label for="" class="col-lg-4">Quantity</label>
                        <div class="col-lg-8">
                            <input type="number" class="form-control" name="pquan">
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                        <label for="" class="col-lg-4">Image</label>
                        <div class="col-lg-8">
                            <input type="file" class="form-control" name="pimage">
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                        <label for="" class="col-lg-4">Category:</label>
                        <div class="col-lg-8">

                            <?php bind_Category_List($c); ?>
                            <br>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mb-3">
                        <label for="" class="col-lg-4">Branch:</label>
                        <div class="col-lg-8">

                            <?php bind_Branch_List($c); ?>
                            <br>
                        </div>
                    </div>     
                    <div class="form-group">
                        <div class="row mb-3">
                            <div class="d-grid mx-auto col-3">
                                <input type="submit" value="Add" class="btn-btn-primary" name="btnAdd">
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>