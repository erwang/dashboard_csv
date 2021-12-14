<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class Data extends Collection {

    public function toSlug()
    {
        return base64_encode($this);
    }
}
