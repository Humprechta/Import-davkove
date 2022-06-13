<?php
require_once 'connect.php';


if(isset($_GET['opakovani'])){
    $file = $_GET['file'];
}else{
    $file =  $_POST['files'];
}
if(isset($_GET['opakovani'])){
    $pocetOpakovani = $_GET['opakovani'];
}else{
    $pocetOpakovani = 0;
}
//nacitani uz ulozenych umelcu do listu
$arrayUmelcu = array(); 
$selectUmelcu = $conn->query("SELECT jmeno from csvinportbig.umelec");                   
         if ($selectUmelcu->num_rows > 0) {
           while($row = $selectUmelcu->fetch_assoc()) {
            $jmeno = $row['jmeno'];
            //$id = $row['id'];
            array_push($arrayUmelcu,$jmeno); 
           }
        }
$fileProcess = fopen($file,"r");
$pocetOpakovaniMAX = $pocetOpakovani + 50000;
while(! feof($fileProcess))
  {
      if($pocetOpakovani < $pocetOpakovaniMAX){
    $x = fgetcsv($fileProcess,0,";");
    if (in_array($x[1], $arrayUmelcu))
    {
        //umelec je v databazi => nic se nedeje
    }
    else
    {
        //umelec jeste neni v databazi
    array_push($arrayUmelcu,$x[1]); 

    $sql = "INSERT INTO csvinportbig.umelec (jmeno)
    VALUES ('$x[1]')";
    
    if ($conn->query($sql) === FALSE) { 
        echo "Error: " . $sql . "<br>" . $conn->error;
        die;
    }
    }
  
    $sql = "INSERT INTO csvinportbig.text (textos, id_umelec)
    VALUES ('$x[0]',(select id from csvinportbig.umelec where jmeno = '$x[1]'))";
    
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error. "<br><br><br><br>";
    }
    $pocetOpakovani ++;
    }else{
        header("location:insert.php?opakovani=$pocetOpakovani&file=$file");
        exit;
    }
}
echo "povedlo se :)<br>";
fclose($fileProcess);
//print_r($arrayUmelcu);
echo "pocet: ".$pocetOpakovani." radku bylo nahrano d databaze.";





?>