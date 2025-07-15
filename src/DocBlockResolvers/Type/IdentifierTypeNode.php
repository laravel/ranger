<?php

namespace Laravel\Ranger\DocBlockResolvers\Type;

use Laravel\Ranger\DocBlockResolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PHPStan\PhpDocParser\Ast;

class IdentifierTypeNode extends AbstractResolver
{
    public function resolve(Ast\Type\IdentifierTypeNode $node): ResultContract
    {
        $name = (string) $node->name;
        // $templates = $this->parsed->getTemplateTagValues();

        // $matchingTemplate = collect($templates)->first(fn($template) => $template->name === $name);

        // if ($matchingTemplate) {
        //     // dd('Found template type: ' . $matchingTemplate);
        // }

        return RangerType::from($name);
    }
}
