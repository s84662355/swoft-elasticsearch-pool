<?php declare(strict_types=1);

namespace cjhswoftElasticsearch;

use Exception;
use cjhswoftElasticsearch\Connection\Connection;
use cjhswoftElasticsearch\Connection\ConnectionInstance;
use cjhswoftElasticsearch\Connection\ConnectionManager;
use cjhswoftElasticsearch\Exception\ElasticsearchException;

/**
 * Class Elasticsearch
 *
 * @since   2.0
 */
class Elasticsearch
{
    /**
     * connection
     *
     * @param string $pool
     *
     * @return ConnectionInstance
     * @throws ElasticsearchException
     */
    public static function connection(string $pool = Pool::DEFAULT_POOL): ConnectionInstance
    {
        try {
            /** @var ConnectionManager $manager */
            $manager = bean(ConnectionManager::class);


            /** @var Pool $elasticsearchPool */
            $elasticsearchPool = bean($pool);


            $connection = $manager->getConnection($elasticsearchPool->getMark());

            if(empty($connection)){

                /** @var Connection $connection */
                $connection = $elasticsearchPool->getConnection();
                $connection->setRelease(true);
                $manager->setConnection($connection);

            }


        } catch (Exception $e) {
            throw new ElasticsearchException(sprintf('Pool error is %s file=%s line=%d', $e->getMessage(),
                    $e->getFile(), $e->getLine()));
        }
        return $connection->getInstance();
    }

    /**
     * __callStatic
     *
     * @param $name
     * @param $arguments
     *
     * @return mixed
     * @throws ElasticsearchException
     */
    public static function __callStatic($name, $arguments)
    {
        /** @var ConnectionInstance $instance */
        $instance = self::connection();
        return $instance->$name(...$arguments);
    }
}
