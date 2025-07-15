<?php

namespace Laravel\Ranger\Resolvers\Expr;

use Laravel\Ranger\Resolvers\AbstractResolver;
use Laravel\Ranger\Types\Contracts\Type as ResultContract;
use Laravel\Ranger\Types\Type as RangerType;
use PhpParser\Node;

class FuncCall extends AbstractResolver
{
    public function resolve(Node\Expr\FuncCall $node): ResultContract
    {
        if ($node->name->toString() === 'array_merge') {
            $arrays = collect($node->args)->map($this->from(...));
            $finalArray = [];

            foreach ($arrays as $array) {
                if (is_array($array)) {
                    $finalArray = array_merge($finalArray, $array);
                } else {
                    $finalArray['[key: string]'] = 'mixed';
                }
            }

            if (array_is_list($finalArray)) {
                dd('is list', $finalArray);

                return RangerType::array([]);
            }

            return RangerType::array($finalArray);
        }

        $stanType = $this->getStanType($node);

        if ($stanType !== null) {
            return $stanType;
        }

        $result = $this->reflector->functionReturnType($node->name->toString(), $node);

        if ($result instanceof Result) {
            return $result;
        }

        if ($result === null || (is_array($result) && count($result) === 0)) {
            return RangerType::mixed();
        }

        if (is_array($result) && count($result) === 1) {
            return RangerType::from($result[0]);
        }

        return RangerType::from($result);
    }
}
