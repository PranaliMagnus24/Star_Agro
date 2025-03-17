<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GoogleLocationPicker extends Component
{
    public $latitude;
    public $longitude;
    public $address;
    public $fieldName;

    public function __construct($latitude = null, $longitude = null, $address = '', $fieldName = 'location')
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->address = $address;
        $this->fieldName = $fieldName;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.google-location-picker');
    }
}
