<?php
use PHPUnit\Framework\TestCase;
require './src/WPNonce.php';

final class WPNonceTest extends TestCase
{


    public function testCanDisplayMessage()
    {
        $this->assertInstanceOf(
            WPNonce::class,
            WPNonce::ays('Are you sure you want to do this?')
        );
    }

    /*public function testCannotDisplayMessage()
    {
        $this->expectException(InvalidArgumentException::class);

        WPNonce::ays();
    }

    public function testLogout()
    {
        $this->assertEquals(
            '',
            WPNonce::ays('log-out')
        );
    }*/
}
