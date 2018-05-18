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
        $this->cssFile('statics/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker.min.css')
            ->jsFile('statics/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js')
            ->jsFile('statics/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.zh-CN.min.js')
            ->jsContent($datepickerJs);

    }


}