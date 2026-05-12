<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $secret
 * @property string $internal_note
 * @property string $display_name
 */
class Visibility extends Model
{
    /**
     * @var list<string>
     */
    protected $visible = [
        'id',
        'name',
        'display_name',
    ];

    /**
     * @var list<string>
     */
    protected $appends = [
        'display_name',
    ];
}
