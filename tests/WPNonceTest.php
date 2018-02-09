<?php
use PHPUnit\Framework\TestCase;
require './src/WPNonce.php';

final class WPNonceTest extends TestCase
{
    private $WPNonce;

    /**
     *
     * Called at the beginning of testing.
     * Initialize the class and redefine wp_nonce_*() functions with Patchwork.
     *
     */
    protected function setUp()
    {
        $this->WPNonce = new WPNonce();

        Patchwork\redefine('wp_nonce_ays', function($action){ if($action == 'log-out') echo  'You are attempting to log out'; else echo 'Are you sure you want to do this?'; });        
    }
 
    /**
     *
     * Called at the end of testing.
     * Destroy the class.
     *
     */
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
        var_dump( $this->WPNonce->ays('log-out'));
        $this->assertEquals(
            '',
            $this->WPNonce->ays('log-out')
        );
    }
}
