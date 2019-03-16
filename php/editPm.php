<link href="../css/temp.css" rel="stylesheet" type="text/css">
<?php
require('Pmclass.php');
if(!isset($_POST["editButton"]))
{
   header('Location: displaypm.php');
}
$DB = new DbConnection();
$sql = 'SELECT * from paymentmethod WHERE  isDeleted=0 AND id = '.$_POST["editButton"];
$sql2= 'SELECT so.id soid,o.id oyd, o.name oname,pm.name pmname,pm.id pmid,so.priority prio FROM selectedoptions so 
Inner join options o ON o.id= so.optionId 
Inner join paymentmethod pm ON pm.id= so.paymentId
where  pm.isDeleted=0 AND so.paymentId='.$_POST["editButton"].' ORDER BY prio ';
$options=[];
$sql3="SELECT * FROM options";
$result = mysqli_query($DB->getdbconnect(), $sql);
$result2 = mysqli_query($DB->getdbconnect(), $sql2);
$result3 = mysqli_query($DB->getdbconnect(), $sql3);
$row=mysqli_fetch_array($result);

while ($row3=mysqli_fetch_array($result3)) 
{
    array_push($options,$row3['name']);
}
?>
<form action = "" method = "POST">
<label>Method Name</label>
<?php echo '<input type = "text" name = "methodName" value = "'.$row['name'].'">' ?>
<table class = "displaytables">
<tr>
<th> Option</th> <th> Priority</th> <th> Delete </th> </tr>

<?php
    while ($row2=mysqli_fetch_array($result2)) 
    {
         echo '<tr>';
         echo '<td> <label>'.$row2['oname'].'</label> </td> ';
         echo '<input type=checkbox name = "Checkedconstraints[]"  style="display:none" value='.$row2['soid'].' checked >';
         echo '<td> <input type = "text" name=priority'.$row2['soid'].' value='.$row2['prio'].' style="width:15%"> </td>
         <td> <input type=checkbox name = "delete[]"  value='.$row2['soid'].' > </td>'; 
         echo '</tr>';
        $key = array_search($row2['oname'], $options); 
        unset($options[$key]);       
    }
?>

</table>
<div id="addOption"></div>
    <label> Add Option </label>
   
    <select id="InOptions"  onchange="onselection()" style=width:15%>
    <option disabled selected value> -- select an option -- </option>
    <?php
    foreach ($options as $selected)
    {
        $sql="SELECT id FROM options where name = '".$selected."' ";
        $result = mysqli_query($DB->getdbconnect(), $sql);
        $row=mysqli_fetch_array($result);
        echo '<option name="optionsOut" value='.$row['id'].'>'.$selected.'</option>';
    }
    ?>
</select>  <br>
<?php
echo '<input type = "hidden" name = "pmID" value='.$_POST["editButton"].'>'; 
?>
<input type = "submit" name = "submit" value = " Update " >
</form>

<script>
var editOp=document.getElementById("addOption");
var html;
var select=document.getElementById("InOptions");
function onselection()
{
    html= '<input type=checkbox name = "unCheckedconstraints[]" style="display:none" value='+select.options[select.selectedIndex].value+' checked >'
    +'<label> Option: '+select.options[select.selectedIndex].text+ '</label> <br>' 
    +'<label> Priority: </label> <input type="text" name=priority'+select.options[select.selectedIndex].value+' style="width:15%"> <br>';
    editOp.innerHTML= html;
}


</script>


<?php
    if (isset($_POST['submit']))
    {
        $paymentM = new paymentMethod(0);
        $paymentM->pmID = $_POST["pmID"]; 
       
        if(!empty(trim($_POST['methodName'])))
        {
            $paymentM->methodName = trim($_POST['methodName']);    
            $paymentM->updateMethod($paymentM);
        }

     
        if(!empty($_POST['Checkedconstraints']))
        {
            foreach($_POST['Checkedconstraints'] as $selected)
            {
              $isPriority=true;
              if(isset($_POST['priority'.$selected]))
               {
                foreach($_POST['Checkedconstraints'] as $compared)
                {
                    if($_POST['priority'.$selected]==$_POST['priority'.$compared] && $selected!=$compared)
                    {
                        $isPriority=false;
                        $DB = new DbConnection();
                        $Q="SELECT `priority` FROM `selectedoptions` WHERE `id` = '$selected' ";
                        $result=mysqli_query($DB->getdbconnect(),$Q);
                        $row = mysqli_fetch_array($result);
                        $_POST['priority'.$selected]= $row['priority'];
                        break;
                    }
                }
               }
               if($isPriority)
               {
                $paymentM->priority=$_POST['priority'.$selected];
                $paymentM->soID=$selected;
                $paymentM->updateSelectedoptions($paymentM);
               }
            }
        }
        if(!empty($_POST['delete']))
        {
            foreach($_POST['delete'] as $selected)
            {
                $paymentM->soID=$selected;
                $paymentM->DeleteSelectedoptions($paymentM);
            }
        }

        if(!empty($_POST['unCheckedconstraints']))
        {
            $isPriority=true;
            foreach($_POST['unCheckedconstraints'] as $selected)
            {
               if(isset($_POST['priority'.$selected]))
               {
                foreach($_POST['Checkedconstraints'] as $compared)
                {
                    if($_POST['priority'.$selected]==$_POST['priority'.$compared])
                    {
                        $isPriority=false;
                        break;
                    }
                }
               }
                if($isPriority)
                {
                    $paymentM->priority=$_POST['priority'.$selected];
                    $paymentM->optionsID=$selected;
                    $paymentM->insertSelectedoptions($paymentM);
                }
            }
        }
    }
?>