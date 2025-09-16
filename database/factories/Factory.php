<?php 

namespace Bimp\Forge\Database\Factories;

use Bimp\Forge\Database\Database;

abstract class Factory {
    protected int $times = 1;
    protected array $states = [];

    abstract public function table(): string;
    abstract public function definition(): array;

    public function count(intdiv $times): static {
        $this->times = max(1, $times);
        return $this;
    }

    public function state(callable $modificar): static{
        $this->states[] = $modificar;
        return $this;
    }
}
