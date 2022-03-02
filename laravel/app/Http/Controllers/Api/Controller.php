<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * コントローラーは整形及びRequestの操作を行う
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected const CREATE_STATUS = 'create';
    protected const UPDATE_STATUS = 'update';
    protected const DELETE_STATUS = 'delete';

    protected function existsModel($model): bool
    {
        $exists = false;
        if ($model->exists) {
            $exists = true;
        }
        return $exists;
    }
}
