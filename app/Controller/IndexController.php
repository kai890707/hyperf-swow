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
use Psr\Log\LoggerInterface;
use Hyperf\Logger\LoggerFactory;

class IndexController extends AbstractController
{
    protected LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('log', 'default');
    }
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

        $createOrder = new CreateOrderOrchestrator();

		$data = $createOrder->build($products, $memberKey);
	    $result = $data ?? ["order_key" => $createOrder->orderKey];
        $this->logger->info(json_encode($result));
        return $this->response->json($result);
    }
}