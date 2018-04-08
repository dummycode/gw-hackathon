<?php

namespace App\Models;

class Event
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'start',
        'end',
        'location',
        'type',
        'description',
        'website',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'organization_id', 'user_id',
    ];
}