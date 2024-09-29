<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = User::where('usertype','user')->get()->count();
        $product = Product::all()->count();
        $order = Order::all()->count();
        $delivered = Order::where('status','Delivered')->get()->count();

        return view('admin.index', compact('user','product','order','delivered'));
    }

    public function home(){
        $product = Product::all();

        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        
        return view('home.index', compact('product','count'));
    }

    public function login_home(){
        $product = Product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.index', compact('product','count'));
    }

    public function testimonial(){
        $product = Product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.testimonial', compact('product','count'));
    }

    public function shop(){
        $product = Product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.shop', compact('product','count'));
    }

    public function why(){
        $product = Product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.why', compact('product','count'));
    }

    public function contactus(){
        $product = Product::all();
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        return view('home.contactUs', compact('product','count'));
    }

    public function product_details($id){
        
        $data = Product::find($id);
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();
        }
        else
        {
            $count = '';
        }
        // Kirim data produk ke view
        return view('home.product_details', compact('data','count'));
    }

    public function add_cart($id){
        $product_id = $id;

        // login user
        $user = Auth::user();
        $user_id = $user->id;

        $data = new Cart;
        $data->user_id = $user_id;
        $data->product_id = $product_id;

        $data->save();
        
        flash()->success('Product Added To Cart');
        return redirect()->back();
        
    }


    public function mycart(){
        if(Auth::id())
        {
            $user = Auth::user();
            $userid = $user->id;
            $count = Cart::where('user_id',$userid)->count();

            $cart = Cart::where('user_id', $userid )->get();
        }
        else
        {
            $count = '';
        }
        return view('home.mycart',compact('count','cart'));
    }

    public function remove_product($id){
        // Ambil user ID dari user yang sedang login
        $userid = Auth::user()->id;

        // Cari produk di cart yang dimiliki oleh user dan memiliki product_id yang sesuai
        $cart_item = Cart::where('user_id', $userid)->where('product_id', $id)->first();

        // Jika item cart ditemukan, hapus item tersebut
        if ($cart_item) {
            $cart_item->delete();
        }

        // Redirect kembali ke halaman sebelumnya setelah produk dihapus
        return redirect()->back()->with('success', 'Product removed from cart successfully!');

    }


    public function confirm_order(Request $request){
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        
        // User that Login
        $userid = Auth::user()->id;
        $cart = Cart::where('user_id', $userid)->get();

        foreach($cart as $carts)
        {
            $order = new Order();
            $order->name = $name;
            $order->rec_address = $address;
            $order->phone = $phone;

            $order->user_id = $userid;
            $order->product_id = $carts->product_id;
            $order->save();
            
        }

        // $cart_remove = Cart::where('user_id', $userid)->get();

        // foreach($cart_remove as $remove)
        // {
        //     $data = Cart::find($remove->id);
        //     $data->delete();
        // }
        // return redirect()->back();

        // Remove data Cart ketika USER klik Place Order
        // Remove all items from the cart for the user in one go
            Cart::where('user_id', $userid)->delete();
            flash()->success('Product CheckOut Successfully.');
            return redirect()->back();

    }

    public function myorders(){
        $user = Auth::user()->id;
        $count = Cart::where('user_id',$user)->get()->count();
        $order = Order::where('user_id',$user)->get();
        return view('home.order',compact('count','order'));
    }
}
