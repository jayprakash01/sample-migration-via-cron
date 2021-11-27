<?php

namespace Drupal\product_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for product.
 *
 * @MigrateSource(
 *   id="product_migration",
 *   source_module = "product_migrate",
 * )
 */
class Product extends SqlBase {

  /**
   * {@inheritdoc}
   */
  public function query() {
    // Source data is queried from 'products' table.
    $query = $this->select('products', 'p');
    $query->fields('p', [
      'title',
      'sku',
      'price',
      'valid_date',
    ]);

    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields = $this->baseFields();
    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function baseFields() {
    $fields = [
      'title' => $this->t('Title'),
      'sku' => $this->t('SKU'),
      'price' => $this->t('Price'),
      'valid_date' => $this->t('Product Valid Date'),
    ];

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    return [
      'sku' => [
        'type' => 'string',
        'alias' => 'p',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function prepareRow(Row $row) {
    $valid_date = $row->getSourceProperty('valid_date');
    $valid_date_arr = explode(' ', $valid_date);
    $datetime = $valid_date_arr[0] . 'T' . $valid_date_arr[1];
    $row->setSourceProperty('validDate', $datetime);

    return parent::prepareRow($row);
  }

}
