<?php

namespace Drupal\product_migrate\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Row;

/**
 * Source plugin for product.
 *
 * @MigrateSource(
 *   id="product",
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
      'url',
      'detail',
      'price',
      'images',
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
      'url' => $this->t('Url'),
      'detail' => $this->t('Detail'),
      'price' => $this->t('Price'),
      'images' => $this->t('Images'),
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
    $scrapedate = $row->getSourceProperty('valid_date');
    $scrapedates = explode(' ', $scrapedate);
    $datetime = $scrapedates[0] . 'T' . $scrapedates[1];
    $row->setSourceProperty('datetime', $datetime);

    return parent::prepareRow($row);
  }

}
