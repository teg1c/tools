<?php

namespace Tegic\Tools\Tests\Stubs;

use ArrayAccess;
use JsonSerializable as JsonSerializableInterface;
use Tegic\Tools\Traits\Accessable;
use Tegic\Tools\Traits\Arrayable;
use Tegic\Tools\Traits\Serializable;

class TraitStub  implements JsonSerializableInterface, ArrayAccess
{
    use Accessable;
    use Arrayable;
    use Serializable;

    private $name = 'tegic';

    private $fooBar = 'name';

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): TraitStub
    {
        $this->name = $name;
        return $this;
    }
}
