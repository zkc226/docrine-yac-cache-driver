<?php
/**
 * Created by PhpStorm.
 * User: zkc
 * Date: 2018-09-13
 * Time: 23:40
 */

namespace zkc\Docrine\Cache;


use Doctrine\Common\Cache\Cache;
use Doctrine\Common\Cache\CacheProvider;

class YacCache extends CacheProvider
{
    private $yac;

    public function __construct()
    {
        $this->yac = new \Yac('');
    }

    private function wrapId($id)
    {
        return md5($id);
    }

    /**
     * Fetches an entry from the cache.
     *
     * @param string $id The id of the cache entry to fetch.
     *
     * @return mixed|false The cached data or FALSE, if no cache entry exists for the given id.
     */
    protected function doFetch($id)
    {
        return $this->yac->get($this->wrapId($id));
    }

    /**
     * Tests if an entry exists in the cache.
     *
     * @param string $id The cache id of the entry to check for.
     *
     * @return bool TRUE if a cache entry exists for the given cache id, FALSE otherwise.
     */
    protected function doContains($id)
    {
        return $this->yac->get($this->wrapId($id)) !== false;
    }

    /**
     * Puts data into the cache.
     *
     * @param string $id         The cache id.
     * @param string $data       The cache entry/data.
     * @param int    $lifeTime   The lifetime. If != 0, sets a specific lifetime for this
     *                           cache entry (0 => infinite lifeTime).
     *
     * @return bool TRUE if the entry was successfully stored in the cache, FALSE otherwise.
     */
    protected function doSave($id, $data, $lifeTime = 0)
    {
        return $this->yac->set($this->wrapId($id), $data, $lifeTime);
    }

    /**
     * Deletes a cache entry.
     *
     * @param string $id The cache id.
     *
     * @return bool TRUE if the cache entry was successfully deleted, FALSE otherwise.
     */
    protected function doDelete($id)
    {
        return $this->yac->delete($this->wrapId($id));
    }

    /**
     * Flushes all cache entries.
     *
     * @return bool TRUE if the cache entries were successfully flushed, FALSE otherwise.
     */
    protected function doFlush()
    {
        return $this->yac->flush();
    }

    /**
     * Retrieves cached information from the data store.
     *
     * @return array|null An associative array with server's statistics if available, NULL otherwise.
     */
    protected function doGetStats()
    {
        $info = $this->yac->info();

        return [
            Cache::STATS_HITS             => $info['hits'],
            Cache::STATS_MISSES           => $info['miss'],
            Cache::STATS_UPTIME           => null,
            Cache::STATS_MEMORY_USAGE     => null,
            Cache::STATS_MEMORY_AVAILABLE => null,
        ];
    }
}