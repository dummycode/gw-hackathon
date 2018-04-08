<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Event.
 * 
 * @package App\Models
 * @author Henry Harris <henry@104101110114121.com>
 */
class Event extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
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