<?php
header("Content-Type: text/xml");
/*this script will create a list of agreements */
/* declare some relevant variables */
// make connection to the databse
require("connect.php");
global $db;
/* Select the data from the database */
$query = "select *
from client c join agreement a on c.Id_client=a.Id_client join firm f on f.Id_firm=a.Id_firm ";
$res = mysqli_query($db,$query);
$agr_list=array();
while($el=mysqli_fetch_assoc($res)) {
    $agr_list[$el['Id_agreement']]=$el;
}
/* Print these results into an XML file*/
$content = "<";
$content .= "?xml version=\"1.0\" encoding=\"UTF-8\"?";
$content .= ">\n";
$content .= "<?xml-stylesheet type=\"text/xsl\" href=\"agr.xsl\"?>\n";
$content .= "<agreements>\n";
foreach($agr_list as $id=>$el) {
    $content .= "<agreement>\n";
    $content .= "<firm>".$el['Name_firm']."</firm>\n";
    $content .= "<client>".$el['Surname'].' '.$el['Name']."</client>\n";
    $content .= "<sum>".$el['SumOrder']."</sum>\n";
    $content .= "\n";
    $content .= "</agreement>\n";
}
$content .= "</agreements>\n";
echo $content;
// close connection to the database
require_once ('disconnect.php');
?>
