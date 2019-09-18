<!-- <form action="" method="post">
<input type="text" name="search">
<input type="submit" name="submit" value="Search">
</form> -->
<html>
<head>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<link rel="stylesheet" href="style.css">
</head>

<?php
$conn = mysqli_connect('localhost:8889','root','root') or die('No connection');
mysqli_select_db($conn,'Nassiba') or die ('db will not open');
$query="Select * from users order by id";
$result=mysqli_query($conn,$query) or die ("Invalid Query");
echo "<form action='' method='post'>
        <input id='add_new' type='button' name='create' value='Create'>
</form>";

echo "<table id='table'><tr><th>id</th><th>name</th><th>surname</th><th>email</th><th>actions</th></tr>";
while($row=mysqli_fetch_array($result)){
    echo "<tr>
            <td id='id'>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['surname']."</td>
            <td>".$row['email']."</td>
            <td>
                <form action='' method='post'>
                    <input id='save' type='button' name='save' value='Save' id='save'>
                    <input type='button' name='update' value='Update' id='edit'>
                    <input type='button' name='delete' value='Delete' id='delete'>
                </form>
            </td>
        </tr>";
}
echo "</table>";

mysqli_close($conn);

?>
</body>
<script>
    function deleteR(r,id){
        var req = new XMLHttpRequest();
        req.onreadystatechange = function() {                     
        if (req.readyState == 4 && req.status == 200) {
            console.log(id);
            }
        };

        req.open("GET", "delete.php?id="+id, true);
        req.send();
    }   
    function saveR(r,info){
        var req = new XMLHttpRequest();
        req.onreadystatechange = function() {                     
        if (req.readyState == 4 && req.status == 200) {
            console.log(info);
            }
        };
        req.open("GET", "save.php?info="+info, true);
        req.send();
    }  


    $(document).ready(function(){
    var actions = $("table td:last-child").html();
    $("#add_new").click(function(){
        $(this).attr("disabled", "disabled");
        var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
                '<td><input type="text" class="form-control" id="id"></td>' +
                '<td><input type="text" class="form-control" id="name"></td>' +
                '<td><input type="text" class="form-control" id="surname"></td>' +
                '<td><input type="text" class="form-control" id="email"></td>' +
                '<td><form action="" method="post">\
                        <input id="save" type="button" name="save" value="Save">\
                        <input type="button" name="update" value="Update" id="edit">\
                        <input type="button" name="delete" value="Delete" id="delete">\
                    </form></td>' +
            '</tr>';
        $("table").append(row);	
        $("table tbody tr").eq(index + 1).find("#save, #edit").toggle();	
    });   
    $(document).on("click", "#delete", function(){
        var row=$(this).parents("tr").children(":first");
        var id=row[0].innerHTML;
        $(this).parents("tr").remove();
        // var i = $(this).parentNode.parentNode.parentNode.rowIndex;
        // document.getElementById("table").deleteRow(i);
		$(".add-new").removeAttr("disabled");
        
        deleteR(this,id);
    });
    $(document).on("click", "#save", function(){
        var empty = false;
        var info=[];
        var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
            if(!$(this).val()){
                $(this).addClass("error");
                empty = true;
            } else{
                $(this).removeClass("error");
            }
        });
        $(this).parents("tr").find(".error").first().focus();
        if(!empty){
            input.each(function(){
                $(this).parent("td").html($(this).val());
                info.push($(this).val());
            });			
            $(this).parents("tr").find("#save, #edit").toggle();
            $("#add_new").removeAttr("disabled");
        }		
        console.log(info);
        saveR(this,info);
    });
    $(document).on("click", "#edit", function(){		
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
            $(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
        });		
        $(".add_new").attr("disabled", "disabled");
        $(this).parents("tr").find("#save, #edit").toggle();
    });

    });

</script>
<body>
</html>


