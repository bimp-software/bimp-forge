<?php

use Bimp\Forge\Core\Component;

// app/Components/Counter.php
class Counter extends Component {
    protected function initializeState() {
        return ['count' => 0];
    }
    
    public function increment() {
        $this->setState(['count' => $this->state['count'] + 1]);
    }
    
    public function render() {
        $count = $this->state['count'];
        return "
            <div class='counter'>
                <h2>Contador: {$count}</h2>
                <button onclick='Bimp.component(\"Counter\", \"increment\", \"counter-1\")'>
                    Incrementar
                </button>
            </div>
        ";
    }
}