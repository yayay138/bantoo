<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
  protected $fillable = [
    'owner',
    'title',
    'category',
    'location',
    'photo',
    'description',
    'updateplan',
    'videolink',
    'targetfunding',
    'deadline',
    'accounttype',
    'accountbank',
    'accountno',
    'accountholder',
    'address',
    ];

  public function owner(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function donations(): HasMany
  {
    return $this->HasMany(Donation::class);
  }
}
