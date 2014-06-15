# JavaScript Packer Bundle for Symfony2

This bundle allows you to use the PHP port of [Dean Edward's Packer](http://dean.edwards.name/packer/) to compress JavaScripts

## Beta disclaimer

Feel free to use this bundle but keep in mind it is still in beta stage and needs a bit of testing. If you see any issues with this bundle, please give feedback using the [GitHub issue tracker](https://github.com/icedream/JavaScriptPackerBundle/issues).

## Installation/Usage

1.	Install via composer:
	```shell
	composer require icedream/javascriptpackerbundle:~0.1@beta
	```
2.	Download the PHP port of Dean Edward's packer. The recommended way is to use the suggestion of this package and install ```meenie/javascript-packer``` via composer.
	```shell
	composer require meenie/javascript-packer:~1.1
	```
3.	Add bundle to the application kernel (```app/AppKernel.php```):
	```php
	<?php
	use Symfony\Component\HttpKernel\Kernel;
	use Symfony\Component\Config\Loader\LoaderInterface;

	class AppKernel extends Kernel
	{
	    public function registerBundles()
	    {
	    	$bundles = array(
	    		// ...
	    		new Icedream\JavaScriptPackerBundle\JavaScriptPackerBundle(),
	    		);
	    	// ...
	    }
	}
	```
3.	Configure the bundle in ```app/config/config.yml```:
	```yaml
	# Assetic Configuration
	assetic:
	    filters:
	        jspacker:
	            resource: %kernel.root_dir%/../src/Icedream/JavaScriptPackerBundle/Resources/config/services.xml
	            # If you did not use the composer method to download the Packer script, uncomment this and point the variable to the full path of class.JavaScriptPacker.php
	            #packer: %kernel.root_dir%/../vendor/meenie/javascript-packer/class.JavaScriptPacker.php
	```
4.	Now you can use the filter as needed.
	```twig
	{% javascripts '@AcmeDemoBundle/Resources/public/js/somescript.js' filter='jspacker' %}
	<script type="text/javascript" src="{{ asset_url }}"></script>
	{% endjavascripts %}
	```

## License

This bundle is licensed under the MIT license. See [LICENSE.txt](LICENSE.txt) for more information.
