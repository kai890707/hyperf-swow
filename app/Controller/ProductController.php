<?php
namespace App\Controller;

use App\JsonRpc\ProductInterface;
use App\JsonRpc\Product;

use Hyperf\Di\Annotation\Inject;

class ProductController extends AbstractController
{
    #[Inject]
    protected ProductInterface $ProductService;

    public function index(Product $service)
    {
        // return ['code' => 200, 'data' => $this->ProductService->products()];
        $getUsers =  $service->products();

        return [
            'products'=>$getUsers,
        ];
    }
}
