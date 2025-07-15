<?php

namespace Laravel\Ranger\Components;

class BroadcastEvent
{
    public function __construct(public readonly string $name)
    {
        //
    }

    public function javaScriptName(): string
    {
        // TODO: Determine namespace, don't hardcode it
        $defaultNamespace = 'App\\Events\\';

        if (str_contains($this->name, $defaultNamespace)) {
            return str_replace($defaultNamespace, '', $this->name);
        }

        return '.'.$this->name;
    }
}
