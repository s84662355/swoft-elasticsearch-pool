<?php declare(strict_types=1);

namespace cjhswoftElasticsearch;

use Swoft\Helper\ComposerJSON;
use Swoft\SwoftComponent;
use function dirname;

/**
 * class AutoLoader
 *
 * @since 2.0
 */
final class AutoLoader extends SwoftComponent
{
    /**
     * @return bool
     */
    public function enable(): bool
    {
        return true;
    }

    /**
     * Get namespace and dirs
     *
     * @return array
     */
    public function getPrefixDirs(): array
    {
        return [
            __NAMESPACE__ => __DIR__,
        ];
    }

    /**
     * Metadata information for the component
     *
     * @return array
     */
    public function metadata(): array
    {
        $jsonFile = dirname(__DIR__) . '/composer.json';

        return ComposerJSON::open($jsonFile)->getMetadata();
    }

    /**
     * {@inheritDoc}
     */
    public function beans(): array
    {
        return [
            'elastic-config'      => [
                'class'    => Client::class,
                'host'     => '127.0.0.1',
                'port'     =>  9200,
 
             
            ],
            'elastic.pool' => [
                'class'   => Pool::class,
                'client' => bean('elastic-config'),
                ///'mark'  => 'rabbitmq_pool',
                'minActive' => 10,
                'maxActive' => 10,
            ]
        ];
    }
}
