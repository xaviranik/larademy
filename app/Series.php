<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    protected $guarded = [];
    protected $with = ['lesson'];

    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getImagePathAttribute()
    {
        return asset('storage/series/' . $this->image_url);
    }

    public function getSeriesBackgroundAttribute()
    {
        $background = array('bg-1.png', 'bg-2.png', 'bg-3.png');

        $index = rand(0, count($background) - 1);
        $randomBackground = $background[$index];

        return asset('assets/static/'. $randomBackground);
    }

    public function getOrderedLessons()
    {
        return $this->lesson()->orderBy('episode_number', 'asc')->get();
    }
}
