<?php

namespace App;

use App\Traits\ViewFormatterTrait;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    use ViewFormatterTrait;

    protected $dates = [
        'date_prices_updated',
    ];

    protected $fillable = [
        'customer_user_id', 'customer_id', 'notes_from_customer',
        'total_items', 'total_currency_tax_excl', 'total_tax_excl',
        'invoicing_address_id', 'shipping_address_id', 'shipping_method_id', 'carrier_id',
        'currency_id', 'payment_method_id',
    ];

    public static $rules = [
        'customer_id'          => 'exists:customers,id',
        'invoicing_address_id' => '',
        'shipping_address_id'  => 'exists:addresses,id,addressable_id,{customer_id},addressable_type,App\Customer',
        //                            'carrier_id'   => 'exists:carriers,id',
        'currency_id'          => 'exists:currencies,id',
        //                            'payment_method_id' => 'exists:payment_methods,id',
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($cart) {
            $cart->secure_key = md5(uniqid(rand(), true));

            if ($cart->shippingmethod) {
                $cart->carrier_id = $cart->shippingmethod->carrier_id;
            }
        });

        static::saving(function ($cart) {
            if ($cart->shippingmethod) {
                $cart->carrier_id = $cart->shippingmethod->carrier_id;
            }
        });

        // https://laracasts.com/discuss/channels/general-discussion/deleting-related-models
        static::deleting(function ($cart) {
            // before delete() method call this
            foreach ($cart->cartLines as $line) {
                $line->delete();
            }
        });

        static::deleted(function () {
            // after delete() method call this
            if (!Auth::guard('customer')->check()) {
                return null;
            }

            // Get Customer Cart
            $customer = Auth::user()->customer;

            // Create instance
            $cart = Cart::create([
                                     'customer_user_id'     => Auth::user()->id,
                                     'customer_id'          => $customer->id,
                                     'invoicing_address_id' => $customer->invoicing_address_id,
                                     'shipping_address_id'  => $customer->shipping_address_id,
                                     'shipping_method_id'   => $customer->shipping_method_id,
                                     //             'carrier_id',
                                     'currency_id'          => $customer->currency_id,
                                     'payment_method_id'    => $customer->payment_method_id,
                                     //                'date_prices_updated',
                                 ]);

            \App\Context::getContext()->cart = $cart;

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

    public static function getCustomerUserCart()
    {
        if (Auth::guard('customer')->check()) {

            // Get Customer Cart
            $customer = Auth::user()->customer;
            $cart = Cart::where('customer_id', $customer->id)
                        ->where('customer_user_id', Auth::user()->id)
                        ->with('cartlines')
                        ->first();

            if ($cart) {
                // Deletable lines
                $deletables = CartLine::where('cart_id', $cart->id)
                                      ->doesntHave('product')
                                      ->get();

                if ($deletables->count() > 0) {
                    $deletables->each(function ($deletable) {
                        $deletable->delete();
                    });

                    $cart = $cart->fresh();
                }

                // Update some values if customer data have changed -> cart data & cart line prices & stock
                if ($cart->persistance_left <= 0) {
                    // Update Cart Prices
                    $cart->updateLinePrices();
                }
            } else {
                // Create instance
                $cart = Cart::create(['customer_user_id'     => Auth::user()->id,
                                      'customer_id'          => $customer->id,
                                      'invoicing_address_id' => $customer->invoicing_address_id,
                                      'shipping_address_id'  => $customer->shipping_address_id,
                                      'shipping_method_id'   => $customer->shipping_method_id,
                                      //       		'carrier_id',
                                      'currency_id'          => $customer->currency_id,
                                      'payment_method_id'    => $customer->payment_method_id,
                                      //                'date_prices_updated',
                                     ]);
            }

            return $cart;
        }

        return null;
    }


    public function addLine($product_id = null, $combination_id = null, $quantity = 1.0)
    {
        $customer_user = Auth::user();  // Don't trust: $request->input('customer_id')

        if (!$customer_user) {
            return response(null);
        }

        // Do the Mambo!
        // Product
        if ($combination_id > 0) {
            $combination = \App\Combination::with('product')->with('product.tax')->find(intval($combination_id));
            $product = $combination->product;
            $product->reference = $combination->reference;
            $product->name = $product->name . ' | ' . $combination->name;
        } else {
            $product = \App\Product::with('tax')->find(intval($product_id));
        }

        // Is there a Price for this Customer?
        if (!$product) {
            return false;
        }    // redirect()->route('abcc.cart')->with('error', 'No se pudo añadir el producto porque no se encontró.');

        $quantity = ($quantity > 0.0) ? $quantity : 1.0;

        $cart = $this; // \App\Context::getContext()->cart;

        // Get Customer Price
        $customer = $cart->customer;
        $currency = $cart->currency;
        $customer_price = $product->getPriceByCustomer($customer, $quantity, $currency);

        // Is there a Price for this Customer?
        if (!$customer_price) {
            return false;
        }

        $tax_percent = $this->getTaxPercent($product, $customer);

        $customer_price->applyTaxPercent($tax_percent);

        return $cart->add($product, $customer_price, $quantity);
    }

    public function addLineByAdmin($product_id = null, $combination_id = null, $quantity = 1.0)
    {
        // Do the Mambo!
        // Product
        if ($combination_id > 0) {
            $combination = \App\Combination::with('product')->with('product.tax')->find(intval($combination_id));
            $product = $combination->product;
            $product->reference = $combination->reference;
            $product->name = $product->name . ' | ' . $combination->name;
        } else {
            $product = \App\Product::with('tax')->find(intval($product_id));
        }

        // Is there a Price for this Customer?
        if (!$product) {
            return false;
        }    // redirect()->route('abcc.cart')->with('error', 'No se pudo añadir el producto porque no se encontró.');

        $quantity > 0 ?: 1.0;

        $cart = $this;

        // Get Customer Price
        $customer = $cart->customer;
        $currency = $cart->currency;
        $customer_price = $product->getPriceByCustomer($customer, $quantity, $currency);

        // Is there a Price for this Customer?
        if (!$customer_price) {
            return false;
        }

        $tax_percent = $this->getTaxPercent($cart, $product, $customer);

        $customer_price->applyTaxPercent($tax_percent);

        return $cart->add($product, $customer_price, $quantity);
    }


    public function add($product = null, $customer_price = null, $quantity = 1.0)
    {
        // If $product is a 'product_id', instantiate product, please.
        if (is_numeric($product)) {
            $product = Product::find($product);
        }

        if ($product == null) {
            return null;
        }

        if ($customer_price === null) { // Price can be 0.0!!!
            $unit_customer_price = $product->price;
            $tax_percent = $product->tax->percent;
        } else {
            $unit_customer_price = $customer_price->getPrice();
            $tax_percent = $customer_price->tax_percent;
        }

        // Already in Cart?
        $line = $this->cartlines()->where('product_id', $product->id)->first();
        if ($line && $unit_customer_price > 0) {
            // Keep line price

            // Quantity
            $line->quantity += $quantity;
            // update tax in case the customer data has changed
            $line->tax_percent = $tax_percent;

            if ($line->quantity <= 0) {
                // Remove line
                $line->delete();
            } else {
                // Save line
                $line->save();
            }
        } else {

            if ($quantity > 0) {
                // New line
                if ($this->isEmpty()) {
                    $customer = Auth::user()->customer;
                    $this->date_prices_updated = \Carbon\Carbon::now();
                    // change this in case the user has updated the address
                    $this->invoicing_address_id = $customer->invoicing_address()->id;
                    $this->save();
                }

                $line = CartLine::create([
                                             'line_sort_order'     => 0,
                                             'product_id'          => $product->id,
                                             //        		'combination_id' => $product->,
                                             'reference'           => $product->reference,
                                             'name'                => $product->name,
                                             'quantity'            => $quantity,
                                             'measure_unit_id'     => $product->measure_unit_id,
                                             'unit_customer_price' => $unit_customer_price,
                                             'tax_percent'         => $tax_percent,
                                             //       		'cart_id' => $product->,
                                             'tax_id'              => $product->tax_id,
                                         ]);

                $this->cartlines()->save($line);
            }
        }

        return $line;
    }

    public function updateLinePrices($byAdmin = false)
    {
        // Update prices or remove from cart
        foreach ($this->cartlines as $line) {

            $product_id = $line->product_id;
            $combination_id = $line->combination_id;
            $quantity = $line->quantity;

            // Remove line
            $line->delete();

            // Recreate
            if ($byAdmin) {
                $newline = $this->addLineByAdmin($product_id, $combination_id, $quantity);
            } else {
                $newline = $this->addLine($product_id, $combination_id, $quantity);
            }
        }

        $this->date_prices_updated = \Carbon\Carbon::now();
        $this->save();

        return true;
    }

    public function updateLinePricesByAdmin()
    {
        return $this->updateLinePrices(true);
    }


    public function nbrItems()
    {
        switch (\App\Configuration::get('ABCC_NBR_ITEMS_IS_QUANTITY')) {
            case 'quantity':
                return $this->quantity;
                break;

            case 'items':
                return $this->cartlines()->count(); // . ' - ' . $this->persistance_left;
                break;

            case 'value':
                return Currency::viewMoneyWithSign($this->amount, $this->currency);
                break;

            default:
                return '';
                break;
        }
    }

    public function isEmpty()
    {
        return !$this->cartlines()->count();
    }

    public function getPersistanceLeftAttribute()
    {
        $persistance = \App\Configuration::getInt('ABCC_CART_PERSISTANCE');
        $now = \Carbon\Carbon::now();

        $days = $this->date_prices_updated ? $persistance - $now->diffInDays($this->date_prices_updated) : $persistance;

        // $days = 1;

        return $days;
    }

    public function getQuantityAttribute()
    {
        return (int)$this->cartlines->sum('quantity');
    }

    public function getAmountAttribute()
    {
        $a = $this->cartlines;

        $s = $a->sum(function ($line) {
            return $line->quantity * $line->unit_customer_price;
        });

        return $s;
    }


    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo('App\CustomerUser', 'customer_user_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function shippingmethod()
    {
        return $this->belongsTo('App\ShippingMethod', 'shipping_method_id');
    }

    public function carrier()
    {
        return $this->belongsTo('App\Carrier');
    }

    public function paymentmethod()
    {
        return $this->belongsTo('App\PaymentMethod', 'payment_method_id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }

    public function invoicingaddress()
    {
        return $this->belongsTo('App\Address', 'invoicing_address_id');
    }

    // Alias function
    public function billingaddress()
    {
        return $this->invoicingaddress();
    }

    public function shippingaddress()
    {
        return $this->belongsTo('App\Address', 'shipping_address_id');
    }

    public function taxingaddress()
    {
        return \App\Configuration::get('TAX_BASED_ON_SHIPPING_ADDRESS') ?
            $this->shippingaddress() :
            $this->invoicingaddress();
    }

    public function cartlines()
    {
        return $this->hasMany('App\CartLine')->orderBy('line_sort_order', 'ASC');
    }

    // Alias
    public function documentlines()
    {
        return $this->cartlines();
    }

    /**
     * @param      $product
     * @param      $customer
     * @return mixed
     */
    public function getTaxPercent($product, $customer)
    {
        // get the tax percent checking the taxing address,
        // while using product tax as backup data
        $address = $this->taxingaddress;

        // if the customer has que sales_equalization enabled,
        // we need to set the product's sales_equalization to 1 to use it
        $product->sales_equalization = 1;

        $tax = $product->getTaxRules($address, $customer);

        if (empty($tax)) {
            return $product->tax->percent;
        }
        // get the sum of the percents in case there are more than one
        return $tax->sum('percent');
    }

    /**
     * From the cart lines, calculate taxes total, discounts and order total
     *
     */
    public function calculateTotals()
    {
        $customer = $this->customer;
        $taxes = 0;
        $this->cartlines->map(function ($line) use (&$taxes, $customer) {
            $line->img = $line->product->getFeaturedImage();
            $line->tax = $line->tax_percent / 100 *
                         $line->unit_customer_price * $line->quantity;
            $line->price_without_taxes = $line->unit_customer_price * $line->quantity;
            $line->price_with_taxes = $line->tax + $line->price_without_taxes;

            if ($line->product->hasApplicableQuantityPriceRules($line->quantity, $customer)) {

                $rule = $line->product->getQuantityPriceRules($customer)->first();

                if ($rule->rule_type === 'promo') {
                    $line->product->has_extra_item_applied = true;
                    $line->product->extra_item_qty = $rule->extra_items;
                } else {
                    $line->product->has_price_rule_applied = true;
                    $line->product->previous_price = $line->product->getPrice()->price;
                }
            }

            $taxes += $line->tax;
        });


        if ($customer->sales_equalization) {
            $taxes_se = 0;
            foreach ($this->cartlines as $line) {
                $line->product->sales_equalization = 1;
                $rules = $customer->getTaxRules($line->product);
                $se_percent = $rules->sum('percent');

                $taxes_se += $se_percent / 100 * $line->unit_customer_price * $line->quantity;
            }
            $this->taxes_se = $this->as_priceable($taxes_se);
            $this->total_taxes = $this->as_priceable($taxes - $taxes_se);
        } else {
            $this->total_taxes = $this->as_priceable($taxes);
        }

        $amount_with_taxes = $this->amount + $this->total_taxes;

        $discount1 = $amount_with_taxes * $this->customer->discount_percent / 100.0;
        $discount2 = ($amount_with_taxes - $discount1) * $this->customer->discount_ppd_percent / 100.0;

        $this->discounts_applied = $discount1 > 0 || $discount2 > 0;

        $this->discount1 = $this->as_priceable($discount1);
        $this->discount2 = $this->as_priceable($discount2);

        $this->total_products = $this->as_priceable($this->amount) - $this->discount1 - $this->discount2;
        $this->total_price = $this->as_priceable($amount_with_taxes) - $this->discount1 - $this->discount2;
    }
}
