# WPNonce

Class to use ```wp_nonce_*()``` functions in an object oriented way.

These functions are:
- [wp_nonce_ays()](https://codex.wordpress.org/Function_Reference/wp_nonce_ays)
- [wp_nonce_field()](https://codex.wordpress.org/Function_Reference/wp_nonce_field)
- [wp_nonce_url()](https://codex.wordpress.org/Function_Reference/wp_nonce_url)
- [wp_verify_nonce()](https://codex.wordpress.org/Function_Reference/wp_verify_nonce)
- [wp_create_nonce()](https://codex.wordpress.org/Function_Reference/wp_create_nonce)
- [check_admin_referer()](https://codex.wordpress.org/Function_Reference/check_admin_referer)
- [check_ajax_referer()](https://codex.wordpress.org/Function_Reference/check_ajax_referer)
- [wp_referer_field()](https://codex.wordpress.org/Function_Reference/wp_referer_field)

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

- [PHP](https://secure.php.net/)
- [Composer](https://getcomposer.org/)

### Installing

Clone the project 
```
git clone https://github.com/jeffarrubla/wp_nonce.git
```

or download the zip

## Running the tests

To test that the ```wp_nonce_*()``` functions can be called from the class.
To test install using composer, it requires:

- [Patchwork](http://patchwork2.org/)
- [PHPUnit](https://phpunit.de/)

To run the test do:
```
phpunit --bootstrap tests/bootstrap.php  tests/WPNonceTest
```

or

```
phpunit --bootstrap tests/bootstrap.php  tests/WPNonceTest  --testdox
```


## Deployment

### Prerequisites

- [Wordpress](https://wordpress.com/)


## License

[GPL2](https://www.gnu.org/licenses/gpl-2.0.html)