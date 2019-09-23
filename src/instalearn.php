<?php
/**
 * Filippo Finke
 */
namespace FilippoFinke;

use Phpml\Classification\KNearestNeighbors;
use Phpml\ModelManager;
class InstaLearn {

    private $classifier;

    private $modelManager;

    public function __construct($model = false) {
        $this->modelManager = new ModelManager();
        if($model) {
            $this->load($model);
        } else {
            $this->classifier = new KNearestNeighbors();
        }
    }

    public function load($path) {
        echo "Loading model..." . PHP_EOL;
        $this->classifier = $this->modelManager->restoreFromFile($path);
        echo "Model loaded!" . PHP_EOL;
    }

    public function train($dataset) {
        echo "Training model..." . PHP_EOL;
        $this->classifier->train($dataset->getSamples(), $dataset->getTargets());
        echo "Training finished!" . PHP_EOL;
    }

    public function save($path) {
        echo "Saving model..." . PHP_EOL;
        $this->modelManager->saveToFile($this->classifier, $path);
        echo "Model saved!" . PHP_EOL;
    }

    public function predict($user) {
        return $this->classifier->predict($user->toArray());
    }

}