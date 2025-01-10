# DemoBundle

A Symfony 7.2 Demo Bundle.
There is no need for a an installer script. Just copy to /src/Bundles/

Drop a like if you find this useful.

## Directory Structure

```
DemoBundle/
├── config/                 # Configuration files
│   ├── routes.yaml        # Route definitions
│   ├── services.yaml      # Service definitions
│   └── validation.yaml    # Validation rules
├── src/                   # Source code
│   ├── Command/          # Console commands
│   ├── Controller/       # Controllers
│   ├── Entity/          # Doctrine entities
│   ├── Event/           # Event classes
│   ├── EventListener/   # Event listeners
│   ├── Repository/      # Doctrine repositories
│   ├── Security/        # Security related classes
│   ├── Service/         # Services
│   ├── Twig/           # Twig extensions
│   └── Validator/      # Custom validators
├── templates/            # Twig templates
├── tests/               # Test files
├── translations/        # Translation files
├── DemoBundle.php       # Bundle class
└── composer.json        # Bundle dependencies
```

## Installation

### Step 1: Add the Bundle
Copy the bundle into your project's `src/Bundles/` directory:
```bash
mkdir -p src/Bundles/DemoBundle
cp -r demo-bundle/* src/Bundles/DemoBundle/
```

### Step 2: Configure Composer
Add the following to your project's `composer.json`:
```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
```

Run composer to update autoload:
```bash
composer dump-autoload
```

### Step 3: Register the Bundle
Add this line to your `config/bundles.php`:
```php
return [
    // ...other bundles
    App\Bundles\DemoBundle\DemoBundle::class => ['all' => true],
];
```

### Step 4: Configure Routes
Add to your `config/routes.yaml`:
```yaml
demo_bundle:
    resource: '@DemoBundle/config/routes.yaml'
    prefix: /demo
```

### Step 5: Configure Twig
Add to your `config/packages/twig.yaml`:
```yaml
twig:
    paths:
        '%kernel.project_dir%/src/Bundles/DemoBundle/templates': DemoBundle
```

### Step 6: Clear Cache
```bash
php bin/console cache:clear
```

## Features

### Demo Test
- View test page at `/demo/test`
- Demonstrates basic bundle setup and Twig template integration

## Configuration Reference

### services.yaml
```yaml
services:
    _defaults:
        autowire: true
        autoconfigure: true
        public: false

    App\Bundles\DemoBundle\:
        resource: '../../*'
        exclude: '../../{DependencyInjection,Entity,Tests}'
```

### routes.yaml
```yaml
demo_bundle_routes:
    resource: 
        path: ../../Controller/
        namespace: App\Bundles\DemoBundle\Controller
    type: attribute
```

## Testing
Run the bundle tests:
```bash
php bin/phpunit src/Bundles/DemoBundle/Tests/
```

## License
This bundle is released under the MIT license. See the LICENSE file.
