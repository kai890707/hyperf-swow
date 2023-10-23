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

//  $services = [
//     'product_service' => \App\JsonRpc\ProductService\ProductServiceInterface::class,
//  ];

return [
    'enable' => [
        'discovery' => true,
        'register' => true,
    ],
    'consumers' => [
        [
            // name 需与服务提供者的 name 属性相同
            'name'          => 'ProductService',
            // 服务接口名，可选，默认值等于 name 配置的值，如果 name 直接定义为接口类则可忽略此行配置，如 name 为字符串则需要配置 service 对应到接口类
            'service'       => \App\JsonRpc\ProductInterface::class,
            // 对应容器对象 ID，可选，默认值等于 service 配置的值，用来定义依赖注入的 key
            'id'            => \App\JsonRpc\ProductInterface::class,
            // 服务提供者的服务协议，可选，默认值为 jsonrpc-http
            // 可选 jsonrpc-http jsonrpc jsonrpc-tcp-length-check
            'protocol'      => 'jsonrpc-http',
            // 负载均衡算法，可选，默认值为 random
            'load_balancer' => 'round-robin',
            // 这个消费者要从哪个服务中心获取节点信息，如不配置则不会从服务中心获取节点信息
            'registry'      => [
                'protocol' => 'consul',
                'address'  => 'http://host.docker.internal:8500',
            ],
            // 配置项，会影响到 Packer 和 Transporter
            'options'       => [
                'connect_timeout' => 60.0,
                'recv_timeout'    => 60.0,
                'settings'        => [
                    // 根据协议不同，区分配置
                    'open_eof_split' => true,
                    'package_eof'    => "\r\n",
                    'package_max_length' => 2 * 1024 * 1024
                    // 'open_length_check' => true,
                    // 'package_length_type' => 'N',
                    // 'package_length_offset' => 0,
                    // 'package_body_offset' => 4,
                ],
                // // 重试次数，默认值为 2，收包超时不进行重试。暂只支持 JsonRpcPoolTransporter
                // 'retry_count'     => 2,
                // // 重试间隔，毫秒
                // 'retry_interval'  => 100,
                // // 使用多路复用 RPC 时的心跳间隔，null 为不触发心跳
                // 'heartbeat'       => 30,
                // // 当使用 JsonRpcPoolTransporter 时会用到以下配置
                // 'pool'            => [
                //     'min_connections' => 20,
                //     'max_connections' => 32,
                //     'connect_timeout' => 60.0,
                //     'wait_timeout'    => 60.0,
                //     'heartbeat'       => -1,
                //     'max_idle_time'   => 60.0,
                // ],
            ],
        ]

        // [
        //     // The service name, this name should as same as with the name of service provider.
        //     'name' => 'CalculatorService',
        //     // The service registry, if `nodes` is missing below, then you should provide this configs.
        //     // 服务接口名，可选，默认值等于 name 配置的值，如果 name 直接定义为接口类则可忽略此行配置，如 name 为字符串则需要配置 service 对应到接口类
        //     'service' => \App\JsonRpc\CalculatorServiceInterface::class,
        //     // 服务提供者的服务协议，可选，默认值为 jsonrpc-http
        //     'protocol' => 'jsonrpc-http',
        //     // 负载均衡算法，可选，默认值为 random
        //     'load_balancer' => 'random',
        //     // 对应容器对象 ID，可选，默认值等于 service 配置的值，用来定义依赖注入的 key
        //     'id' => \App\JsonRpc\CalculatorServiceInterface::class,
        //     // If `registry` is missing, then you should provide the nodes configs.
        //     'nodes' => [
        //         // 这里就是服务发布的位置就是服务端配置server.php中的那个
        //         ['host' => 'xxx.xxx.xxx.xxx', 'port' => 9503]
        //     ],
        //     // 配置项，会影响到 Packer 和 Transporter
        //     'options' => [
        //         'connect_timeout' => 5.0,
        //         'recv_timeout' => 5.0,
        //         'settings' => [
        //             // 根据协议不同，区分配置
        //             'open_eof_split' => true,
        //             'package_eof' => "\r\n",
        //             // 'open_length_check' => true,
        //             // 'package_length_type' => 'N',
        //             // 'package_length_offset' => 0,
        //             // 'package_body_offset' => 4,
        //         ],
        //         // 当使用 JsonRpcPoolTransporter 时会用到以下配置
        //         'pool' => [
        //             'min_connections' => 1,
        //             'max_connections' => 32,
        //             'connect_timeout' => 10.0,
        //             'wait_timeout' => 3.0,
        //             'heartbeat' => -1,
        //             'max_idle_time' => 60.0,
        //         ],
        //     ]

        // ],
        // [
        //     'name'=>'ProductService',
        //     'service'=>\App\JsonRpc\ProductInterface::class,
        //     'nodes' => [
        //         // ['host' => 'host.docker.internal', 'port' => 8083],
        //         ['host' => '140.127.74.161', 'port' => 8081],
        //     ],
        // ]
    ],
    // 'consumers' => value(function () use($services) {
    //     $consumers = [];
    //     foreach ($services as $name => $interface) {
    //         $consumers[] = [
    //             'name'          => $name,
    //             'service'       => $interface,
    //             'load_balancer' => 'random',
    //             'registry'      => [
    //                 'protocol' => 'consul',
    //                 'address'  => 'http://140.127.74.136:8500'
    //             ]
    //         ];
    //     }
    //     return $consumers;
    // }),
    'providers' => [],
    'drivers' => [
        'consul' => [
            'uri' => 'http://host.docker.internal:8500',
            'token' => '',
            'check' => [
                'deregister_critical_service_after' => '90m',
                'interval' => '5s',
            ],
        ],
        'nacos' => [
            // nacos server url like https://nacos.hyperf.io, Priority is higher than host:port
            // 'url' => '',
            // The nacos host info
            'host' => '127.0.0.1',
            'port' => 8848,
            // The nacos account info
            'username' => null,
            'password' => null,
            'guzzle' => [
                'config' => null,
            ],
            'group_name' => 'api',
            'namespace_id' => 'namespace_id',
            'heartbeat' => 5,
            'ephemeral' => false,
        ],
    ],
];
