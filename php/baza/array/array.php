<?php
    $array = [1=>"1","aA","2"=>2,"23"=>"33",3=>33, "first"=>"bb", "SECOND"=>"dd","ThIrD"=> "dd", array("first"=>"bb", "SECOND"=>"dd"), array("first"=>"bb", "SECOND"=>"dd")];
    $array1 = [1=>"2","aA","3"=>4,"22"=>"33",3=>33, "first"=>"bb", "SECOND"=>"dd","ThIrD"=> "dd", array("first"=>"рр", "SECOND"=>"dd"), array("first"=>"bb", "SECOND"=>"dd")];
    print_r($array); echo "<br>";
    print_r($array1); echo "<br>";
    echo "array_change_key_case: <br>";
    print_r(array_change_key_case($array, CASE_LOWER)); echo "<br>";
    print_r(array_change_key_case($array, CASE_UPPER)); echo "<br>";
    echo "array_chunk: <br>";
    print_r(array_chunk($array, 4)); echo "<br>";
    print_r(array_chunk($array, 4, true)); echo "<br>";
    echo "array_column: <br>";
    print_r(array_column($array, "first")); echo "<br>";
    print_r(array_column($array, "first", "SECOND")); echo "<br>";
    echo "array_combine: <br>";
    print_r(array_combine($array, $array)); echo "<br>";
    echo "array_count_values: <br>";
    print_r(array_count_values($array)); echo "<br>";
    echo "array_diff_assoc: <br>";
    print_r(array_diff_assoc($array, $array1)); echo "<br>";//по значение возвращает без совпадений если не словарь то присвоит ключи начиная с 0
    echo "array_diff_key: <br>";
    print_r(array_diff_key($array, $array1)); echo "<br>";
    echo "array_diff_uassoc: <br>";
//  print_r(array_diff_uassoc($array, $array1)); echo "<br>"; //
    echo "array_diff_ukey: <br>";
//  print_r(array_diff_ukey($array, $array1)); echo "<br>"; //
    echo "array_diff: <br>";
    print_r(array_diff($array, $array1)); echo "<br>";
