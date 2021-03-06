<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'deadlines_by', 'deadlines', 
                           'payment_is_cash', 'auto_direct_debit', 'active',
                           'payment_type_id'];

    public static $rules = array(
        'name'         => array('required', 'min:2', 'max:128'),
    	);


    public function getDeadlinesAttribute($value)
    {
        return unserialize($value);
    }

    public function setDeadlinesAttribute($value)
    {
        $this->attributes['deadlines'] = serialize($value);
    }

    // Transient
    public function getPaymentDocumentIdAttribute($value)
    {
        return $value ?: 1;
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function paymenttype()
    {
        return $this->belongsTo('App\PaymentType', 'payment_type_id');
    }
    
    public function customerinvoices()
    {
        return $this->hasMany('App\Customerinvoice');
    }
}