<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class BusinessCategory extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logFillable = true;

    
    protected static $logName = 'Business Category'; 

    protected $table = 'bussines_categories';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
