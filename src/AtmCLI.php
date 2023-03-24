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

$amount = readline("Ingrese la cantidad a retirar:\n");
echo $atm->withdraw($amount);
?>