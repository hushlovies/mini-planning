<?php

require_once 'connect.php';


$documents = $collection->find()->toArray();
foreach ($documents as $document) {
    $dateCorvee[] = $document["date_corvee"];
}

$student = $collection->find()->toArray();
foreach ($student as $etudiant) {
    $er[] = $etudiant["etudiant"];
}

//when posted, 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bulk = new MongoDB\Driver\BulkWrite;
    //car il y a 48 champs
    for ($n = 0; $n < 48; $n++) {
        $sel[$n] = $_POST['1' + $n];
        $bulk->update(['$set' => ['etudiant' => $sel[$n]]], ['multi' => true, 'upsert' => true]);
        $result = $mongo->executeBulkWrite('testPro.update', $bulk);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>

<body>
    <button class="btn btn-primary">select</button>

    <h2>corvée d'épulchage des Etudiants</h2>
    <form action="finaltest.php" method="post">

        <table border="1px" onload="changeSelect();">
            <tbody>
                <?php

                $num = 0;
                $row = 0;
                for ($i = 0; $i <= 12; $i++) {
                    $row = $num ?>
                    <tr>
                        <?php for ($j = 1; $j < 5; $j++) {
                            $num = $row + $j; ?>
                            <td>

                                <?php echo $dateCorvee[$num] ?>
                                <span style="color:red;"><?php echo $er[$num] ?></span> <?php echo " Change to :" ?>
                                <select name="<?php echo $num ?>" class="<?php echo $er[$num] ?>">
                                    <option value="remy">remy</option>
                                    <option value="amy">amy</option>
                                    <option value="dexter">dexter</option>
                                    <option value="fabian">fabian</option>
                                </select>
                            </td>
                        <?php
                        } ?>
                    </tr> <?php
                        } ?>

            </tbody>

        </table>
        <input type="submit" value="save">
    </form>

    <!-- <script>
                    window.onload = function changeSelect(){
                        
                        var select = document.getElementsByClassName("<?php echo $er[$num] ?>");
                        let studentName= select.toString();
                        
                        // Get a reference to the option you want to select
                        var options = document.querySelectorAll(".opt");
                       
                        for (let i = 0; i < options.length; i++) {
                            if(studentName==options[i].toString()){
                                var n=options[i]
                                return n
                                
                            }
                        }   
                        alert(options[1].value());                                 
                        document.getElementById(n).setAttribute('selected', 'selected');  
                    }
                </script> -->
</body>

</html>