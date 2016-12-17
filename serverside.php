<?php
/* this script will creating the list of agreements in correct style */
/* declare some relevant variables */
// make connection to the databse
require("connect.php");
/* Select the data from the database */
$query = "select *
 from client c join agreement a on c.Id_client=a.Id_client join firm f on f.Id_firm=a.Id_firm
 order by Id_agreement";
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
    $content .= "<agreement id=\"".$el['Id_agreement']."\">\n";
    $content .= "<firm>".$el['Name_firm']."</firm>\n";
    $content .= "<client>".$el['Surname'].' '.$el['Name']."</client>\n";
    $content .= "<sum>".$el['SumOrder']."</sum>\n";
    $content .= "</agreement>\n";
}
$content .= "</agreements>\n";
$file = fopen("tmp.xml", "w");
fwrite ($file, $content);
fclose($file);
// close connection to the database
require("disconnect.php");
$xml = new DomDocument;
$xml->load('tmp.xml');
$xsl = new DomDocument;
$xsl->load('agr.xsl');
/* Create an XSLT processor */
$proc = new XsltProcessor;
$proc->importStyleSheet($xsl);
/* Perform the transformation */
$html = $proc->transformToXML($xml);
/* Detect errors */
if (!$html) die('XSLT processing error: '.libxml_get_last_error());
/* Output the resulting HTML */
echo $html;
?>