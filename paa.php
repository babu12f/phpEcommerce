<?php

if(isset($_POST['submit'])){
    for($j = 0; $j < count($_POST['babor']); $j++) {
        echo $j;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<script>
function addRow()
{
    var table = document.getElementById("studentsTable");
    var row = table.insertRow(1);

    //row.innerHTML='<tr><td style="width:20%"><img src='+src+' alt="animal1" class="img-responsive"></td><td><input type="text" name="productPic[]" class="form-control m-t-10" value='+src+' readonly></td><td><input type="checkbox" name="productProfileImage[]" value="1" class="m-t-10"></td><td class="text-center"><a href="#" class="delete-img btn btn-sm btn-default m-t-10"  onclick="removeImage(this)"><i class="fa fa-times-circle"></i> Remove</a></td></tr>';

    row.innerHTML= '<td><input name="babor[]" type="text" /></td>';
}
</script>
</head>
<body>

<form action="" method="post">
    <table id="studentsTable">
    <tr>
        <th>Name</th>
    </tr>

    </table>
    <input name="submit" type="submit" value="Submit" />
    <br>
</form>
<button onclick="addRow()">Add New Row</button>
</body>
<html>