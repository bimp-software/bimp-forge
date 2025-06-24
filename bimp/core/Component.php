<?php

namespace Bimp\Forge\Core;

abstract class Component {
    protected $props;
    protected $state;
    
    public function __construct($props = []) {
        $this->props = $props;
        $this->state = $this->initializeState();
    }
    
    abstract protected function initializeState();
    abstract public function render();
    
    public function setState($newState) {
        $this->state = array_merge($this->state, $newState);
        return $this->render();
    }
    
    public static function mount($selector, $props = []) {
        $component = new static($props);
        echo "<div id='$selector'>{$component->render()}</div>";
    }
}