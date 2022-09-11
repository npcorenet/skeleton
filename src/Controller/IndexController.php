<?php
declare(strict_types=1);

namespace App\Controller;

use App\Http\JsonResponse;
use App\Software;
use Laminas\Diactoros\Response;
use Psr\Http\Message\RequestInterface;

class IndexController
{

    public function load(RequestInterface $request): Response
    {
        Software::getLogger()->info('Opened Index');

        return new JsonResponse(200, ['Controller' => 'IndexController']);
    }

}
