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
        Response::macro('custom', function (int $status_code, array $data) {
            return response()->json($data, $status_code);
        });

        /**
         * 成功
         */
        Response::macro('success', function (array $data = []) {
            return response()->json($data, 200);
        });

        /**
         * 失敗
         */
        Response::macro('fail', function (array $errors = [], int $status_code = 500,) {
            return response()->json([
                'errors' => $errors,
            ], $status_code);
        });
    }
}
