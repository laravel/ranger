<?php

namespace Laravel\Ranger\Tests\Fixtures;

use Illuminate\Database\Eloquent\Model;

/**
 * Stands in for a base model shipped by a package: it lives outside the
 * application's paths, so scanning them never reads it.
 */
abstract class PackageModel extends Model
{
    //
}
