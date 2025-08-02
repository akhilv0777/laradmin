<?php

if (! function_exists('laradmin_asset')) {
    function laradmin_asset(string $path): string
    {
        $publicPath = public_path('vendor/laradmin/'.$path);
        $ver = file_exists($publicPath) ? '?v='.filemtime($publicPath) : '';
        return asset('vendor/laradmin/'.$path).$ver;
    }
}
