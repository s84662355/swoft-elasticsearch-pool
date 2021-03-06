<?php declare(strict_types=1);

namespace cjhswoftElasticsearch;

use Swoft\Connection\Pool\AbstractPool;
use Swoft\Connection\Pool\Contract\ConnectionInterface;
use cjhswoftElasticsearch\Connection\Connection;

/**
 * Class Pool
 *
 * @since   2.0
 *
 * @package cjhswoftElasticsearch
 */
class Pool extends AbstractPool
{

    public const DEFAULT_POOL = 'elastic.pool';

    /**
     * @var Client
     */
    private $client;


    /**
     * @var string
     */
    private $mark ;

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    public function getMark()
    {
        return $this->mark ;
    }

    /**
     * createConnection
     *
     * @return ConnectionInterface
     */
    public function createConnection(): ConnectionInterface
    {
        $id = $this->getConnectionId();

        /** @var Connection $connection */
        $connection = bean(Connection::class);
        $connection->setId($id);
        $connection->setPool($this);
        $connection->setLastTime();
        $connection->setClient($this->client);

        $connection->create();

        return $connection;
    }

}
