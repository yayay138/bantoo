<div>
  <flux:modal name="donate-campaign" :dismissible="false" wire:close="close" wire:cancel="close">
    <div class="p-6">
      <div class=" mb-4 flex justify-between items-center">
        <h3 class="text-xl font-bold">{{ $campaign['title'] }}</h3>
      </div>
      <div class="mb-6 {{ $donationtype == "CHOOSE" ? 'show' : 'hide'}}">
        <h4 class="font-bold mb-2">Pilih Jenis Donasi</h4>
        <flux:radio.group variant="segmented" wire:model.live="donationtype">
          <flux:radio value="GOODS" label="Berupa Barang" icon="building-office-2"/>
          <flux:radio value="FUND" label="Berupa Dana"   icon="wallet"/>
        </flux:radio.group>
      </div>
      <div class="{{ $donationtype == "GOODS" ? 'show' : 'hide'}}">
        <div class="mb-6">
          <h4 class="font-bold mb-2">Alamat Pengirim Barang</h4>
          <flux:textarea
            placeholder="Jalan, No Bangunan, RT/RW, Desa, Kecamatan, Kota, Propinsi, Kode Pos"
            description="Tulis alamat penerimaan donasi barang dengan lengkap dan jelas"
            wire:model="senderaddress"
          />
        </div>
        <div class="mb-6">
          <h4 class="font-bold mb-2">Kode Pengiriman Barang</h4>
          <flux:input
            placeholder="Nomor resi"
            description="Cantumkan nomor resi pengiriman barang"
            wire:model="waybill"
          />
        </div>
        <div class="mb-6">
          <h4 class="font-bold mb-2">Foto Barang Yang Dikirim</h4>
          <div class="image-upload block w-full m-auto">
            <input
              id="photo"
              type="file"
              accept="image/*"
              wire:model="photo"
            />
            <label for="photo">
              <div  class="grid grid-cols-1 justify-items-center w-full m-auto">
                @if (!$photo)
                  <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                  <p class="font-medium">Unggah foto barang yang dikirim</p>
                  <p class="text-sm text-gray-500">Format JPG, PNG (maks. 5MB)</p>
                  <p class="text-sm text-blue-500 mt-2">Pilih dari komputer</p>
                  @else
                  <img src="{{ $photo->temporaryUrl() }}" class="max-w-full max-h-48 rounded-lg">
                @endif
                <flux:error name="photo"/>
              </div>
            </label>
          </div>
        </div>
        <div class="flex justify-center items-center">
          <flux:button variant="primary" wire:click="sendDonation">Kirim Donasi</flux:button>
        </div>
      </div>
      <div class="{{ $donationtype == "FUND" ? 'show' : 'hide'}}">
        <div class="mb-6">
          <div class="mb-1 flex justify-between text-sm">
            <span class="font-medium">Rp. {{ $campaign['amount'] }} terkumpul</span>
            <span class="text-gray-500">dari Rp. {{ $campaign['target'] }}</span>
          </div>
          <div class="progress-bar">
            <div class="progress-fill" style="width: {{ $campaign['percent'] }}%"></div>
          </div>
        </div>
        <div class="mb-6">
          <h4 class="font-bold mb-2">Pilih Jumlah Donasi</h4>
          <fieldset class="radio-cards grid-cols-3 gap-3 mb-4" wire:model.live="paymentamount">
            <label class="radio-card">
              <input type="radio" class="radio-card" value="100" name="paymentamount"/>
              <div class="radio-card">Rp. 100.000</div>
            </label>
            <label class="radio-card">
              <input type="radio" class="radio-card" value="250" name="paymentamount"/>
              <div class="radio-card">Rp. 250.000</div>
            </label>
            <label class="radio-card">
              <input type="radio" class="radio-card" value="500" name="paymentamount"/>
              <div class="radio-card">Rp. 500.000</div>
            </label>
            <label class="radio-card">
              <input type="radio" class="radio-card" value="750" name="paymentamount"/>
              <div class="radio-card">Rp. 750.000</div>
            </label>
            <label class="radio-card">
              <input type="radio" class="radio-card" value="1000" name="paymentamount"/>
              <div class="radio-card">Rp. 1.000.000</div>
            </label>
            <label class="radio-card">
              <input type="radio" class="radio-card" value="0" name="paymentamount"/>
              <div class="radio-card">Lainnya</div>
            </label>
          </fieldset>
          <div class="relative {{ $paymentamount == "0" ? 'show' : 'hide'}}">
            <flux:input
              wire:model="paymentamount"
              placeholder="Contoh: 10.000.000,-"
              label="Jumlah Donasi"
              description="Tentukan sendiri besaran donasi anda"
            />
          </div>
          <div class="relative {{ $paymentamount == "0" ? 'hide' : 'show'}}">
            <flux:error name="paymentamount"/>
          </div>
        </div>
        <div class="mb-6">
          <h4 class="font-bold mb-3">Metode pembayaran</h4>
          <flux:radio.group variant="segmented" wire:model.live="paymentmethod">
            <flux:radio value="BANK"   label="Transfer Bank" icon="building-office-2"/>
            <flux:radio value="WALLET" label="E-Wallet"      icon="wallet"/>
            <flux:radio value="CARD"   label="Kartu Kredit"  icon="credit-card"/>
          </flux:radio.group>
          <flux:error name="paymentmethod"/>
          <fieldset class="radio-cards grid-cols-1 gap-3 mb-4" wire:model="paymentchannel">
            <div class="tab-content {{ $paymentmethod == 'BANK' ? 'active' : ''}}">
              <label class="radio-card">
                <input type="radio" class="radio-card" value="BCA" name="paymentchannel"/>
                <div class="radio-card">
                  <div class="flex items-center">
                    <img src="/icons/bca.svg" alt="BCA" class="w-10 h-10 mr-3">
                    <div>
                      <p class="font-medium">Bank Central Asia (BCA)</p>
                      <p class="text-sm text-gray-500">Transfer Virtual Account</p>
                    </div>
                  </div>
                </div>
              </label>
              <label class="radio-card">
                <input type="radio" class="radio-card" value="MANDIRI" name="paymentchannel"/>
                <div class="radio-card">
                  <div class="flex items-center">
                    <img src="/icons/mandiri.svg" alt="Mandiri" class="w-10 h-10 mr-3">
                    <div>
                      <p class="font-medium">Bank Mandiri</p>
                      <p class="text-sm text-gray-500">Transfer Virtual Account</p>
                    </div>
                  </div>
                </div>
              </label>
              <label class="radio-card">
                <input type="radio" class="radio-card" value="BRI" name="paymentchannel"/>
                <div class="radio-card">
                  <div class="flex items-center">
                    <img src="/icons/bri.svg" alt="BRI" class="w-10 h-10 mr-3">
                    <div>
                      <p class="font-medium">Bank Rakyat Indonesia (BRI)</p>
                      <p class="text-sm text-gray-500">Transfer Virtual Account</p>
                    </div>
                  </div>
                </div>
              </label>
            </div>
            <div class="tab-content {{ $paymentmethod == 'WALLET' ? 'active' : ''}}">
              <label class="radio-card">
                <input type="radio" class="radio-card" value="OVO" name="paymentchannel"/>
                <div class="radio-card">
                  <div class="flex items-center">
                    <img src="/icons/ovo.svg" alt="OVO" class="w-10 h-10 mr-3">
                    <div>
                      <p class="font-medium">OVO</p>
                      <p class="text-sm text-gray-500">Dompet Digital</p>
                    </div>
                  </div>
                </div>
              </label>
              <label class="radio-card">
                <input type="radio" class="radio-card" value="DANA" name="paymentchannel"/>
                <div class="radio-card">
                  <div class="flex items-center">
                    <img src="/icons/dana.svg" alt="DANA" class="w-10 h-10 mr-3">
                    <div>
                      <p class="font-medium">DANA</p>
                      <p class="text-sm text-gray-500">Dompet Digital</p>
                    </div>
                  </div>
                </div>
              </label>
              <label class="radio-card">
                <input type="radio" class="radio-card" value="LINKAJA" name="paymentchannel"/>
                <div class="radio-card">
                  <div class="flex items-center">
                    <img src="/icons/linkaja.svg" alt="LinkAja" class="w-10 h-10 mr-3">
                    <div>
                      <p class="font-medium">LinkAja</p>
                      <p class="text-sm text-gray-500">Dompet Digital</p>
                    </div>
                  </div>
                </div>
              </label>
            </div>
            <div class="tab-content {{ $paymentmethod == 'CARD' ? 'active' : ''}}">
              <label class="radio-card">
                <input type="radio" class="radio-card" value="VISA" name="paymentchannel"/>
                <div class="radio-card">
                  <div class="flex items-center">
                    <img src="/icons/visa.svg" alt="Visa" class="w-10 h-10 mr-3">
                    <div>
                      <p class="font-medium">Visa</p>
                      <p class="text-sm text-gray-500">Kartu Kredit/Debit</p>
                    </div>
                  </div>
                </div>
              </label>
              <label class="radio-card">
                <input type="radio" class="radio-card" value="MASTERCARD" name="paymentchannel"/>
                <div class="radio-card">
                  <div class="flex items-center">
                    <img src="/icons/mastercard.svg" alt="Mastercard" class="w-10 h-10 mr-3">
                    <div>
                      <p class="font-medium">Mastercard</p>
                      <p class="text-sm text-gray-500">Kartu Kredit/Debit</p>
                    </div>
                  </div>
                </div>
              </label>
            </div>
          </fieldset>
          <div class="relative {{ $paymentmethod == '' ? 'hide' : 'show'}}">
            <flux:error name="paymentchannel"/>
          </div>
        </div>
        <div class="mb-4">
          <flux:field variant="inline" class="flex items-center">
            <flux:checkbox wire:model="paymentanonim"/>
            <flux:label>Sembunyikan nama saya dari daftar donatur (donasi anonim)</flux:label>
          </flux:field>
        </div>
        <div class="flex justify-center items-center">
          <flux:button variant="primary" wire:click="makePayment">Lanjutkan Pembayaran</flux:button>
        </div>
      </div>
    </div>
  </flux:modal>
  <flux:modal name="donate-campaign-success" wire:close="close" wire:cancel="close">
    <div class="p-6 text-center">
      <div class="mb-6">
        <flux:icon.check-circle class="text-green-500 size-20 flex items-center justify-center mx-auto mb-4"/>
        <h3 class="text-xl font-bold mb-2">{{ $donationtype == "FUND" ? 'Pembayaran Berhasil!' : 'Pengiriman Barang Tercatat!'}}</h3>
        <p class="text-gray-600">{{ $campaign['donatur'] }}, terima kasih atas donasi Anda untuk {{ $campaign['title'] }}.</p>
      </div>
      <div class="{{ $donationtype == "GOODS" ? 'show' : 'hide'}}">
        <div class="grid grid-cols-1 bg-gray-50 rounded-lg p-4 mb-6">
          <div class="text-start mb-6">
            <h4 class="font-bold mb-2">Alamat Pengirim Barang</h4>
            <p>{{ $senderaddress }}</p>
          </div>
          <div class="text-start mb-6">
            <h4 class="font-bold mb-2">Kode Pengirim Barang</h4>
            <p>{{ $waybill }}</p>
          </div>
          <div class="mb-2">
            <img src="{{ $photo?->temporaryUrl() }}" alt="Donasi barang {{ $campaign['donatur'] }}" class="max-w-full max-h-48 rounded-lg">
          </div>
        </div>
        <p class="text-sm text-gray-500 mb-6">Kami akan mengirimkan konfirmasi penerimaan barang ke email Anda di {{ $campaign['email'] }}. Silakan cek inbox atau folder spam jika tidak ditemukan.</p>
      </div>
      <div class="{{ $donationtype == "FUND" ? 'show' : 'hide'}}">
        <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
          <div class="flex justify-between mb-2">
            <span class="text-gray-600">Jumlah Donasi</span>
            <span class="font-medium" id="success-amount">Rp. {{ $paymentamount }}</span>
          </div>
          <div class="flex justify-between mb-2">
            <span class="text-gray-600">Metode Pembayaran</span>
            <span class="font-medium" id="success-method">Bank Central Asia (BCA)</span>
          </div>
          <div class="flex justify-between">
            <span class="text-gray-600">Kode Transaksi</span>
            <span class="font-medium">BTO-2023-987654</span>
          </div>
        </div>
        <p class="text-sm text-gray-500 mb-6">Kami telah mengirimkan bukti pembayaran ke email Anda di {{ $campaign['email'] }}. Silakan cek inbox atau folder spam jika tidak ditemukan.</p>
      </div>
      <div class="flex items-center justify-center">
        <flux:button variant="filled" wire:click="close"><i class="fab fa-facebook-f mr-2"></i> Bagikan</flux:button>
      </div>
    </div>
  </flux:modal>
</div>
