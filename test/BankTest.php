<?php
namespace App\Test;

use App\Bank;
use PHPUnit\Framework\TestCase;

class BankTest extends TestCase {
    // TESTS WITH DATABASE
    public function testGetPinWithDatabase() {
        $account = new Bank("4987");
        $this->assertEquals("4987", $account->getPin());
    }

    public function testValidatePinWithDatabase() {
        $account = new Bank("4987");
        $this->assertTrue($account->validatePin());
    }

    public function testGetAccountBalanceWithDatabase() {
        $account = new Bank("4987", 1000);
        $this->assertEquals(1000, $account->getAccountBalance());
    }

    public function testUpdateBalanceWithDatabase() {
        $account = new Bank("4987");
        $account->updateBalance(1500);
        $this->assertEquals(1500, $account->getAccountBalance());
    }
    
    // TESTS WITH MOCKS
    public function testGetPinWithMocks() {
        $account = $this->getMockBuilder(Bank::class)->disableOriginalConstructor()->getMock();
        $account->method('getPin')->will($this->returnValue("4987"));
        $this->assertEquals("4987", $account->getPin());
    }

    public function testValidatePinWithMocks() {
        $account = $this->getMockBuilder(Bank::class)->setConstructorArgs(["4987"])->getMock();
        $account->method('validatePin')->will($this->returnValue(True));
        $this->assertTrue($account->validatePin());
    }

    public function testGetAccountBalanceWithMocks() {
        $account = $this->getMockBuilder(Bank::class)->disableOriginalConstructor()->getMock();
        $account->method('getAccountBalance')->will($this->returnValue(1000));
        $this->assertEquals(1000, $account->getAccountBalance());
    }

    public function testUpdateBalanceWithMocks() {
        $account = $this->getMockBuilder(Bank::class)->disableOriginalConstructor()->getMock();
        $account->method('getAccountBalance')->will($this->returnValue(1500));
        $account->method('updateBalance');
        $account->updateBalance(1500);
        $this->assertEquals(1500, $account->getAccountBalance());
    }

 }


?>