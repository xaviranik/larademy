<?php

namespace App\Http\Requests;


class UpdateSeriesRequest extends SeriesRequest
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

    public function updateSeries($series)
    {
        if ($this->hasFile('image')) 
        {
            $series->image_url = $this->uploadSeriesImage()->file_name;
        }

        $series->title = $this->title;
        $series->description = $this->description;
        $series->slug = str_slug($this->title);

        $series->save();
    }
}
