<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
  protected $fillable = [
    'campaign_id',
    'amount',
    'donaturname',
    'donaturemail',
  ];

  public function campaign(): BelongsTo
  {
    return $this->belongsTo(Campaign::class);
  }
}