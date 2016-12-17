<?php
require ('header.php');
global $db;
$query="select *
from firm f JOIN location l ON f.Id_location=l.Id_location;";
$res=mysqli_query($db,$query);
$firm_list=array();
while($el=mysqli_fetch_assoc($res)) {
    $el['agreements']=array();
    $firm_list[$el['Id_firm']]=$el;
}
$query="select Id_agreement, SumOrder, Id_firm, a.Id_client, CONCAT(Surname, ' ',Name) as Title_client
from agreement a JOIN client c ON a.Id_client=c.Id_client;";
$res=mysqli_query($db,$query);
while($el=mysqli_fetch_assoc($res)) {
    $agr_list[$el['Id_agreement']]=$el;
    if(isset($firm_list[$el['Id_firm']])) {
        $firm_list[$el['Id_firm']]['agreements'][$el['Id_agreement']]=$el;
    }
}
?>

    <script>
        document.title='Firm list';
    </script>
    <table class="list-table">
        <thead>
        <tr>
            <th width="30px">Id</th>
            <th width="200px">Title</th>
            <th>Location</th>
            <th width="300px">Agreements</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($firm_list as $id=>$el) {
            ?>
            <tr>
                <td><?=$el['Id_firm']?></td>
                <td><?=$el['Name_firm']?></td>
                <td><?=$el['Name_city']?></td>
                <td>
                <span id="agreements_<?=$el['Id_firm']?>_show" class="show-agreements"
                      onclick="ShowAgr('<?=$el['Id_firm']?>')">Show</span>
                <span id="agreements_<?=$el['Id_firm']?>_hide" class="hide-agreements"
                      onclick="HideAgr('<?=$el['Id_firm']?>')" style="display: none">Hide</span>
                    <div id="agreements_<?=$el['Id_firm']?>_div" style="display: none">
                        <table class="agr-table">
                            <thead>
                            <tr>
                                <th width="20%">Id</th>
                                <th width="60%">Client</th>
                                <th width="20%">Sum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($el['agreements'] as $agr_id=>$agr_el) {
                                ?>
                                <tr>
                                    <td><?=$agr_el['Id_agreement']?></td>
                                    <td><?=$agr_el['Title_client']?></td>
                                    <td><?=$agr_el['SumOrder']?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <p><a href="index.php">Back</a></p>
    <script>
        function ShowAgr(firmId) {
            var div=document.getElementById('agreements_'+firmId+'_div');
            div.style.display='block';
            var show=document.getElementById('agreements_'+firmId+'_show');
            show.style.display='none';
            var hide=document.getElementById('agreements_'+firmId+'_hide');
            hide.style.display='block';
        }
        function HideAgr(firmId) {
            var div=document.getElementById('agreements_'+firmId+'_div');
            div.style.display='none';
            var show=document.getElementById('agreements_'+firmId+'_show');
            show.style.display='block';
            var hide=document.getElementById('agreements_'+firmId+'_hide');
            hide.style.display='none';
        }
    </script>
<?php require ('footer.php');?>