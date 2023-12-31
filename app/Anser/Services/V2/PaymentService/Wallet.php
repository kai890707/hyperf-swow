<?php

namespace App\Anser\Services\V2\PaymentService;

use SDPMlab\Anser\Service\SimpleService;
use SDPMlab\Anser\Service\Action;
use SDPMlab\Anser\Exception\ActionException;
use Psr\Http\Message\ResponseInterface;
use SDPMlab\Anser\Service\ActionInterface;
use App\Utils\Log;

class Wallet extends SimpleService
{

    protected $serviceName = "payment_service";
    protected $retry      = 0;
    protected $retryDelay = 0.2;
    protected $timeout    = 6000.0;

    /**
     * 取得使用者錢包餘額 Action
     *
     * @return ActionInterface $action
     */
    public function getWallet(int $userKey): ActionInterface
    {
        $action = $this->getAction("GET", "/api/v1/wallet")
            ->addOption("headers", [
                "X-User-key" => $userKey
            ])
            ->doneHandler(function(
                ResponseInterface $response,
                Action $action
            ){
                $resBody = $response->getBody()->getContents();
                $data = json_decode($resBody,true);
                $action->setMeaningData($data["data"]);
            })
            ->failHandler(function (
                ActionException $e
            ) {
                
                // $errorResult = $e->getResponse()->getBody();
                // $data = json_decode($errorResult, true);
                if ($e->isServerError()) {
                    // Log::getInstance()->error($e->getMessage());
                    // // Log::error($e->getMessage());
                    // $e->getAction()->setMeaningData([]);
                    Log::getInstance()->info($e->getAction()->getResponse()->getBody()->getContents());
                    $e->getAction()->setMeaningData([
                        "code" => 500,
                        "msg" => $e->getAction()->getResponse()->getBody()->getContents()
                    ]);
                }

                if ($e->isClientError()) {
                    // $errorResult = $errorResult->getContents();
                    // $data = json_decode($errorResult, true);
                    // Log::getInstance()->alert($e->getMessage());
                    // // Log::alert($e->getMessage());
                    // $e->getAction()->setMeaningData([]);
                    Log::getInstance()->info($e->getAction()->getResponse()->getBody()->getContents());
                    $e->getAction()->setMeaningData([
                        "code" => 500,
                        "msg" => $e->getAction()->getResponse()->getBody()->getContents()
                    ]);
                }

                if ($e->isConnectError()) {
                    // Log::emergency($e->getMessage());
                    // Log::getInstance()->emergency($e->getMessage());
                    // $e->getAction()->setMeaningData([]);
                    Log::getInstance()->info($e->getMessage());
                    $e->getAction()->setMeaningData([
                        "code" => 500,
                        "msg" => $e->getMessage()
                    ]);
                }
            });
        return $action;
    }
    
    /**
     * 取得使用者錢包儲值 Action
     *
     * @param integer $addAmount
     * @return ActionInterface $action
     */
    public function storeToWallet(int $addAmount): ActionInterface
    {
         $action = $this->getAction("POST", "/api/v1/wallet")
            ->addOption("headers", [
                "X-User-key" => 1
            ])
            ->addOption("form_params",[
                "addAmount" => $addAmount
            ])
            ->doneHandler(function (
                ResponseInterface $response,
                Action $action
            ){
                $resBody = $response->getBody()->getContents();
                $data    = json_decode($resBody, true);
                $action->setMeaningData($data["data"]);
            })
            ->failHandler(function (
                ActionException $e
            ){

                // $errorResult = $e->getResponse()->getBody();
                // $data = json_decode($errorResult, true);
                if ($e->isServerError()) {
                    // Log::error($e->getMessage());
                    // Log::getInstance()->error($e->getMessage());
                    // $e->getAction()->setMeaningData([]);
                    Log::getInstance()->info($e->getAction()->getResponse()->getBody()->getContents());
                    $e->getAction()->setMeaningData([
                        "code" => 500,
                        "msg" => $e->getAction()->getResponse()->getBody()->getContents()
                    ]);
                }

                if ($e->isClientError()) {
                    // $errorResult = $errorResult->getContents();
                    // $data = json_decode($errorResult, true);
                    // // Log::alert($e->getMessage());
                    // Log::getInstance()->alert($e->getMessage());
                    // $e->getAction()->setMeaningData([]);
                    Log::getInstance()->info($e->getAction()->getResponse()->getBody()->getContents());
                    $e->getAction()->setMeaningData([
                        "code" => 500,
                        "msg" => $e->getAction()->getResponse()->getBody()->getContents()
                    ]);
                }

                if ($e->isConnectError()) {
                    // Log::emergency($e->getMessage());
                    // Log::getInstance()->emergency($e->getMessage());
                    // $e->getAction()->setMeaningData([]);
                    Log::getInstance()->info($e->getMessage());
                    $e->getAction()->setMeaningData([
                        "code" => 500,
                        "msg" => $e->getMessage()
                    ]);
                }
            });
        return $action;
    }

    /**
     * 取得使用者錢包補償 Action
     *
     * @param integer $addAmount
     * @return ActionInterface $action
     */
    public function walletCompensate(int $addAmount): ActionInterface
    {
        $action = $this->getAction("POST", "/api/v1/wallet/compensate")
            ->addOption("headers", [
                "X-User-key" => 1
            ])
            ->addOption("form_params",[
                "addAmount" => $addAmount
            ])
            ->doneHandler(function (
                ResponseInterface $response,
                Action $action
            ){
                $resBody = $response->getBody()->getContents();
                $data    = json_decode($resBody, true);
                $action->setMeaningData($data["data"]);
            })
            ->failHandler(function (
                ActionException $e
            ){
                
                // $errorResult = $e->getResponse()->getBody();
                // $data = json_decode($errorResult, true);
                if ($e->isServerError()) {
                    // Log::error($e->getMessage());
                    // Log::getInstance()->error($e->getMessage());
                    // $e->getAction()->setMeaningData([]);
                    Log::getInstance()->info($e->getAction()->getResponse()->getBody()->getContents());
                    $e->getAction()->setMeaningData([
                        "code" => 500,
                        "msg" => $e->getAction()->getResponse()->getBody()->getContents()
                    ]);
                }

                if ($e->isClientError()) {
                    // $errorResult = $errorResult->getContents();
                    // $data = json_decode($errorResult, true);
                    // // Log::alert($e->getMessage());
                    // Log::getInstance()->alert($e->getMessage());
                    // $e->getAction()->setMeaningData([]);
                    Log::getInstance()->info($e->getAction()->getResponse()->getBody()->getContents());
                    $e->getAction()->setMeaningData([
                        "code" => 500,
                        "msg" => $e->getAction()->getResponse()->getBody()->getContents()
                    ]);
                }

                if ($e->isConnectError()) {
                    // // Log::emergency($e->getMessage());
                    // Log::getInstance()->emergency($e->getMessage());
                    // $e->getAction()->setMeaningData([]);
                    Log::getInstance()->info($e->getMessage());
                    $e->getAction()->setMeaningData([
                        "code" => 500,
                        "msg" => $e->getMessage()
                    ]);
                }
            });
        return $action;
    }
}