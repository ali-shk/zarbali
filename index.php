<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>fayaz</title>

</head>
<body>
<form method="post" action="index.php">
    <p><label for="2dtable">ضرب فیاضی</label></p>
    <textarea id="2dtable" name="2dtable" rows="10" cols="50"><?php echo $_POST['2dtable'] ?? ''?></textarea>
    <br>
    <input id="val1" name="val1" type="text" value="<?php echo $_POST['val1'] ?? ''?>" >
    <input id="val2" name="val2" type="text" value="<?php echo $_POST['val2'] ?? ''?>">
    <br>
    <input type="submit" value="Calculate">
</form>
<pre>
<?php

function pull($row, $col, $t)
{
    if ($row == 0 || $col == 0)
        return 0;
    return $t[max($row - 1, 0)][max($col - 1, 0)];
}

function zarbali($v1, $v2, $t1)
{
    $v1 = array_reverse($v1);
    $v2 = array_reverse($v2);
    $lv1 = count($v1);
    $lv2 = count($v2);
    $extra = 0;
    $res = 0;
    $result= 0;
    foreach ($v1 as $index1 => $vrow){
        $res = 0;
        foreach ($v2 as $index2 => $vcol) {
            $temp = pull((int)$vrow, (int)$vcol, $t1);

            if ($extra > 0) {
                $temp = $extra + $temp;
                $extra = 0;
            }

            if ($temp >= 10 && $index2 != $lv2-1) {
                $extra = (int)($temp / 10);
                $temp = ($temp % 10);
            }

            $temp2 = $temp * pow(10, $index2);
            $res = $res + $temp2;
        }
        $result =$result+ ($res * pow(10,$index1));
    }
    return ($result);
}


if (! empty($_POST['2dtable']))
{
    if (!trim($_POST['val1'] )|| !trim($_POST['val2'])){
        echo "Enter Valid Number Please !!";
        exit();
    }

    $val1 = str_split($_POST['val1']);
    $val2 =str_split( $_POST['val2']);

    $flag = ( $_POST['val1']/ abs($_POST['val1']))*($_POST['val2']/ abs($_POST['val2']));


    $d2table = $_POST['2dtable'];
    $table = explode(PHP_EOL,$d2table);
    $array = [];
    foreach ($table as $item ){
        $array[] = explode(" ",$item);
    }
    $resulteakhar = zarbali($val1,$val2,$array);
    $resulteakhar = $resulteakhar*$flag;
    dump((string)$resulteakhar);
}


function dump(...$extra)
{
    var_dump($extra);
    exit();
}
//$data = [];
//for ($i=1;$i<=9;$i++){
//    $array = [];
//    for ($j=1;$j<=9;$j++){
//        $array[]=$i*$j;
//    }
//    $data[] = $array;
//}
//function multiple($a,$b){
//
//    return $a*$b;
//}
//$tempult = multiple(658945785,-45895310546590);
//
//echo $tempult;
//

?>
</pre>

</body>
</html>
