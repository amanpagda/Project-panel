<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>


    <form action="" method="POST">
        <div class="row mt-3">
            <div class="col-6 form-group">
                <select id="pro-category" class="form-control" name="pro-category">
                    <option value="" disabled selected>--Select Category--</option>
                    <?php 
                    include("data.php");
                    $sql = "SELECT * FROM `pro-category` ORDER BY pname";
                    $result = mysqli_query($conn,$sql);
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row["pid"];?>"><?php echo $row["pname"];?></option>
                        <?php
                    }
                    
                    ?>
                </select>
            </div>
            <div class="col-6 form-group">
                <select id="pro-sub-cate" class="form-control" name="pro-sub-cate">
                    <option value="" disabled selected>--Select Sub Category--</option>
                </select>
            </div>
        </div>
    </form>


    <footer>
        <!-- place footer here -->
    </footer>
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#pro-category').change(function() {
                var ps_code=$(this).val();
                $.ajax({
                    url:"data.php",
                    method:"POST",
                    data:{code:ps_code},
                    success:function(data){
                        $('#pro-sub-cate').html(data);
                    }
                })
            })
        })
    </script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>