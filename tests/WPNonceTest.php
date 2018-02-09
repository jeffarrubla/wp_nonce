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

        Patchwork\redefine('wp_nonce_ays', function($action){ if($action == 'log-out') return  'You are attempting to log out'; else return 'Are you sure you want to do this?'; });        
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



    public function testIsInstaceOf()
    {        
        $this->assertInstanceOf(
            WPNonce::class,
            $this->WPNonce
        );
    }

    public function testCanDisplayMessage()
    {        
        $this->assertEquals(
            'Are you sure you want to do this?',
            $this->WPNonce->ays('Are you sure you want to do this?')
        );
    }


    public function testCannotDisplayMessage()
    {
        $this->expectException(InvalidArgumentException::class);
        
    }


    public function testLogoutFailure()
    {        
        $this->assertEquals(
            '',
            $this->WPNonce->ays('log-out')
        );
    }
}
