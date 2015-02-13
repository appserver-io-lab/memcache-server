<?php

/**
 * AppserverIo\Lab\MemcacheServer\GarbageCollector
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Philipp Dittert <pd@appserver.io>
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-lab/memcache-server
 * @link      http://www.appserver.io
 * @link      https://github.com/memcached/memcached/blob/master/doc/protocol.txt
 */

namespace AppserverIo\Lab\MemcacheServer;

/**
 * This thread is responsible for handling the garbage collection.
 *
 * @author    Philipp Dittert <pd@appserver.io>
 * @author    Tim Wagner <tw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-lab/memcache-server
 * @link      http://www.appserver.io
 * @link      https://github.com/memcached/memcached/blob/master/doc/protocol.txt
 */
class GarbageCollector extends \Thread
{

    /**
     * Holds the cache API.
     *
     * @var \AppserverIo\Lab\MemcacheServer\CacheInterface
     */
    protected $cache;

    /**
     * Constructs the garbage collector instance.
     *
     * @param \AppserverIo\Lab\MemcacheServer\CacheInterface $cache The cache API
     */
    public function __construct(CacheInterface $cache)
    {

        // set the cache API
        $this->cache = $cache;

        // start server thread
        $this->start();
    }

    /**
     * Returns the context instance.
     *
     * @return \AppserverIo\Lab\MemcacheServer\CacheInterface The cache API
     */
    public function getCache()
    {
        return $this->cache;
    }

    /**
     * This method is called when the thread is started.
     *
     * @return void
     */
    public function run()
    {
        while (true) {
            $this->getCache()->gc();
        }
    }
}
