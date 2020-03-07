<?php

namespace Boekm\Forge\Resources;

class Resource
{
    protected $forge;

    public function __construct(array $attributes, $forge = null)
    {
        $this->forge = $forge;

        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function toArray()
    {
        unset($this->forge);
        return (array) $this;
    }

    public function toJson()
    {
        unset($this->forge);
        return json_encode((array) $this);
    }
}
