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
    if(isset($_POST["location_firm"]) && isset($_POST["name_firm"])) {
      $location_firm = $_POST["location_firm"];
      $name_firm = $_POST["name_firm"];

      $result = mysqli_query($db,"
        INSERT INTO firm (Name_firm, Id_location) VALUES('$name_firm', '$location_firm')
        ");

      if (!$result) {
        echo "<h1>Error!</h1>";
      } else {
        echo "<h1>Firm is added! You want to add another?</h1>";
        echo "<form id='articleForm' action='" .htmlentities($_SERVER['PHP_SELF']) ."' method='post' onsubmit='doLogin(this); return false;'>
        <label for='name_firm'>Title firm</label>
        <input required type='text' name='name_firm' id='name_firm'>

        <label class='label'>Location firm</label>
        <select name='location_firm' id='location_firm'>";
        for ($i=0; $i < count($location_list); $i++) {
          echo '<option selected value="'.$location_list_id[$i].'" >'.$location_list[$i];
        }
        echo "</select>\n
        <button class='button' type='submit'>Submit</button></form><p><a href='index.php'>Back</a></p>";
      }
    }
    else {
      echo "<form id='firmForm' action='" .htmlentities($_SERVER['PHP_SELF']) ."' method='post' onsubmit='doLogin(this); return false;'>
        <span class='new_firm'>New firm</span><br>
        <label for='name_firm'>Title firm</label>
        <input type='text' name='name_firm' id='name_firm'>

        <label class='label'>Location firm</label>
        <select name='location_firm' id='location_firm'>";
        for ($i=0; $i < count($location_list); $i++) {
          echo '<option selected value="'.$location_list_id[$i].'" >'.$location_list[$i];
        }
        echo "</select>\n
        <button class='button' type='submit'>Submit</button></form><p><a href='index.php'>Back</a></p>";
      }
  ?>
<?php require ('footer.php');?>
