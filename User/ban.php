<?php
include 'adminHeader.php';
include '../Manager/TokenGenerate.php';

?>



<div class="wrapper">


    <?php
    include_once '../Manager/config.php';
    $token = newToken();
    $query = "SELECT * FROM users ORDER BY id DESC";
    $mine = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($mine, $query)) {
        echo "The statement failed";
    } else {

        mysqli_stmt_execute($mine);
        $count = 0;
        $result = mysqli_stmt_get_result($mine);
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['ID'];
            $name = $row['user_name'];
            if ($name != $_SESSION["USER_NAME"]) {
                $email = $row['email'];

                echo '

            <div class="card request">
            <div class="card-content invoice-print-area">
            <!-- header section -->
            
            <!-- logo and title -->
            <div class="row mt-3 invoice-logo-title">
                <div class="col m6 s12 pull-m6">
                <h6 class="indigo-text invoice-number mr-1">comment# ' . $count . '</h6>

                </div>
            </div>
            <div class="divider mb-3 mt-3"></div>
            <div class="row invoice-info">
                <div class="col m4 l4 s6">
                
                <div class="invoice-address">
                    <span>' . $name . '</span>
                </div>
                <div class="invoice-address">
                    <span>' . $email . '</span>
                </div>
                </div>
                <form method="post" action="../Manager/banHandler.php">
                <input type="hidden" name="user_id" value='.$id.'><br>
                <input type="hidden" name="token" value='.$token.'><br>
                ';
                if ($row['ban'] == true) {

                    echo ' <button class="btn waves-effect waves-light" type="submit" name="unban">unban</button>
                ';
                } else {
                    echo ' <button  class="btn waves-effect waves-light" type="submit" name="ban">ban</button>';
                }


                echo '   </form>
            </div>
            </div>
            </div>
            <hr>
            ';
                $count++;
            }
        }
    }
    if ($count == 0) {
        echo '<div  style="margin-top:300px" class="center">No Users </div>';
    }
    ?>


    <div class="col xl9 m8 s12">

    </div>
</div>

</body>

<script src="jquery-3.4.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

<script src="../js/script.js"></script>
</body>

</html>