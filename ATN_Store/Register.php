<?php
require_once('Header.php');
//http://localhost:1000/1633/connection.php/
require_once('connection.php');

//kiểm tra biến hoặc giá trị có tồn tại hay ko ( khi mà ngta bấm vào nút đăng kí)
if (isset($_POST['btnRegister'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hometown = $_POST['Hometown'];

    //Câu lệnh truy vấn (qua PHP MyAdmin Shop_GCC200224->USER->SQL->Insert

    $sql = "INSERT INTO `user`( `username`, `password`, `hometown`) VALUES (?,?,?)";
    $c = new Connect();
    $dblink = $c->connectToPDO();
    $re = $dblink->prepare($sql);
    $valueArray = ["$username", "$password", "$hometown"];
    $stmt = $re->execute($valueArray);
    // if($stmt) echo "Congrats";
    header("location: login.php");
}

?>

        <div class="container">
            <h2> Member Registeration</h2>
            <form action="" name="formReg" method="POST">
                <div class="row mb-3">
                    <label for="" class="col-lg-4">Username</label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" name="username">
                        <br>
                    </div>

                    <label for="" class="col-lg-4">Password</label>
                    <div class="col-lg-8">
                        <input type="password" class="form-control"name="password">
                        <br>
                    </div>
                   
                    <div class="row mb-3">
                    <label for="" class="col-lg-4">Hometown</label>
                    <div class="col-lg-8">
                        <select name="Hometown" id="" class="form-select">
                            <option selected value="1">1</option>
                            <option selected value="2">2</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="d-grid mx-auto col-3">
                        <input type="submit"value="Register" class="btn-btn-primary" name="btnRegister">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>