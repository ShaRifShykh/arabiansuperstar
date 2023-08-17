<?php

namespace App\Http\Livewire\Frontend\Layout;

use App\Models\Country;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{
    public $q;
    public $filter;
    public $gender;
    public $seletedCountry;

    public function mount($q = null, $filter = null, $gender = null, $country = null)
    {
        $this->q = $q;
        $this->filter = $filter;
        $this->gender = $gender;
        $this->seletedCountry = $country;
    }

    public function render()
    {
        $countries = Country::all();
        $notifications = Notification::where("user_id", "=", Auth::guard("web")->id())
            ->where("has_read", "=", 0)->count();
        return view('livewire.frontend.layout.header', compact("notifications", "countries"));
    }
}
