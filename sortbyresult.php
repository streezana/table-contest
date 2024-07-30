<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Страница таблицы результатов с сортировкой по результатам</title>
     <link rel="stylesheet" href="./css/mysite.css">
</head>
<body style="text-align:center;"> 

<?php 
include "blocks/header.php"; 

  $f_json = 'data_attempts.json';
  $json = file_get_contents("$f_json");
  $obj = json_decode($json,true);
  //--------------
  $data_cars = 'data_cars.json';
  $json_data_cars = file_get_contents("$data_cars");
  $cars = json_decode($json_data_cars,true); 
  $newar = [];
  $data = [];
  $newmass = [];
  //-------------
  foreach ($cars as $key => $val) { 
    foreach ($obj as $k => $va){
  if ($val['id'] == $va['id']) {
    $newar += [$va['id']  => $va['result']];
    } 
   }
  }

 foreach ($cars as $key => $val) {
  $data += [$key => $val];
    foreach ($newar as $k => $va) {
    if ($val['id'] == $k) {
      $data[$key] += ['result' => $va];
      }
    }
  }
  $sortresult = $data;
  if(array_key_exists('butt1', $_POST)) {  
    butt_1($sortresult);
    $butt = true; 
  } 
  function butt_1($d) { 
    $result_sort = array_column($d, 'result');
    array_multisort($result_sort, SORT_DESC, $d);
  } 
?>

<table class="table">
<thead>
    <tr>
      <th scope="col"><a href="index.php">N</a></th>
      <th scope="col">ИМЯ</br>УЧАСТНИКА</th>
      <th scope="col">ГОРОД</th>
      <th scope="col">МАШИНА</th>
      <th scope="col">
      <a href="sortbyresult.php">ИТОГОВЫЙ</br>РЕЗУЛЬТАТ</a>
    </th>
 </tr>
  </thead>
  <tbody>
<?php
$result_sort = array_column($sortresult, 'result');
array_multisort($result_sort, SORT_DESC, $sortresult);

foreach ($sortresult as $key => $val)
{
    echo "<tr>";
    foreach ($val as $key => $value)
    {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
?>
</tbody>
</table>
</body> 
</html> 