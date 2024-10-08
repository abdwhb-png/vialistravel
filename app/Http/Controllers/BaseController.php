<?php

namespace App\Http\Controllers;

use stdClass;
use Throwable;
use HTMLPurifier, HTMLPurifier_Config;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ValidationController;

class BaseController extends ValidationController
{

    public function purifyHtml($html): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($html);
    }

    public function showSuccess(
        string $msg,
        ?string $title = 'Action completed successfully.',
        ?string $where = '',
        ?array $list = [],
        bool $json_res = false,
        ?string $reload = '<br>Reloading...'
    ): RedirectResponse|JsonResponse {
        $ret = [
            'title' => $title,
            'msg' => $msg,
            'list' => $list
        ];
        if ($json_res) {
            Session::flash('success', $ret);
            return $this->sendSuccess($msg . $reload, $list);
        }
        if ($where)
            return redirect($where)->with('success', $ret);
        return back()->with('success', $ret);
    }

    public function showError(
        string $msg,
        ?string $title = 'Something went wrong... <br>Please, try again!',
        string $where = '',
        ?array $errors = [],
        bool $json_res = false,
    ): RedirectResponse|JsonResponse {
        $ret = [
            'title' => $title,
            'msg' => $msg,
            'list' => $errors
        ];
        if ($json_res) {
            Session::flash('fail', $ret);
            return $this->sendError($msg, $errors);
        }
        if ($where)
            return redirect($where)->with('fail', $ret);
        return back()->with('fail', $ret);
    }

    public function redirectTh(
        Throwable $th,
        bool $json_res = false,
    ): RedirectResponse|JsonResponse {
        return $this->showError(
            msg: env('APP_DEBUG') ? $th->getMessage() : 'This an exception error message. You cannot view it in production.',
            errors: ['In file :' . $th->getFile(), 'At line : ' . $th->getLine()]
        );
    }

    public function sendSuccess(?string $msg = 'Action completed successfully.', array|stdClass $result = []): JsonResponse
    {
        $response = [
            'ok' => true,
            'code'    => 200,
            'type' => 'success',
            'msg'     => $msg,
            'list'    => $result,
        ];

        return response()->json($response, 200);
    }

    public function sendError(?string $msg = 'This action cannot be performed. Please, try again!', ?array $errorMessages = [], ?int $code = null): JsonResponse
    {
        $response = [
            'ok' => false,
            'code' => $code,
            'type' => 'error',
            'msg' => $msg,
            'list' => $errorMessages,
        ];

        return response()->json($response);
    }

    public function sendTh(Throwable $th): JsonResponse
    {
        return $this->sendError(
            msg: env('APP_DEBUG') ? $th->getMessage() : 'This an exception error message. You cannot view it in production.',
            errorMessages: ['In file : ' . $th->getFile(), 'At line : ' . $th->getLine()]
        );
    }
}
