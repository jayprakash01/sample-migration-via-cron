# Simple content migration via cron scheduler

The product_migrate module extends the core migration system to migrate the
content from external database as source into Drupal nodes.

### Features of the module:
* Migrate the product content form external database source into Drupal nodes.
* Migration of the content will be performed using hook_cron().
* It requires contrib modules migrate_plus
  (https://www.drupal.org/project/migrate_plus).

### Installation Steps

1. Download the module(product_migrate) and dependencies module (migrate_plus).
2. Enable the modules - migrate_plus and product_migrate.
3. Add the external database(to be migrated) config in active settings.php file.
    ```sh
      $databases['migrate']['default'] = array (
        'database' => 'source_db',
        'username' => 'root',
        'password' => '',
        'prefix' => '',
        'host' => '127.0.0.1',
        'port' => '3306',
        'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
        'driver' => 'mysql',
      );
    ```
4. Add migration scheduler config in settings.php file.
  ```sh
    $config['product_migrate']['migrations'] = [
      'product' => [
        'time' => 60, # To be executed every minute.
        'update' => TRUE, # To be executed with the --update flag.
      ],
    ];
  ```
5. Choose the scheduler time as mentioned in step 4 from Cron dropdown
   field (admin/config/system/cron) and save.

6. Source database fields content to be migrated:
    * title (plain text)
    * sku (plain text)
    * url (plain text)
    * detail (plain text)
    * price (plain text)
    * images (plain text)
    * valid_date (datetime)

7. Destination database fields of the content type:
    * title (plain text)
    * field_sku (plain text)
    * field_url (plain text)
    * field_detail (plain text)
    * field_price (plain text)
    * field_images (plain text)
    * field_valid_date (datetime)

8. Entity type is node of the `product` bundle.

9. All setup!
