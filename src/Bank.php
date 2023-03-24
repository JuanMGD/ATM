<?php
namespace App;

use mysqli;

class Bank {
    private $pin = "";
    
    function __construct($pin, $accountBalance=null) {
        $this->pin = $pin;
        if ($this->validatePin() && $accountBalance != null) {
            $this->updateBalance($accountBalance);
        }
    }

    // Authorize
    public function getPin() {
        return $this->pin;
    }

    // Check account balance
    public function getAccountBalance() {
        $con = new mysqli("localhost", "root", "", "bank");
        $result = mysqli_fetch_array($con->query("SELECT balance FROM account where pin = '{$this->pin}';"));
        $con->close();
        return $result['balance'] ?? 0;
        // return $this->accounts[$this->pin] ?? 0;
    }

    public function validatePin(/* $pin */) {
        $con = new mysqli("localhost", "root", "", "bank");
        $result = mysqli_fetch_array($con->query("SELECT pin FROM account where pin = '{$this->pin}';"));
        $con->close();
        return $result && $result != null;
    }

    public function updateBalance($balance) {
        $con = new mysqli("localhost", "root", "", "bank");
        $con->query("UPDATE account SET balance={$balance} where pin = '{$this->pin}';");
        $con->close();
    }
 }
 
?>