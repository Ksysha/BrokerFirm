<?php
require ('header.php');
global $db;
?>
<?php
if(isset($_POST["sumorder"])) {
    $sumorder = $_POST["sumorder"];
    $query="select c.Id_client,Surname,Name,sum(SumOrder) as total,Phone,Name_city
from client c JOIN agreement a on c.Id_client=a.Id_client JOIN location l ON l.Id_location=c.Id_location
group by c.Id_client,Surname,Name,Phone,Name_city
HAVING sum(SumOrder)>$sumorder;";
    $res=mysqli_query($db,$query);
    $client_list=array();
    while($el=mysqli_fetch_array($res)) {
        $client_list[$el['Id_client']]=$el;
    }
    echo "
<h1>Clients, which total sum of orders more than ".$sumorder."</h1>
<table class='list-table' style='min-width: 600px'>
<tr>
    <th width='20px'>Id</th>
    <th>Full name</th>
    <th width='130px'>Phone</th>
    <th width='130px'>Location</th>
    <th width='70px'>Total sum</th>
</tr>";
    foreach($client_list as $id=>$el) {
        $fullName=$el['Surname'].' '.$el['Name'];
        $phone=$el['Phone'];
        $location=$el['Name_city'];
        $total=$el['total'];
        echo "
<tr>
    <td>$id</td>
    <td>$fullName</td>
    <td>$phone</td>
    <td>$location</td>
    <td>$total</td>
</tr>
        ";
    }
echo "</table>";
}
else {
    echo "<form id='findBySum' action='" .htmlentities($_SERVER['PHP_SELF']) ."' method='post'>";
    echo "<p>Enter minimum sum of orders to display clients, which total sum of orders more than value</p>
        <label for='sumorder'>Value</label>
        <input required type='number' name='sumorder' id='sumorder'>

        <button class='button' type='submit'>Find</button></form>";
}
?>
<p><a href='index.php'>Back</a></p>
<?php require ('footer.php');?>
