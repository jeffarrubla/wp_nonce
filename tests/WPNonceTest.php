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

    /**
     *
     * To determinate if the class is a instace of the WPNonce
     *
     */
    public function testIsInstaceOf()
    {        
        $this->assertInstanceOf(
            WPNonce::class,
            $this->WPNonce
        );
    }

    /**
     *
     * To determinate if wp_nonce_ays can be called from ays method.
     *
     * Refined wp_nonce_ays function with patchwork 
     *
     * wp_nonce_ays always die, so to check if the function is called, 
     * modify a variable inside it, if the variable changes, the function
     * is been called.
     *
     */
    public function testCanDisplayMessage()
    {   
        $action;              
        Patchwork\redefine('wp_nonce_ays', 
                                function($arg) use (&$action){ 
                                    if($arg == 'log-out')
                                        $action = 'You are attempting to log out'; 
                                    else 
                                        $action = 'Are you sure you want to do this?';                                               
                                }                              
                            );
        
        $this->WPNonce->ays('Are you sure you want to do this?');
        // do assert to check if $action has been modify inside the function
        $this->assertEquals(
            'Are you sure you want to do this?',
            $action           
        );
    }

/*
    public function testCannotDisplayMessage()
    {
        $this->expectException(InvalidArgumentException::class);
        
    }
*/

    /**
     *
     * To determinate if wp_nonce_ays can be called from ays method to logout.
     *
     * Refined wp_nonce_ays function with patchwork 
     *
     * wp_nonce_ays always die, so to check if the function is called, 
     * modify a variable inside it, if the variable changes, the function
     * is been called.
     *
     */
    public function testLogout()
    {
        $action;
        Patchwork\redefine('wp_nonce_ays', 
                                function($arg) use (&$action){ 
                                    if($arg == 'log-out')
                                        $action = 'You are attempting to log out'; 
                                    else 
                                        $action = 'Are you sure you want to do this?';                                               
                                }                              
                            );

        $this->WPNonce->ays('log-out');
        $this->assertEquals(
            'You are attempting to log out',
            $action
        );
    }
}
