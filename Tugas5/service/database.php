<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "apps";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if ($conn) {
  //echo "konesi berhasil";
} else {
  echo "koneksi gagal";
  die("gagal");
}
