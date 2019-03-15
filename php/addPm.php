<?php
require('Pmclass.php'); ?>
<link href="../css/temp.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<?php
$DB = new DbConnection();
$sql = 'SELECT * FROM options';
$result = mysqli_query($DB->getdbconnect(), $sql);
$options=[];
?>

<form action = "" method = "POST">
<label>Method Name</label>
<input type = "text" name = "methodName">

<table id="optionsTable" class = "displaytables" style=display:none;>
<tr> <th> Option</th> <th> Priority</th> </tr>
</table>

<label>Add Option</label>
<select id="Optionsdrpdwn" style="width:15%" onchange="addoption()">
<option disabled selected value="none"> -- select an option -- </option>
    <?php
     while ($row=mysqli_fetch_array($result)) {
     echo '<option  value='.$row['id'].'>'.$row['name'].'</option>';
     array_push($options,$row['name']);
     $key = array_search($row['name'], $options); 
     unset($options[$key]);   
     }
     ?>
 </select>      

<input type = "submit" name = "submit" value = "Add Method">
</form>

<script>
var newOp=document.getElementById("optionsTable");
var html;
var select=document.getElementById("Optionsdrpdwn");
function addoption()
{
  newOp.style.display="inline-table"; 
  var selectedVal=select.options[select.selectedIndex].value;
  html= '<tr> <td>'+select.options[select.selectedIndex].text+'</td>' 
    +'<td> <input type = "text" name=priority'+selectedVal+' style="width:15%"> </td> </tr>'
    +'<input style="display:none" type = "checkbox" name = "constraints[]" value='+selectedVal+' checked>';
 newOp.innerHTML+= html;
 $("#Optionsdrpdwn option[value='"+selectedVal+"']").remove();
 $("#Optionsdrpdwn").val('none');
}
</script>
<?php

if (isset($_POST['submit']))
{
    $paymentM = new paymentMethod(0);

    if(!empty(trim($_POST['methodName'])))
    {
        $paymentM->methodName = trim($_POST['methodName']);    
        $paymentM->addMethod($paymentM);
    }

    if(!empty($_POST['constraints']))
    {
        foreach($_POST['constraints'] as $selected)
        { 
            $isPriority=true;
            if(isset($_POST['priority'.$selected]))
            {
             foreach($_POST['constraints'] as $compared)
             {
                 
                 if($_POST['priority'.$selected]==$_POST['priority'.$compared] && $selected!=$compared)
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

    // if(!empty($_POST['optionName']) && !empty($_POST['optionType']))
    // {
    //     foreach($_POST['optionName'] as $type=>$name)
    //     {
    //         $paymentM->optionsName=$name;
    //         $paymentM->optionsType= $_POST['optionType'][$type];
    //         $paymentM->optionsType= $_POST['optionType'][$type];
    //         $paymentM->insertoptions($paymentM);
                         
    //     }
    // }
}
?>
