<?php
require ('header.php');
global $db;
$query="select *
from client c JOIN location l ON c.Id_location=l.Id_location;";
$res=mysqli_query($db,$query);
$client_list=array();
while($el=mysqli_fetch_assoc($res)) {
    $el['agreements']=array();
    $client_list[$el['Id_client']]=$el;
}
$query="select Id_agreement, SumOrder, a.Id_firm, a.Id_client, Name_firm
from agreement a JOIN firm f ON f.Id_firm=a.Id_firm;";
$res=mysqli_query($db,$query);
while($el=mysqli_fetch_assoc($res)) {
    $agr_list[$el['Id_agreement']]=$el;
    if(isset($client_list[$el['Id_client']]))
        $client_list[$el['Id_client']]['agreements'][$el['Id_agreement']]=$el;
}
?>
    <script>
        document.title='Client list';
    </script>
    <table class="list-table" cellspacing="0">
        <thead>
        <tr>
            <th width="30px">Id</th>
            <th width="200px">Full name</th>
            <th width="130px">Phone</th>
            <th>Location</th>
            <th width="300px">Agreements</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($client_list as $id=>$el) { ?>
            <tr>
                <td><?=$el['Id_client']?></td>
                <td><?=$el['Surname'].' '.$el['Name']?></td>
                <td><?=$el['Phone']?></td>
                <td><?=$el['Name_city']?></td>
                <td>
                <span id="agreements_<?=$el['Id_client']?>_show" class="show-agreements"
                      onclick="ShowAgr('<?=$el['Id_client']?>')">Show</span>
                <span id="agreements_<?=$el['Id_client']?>_hide" class="hide-agreements"
                      onclick="HideAgr('<?=$el['Id_client']?>')" style="display: none">Hide</span>
                    <div id="agreements_<?=$el['Id_client']?>_div" style="display: none">
                        <table class="agr-table">
                            <thead>
                            <tr>
                                <th width="20%">Id</th>
                                <th width="60%">Firm</th>
                                <th width="20%">Sum</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($el['agreements'] as $agr_id=>$agr_el) { ?>
                                <tr>
                                    <td><?=$agr_el['Id_agreement']?></td>
                                    <td><?=$agr_el['Name_firm']?></td>
                                    <td><?=$agr_el['SumOrder']?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <p><a href="index.php">Back</a></p>
    <script>
        function ShowAgr(clientId) {
            var div=document.getElementById('agreements_'+clientId+'_div');
            div.style.display='block';
            var show=document.getElementById('agreements_'+clientId+'_show');
            show.style.display='none';
            var hide=document.getElementById('agreements_'+clientId+'_hide');
            hide.style.display='block';
        }
        function HideAgr(clientId) {
            var div=document.getElementById('agreements_'+clientId+'_div');
            div.style.display='none';
            var show=document.getElementById('agreements_'+clientId+'_show');
            show.style.display='block';
            var hide=document.getElementById('agreements_'+clientId+'_hide');
            hide.style.display='none';
        }
    </script>
<?php require ('footer.php');?>