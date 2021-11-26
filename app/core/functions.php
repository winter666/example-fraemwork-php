<?php

use App\Core\env\EnvService;
use App\core\Exceptions\EnvFileNotFoundException;

if (!function_exists('env')) {
    function env(string $name, $default_value = null) {
        try {
            $envService = new EnvService('.env');
            $envData = $envService->getEnvData();
            $envKeys = array_keys($envData);
            $key = array_search($name, $envKeys);
            if ($key !== false) {
                return $envData[$envKeys[$key]];
            }
            return $default_value;
        } catch(EnvFileNotFoundException $e) {
            // TODO: print log on file;
        }
    }
}