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
     * Release resources.
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
                                    $action = $arg;                                            
                                }                              
                            );
        
        $this->WPNonce->ays('Are you sure you want to do this?');
        // do assert to check if $action has been modify inside the function
        $this->assertEquals(
            'Are you sure you want to do this?',
            $action           
        );
    }

}
