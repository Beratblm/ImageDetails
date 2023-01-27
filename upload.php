<?php

require_once("file.php");


if (!isset($_SERVER['HTTP_REFERER'])) {

    header('location: test.php');
    exit;
}

if (isset($_FILES["files"])) {

    $file = new File($_FILES["files"]["name"], $_FILES["files"]["size"], $_FILES["files"]["type"], $_FILES["files"]["error"], $_FILES["files"]["tmp_name"], $_FILES["files"]["tmp_name"]);
   
   $fileexif =  $file->getFile();
   


}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="public\style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row d-flex justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center mb-3">Dosya Bilgileri</h2>
                        <table class="table table-striped table-white">
                            <thead>
                                <tr>
                        
                                    <th scope="col" class="text-center">İsim</th>
                                    <th scope="col" class="text-center">Değerler</th>

                                </tr>
                            </thead>
                            <tbody>
                             <?php 
                              foreach($fileexif as $key => $value){
                                $values = explode(":", $value);
                                  echo "<tr>";
                                  echo "<td class='text-center'>". $values[0] ."</td>";
                                  echo "<td class='text-center'>". $values[1] ."</td>";
                                  echo "</tr>";
                              }
                                  
                             ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="public/config.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>