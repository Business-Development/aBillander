<?php

namespace App\Http\Controllers\CustomerCenter;

use App\Address;
use App\Cart;
use App\CartLine;
use App\Combination;
use App\Configuration;
use App\Context;
use App\Currency;
use App\Customer;
use App\Http\Controllers\Controller;
use App\Product;
use App\Traits\BillableControllerTrait;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class AbccCustomerCartController extends Controller
{

    use BillableControllerTrait;

    protected $customer_user;
    protected $customer, $cart, $cartLine, $product;

    public function __construct(Cart $cart, CartLine $cartLine, Product $product)
    {
        $this->middleware('auth:customer');

        $this->cart = $cart;
        $this->cartLine = $cartLine;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->customer_user = Auth::user();
        $this->customer = $this->customer_user->customer;

        $cart = Cart::getCustomerUserCart();

        return view('abcc.cart.index', compact('cart'));
    }


    /**
     * Deprecated
     * Groovy Cart mechanism.
     *
     * @param Request $request
     * @param         $id
     * @return RedirectResponse
     */
    public function addItem(Request $request, $id)
    {
        $cart = Cart::getCustomerUserCart();

        $product = $this->product->find($id);

        // Is there a Price for this Customer?
        if (!$product) {
            redirect()->route('abcc.cart')->with('error', 'No se pudo añadir el producto porque no se encontró.');
        }

        $quantity = floatval($request->input('quantity', 1.0));
        $quantity = ($quantity > 0.0) ? $quantity : 1.0;

        // Get Customer Price
        $customer = $cart->customer;
        $currency = $cart->currency;
        $customer_price = $product->getPriceByCustomer($customer, $quantity, $currency);

        // Is there a Price for this Customer?
        if (!$customer_price) {
            return redirect()->route('abcc.cart')->with('error', 'No se pudo añadir el producto porque no está en su tarifa.');
        }      // Product not allowed for this Customer

        $tax_percent = $product->tax->percent;

        $customer_price->applyTaxPercent($tax_percent);
        $unit_customer_price = $customer_price->getPrice();

        $cart->add($product, $unit_customer_price, $quantity);

        $cart->load('cartlines');

        return redirect()->route('abcc.cart')->with('success', 'Se ha añadido el producto.');
    }

    public function removeLine($id)
    {
        Cart::remove($id);
        return back(); // will keep same page
    }

    public function updateLine(Request $request, $id)
    {
        $qty = $request->qty;
        $proId = $request->proId;
        $rowId = $request->rowId;
        Cart::update($rowId, $qty); // for update
        $cartItems = Cart::content(); // display all new data of cart
        return view('cart.upCart', compact('cartItems'))->with('status', 'cart updated');
    }

    /**
     * AJAX Stuff.
     *
     * @param Request $request
     * @return ResponseFactory|Response
     */
    public function searchProduct(Request $request)
    {
        $customer_user = Auth::user();    // Don't trust: $request->input('customer_id')

        if (!$customer_user) {
            return response(null);
        }

        $search = $request->term;

        $products = Product::select('id', 'name', 'reference', 'measure_unit_id')
                           ->where('name', 'LIKE', '%' . $search . '%')
                           ->orWhere('reference', 'LIKE', '%' . $search . '%')
                           ->orWhere('ean13', 'LIKE', '%' . $search . '%')
                           ->IsOrderable()
                           ->qualifyForCustomer($customer_user->customer_id, $request->input('currency_id'))
                           ->IsActive()
                           ->get(intval(Configuration::get('DEF_ITEMS_PERAJAX')));

        return response($products);
    }

    public function getProduct(Request $request)
    {
        // Request data
        $product_id = $request->input('product_id');
        $combination_id = $request->input('combination_id');
        $customer_id = $request->input('customer_id');
        $currency_id = $request->input('currency_id', Context::getContext()->currency->id);
        //        $currency_conversion_rate = $request->input('currency_conversion_rate', $currency->conversion_rate);

        //       return response()->json( [ $product_id, $combination_id, $customer_id, $currency_id ] );

        // Do the Mambo!
        // Product
        if ($combination_id > 0) {
            $combination = Combination::with('product')->with('product.tax')->findOrFail(intval($combination_id));
            $product = $combination->product;
            $product->reference = $combination->reference;
            $product->name = $product->name . ' | ' . $combination->name;
        } else {
            $product = Product::with('tax')->findOrFail(intval($product_id));
        }

        // Customer
        $customer = Customer::findOrFail(intval($customer_id));

        // Currency
        $currency = Currency::findOrFail(intval($currency_id));
        $currency->conversion_rate = $request->input('conversion_rate', $currency->conversion_rate);

        // Tax
        $tax = $product->tax;
        $taxing_address = Address::findOrFail($request->input('taxing_address_id'));
        $tax_percent = $tax->getTaxPercent($taxing_address);

        $price = $product->getPrice();
        if ($price->currency->id != $currency->id) {
            $price = $price->convert($currency);
        }

        // Calculate price per $customer_id now!
        $customer_price = $product->getPriceByCustomer($customer, 1, $currency);
        //        $tax_percent = $tax->percent;               // Accessor: $tax->getPercentAttribute()
        //        $price->applyTaxPercent( $tax_percent );

        if ($customer_price) {
            $customer_price->applyTaxPercentToPrice($tax_percent);

            $data = [
                'product_id'     => $product->id,
                'combination_id' => $combination_id,
                'reference'      => $product->reference,
                'name'           => $product->name,
                'cost_price'     => $product->cost_price,
                'unit_price'     => [
                    'tax_exc'          => $price->getPrice(),
                    'tax_inc'          => $price->getPriceWithTax(),
                    'display'          => Configuration::get('PRICES_ENTERED_WITH_TAX') ?
                        $price->getPriceWithTax() : $price->getPrice(),
                    'price_is_tax_inc' => $price->price_is_tax_inc,
                    //                            'price_obj' => $price,
                ],

                'unit_customer_price' => [
                    'tax_exc'          => $customer_price->getPrice(),
                    'tax_inc'          => $customer_price->getPriceWithTax(),
                    'display'          => Configuration::get('PRICES_ENTERED_WITH_TAX') ?
                        $customer_price->getPriceWithTax() : $customer_price->getPrice(),
                    'price_is_tax_inc' => $customer_price->price_is_tax_inc,
                    //                            'price_obj' => $customer_price,
                ],

                'tax_percent' => $tax_percent,
                'tax_id'      => $product->tax_id,
                'tax_label'   => $tax->name . " (" . $tax->as_percentable($tax->percent) . "%)",
                'customer_id' => $customer_id,
                'currency'    => $currency,

                'measure_unit_id'         => $product->measure_unit_id,
                'quantity_decimal_places' => $product->quantity_decimal_places,
                'reorder_point'           => $product->reorder_point,
                'quantity_onhand'         => $product->quantity_onhand,
                'quantity_onorder'        => $product->quantity_onorder,
                'quantity_allocated'      => $product->quantity_allocated,
                'blocked'                 => $product->blocked,
                'active'                  => $product->active,
            ];
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    public function add(Request $request)
    {
        $product_id = $request->input('product_id');
        $combination_id = $request->input('combination_id', 0);
        $quantity = floatval($request->input('quantity', 1.0));

        $cart = Cart::getCustomerUserCart();
        $line = $cart->addLine($product_id, $combination_id, $quantity);

        // Refresh Cart
        $cart = Cart::getCustomerUserCart();

        if ($line) {
            $msg = ['msg'            => 'OK',
                    'cart_nbr_items' => $cart->nbrItems()];
        } else {
            $msg = ['msg' => 'ERROR'];
        }

        return response()->json($msg);
    }


    /**
     * abcc.cart.updateline Endpoint
     *
     * @param Request $request
     * @return ResponseFactory|JsonResponse|Response
     */
    public function updateLineQuantity(Request $request)
    {
        $line_id = $request->input('line_id', 0);
        $customer_user = Auth::user();    // Don't trust: $request->input('customer_id')

        if (!$line_id || !$customer_user) {
            return response(null);
        }

        $quantity = floatval($request->input('quantity', 1.0));
        $quantity >= 0 ?: 1.0;

        $cart = Context::getContext()->cart;

        // Get line
        $line = $cart->cartlines()->where('id', $line_id)->first();

        if ($quantity > 0) {
            $data = ['quantity' => $quantity];
            if ($line->product->hasQuantityPriceRulesApplicable($customer_user->customer)) {
                $data['unit_customer_price'] = $customer_user->customer->getPrice($line->product, $quantity)->price;
            }
            $line->update($data);
        } else {
            $line->delete();

            // check if we should delete the cart in case it's empty
            if ($cart->cartlines()->count() == 0) {
                $cart->delete();
            }
        }

        return response()->json(['msg'  => 'OK',
                                 'data' => [$line_id, $quantity]]);
    }


    /**
     * abcc.cart.getlines Endpoint
     * Called via ajax after success Ajax call to add/update cart
     *
     * @return Factory|View
     */
    public function getCartLines()
    {
        $this->customer_user = Auth::user();
        $this->customer = $this->customer_user->customer;

        $cart = Context::getContext()->cart;

        $this->calculateCartTotals($cart, $this->customer);

        $config['display_with_taxes'] = $this->customer_user->canDisplayPricesTaxInc();

        return view('abcc.cart._panel_cart_lines', compact('cart', 'config'));
    }


    public function deleteCartLine($line_id)
    {
        $order_line = $this->cartLine->findOrFail($line_id);

        $order_line->delete();

        // check if we should delete the cart in case it's empty
        $cart = $this->cart->findOrFail($order_line->cart_id);
        if ($cart->cartlines()->count() == 0) {
            $cart->delete();
        }

        // Now, update Order Totals
        // $order->makeTotals();
        return response()->json(['msg'  => 'OK',
                                 'data' => $line_id]);
    }

    /**
     * From the cart lines, calculate taxes total, discounts and order total
     *
     * @param $cart
     * @param $customer
     */
    public function calculateCartTotals($cart, $customer)
    {
        $taxes = 0;
        $cart->cartlines->map(function ($line) use (&$taxes, $customer) {
            $line->img = $line->product->getFeaturedImage();
            $line->tax = $line->tax_percent / 100 *
                         $line->unit_customer_price * $line->quantity;
            $line->price_without_taxes = $line->unit_customer_price * $line->quantity;
            $line->price_with_taxes = $line->tax + $line->price_without_taxes;

            if ($line->product->hasQuantityPriceRulesApplicable($line->quantity, $customer)) {

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
            foreach ($cart->cartlines as $line) {
                $line->product->sales_equalization = 1;
                $rules = $customer->getTaxRules($line->product);
                $se_percent = $rules->sum('percent');

                $taxes_se += $se_percent / 100 * $line->unit_customer_price * $line->quantity;
            }
            $cart->taxes_se = $cart->as_priceable($taxes_se);
            $cart->total_taxes = $cart->as_priceable($taxes - $taxes_se);
        } else {
            $cart->total_taxes = $cart->as_priceable($taxes);
        }

        $discount1 = $cart->amount * $cart->customer->discount_percent / 100.0;
        $discount2 = ($cart->amount - $discount1) * $cart->customer->discount_ppd_percent / 100.0;

        $cart->discounts_applied = $discount1 > 0 || $discount2 > 0;

        $cart->discount1 = $cart->as_priceable($discount1);
        $cart->discount2 = $cart->as_priceable($discount2);

        $cart->total_products = $cart->as_priceable($cart->amount) - $cart->discount1 - $cart->discount2;
        $cart->total_price = $cart->as_priceable($cart->amount + $cart->total_taxes) - $cart->discount1 - $cart->discount2;
    }

    /**
     * Will be called from the endpoint post abcc.cart.updateaddres
     * @param Request $request
     */
    public function updateCartAddress(Request $request)
    {
        /** @var Customer $customer */
        $customer = Auth::user()->customer;
        $customer->shipping_address_id = $request->shipping_address_id;
        $customer->updateCustomersCartAddresses();

        echo json_encode(['message' => 'ok']);
    }

}
