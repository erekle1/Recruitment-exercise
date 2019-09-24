<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoanFormAssets extends AssetBundle
{
    public $basePath  = '@webroot';
    public $baseUrl   = '@web';
    public $css       = [
        'css/libs/bootstrap-datepicker3.min.css',
        'scss/pages/loan/form.scss'
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_END];

    public $js       = [
        'js/libs/bootstrap-datepicker.min.js',
        'js/loan.form.js'
    ];

}
