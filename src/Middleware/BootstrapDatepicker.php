<?php

namespace Baijunyao\LaravelBootstrapDatepicker\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Baijunyao\LaravelMiddlewareManager\Manager;

class BootstrapDatepicker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $manager = new Manager($request, $next);
        if (!$manager->className('js-laravel-bootstrap-datepicker')->verify()) {
            return $next($request);
        }

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
        $manager->cssFile('statics/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker.min.css')
            ->jsFile('statics/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js')
            ->jsFile('statics/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.zh-CN.min.js')
            ->jsContent($datepickerJs);
        return $manager->response();
    }
}
