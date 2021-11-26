<?php


namespace App\core\env;


use App\core\Exceptions\EnvFileNotFoundException;

/**
 * Class EnvService
 * @package App\Core\env
 * @property $env_file_name
 */
class EnvService {
    protected $env_file_name;

    public function __construct(string $env_file_name)
    {
        $this->setEnvName($env_file_name);
    }

    /**
     * @return array
     * @throws EnvFileNotFoundException
     */
    public function getEnvData(): array
    {
        if (file_exists($this->env_file_name)) {
            return $this->parseEnvData();
        }
        throw new EnvFileNotFoundException;
    }

    private function parseEnvData(): array {
        $fileContent = file_get_contents($this->env_file_name);
        $contentArrayCouple = explode("\n", $fileContent);
        $envData = [];
        foreach ($contentArrayCouple as $content) {
            if (trim($content)) {
                $contentArray = explode('=', $content);
                $envData[trim($contentArray[0])] = trim($contentArray[1]);
            }
        }
        return $envData;
    }

    private function setEnvName($env_file_name) {
        $this->env_file_name = $env_file_name;
    }

}