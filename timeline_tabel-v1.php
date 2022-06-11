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

  <center>
    <?php
        date_default_timezone_set("Asia/Jakarta");

        $today_day  = date('Y/m/d');
        $today_jam  = date('H/i/s');

        echo($today_day);
        echo(" ");
        echo($today_jam);
    ?>
  </center>
  
    <thead>
      <th>ID</th>
      <th>comment</th>
      <th>tanggal</th>
      <th>start</th>
      <th>end</th>
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
                    <td><?php echo $row['start']; ?></td>
                    <td><?php echo $row['end']; ?></td>
                    <td><?php echo $row['buat']; ?></td>
                    <td>

                        <?php
                            //default time zone
                            date_default_timezone_set("Asia/Jakarta");

                            // test tentang expired date
                            $exp_date   = $row['tanggal'];
                            $exp_start    = $row['start'];
                            $exp_end    = $row['end'];
                            $today_day  = date('Y/m/d');
                            $today_jam  = date('H/i/s');

                            //lalu convert data diatas ke strtotime
                            $exp_d = strtotime($exp_date);
                            // $exp_j = strtotime($exp_jam);
                            $td  = strtotime($today_day);
                            // $tj  = strtotime($today_jam);

                           if($td >= $exp_d)
                           {
                              if($today_jam > $exp_end){
                                echo "expired";  
                              }
                              elseif($today_jam >= $exp_start and $today_jam <= $exp_end){
                                echo "ongoing";
                              }
                              else{
                                echo "today";
                              }
                           }
                           else{
                            echo " coming soon";
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
      <th>start</th>
      <th>end</th>
      <th>pembuatan</th>
      <th>masa berlaku</th>
    </tfoot>
  </table>
</body>
</html>
