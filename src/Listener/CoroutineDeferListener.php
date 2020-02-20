<?php declare(strict_types=1);

namespace cjhswoftElasticsearch\Listener;

use Swoft\Bean\BeanFactory;
use cjhswoftElasticsearch\Connection\ConnectionManager;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\SwoftEvent;

/**
 * Class CoroutineDeferListener
 *
 * @since 2.0
 *
 * @Listener(event=SwoftEvent::COROUTINE_DEFER)
 */
class CoroutineDeferListener implements EventHandlerInterface
{
    /**
     * @param EventInterface $event
     *
     */
    public function handle(EventInterface $event): void
    {
        /* @var ConnectionManager $conManager */
        $conManager = BeanFactory::getBean(ConnectionManager::class);

        $conManager->release();
    }
}
