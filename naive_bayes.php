<?php 
include "include/connect.php";

//menghitung jumlah data
function totalData(){
    global $conn;
    return (int) mysqli_fetch_row(mysqli_query($conn,"SELECT COUNT(*) FROM cars"))[0];

}

//menghitung jumlah masing-maaing mobil
function jumlahDataMobil(){
    global $conn;
    $queryMobil = "SELECT COUNT(*) FROM cars WHERE manufacturer=";

    $jmlDataMobil['Chevrolet'] = (int) mysqli_fetch_row(mysqli_query($conn,$queryMobil . "'Chevrolet'"))[0];
    $jmlDataMobil['Dodge'] = (int) mysqli_fetch_row(mysqli_query($conn,$queryMobil . "'Dodge'"))[0];
    $jmlDataMobil['Toyota'] = (int) mysqli_fetch_row(mysqli_query($conn,$queryMobil . "'Toyota'"))[0];
    return $jmlDataMobil;
}

//menghitung prior probability
function priorProbability(){
    $mobil['Chevrolet'] = jumlahDataMobil()['Chevrolet'] / totalData();
    $mobil['Dodge'] = jumlahDataMobil()['Dodge'] / totalData();
    $mobil['Toyota'] = jumlahDataMobil()['Toyota'] / totalData();
    return $mobil;
}

// var_dump(priorProbability());

//menghitung conditional probability
function conditionalProbability($colName, $val){
    global $conn;
    $queryCon = "SELECT COUNT($colName) FROM cars WHERE $colName = '$val' AND manufacturer=";

    $conProb['Dodge'] = (int) mysqli_fetch_row(mysqli_query($conn, $queryCon . "'Dodge'"))[0] / jumlahDataMobil()['Dodge'];
    $conProb['Chevrolet'] = (int) mysqli_fetch_row(mysqli_query($conn, $queryCon . "'Chevrolet'"))[0] / jumlahDataMobil()['Chevrolet'];
    $conProb['Toyota'] = (int) mysqli_fetch_row(mysqli_query($conn, $queryCon . "'Toyota'"))[0] / jumlahDataMobil()['Toyota'];

    return $conProb;
}
function my_sort($a, $b) {
    if ($a == $b) return 0;
    return ($a < $b) ? 1 : -1;
}

//menghitung posterior probability
function posteriorProbability($data){
    $attr['sales_in_thousands'] = conditionalProbability('sales_in_thousands', $data['sales_in_thousands']);
    $attr['year_resale_value'] = conditionalProbability('year_resale_value', $data['year_resale_value']);
    $attr['price_in_thousands'] = conditionalProbability('price_in_thousands', $data['price_in_thousands']);
    $attr['horsepower'] = conditionalProbability('horsepower', $data['horsepower']);
    $attr['curb_weight'] = conditionalProbability('curb_weight', $data['curb_weight']);
    $attr['fuel_capacity'] = conditionalProbability('fuel_capacity', $data['fuel_capacity']);
    $attr['fuel_efficiency'] = conditionalProbability('fuel_efficiency', $data['fuel_efficiency']);

    $prob['Dodge'] = $attr['sales_in_thousands']['Dodge'] * $attr['year_resale_value']['Dodge'] * $attr['price_in_thousands']['Dodge'] * $attr['horsepower']['Dodge'] * $attr['curb_weight']['Dodge'] * $attr['fuel_capacity']['Dodge'] * $attr['fuel_efficiency']['Dodge'];
    $prob['Chevrolet'] = $attr['sales_in_thousands']['Chevrolet'] * $attr['year_resale_value']['Chevrolet'] * $attr['price_in_thousands']['Chevrolet'] * $attr['horsepower']['Chevrolet'] * $attr['curb_weight']['Chevrolet'] * $attr['fuel_capacity']['Chevrolet'] * $attr['fuel_efficiency']['Chevrolet'];
    $prob['Toyota'] = $attr['sales_in_thousands']['Toyota'] * $attr['year_resale_value']['Toyota'] * $attr['price_in_thousands']['Toyota'] * $attr['horsepower']['Toyota'] * $attr['curb_weight']['Toyota'] * $attr['fuel_capacity']['Toyota'] * $attr['fuel_efficiency']['Toyota'];

    uasort($prob, 'my_sort');
    return $prob;

}
?>