<?php

namespace App\Livewire\Campaign;

use Flux\Flux;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Validate;

class DonateCampaign extends Component
{
  use WithFileUploads;

  public $campaign;

  public $donationtype = 'CHOOSE';

  #[Validate('required', message: 'Alamat pengirim barang harus diisi')]
  public $senderaddress;

  #[Validate('required', message: 'Kode resi paengiriman barang harus diisi')]
  public $waybill;

  #[Validate('required',           message: 'Foto pengiriman barang harus ada')]
  #[Validate('mimes:jpg,jpeg,png', message: 'Foto pengiriman barang harus bertipe JPG atau PNG')]
  #[Validate('max:2048',           message: 'Foto pengiriman barang maksimum berukuran 2MB')]
  #[Validate('image',              message: 'Media tidak dikenali')]
  public $photo;

  #[Validate('required', message: 'Jumlah donasi harus dipilih')]
  #[Validate('gt:0', message: 'Jumlah donasi tidak bisa kosong')]
  #[Validate('numeric', message: 'Jumlah donasi harus berupa angka')]
  public $paymentamount = '0';

  #[Validate('required', message: 'Metode pembayaran donasi harus dipilih')]
  public $paymentmethod;

  #[Validate('required', message: 'Alat pembayaran donasi harus dipilih')]
  public $paymentchannel;

  public $paymentanonim;

  public function mount()
  {
    $this->reset();
    $this->clear();
  }

  public function render()
  {
    return view('livewire.campaign.donate-campaign');
  }

  #[On('make-donation')]
  public function makeDonation($campaign) {
    $this->clear();
    $this->campaign = $campaign;
    $this->donationtype = $this->donationTypeOf($campaign);
    $this->modal('donate-campaign')->show();
  }

  public function sendDonation() {
    $this->validateOnly('senderaddress');
    $this->validateOnly('waybill');
    $this->validateOnly('photo');
    $this->modal('donate-campaign-success')->show();
  }

  public function makePayment() {
    $this->validateOnly('paymentamount');
    $this->validateOnly('paymentmethod');
    $this->validateOnly('paymentchannel');
    $this->modal('donate-campaign-success')->show();
  }

  public function close() 
  {
    Flux::modals()->close();
    $this->reset();
    $this->clear();
  }

  private function donationTypeOf($campaign)
  {
    switch($campaign['category']) {
      case 'EMERGENCY':
        return 'CHOOSE';
      case 'DISASTER':
        return 'CHOOSE';
      default:
        return 'FUND';
    }
  }
  private function clear()
  {
    $this->resetValidation();

    $this->campaign = [
      'category' => 'dummy',
      'title'    => 'dummy',
      'amount'   => 'dummy',
      'target'   => 'dummy',
      'percent'  => 'dummy',
      'donatur'  => 'dummy',
      'email'    => 'dummy'
    ];
    $this->donationtype   = 'CHOOSE';

    $this->paymentamount = '0';
    $this->reset('paymentamount');

    $this->paymentmethod = '';
    $this->reset('paymentmethod');

    $this->paymentchannel = '';
    $this->reset('paymentchannel');

    $this->paymentanonim = '';
    $this->reset('paymentanonim');

    $this->senderaddress = '';
    $this->reset('senderaddress');

    $this->waybill = '';
    $this->reset('paymentanonim');

    $this->photo = null;
    $this->reset('photo');
  }
}
