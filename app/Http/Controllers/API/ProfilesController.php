<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Profiles;

class ProfilesController extends BaseController {

  use AuthorizesRequests,
      ValidatesRequests;

  public function allProfiles() {
    $profiles = Profiles::all();
    return $profiles;
  }
}


