<?php

namespace App\Livewire\Campaign;

use Livewire\Component;
use Livewire\Attributes\Renderless;

class LoadMore extends Component
{
  public $perpage;
  
  public function render()
  {
      return view('livewire.campaign.load-more');
  }

  #[Renderless]
  public function loadMore() {
    $this->dispatch('load-more', page: $this->perpage)->to(LatestCampaign::class);
  }
}
