<?php
namespace AliOpen\Core;

interface IAcsClient {
    /**
     * @param \AliOpen\Core\AcsRequest $request
     * @return mixed
     */
    public function doAction($request);
}
