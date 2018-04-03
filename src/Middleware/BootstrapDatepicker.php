<?php

namespace Baijunyao\LaravelBootstrapDatepicker\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

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
        $response = $next($request);
        // 获取 response 内容
        $content = $response->getContent();

        // 如果没有 body 标签直接返回
        if (false === strripos($content, '</body>')) {
            return $response;
        }

        // 如果没有用到 datepicker 直接返回
        if (false === strripos($content, 'js-laravel-bootstrap-datepicker')) {
            return $response;
        }
    
        // 插入 css 标签
        $datepickerCssPath = asset('statics/bootstrap-datepicker-1.6.4/css/bootstrap-datepicker.min.css');

        $datepickerCss = <<<php
<link href="$datepickerCssPath" rel="stylesheet" type="text/css" />
</head>
php;

        // 插入 js 标签
        $datepickerJsPath = asset('statics/bootstrap-datepicker-1.6.4/js/bootstrap-datepicker.min.js');
        $datepickerLanguageJsPath = asset('statics/bootstrap-datepicker-1.6.4/locales/bootstrap-datepicker.zh-CN.min.js');

        $datepickerJs = <<<php
<script src="$datepickerJsPath"></script>
<script src="$datepickerLanguageJsPath"></script>
<script>
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
</script>
</body>
php;

        $seach = [
            '</head>',
            '</body>'
        ];
        $subject = [
            $datepickerCss,
            $datepickerJs
        ];
        // p($content);die;
        $content = str_replace($seach, $subject, $content);
        // 更新内容并重置Content-Length
        $response->setContent($content);
        $response->headers->remove('Content-Length');
        return $response;
    }
}
