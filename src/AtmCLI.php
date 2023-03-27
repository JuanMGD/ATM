<?php
namespace App;

require 'src\ATM.php';
require 'src\Bank.php';

echo "Bienvenidos a Banco JMGD\n";
$pin = readline("Por favor a continuación ingrese su pin: ");

$account = new Bank($pin);
if (!$account->validatePin()) {
    echo "Wrong pin";
    return;
}

$atmFunds = 5000;
$atm = new ATM($account, $atmFunds);

$opciones = [
    "1" => ["Retiro", function ($atm, $amount) {return $atm->withdraw($amount);}],
    "2" => ["Depósito", function ($atm, $amount) {return $atm->deposit($amount);}],
];
$opcionSeleccionada = 0;
$error = false;

do {
    if ($error) echo "Por favor seleccione solo las opciones disponibles\n";

    foreach ($opciones as $index => $opcion) { 
        echo "({$index}) {$opcion[0]}\n";
    }

    $opcionSeleccionada = readline("Seleccione la operación a realizar (ingrese un número): ");

    $error = !array_key_exists($opcionSeleccionada, $opciones);

} while ($error);


$amount = readline("Ingrese la cantidad:\n");
echo $opciones[$opcionSeleccionada][1]($atm, $amount);
// echo $atm->withdraw($amount);
?>