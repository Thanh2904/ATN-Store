<?php
require_once('Header.php');
require_once('connection.php');


if (isset($_POST['btnAdd'])){
    $cname = $_POST['cname'];

    $c = new Connect();
    $sql= "INSERT INTO `category`(`cname`) VALUES (?)";
    $dblink = $c->connectToPDO();
    $re = $dblink->prepare($sql);
    $valueArray = [ $cname];
    $stmt = $re->execute($valueArray);
    
    if($stmt) echo "Congrats";
    
}

?>
        <div class="container">
            <h2> Add New Category</h2>
            <form action="" name="formReg" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="form-group">  
                        <div class="row mb-3">  
                        <label for="" class="col-lg-4">Category Name</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="cname">
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