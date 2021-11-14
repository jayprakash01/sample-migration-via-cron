# Content migration via cron scheduler

The product_migrate module extends the core migration system with API enhancements and additional functionality to migrate the content from external database to Drupal.

### Features of the module:
* Migrate the product content form external database to Drupal nodes.
* Migration of the content will be performed using hook_cron().
* It requires contrib modules migrate_plus (https://www.drupal.org/project/migrate_plus).

### Installation Steps
1. Download the module (product_migrate) and its dependencies module (migrate_plus).
2. Enable the modules - migrate_plus and product_migrate.
3. Add the external database(to be migrated) in active settings.php file.
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
5. Set the scheduler time same as step 4 from Run Cron dropdown field (admin/config/system/cron).

6. Source database fields (plain text fields + datetime):
    * title
    * sku
    * url
    * detail
    * price
    * images
    * origin
    * scrapedate

7. Destination database fields (plain text fields + datetime) of product content type:
    * title
    * field_sku
    * field_url
    * field_detail
    * field_price
    * field_images
    * field_origin
    * field_scrape_date

8. Entity type is node of product bundle.
