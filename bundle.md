# Step-by-Step Implementation Instructions

## Step 1: Create Bundle Directory Structure
Create the following directory structure in your Symfony project:

```
/src/Bundles/DemoBundle/
    /config/                        # Configuration files
        routes.yaml                # Route definitions
        services.yaml             # Service definitions
        validation.yaml           # Validation rules
    /src/                          # Source code
        /Command/                 # Console commands
            .gitignore
        /Controller/             # Controllers
            DemoController.php
        /Entity/                 # Doctrine entities
            .gitignore
        /Event/                  # Event classes
            .gitignore
        /EventListener/         # Event listeners
            .gitignore
        /EventSubscriber/       # Event subscribers
            .gitignore
        /Exception/             # Bundle-specific exceptions
            .gitignore
        /Message/               # Message classes
            .gitignore
        /MessageHandler/        # Message handlers
            .gitignore
        /Middleware/            # Middleware classes
            .gitignore
        /Repository/           # Doctrine repositories
            .gitignore
        /Security/             # Security related classes
            /Authentication/
                .gitignore
            /Authorization/
                .gitignore
            /Voter/
                .gitignore
        /Service/              # Service classes
            .gitignore
        /Twig/                # Twig extensions
            /Extension/
                .gitignore
            /Runtime/
                .gitignore
        /Utils/               # Utility classes
            .gitignore
        /Validator/           # Custom validators
            /Constraint/
                .gitignore
    /templates/                    # Twig templates
        layout.html.twig
        /demo/
            index.html.twig
    /tests/                       # Test files
        /Controller/
            DemoControllerTest.php
    /translations/                # Translation files
        .gitignore
    DemoBundle.php               # Bundle class
    README.md                    # Bundle documentation
    LICENSE                      # License information
    composer.json                # Composer configuration
    phpunit.xml.dist            # PHPUnit configuration
```

## Step 2: Create Core Bundle Files
### Step 2.1: Create DemoBundle.php
Create `DemoBundle.php` in bundle root:

```php
<?php

namespace App\Bundles\DemoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DemoBundle extends Bundle
{
}
```

### Step 2.2: Create DependencyInjection Files
#### DemoExtension.php
```php
<?php

namespace App\Bundles\DemoBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class DemoExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../config'));
        $loader->load('services.yaml');
    }
}
```

#### Configuration.php
```php
<?php

namespace App\Bundles\DemoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('demo');
        $rootNode = $treeBuilder->getRootNode();

        // Define the parameters that are allowed to configure your bundle.
        $rootNode
            ->children()
                ->scalarNode('some_parameter')->defaultValue('default_value')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
```

### Step 2.3: Create Configuration Files
#### services.yaml
```yaml
services:
    _defaults:
        autowire: true
        autoconfigure: true
        public: false

    App\Bundles\DemoBundle\src\:
        resource: '../src/*'
        exclude: '../src/{DependencyInjection,Entity,Tests}'

    App\Bundles\DemoBundle\EventListener\QuoteViewedListener:
        tags:
            - { name: kernel.event_listener, event: quote.viewed, method: onQuoteViewed }
```

#### routes.yaml
```yaml
demo_bundle_routes:
    resource: 
        path: ../src/Controller/
        namespace: App\Bundles\DemoBundle\src\Controller
    type: attribute
```

## Step 3: Update Project Configuration

### Step 3.1: Update composer.json autoload section
```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

### Step 3.2: Register in config/bundles.php
```php
<?php
return [
    // Existing bundles...
    App\Bundles\DemoBundle\DemoBundle::class => ['all' => true],
];
```

### Step 3.3: Configure routes in config/routes.yaml
```yaml
demo_bundle:
    resource: '@DemoBundle/config/routes.yaml'
    prefix: /demo
```

### Step 3.4: Configure Twig in config/packages/twig.yaml
```yaml
twig:
    paths:
        '%kernel.project_dir%/src/Bundles/DemoBundle/templates': DemoBundle
