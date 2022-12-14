<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(title="Helpet", version="0.1"),
 * 
 * @OA\SecurityScheme(
 *     type="http",
 *     scheme="bearer",
 *     description="Authentication Bearer Token",
 *     securityScheme="bearerAuth",
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
