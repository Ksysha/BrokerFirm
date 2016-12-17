<?php
  require ('header.php');
  global $db;
  $query="select Name_city, Id_location from location;";
  $res=mysqli_query($db,$query);
  $location_list=array();

  while($el=mysqli_fetch_array($res)) {
    $location_list[]=$el[0];
    $location_list_id[]=$el[1];
  }
?>
  <?php
    if(isset($_POST["name_client"]) && isset($_POST["surname_client"]) && isset($_POST["location_firm"]) && isset($_POST["phone_client"])) {
      $location_firm = $_POST["location_firm"];
      $name_client = $_POST["name_client"];
      $surname_client = $_POST["surname_client"];
      $phone_client = $_POST["phone_client"];

      $result = mysqli_query($db,"
        INSERT INTO client (Name, Surname, Id_location, Phone) VALUES('$name_client', '$surname_client', '$location_firm', '$phone_client')
        ");

      if (!$result) {
        echo "<h1>Error!</h1>";
      } else {
        echo "<h1>Client is added! You want to add another?</h1>";
        echo "<form id='ClientForm' action='" .htmlentities($_SERVER['PHP_SELF']) ."' method='post' onsubmit='doLogin(this); return false;'>
        <label for='name_client'>Client name</label>
        <input required type='text' name='name_client' id='name_client'>

        <label for='surname_client'>Client surname</label>
        <input required type='text' name='surname_client' id='surname_client'>

        <label class='label'>Location client</label>
        <select name='location_firm' id='location_firm'>";
        for ($i=0; $i < count($location_list); $i++) {
          echo '<option selected value="'.$location_list_id[$i].'" >'.$location_list[$i];
        }
        echo "</select>\n

        <label for='phone_client'>Client phone</label>
        <input type='tel' maxlength='7' name='phone_client' id='phone_client'>

        <button class='button' type='submit'>Submit</button>";
      }
    }
    else {
      echo "<form id='ClientForm' action='" .htmlentities($_SERVER['PHP_SELF']) ."' method='post' onsubmit='doLogin(this); return false;'>
        <span class='new_client'>New client</span><br>
        <label for='name_client'>Client name</label>
        <input required type='text' name='name_client' id='name_client'>

        <label for='surname_client'>Client surname</label>
        <input required type='text' name='surname_client' id='surname_client'>

        <label class='label'>Location client</label>
        <select name='location_firm' id='location_firm'>";
        for ($i=0; $i < count($location_list); $i++) {
          echo '<option selected value="'.$location_list_id[$i].'" >'.$location_list[$i];
        }
        echo "</select>\n

        <label for='phone_client'>Client phone</label>
        <input type='tel' maxlength='7' name='phone_client' id='phone_client'>

        <button class='button' type='submit'>Submit</button>";
      }
  ?>
<?php require ('footer.php');?>
