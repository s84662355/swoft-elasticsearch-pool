<?php declare(strict_types=1);

namespace cjhswoftElasticsearch\Listener;


use Swoft\Bean\BeanFactory;
use cjhswoftElasticsearch\Connection\ConnectionManager;
use Swoft\Event\Annotation\Mapping\Listener;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\SwoftEvent;

/**
 * Class CoroutineDestroyListener
 *
 * @since 2.8
 *
 * @Listener(event=SwoftEvent::COROUTINE_DESTROY)
 */
class CoroutineDestroyListener implements EventHandlerInterface
{
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event): void
    {
        /* @var ConnectionManager $conManager */
        $conManager = BeanFactory::getBean(ConnectionManager::class);
        $conManager->release(true);
    }
}
