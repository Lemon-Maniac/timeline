<?php
    $server = "localhost";
    $username = "root";
    $password = "";

    $connect = mysqli_connect($server, $username, $password, "demo");

    if(!$connect)
    {
        die ("koneksi ke database gagal");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<center><h1>Test tanggal kadaluarsa</h1></center>
  <table width="100%" cellspacing="0" border="1" align="center">
    <thead>
      <th>ID</th>
      <th>comment</th>
      <th>tanggal</th>
      <th>jam</th>
      <th>pembuatan</th>
      <th>masa berlaku</th>
    </thead>

    <?php
        $query = "SELECT * FROM timeline ORDER BY id ASC";
        $result = mysqli_query($connect, $query);

        //cek jika database eror
        if(!$result){
            die ("Query Error: ".mysqli_errno($connect).
            " - ".mysqli_error($connect));
        }   
        $no = 1; 
        //cetak data
        while($row = mysqli_fetch_assoc($result))
        {
    ?>
                <tr style="text-align: center;">
                    <!-- <td>test</td> -->
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['comment']; ?></td>
                    <td><?php echo $row['tanggal']; ?></td>
                    <td><?php echo $row['jam']; ?></td>
                    <td><?php echo $row['buat']; ?></td>
                    <td>

                        <?php
                            // test tentang expired date
                            $exp_date = $row['tanggal'];
                            $today    = date('Y/m/d');

                            //lalu convert data diatas ke strtotime
                            $exp = strtotime($exp_date);
                            $td  = strtotime($today);

                            if($td > $exp){
                                echo "expired";
                            }
                            else{
                                echo "masih";
                            }
                        ?>


                    </td>
                </tr>
                
    <?php
        }
    ?>
    <tfoot>
      <th>ID</th>
      <th>comment</th>
      <th>tanggal</th>
      <th>jam</th>
      <th>pembuatan</th>
      <th>masa berlaku</th>
    </tfoot>
  </table>
</body>
</html>
