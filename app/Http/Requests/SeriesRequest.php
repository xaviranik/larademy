<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesRequest extends FormRequest
{

    public function uploadSeriesImage()
    {
        $uploaded_image = $this->image;
        $this->file_name = str_slug($this->title) . '.' . $uploaded_image->getClientOriginalExtension();
        $uploaded_image->storePubliclyAs('series', $this->file_name);

        return $this;
    }
}
