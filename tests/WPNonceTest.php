<?php
use PHPUnit\Framework\TestCase;
require './src/WPNonce.php';

final class WPNonceTest extends TestCase
{
    private $WPNonce;

 
    protected function setUp()
    {
        $this->WPNonce = new WPNonce();

        Patchwork\redefine('wp_nonce_ays', function($action){ if($action == 'log-out') echo  'You are attempting to log out'; else echo 'Are you sure you want to do this?'; });
    }
 
    protected function tearDown()
    {
        $this->WPNonce = NULL;
    }


/*
    public function testCanDisplayMessage()
    {
        
        $this->assertInstanceOf(
            WPNonce::class,
            $this->WPNonce->ays('Are you sure you want to do this?')
        );
    }

    public function testCannotDisplayMessage()
    {
        $this->expectException(InvalidArgumentException::class);

        WPNonce::ays();
    }
*/
    public function testLogout()
    {
        $this->assertEquals(
            '',
            $this->WPNonce->ays('log-out')
        );
    }
}
