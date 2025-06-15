<?php

if (! function_exists('campaignPhoto')) {
  function campaignPhoto($campaign): string {
    $campaign = (object)$campaign;
    return ($campaign->photo === null || $campaign->content_type === null) ? "../foto/hayya.png" : "data:$campaign->content_type;base64," . base64_encode($campaign->photo);
  }  
}

if (! function_exists('campaignTitle')) {
  function campaignTitle($campaign): string {
    return ucwords(strtolower($campaign['title']));
  }  
}

if (! function_exists('campaignDescription')) {
  function campaignDescription($campaign): string {
    return $campaign['description'];
  }
}

if (! function_exists('campaignTarget')) {
  function campaignTarget($campaign): string {
    return number_format($campaign['target_donasi'],2,",",".");
  }
}

if (! function_exists('campaignRaised')) {
  function campaignRaised($campaign): string {
    return number_format($campaign['raised'],2,",",".");
  }
}
if (! function_exists('campaignRaisedPct')) {
  function campaignRaisedPct($campaign): string {
    return number_format($campaign['raised_pct'],0,",",".") . "%";
  }
}

if (! function_exists('campaignLike')) {
  function campaignLike($campaign) {
    return $campaign['impressions'];
  };
}

if (! function_exists('campaignDonatur')) {
  function campaignDonatur($campaign) {
    return $campaign['donatur'];
  };
}
