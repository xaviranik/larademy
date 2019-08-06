<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeriesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required'
        ];
    }

    public function uploadSeriesImage()
    {
        $uploaded_image = $this->image;
        $this->file_name = str_slug($this->title) . '.' . $uploaded_image->getClientOriginalExtension();
        $uploaded_image->storePubliclyAs('series', $this->file_name);

        return $this;
    }
}
