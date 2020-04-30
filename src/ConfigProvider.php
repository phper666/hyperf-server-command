<?php
declare(strict_types=1);
namespace Phper666\HyperfServiceCommand;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
            ],
            'commands' => [
            ],
            'listeners' => [],
            // 合并到  config/autoload/annotations.php 文件
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config of service_command client.',
                    'source' => __DIR__ . '/../publish/service_command.php',
                    'destination' => BASE_PATH . '/config/autoload/service_command.php',
                ],
            ],
        ];
    }
}
