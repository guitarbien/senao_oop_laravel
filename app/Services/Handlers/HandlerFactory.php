<?php

namespace App\Services\Handlers;

use function json_decode;
use Storage;

class HandlerFactory
{
    /** @const string handler對應檔 */
    const HANDLER_MAPPING_FILE = 'handler_mapping.json';

    public static function create(string $handleType): ?Handler
    {
        $handlerMapping = json_decode(Storage::get(self::HANDLER_MAPPING_FILE), true);

        if (isset($handlerMapping[$handleType])) {
            return new $handlerMapping[$handleType]();
        }
    }
}