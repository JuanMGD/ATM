<?php
namespace App\Test;

use App\ATM;
use App\Bank;
use PHPUnit\Framework\TestCase;

class ATMTest extends TestCase {
    // TESTS WITH DATABASE
    public function testSuccessfulWithdrawWithDatabase() {
        $account = new Bank("4987", 1000);
        $atm = new ATM($account, 5000);
        $this->assertEquals("Sucessful withdraw", $atm->withdraw(200));
    }
    
    public function testAtmOutOfMoneyWithDatabase() {
        $account = new Bank("4987", 800);
        $atm = new ATM($account, 0);
        $this->assertEquals("ATM is out of money", $atm->withdraw(200));
    }

    public function testInsufficientFundsInAtmWithDatabase() {
        $account = new Bank("4987", 800);
        $atm = new ATM($account, 100);
        $this->assertEquals("Insufficient funds in ATM", $atm->withdraw(200));
    }

    public function testAmountIsNotMultipleOf100WithDatabase() {
        $account = new Bank("4987", 800);
        $atm = new ATM($account, 5000);
        $this->assertEquals("Amount must be a multiple of 100", $atm->withdraw(50));
    }

    public function testIncorrectPinWithDatabase() {
        $account = new Bank("4978", 800);
        $atm = new ATM($account, 5000);
        $this->assertEquals("Wrong pin", $atm->withdraw(0));
    }

    // TESTS WITH MOCKS

    public function testSuccessfulWithdrawWithMocks() {
        $account = $this->getMockBuilder(Bank::class)->disableOriginalConstructor()->getMock();
        $account->method('getAccountBalance')->will($this->returnValue(1000));
        $account->method('validatePin')->will($this->returnValue(true));
        $account->method('updateBalance');
        $atm = new ATM($account, 5000);
        $this->assertEquals("Sucessful withdraw", $atm->withdraw(200));
    }
    
    public function testAtmOutOfMoneyWithMocks() {
        $account = $this->getMockBuilder(Bank::class)->disableOriginalConstructor()->getMock();
        $account->method('getAccountBalance')->will($this->returnValue(800));
        $account->method('validatePin')->will($this->returnValue(true));
        $account->method('updateBalance');
        $atm = new ATM($account, 0);
        $this->assertEquals("ATM is out of money", $atm->withdraw(200));
    }

    public function testInsufficientFundsInAtmWithMocks() {
        $account = $this->getMockBuilder(Bank::class)->disableOriginalConstructor()->getMock();
        $account->method('getAccountBalance')->will($this->returnValue(800));
        $account->method('validatePin')->will($this->returnValue(true));
        $account->method('updateBalance');
        $atm = new ATM($account, 100);
        $this->assertEquals("Insufficient funds in ATM", $atm->withdraw(200));
    }
    
    public function testAmountIsNotMultipleOf100WithMocks() {
        $account = $this->getMockBuilder(Bank::class)->disableOriginalConstructor()->getMock();
        $account->method('getAccountBalance')->will($this->returnValue(800));
        $account->method('validatePin')->will($this->returnValue(true));
        $account->method('updateBalance');
        $atm = new ATM($account, 5000);
        $this->assertEquals("Amount must be a multiple of 100", $atm->withdraw(50));
    }
    
    public function testIncorrectPinWithMocks() {
        $account = $this->getMockBuilder(Bank::class)->disableOriginalConstructor()->getMock();
        $account->method('getAccountBalance')->will($this->returnValue(800));
        $account->method('validatePin')->will($this->returnValue(false));
        $account->method('updateBalance');
        $atm = new ATM($account, 5000);
        $this->assertEquals("Wrong pin", $atm->withdraw(0));
    }
 }


?>