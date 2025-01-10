# DemoBundle

A Symfony 7.2 Demo Bundle.
There is no need for a an installer scritp. Just copy to /src/Bunldes/

Drop a like if you find this useful.

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
    resource: '@DemoBundle/Resources/config/routes.yaml'
    prefix: /demo
```

### Step 5: Configure Twig
Add to your `config/packages/twig.yaml`:
```yaml
twig:
    paths:
        '%kernel.project_dir%/src/Bundles/DemoBundle/Resources/views': DemoBundle
```

### Step 6: Clear Cache
```bash
php bin/console cache:clear
```

## Features

### Demo Test
- View test page at `/demo/test`
- Demonstrates basic bundle setup and Twig template integration

## Directory Structure
```
DemoBundle/
├── Controller/               # Route controllers
├── DependencyInjection/     # Bundle configuration
├── Resources/
│   ├── config/            # Bundle configuration files
│   │   ├── routes.yaml
│   │   ├── services.yaml
│   │   └── validation.yaml
│   └── views/             # Twig templates
│       ├── layout.html.twig
│       └── demo/
└── Tests/                  # Test files
```

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
