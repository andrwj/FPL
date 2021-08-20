<?php
namespace Ntuple\FPL;

class NArray
{
    public $data;
    function __construct(...$args) {
       $this->data = $args;
    }

    public function map(callable $cb): NArray
    {
        $this->data = array_map($cb, $this->data);
        return $this;
    }

    public function push(...$args): NArray
    {
        $this->data = array_push($this->data, $args);
        return $this;
    }

    public function pop(...$args)
    {
        return array_pop($this->data);
    }

}