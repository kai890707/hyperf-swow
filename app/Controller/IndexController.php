<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

use SDPMlab\Anser\Service\ServiceList;
use App\Anser\Orchestrators\V2\CreateOrderOrchestrator;
// use Psr\Log\LoggerInterface;
// use Hyperf\Logger\LoggerFactory;
use App\Utils\Log;
use Hyperf\Utils\Coroutine;

class IndexController extends AbstractController
{
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }

    public function createOrder()
    {

        $data      = $this->request->all();
        $memberKey = $data["memberKey"];
        $products  = $data["products"];
        Coroutine::create(function () use ($memberKey,$products) {
            $createOrder = new CreateOrderOrchestrator();

            $data = $createOrder->build($products, $memberKey);
            $result = $data ?? ["order_key" => $createOrder->orderKey];
            Log::getInstance()->info(json_encode($result));
            // $this->logger->info(json_encode($result));
            return $this->response->json($result);
        });
        

        
    }
}
