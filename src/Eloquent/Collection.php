<?php declare(strict_types=1);

namespace cjhswoftElasticsearch\Eloquent;

use Swoft\Stdlib\Collection as SwoftCollection;

/**
 * Class Collection
 *
 * @package cjhswoftElasticsearch\Eloquent
 */
class Collection extends SwoftCollection
{

    /**
     * update
     *
     * @param array $data
     *
     * @return bool
     */
    public function update(array $data): bool
    {
        $bool = true;
        foreach ($this->items as $item) {
            $bool = $item->update($data) && $bool;
        }

        return $bool;
    }

    /**
     * delete
     *
     * @return bool
     */
    public function delete(): bool
    {
        $bool = true;
        foreach ($this->items as $item) {
            $bool = $bool && $item->delete();
        }

        return $bool;
    }

}