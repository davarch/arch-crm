<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes\Info;

#[Info(version: '0.0.1', title: 'Arch CRM')]
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
