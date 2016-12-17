<?php
  require ('header.php');
  global $db;
  $query="select Name_firm, Id_firm from firm;";
  $res=mysqli_query($db,$query);
  $location_list=array();

  while($el=mysqli_fetch_array($res)) {
    $name_firm_list[]=$el[0];
    $id_firm_list[]=$el[1];
  }

  $query="select Name, Surname, Id_client from client;";
  $res=mysqli_query($db,$query);
  while($el=mysqli_fetch_array($res)) {
    $name_client_list[]=$el[0];
    $surname_client_list[]=$el[1];
    $id_client_list[]=$el[2];
  }


  if(isset($_POST["client"]) && isset($_POST["firm"]) && isset($_POST["sumorder"])) {
    $client = $_POST["client"];
    $firm = $_POST["firm"];
    $sumorder = $_POST["sumorder"];

    $result = mysqli_query($db,"
      INSERT INTO agreement (Id_firm, Id_client, SumOrder) VALUES('$firm', '$client', '$sumorder')
      ");

    if (!$result) {
        echo "<h1>Error!</h1>";
      } else {
        echo "<h1>Agreemnet is added! You want to add another?</h1>";
        echo "<form id='AgreemnetForm' action='" .htmlentities($_SERVER['PHP_SELF']) ."' method='post' onsubmit='doLogin(this); return false;'>
      <span class='new_client'>New agreement</span><br>

      <label class='label'>Client: </label>
      <select name='client' id='client'>";
      for ($i=0; $i < count($name_client_list); $i++) {
        echo '<option selected value="'.$id_client_list[$i].'" >'.$name_client_list[$i] .' ' .$surname_client_list[$i];
      }
      echo "</select>\n
      <label class='label'>Firm: </label>
      <select name='firm' id='firm'>";
      for ($i=0; $i < count($name_firm_list); $i++) {
        echo '<option selected value="'.$id_firm_list[$i].'" >'.$name_firm_list[$i];
      }
      echo "</select>\n

      <label for='sumorder'>Sum order:</label>
      <input type='text' required name='sumorder' id='sumorder'>

      <button class='button' type='submit'>Submit</button></form><p><a href='index.php'>Back</a></p>";
      }

  }
  else {
    echo "<form id='AgreemnetForm' action='" .htmlentities($_SERVER['PHP_SELF']) ."' method='post' onsubmit='doLogin(this); return false;'>
      <span class='new_client'>New agreement</span><br>

      <label class='label'>Client: </label>
      <select name='client' id='client'>";
      for ($i=0; $i < count($name_client_list); $i++) {
        echo '<option selected value="'.$id_client_list[$i].'" >'.$name_client_list[$i] .' ' .$surname_client_list[$i];
      }
      echo "</select>\n
      <label class='label'>Firm: </label>
      <select name='firm' id='firm'>";
      for ($i=0; $i < count($name_firm_list); $i++) {
        echo '<option selected value="'.$id_firm_list[$i].'" >'.$name_firm_list[$i];
      }
      echo "</select>\n

      <label for='sumorder'>Sum order:</label>
      <input type='text' required name='sumorder' id='sumorder'>

      <button class='button' type='submit'>Submit</button></form><p><a href='index.php'>Back</a></p>";
    }
?>
<?php require ('footer.php');?>
