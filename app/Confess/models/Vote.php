<?php namespace Confess\Models;

class Vote extends BaseModel
{
    public $timestamps = false;
    protected $guarded = array();

    public static $rules = array();

    /**
     * Get the votes's confession.
     *
     * @return Confession
     */
    public function confession()
    {
        return $this->belongsTo('\Confess\Models\Confession', 'confession_id');
    }
}
