<?php

namespace Baijunyao\LaravelBootstrapDatepicker;

use Baijunyao\LaravelPluginManager\Contracts\PluginManager;

class Manager extends PluginManager
{
    protected $element = 'js-laravel-bootstrap-datepicker';

    protected function load()
    {
        $datepickerJs = <<<php
$(function () {
    // 日期插件
    $('.js-laravel-bootstrap-datepicker').datepicker({
        format: "yyyy-mm-dd",
        todayBtn: "linked",
        language: "zh-CN",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
})
php;
        $this->cssFile('statics/laravel-bootstrap-datepicker/css/bootstrap-datepicker.min.css')
            ->jsFile('statics/laravel-bootstrap-datepicker/js/bootstrap-datepicker.min.js')
            ->jsFile('statics/laravel-bootstrap-datepicker/locales/bootstrap-datepicker.zh-CN.min.js')
            ->jsContent($datepickerJs);

    }


}