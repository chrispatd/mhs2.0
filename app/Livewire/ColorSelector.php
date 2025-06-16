<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ColorSelector extends Component
{
    public $colors;
    public $selectedColor;
    public $tempColor;

    public function mount()
    {
        // Fetch all colors from ms_color table
        $this->colors = DB::table('ms_color')->get();
        
        // Set default color from session or first color
        $this->selectedColor = session('selected_color', $this->colors->first()->hex_color ?? '#5352ed');
        $this->tempColor = $this->selectedColor;
    }

    public function updatedTempColor($value)
    {
        $this->tempColor = $value;
    }

    public function saveColor()
    {
        $this->selectedColor = $this->tempColor;
        session(['selected_color' => $this->selectedColor]);
        $this->dispatch('color-updated', color: $this->selectedColor);
    }

    public function render()
    {
        return view('livewire.color-selector');
    }
}