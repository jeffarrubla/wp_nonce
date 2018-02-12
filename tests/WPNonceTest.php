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

    /**
     *
     * To determinate if wp_nonce_field can be called from ays method.
     *
     * Refined wp_nonce_field function with patchwork 
     *
     */
    public function testCanReturnField()
    {
        $params = array();

        Patchwork\redefine( 'wp_nonce_field', function( $action, $name, $referer, $echo ) use ( &$params ) {
            $params = compact( 'action', 'name', 'referer', 'echo' );

            return 'HTML code';
        } );

        $result = $this->WPNonce->field( 'new_value' );

        $this->assertEquals( 'new_value', $params['action'] );
        $this->assertEquals( '_wpnonce', $params['name'] );
        $this->assertEquals( true, $params['referer'] );
        $this->assertEquals( true, $params['echo'] );

        $this->assertEquals( 'HTML code', $result );
    }

    /**
     *
     * To determinate if wp_nonce_url can be called from url method.
     *
     * Refined wp_nonce_url function with patchwork 
     *
     */
    public function testCanCreateURL()
    {
        $params = array();

        Patchwork\redefine( 'wp_nonce_url', function( $actionurl, $action, $name  ) use ( &$params ) {
            $params = compact( 'actionurl', 'action', 'name' );

            return 'Formatted HTML code';
        } );

        $result = $this->WPNonce->url( 'new_value' );

        $this->assertEquals( 'new_value', $params['actionurl'] );
        $this->assertEquals( -1, $params['action'] );
        $this->assertEquals( '_wpnonce', $params['name'] );

        $this->assertEquals( 'Formatted HTML code', $result );

    }


}
