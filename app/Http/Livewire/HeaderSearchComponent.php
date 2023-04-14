<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;


class HeaderSearchComponent extends Component
{
    public $search;
    public $showDiv = false;
    public $records;
    
    public function mount()
    {
        $this->fill(request()->only('search'));
    }

    public function searchResult()
    {
        if($this->search){
            $this->records = Product::orderby('name','asc')
                      ->where('name','like','%'.$this->search.'%')
                      ->limit(10)
                      ->get();

            $this->showDiv = true;
        }else{
            $this->showDiv = false;
        }
    }

    public function fetchEmployeeDetail($id = 0){

        $record = Product::where('id',$id)->first();

        $this->search = $record->name;
        $this->showDiv = false;
    }

    public function render()
    {
        return view('livewire.header-search-component');
    }
}
