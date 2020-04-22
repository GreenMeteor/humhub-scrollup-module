<?php

namespace humhub\modules\scrollup\widgets;

use Yii;
use yii\helpers\Json;
use yii\helpers\Html;
use humhub\widgets\Pjax;
use humhub\modules\scrollup\Assets;

/**
 * scroll-up widget to include in a website
 *
 */
class ScrollUp extends Pjax
{

    public $contentContainer;

    public static function isActive()
    {
        // Pjax work around
        return Yii::$app->params['enablePjax'];
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $view = $this->getView();
        Assets::register($view);

        // Enable use of inline JS
        $view->registerJsConfig('client.pjax', [
            'active' => self::isActive(),
            'options' => $this->clientOptions
        ]);

        $position = Yii::$app->getModule('scrollup')->getPosition() . '';

        $color = Yii::$app->getModule('scrollup')->getColor() . '';

        return $this->render('scrollup', ['position' => $position, 'color' => $color]);
    }
}
