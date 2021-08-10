<?php

namespace GuzzleHttp\Promise;

final class Is
{
    /**
     * Returns true if a promise is pending.
     *
     * @return bool
     */
    public static function pending(PromiseInterface $promise)
    {
        return PromiseInterface::PENDING === $promise->getState();
    }

    /**
     * Returns true if a promise is fulfilled or rejected.
     *
     * @return bool
     */
    public static function settled(PromiseInterface $promise)
    {
        return PromiseInterface::PENDING !== $promise->getState();
    }

    /**
     * Returns true if a promise is fulfilled.
     *
     * @return bool
     */
    public static function fulfilled(PromiseInterface $promise)
    {
        return PromiseInterface::FULFILLED === $promise->getState();
    }

    /**
     * Returns true if a promise is rejected.
     *
     * @return bool
     */
    public static function rejected(PromiseInterface $promise)
    {
        return PromiseInterface::REJECTED === $promise->getState();
    }
}
