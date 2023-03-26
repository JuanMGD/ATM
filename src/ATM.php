<?php
namespace App;

class ATM {
    private $amountInAtm = 0;
    private $bankAccount;
    
    
    function __construct($account, $amountInAtm) {
        $this->bankAccount = $account;
        $this->amountInAtm = $amountInAtm;
    }

    public function withdraw($amount){
        if (!$this->bankAccount->validatePin()) return "Wrong pin";

        $balance = $this->bankAccount->getAccountBalance();
        if ($balance < $amount) {
            // echo "\nAccount balance is: {$balance}\n";
            return "Insufficient funds in account";
        }

        if ($this->amountInAtm == 0)
            return "ATM is out of money";

        if ($this->amountInAtm < $amount)
            return "Insufficient funds in ATM";
        
        if (fmod(floatval($amount), 100) != 0)
            return "Amount must be a multiple of 100";

        $newBalance = $balance - $amount;
        $this->bankAccount->updateBalance($newBalance);
        
        // echo "\nAmount withdrawn: {$amount}\n";
        // echo "Account balance is now: {$newBalance}\n";
        return "Sucessful withdraw";
    }

    public function deposit($amount){
        if (!$this->bankAccount->validatePin()) return "Wrong pin";

        $balance = $this->bankAccount->getAccountBalance();
        // if ($balance < $amount) {
        //     // echo "\nAccount balance is: {$balance}\n";
        //     return "Insufficient funds in account";
        // }

        // if ($this->amountInAtm == 0)
        //     return "ATM is out of money";

        // if ($this->amountInAtm < $amount)
        //     return "Insufficient funds in ATM";
        
        if (fmod(floatval($amount), 100) != 0)
            return "Amount must be a multiple of 100";

        $newBalance = $balance + $amount;
        $this->bankAccount->updateBalance($newBalance);
        
        // echo "\nAmount withdrawn: {$amount}\n";
        // echo "Account balance is now: {$newBalance}\n";
        return "Sucessful deposit";
    }
 }

?>