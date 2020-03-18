<?php 

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Traits\ViewFormatterTrait;

class ShippingMethodServiceLine extends Model {

    use ViewFormatterTrait;

    // protected $appends = ['fullName'];

    public static $types = array(
            'sales', 
            'sales_equalization',
        );
    
    protected $fillable = [ 'country_id', 'state_id', 'postcode', 'from_amount', 'price' ];

    public static $rules = array(
        'from_amount' => 'min:0',
        'price'       => 'min:0',
        'country_id'  => 'exists:countries,id',
        'state_id'    => 'sometimes|nullable|exists:states,id',
        'postcode'    => 'nullable|numeric',
    	);

    public static function getTypeList()
    {
            $list = [];
            foreach (self::$types as $type) {
                $list[$type] = l($type, [], 'appmultilang');
            }

            return $list;
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFullNameAttribute()
    {
        // $value = $this->tax->name . ' | ' . $this->name;

        return $value;
    }

    
    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function tabulable()
    {
        return $this->morphTo();
	}

    public function country()
    {
        return $this->belongsTo('App\Country')
                    ->withDefault(function ($country) {
                            $country->name = '';
                        });
    }

    public function state()
    {
        return $this->belongsTo('App\State')
                    ->withDefault(function ($state) {
                            $state->name = '';
                        });
    }
}