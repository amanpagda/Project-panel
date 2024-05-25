<?php
$conn = mysqli_connect("localhost","root","","admin_project") or die(mysqli_error($conn));
$code = $_POST["code"];
$sql = "SELECT * FROM `pro-sub-cate` WHERE ps_code='$code' ORDER BY ps_name";
$result = mysqli_query($conn, $sql);
$str = '';
while ($row = mysqli_fetch_array($result)) {
    $str .= "<option value='$row[ps_id]'>".$row["ps_name"]."</option>";
}
echo $str;
?>