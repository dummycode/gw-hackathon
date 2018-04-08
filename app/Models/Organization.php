<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Organization.
 *
 * @package App\Models
 * @author Henry Harris <henry@104101110114121.com>
 */
class Organization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id',
    ];
}