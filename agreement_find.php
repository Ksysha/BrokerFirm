<?php
require ('header.php');
global $db;
?>
<?php
if(isset($_POST["name_city"])) {
    $name_city = $_POST["name_city"];
    $query="select *
from location l JOIN firm f on l.Id_location=f.Id_location
 JOIN agreement a ON a.Id_firm=f.Id_firm
 JOIN client c ON a.Id_client=c.Id_client
WHERE l.Name_city LIKE '%$name_city%';";
    $res=mysqli_query($db,$query);
    $agr_list=array();

    while($el=mysqli_fetch_array($res)) {
        $agr_list[$el['Id_agreement']]=$el;
    }
    echo "
<h1>Agreements with firms from city like \"".$name_city."\"</h1>
<table class='list-table'>
<tr>
    <th width='10px'>Id</th>
    <th width='200px'>Firm</th>
    <th width='200px'>Firm city</th>
    <th width='200px'>Client</th>
    <th width='100px'>Sum</th>
</tr>";
    foreach($agr_list as $id=>$el) {
        $firm=$el['Name_firm'];
        $firmCity=$el['Name_city'];
        $client=$el['Surname'].' '.$el['Name'];
        $sum=$el['SumOrder'];
        echo "
<tr>
    <td>$id</td>
    <td>$firm</td>
    <td>$firmCity</td>
    <td>$client</td>
    <td>$sum</td>
</tr>";
    }
echo "</table>";
}
else {
    echo "<form id='findByLocation' action='" .htmlentities($_SERVER['PHP_SELF']) ."' method='post'>";
    echo "<p>Enter city name to display agreements with firms from this location</p>
        <label for='name_city'>City name</label>
        <input required type='text' name='name_city' id='name_city'>
        <button class='button' type='submit'>Find</button></form>";
}
?>
<p><a href='index.php'>Back</a></p>
<?php require ('footer.php');?>
