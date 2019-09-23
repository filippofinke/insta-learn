<?php
/**
 * Filippo Finke
 */
use Phpml\Dataset\CsvDataset;
use FilippoFinke\InstaLearn;
use FilippoFinke\User;
require_once __DIR__ . '/../vendor/autoload.php';
ini_set('memory_limit', '-1');

$model = __DIR__ . '/../instalearn.model';
$dataset = new CsvDataset(__DIR__ . '/../data/data.csv', 7, true);
$il = new InstaLearn();
if (!file_exists($model)) {
    $il->train($dataset);
    $il->save($model);
} else {
    $il->load($model);
}

$user = new User();
$user->load('nasa');
print_r($user->toArray());
$prediction = $il->predict($user);
var_dump($prediction);
