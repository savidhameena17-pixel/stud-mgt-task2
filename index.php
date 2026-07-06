<?php
$file="student.json";
if(!file_exists($file)){
    file_put_contents($file,"[]");
}
$students=json_decode(file_get_contents($file),true);
$action=$_GET["action"]??"";
if($action=="add"){
    $students[]=[
        "name"=>$_POST["name"],
        "id"=>$_POST["id"],
        "department"=>$_POST["department"],
        "year"=>$_POST["year"],
        "age"=>$_POST["age"]
    ];
    file_put_contents($file,json_encode($students,JSON_PRETTY_PRINT));
    header("Location:index.php");
    exit();
}
if($action=="delete"){
    $id=$_GET["id"];
    foreach($students as $key=>$student){
        if($student["id"]==$id){
            unset($students[$key]);
        }
    }
    $students=array_values($students);
    file_put_contents($file,json_encode($students,JSON_PRETTY_PRINT));
    header("Location:index.php");
    exit();
}
$students=json_decode(file_get_contents($file),true);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student list</title>
    </head>
    <body>
        <h2>Student list</h2>
        <table border="1" cellpadding="8">
            <tr>
                <th>name</th>
                <th>id</th>
                <th>department</th>
                <th>year</th>
                <th>age</th>
                <th>Action</th>
            </tr>
            <?php
            foreach($students as $student){
                    echo"<tr>";
                    echo"<td>".$student["name"]."</td>";
                    echo"<td>".$student["id"]."</td>";
                    echo"<td>".$student["department"]."</td>";
                    echo"<td>".$student["year"]."</td>";
                    echo"<td>".$student["age"]."</td>";
                    echo"<td><a href='index.php?action=delete&id=".$student["id"]."'>delete</a></td>";
                    echo"</tr>";
            }
            ?>
        </table>
        <br><a href="index.html">Add student</a>
    </body>
</html>