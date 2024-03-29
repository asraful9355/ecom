<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('frontend.dashboard');
        return view('frontend.user.profile.profile');
    }
    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profileEdit()
    {
        return view('frontend.user.profile.edit_profile');
    } // End profileEdit


    public function profileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|unique:users|max:11',
            'address' => 'required',
        ],);

        if ($request->hasfile('profile_pic')) {
            if ($request->file('profile_pic')) {
                $file = $request->file('profile_pic');
                @unlink(public_path('upload/user_profile_pic/'.$user->profile_photo_path));
                $fileName = time().$file->getClientOriginalName();
                $file->move(public_path('upload/user_profile_pic'),$fileName);
                $user['profile_photo_path'] = $fileName;
            }
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        Session::flash('success', 'Successfully update profile');
        return redirect()->route('user.dashboard');

    } // End profileUpdate


    public function changePsd()
    {
        return view('frontend.user.profile.updatePassword');
    } // End changePsd

    public function updatePassword(Request $request)
    {
        $id = Auth::user()->id; 

        $validateData = $request->validate([
            'oldpassword' => 'required',
            'new_password' => 'required',
            'password' => 'same:new_password'
        ]);
        
        $hashedPassword = User::find($id)->password;
        if(Hash::check($request->oldpassword,$hashedPassword)) {
            $user_admin = User::find($id);
            $user_admin->password = Hash::make($request->password);
            $user_admin->save();
            Auth::guard('web')->logout();
            return redirect()->route('login');
        }else{
            Session::flash('current_password', 'The current password is incorrect.');
            return redirect()->back();
        }
    } // End updatePassword


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // =================================================
    // ===========>>>Order Controller Start<<<==========
    // =================================================
    public function MyOrder()
    {
        $orders = Order::where('user_id',Auth::id())->orderBy('id','DESC')->get();
    	return view('frontend.user.order.order_view',compact('orders'));
    } // End Method
    
    public function OrderDetails($order_id)
    {
        $order = Order::where('id',$order_id)->where('user_id',Auth::id())->first();
    	$orderItem = OrderItem::where('order_id',$order_id)->orderBy('id','DESC')->get();
    	return view('frontend.user.order.order_details',compact('order','orderItem'));
    } // End Method

    public function InvoiceDownload($order_id)
    {
        $order = Order::where('id',$order_id)->where('user_id',Auth::id())->first();
    	$orderItem = OrderItem::where('order_id',$order_id)->orderBy('id','DESC')->get();

    	// return view('frontend.user.order.order_invoice',compact('order','orderItem'));

        $pdf = Pdf::loadView('frontend.user.order.order_invoice',compact('order','orderItem'))->setPaper('a4')->setOptions([
            'tempDir' => public_path(),
			'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    } // End Method

}
