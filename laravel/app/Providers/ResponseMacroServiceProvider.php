<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('success', function (string $view, array $data = []) {
            return view($view, $data);
        });

        /**
         * 直前のURLにリダイレクトしてエラーを送る
         */
        Response::macro('fail', function (array $messages = []) {
            return back()->withErrors($messages);
        });
    }
}
