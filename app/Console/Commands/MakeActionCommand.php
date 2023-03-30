<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeActionCommand extends GeneratorCommand
{
    /**
     * @var string
     */
    protected $name = 'make:action';

    /**
     * @var string
     */
    protected $description = 'Create a new action class';

    /**
     * @var string
     */
    protected $type = 'Action';

    /**
     * @param  string  $rawName
     */
    protected function alreadyExists($rawName): bool
    {
        return class_exists($rawName);
    }

    protected function getStub(): string
    {
        return base_path('/stubs/action.stub');
    }

    /**
     * @param  string  $rootNamespace
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Actions';
    }
}
