## BolOpenApiBundle

[![Build Status](https://secure.travis-ci.org/netvlies/NetvliesBolOpenApiBundle.png)](http://travis-ci.org/netvlies/NetvliesBolOpenApiBundle)

The [Bol.com Open Api](http://developers.bol.com/documentatie/handleiding/) is an RESTfull API wich you can use to communicate with the Bol.com webshop catalogue. This bundle makes it very easy to use this API as a service within your Symfony 2 application.

You need to have a developer key to use this API. You can get one by [registering at the Bol.com developer center](https://developers.bol.com/inloggen/?action=register).

**NOTE** this bundle is in development and cannot be used in an production enviroment.

## License
This bundle is released under the MIT license. See the complete license here:
    
    Resources/meta/LICENSE

## Dependencies
- [Buzz](https://github.com/kriswallsmith/Buzz): PHP 5.3's lightweight HTTP client

## Installation

### Download
Add the following to your `deps` file:

    [Buzz]
        git=git://github.com/kriswallsmith/Buzz.git
        target=/Buzz

    [NetvliesBolOpenApiBundle]
        git=git@github.com:netvlies/NetvliesBolOpenApiBundle.git
        target=/bundles/Netvlies/Bundle/BolOpenApiBundle

Next, run the vendors script:

    $ php bin/vendors install

### Register the namespace
Register the Netvlies namespace in your `app/autoload.php` file:

    $loader->registerNamespaces(array(
        // ...
        'Netvlies\\Bundle'         => __DIR__.'/../vendor/bundles',
        'Buzz'                     => __DIR__.'/../vendor/Buzz/lib',
        // ...
    ));

### Initialize the bundle
Register the bundle in `app/AppKernel.php`:

    public function registerBundles()
    {
        return array(
            // ...
            new Netvlies\Bundle\BolOpenApiBundle\NetvliesBolOpenApiBundle(),
            // ...
        );
    }

## Configuration
Next step is to configure the bundle in `app/config/config.yml`:

    netvlies_bol_open_api:
        access_key:         YOUR_ACCESS_KEY
        secret_access_key:  YOUR_SECRET_ACCESS_KEY


## Using it
The API is now available as a service from the service container:

    class WelcomeController extends Controller
    {
        public function indexAction()
        {
            // ...
            $bolApi = $this->get('netvlies_bol_open_api.api');
            // ...
        }
    }

### Search for products / categories
The searchresults operation returns product information by supplying keywords or ISBN/EAN. The operation has filtering and paging options.

    class WelcomeController extends Controller
    {
        public function indexAction()
        {
            // ...
            $term = 'PHP';
            $options = array(
                // Set your options here
            );
            $bolApi = $this->get('netvlies_bol_open_api.api');
            $searchResult = $bolApi->searchResults($term, $options);
            // ...
        }
    }

### List products / categories
The listresults operation returns various product lists, based on list type and category. The category is based on the id, which can be obtained by the category list request.

For available list types see the [documentation](http://developers.bol.com/documentatie/handleiding/).

    class WelcomeController extends Controller
    {
        public function indexAction()
        {
            // ...
            $type = 'toplist_default';
            $categoryIdAndRefinements = '87';
            $options = array(
                // Set your options here
            );
            $bolApi = $this->get('netvlies_bol_open_api.api');
            $listResult = $bolApi->listResults($type, $categoryIdAndRefinements, $options);
            // ...
        }
    }

### Get product information
The products operation gets detailed information for products.

    class WelcomeController extends Controller
    {
        public function indexAction()
        {
            // ...
            $productId = '1002004011800815';
            $bolApi = $this->get('netvlies_bol_open_api.api');
            $productResponse = $bolApi->products($productId);
            // ...
        }
    }

## Documentation
Further documentation about the API can be found at the [Bol.com developer center](http://developers.bol.com/documentatie/handleiding/).

## Testing
Running the tests from the projectfolder of your Symfony 2 application:

    phpunit -c app/ vendor/bundles/Netvlies/Bundle/BolOpenApiBundle/

## Todo
- product mapping with product type properties (for now only general values are implemented)
- add enumeration class for fixed options
- increase unit test code coverage