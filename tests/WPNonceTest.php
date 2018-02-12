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

            return 'URL with nonce';
        } );

        $result = $this->WPNonce->url( 'https://example.org/' );

        $this->assertEquals( 'https://example.org/', $params['actionurl'] );
        $this->assertEquals( -1, $params['action'] );
        $this->assertEquals( '_wpnonce', $params['name'] );

        $this->assertEquals( 'URL with nonce', $result );

    }   

    /**
     *
     * To determinate if wp_verify_nonce can be called from verify method.
     *
     * Refined wp_verify_nonce function with patchwork 
     *
     */   
    public function testCanVerifyNonce()
    {
        $params = array();

        Patchwork\redefine( 'wp_verify_nonce', function( $nonce, $action  ) use ( &$params ) {
            $params = compact( 'nonce', 'action' );

            return 'boolean or int';
        } );

        $result = $this->WPNonce->verify( 'nonce_value' );

        $this->assertEquals( 'nonce_value', $params['nonce'] );
        $this->assertEquals( -1, $params['action'] );

        $this->assertEquals( 'boolean or int', $result );

    }

    /**
     *
     * To determinate if wp_create_nonce can be called from create method.
     *
     * Refined wp_create_nonce function with patchwork 
     *
     */  
    public function testCanCreateNonce()
    {
        $param;

        Patchwork\redefine( 'wp_create_nonce', function( $action  ) use ( &$param ) {
            $param = $action;

            return 'token';
        } );

        $result = $this->WPNonce->create( 'new_value' );

        $this->assertEquals( 'new_value', $param );        

        $this->assertEquals( 'token', $result );

    }


}