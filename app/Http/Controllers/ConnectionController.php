<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\pakages;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class ConnectionController extends Controller
{

    public function index(){
        $connection = Connection::with('customer','pakage')->get();
        return view('Connection.connection',compact('connection'));
    }

    public function getcustomer(){
        $customers = Customer::get();
        return view('Customer.customer',compact('customers'));
    }

    public function addconnection(){
            $pakages = pakages::get();
            return view('Connection.addconnection',compact('pakages'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'customer_name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone_no' => 'required',
            'cnic' => 'required',
            'pakage' => 'required',
            'status' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        $data = [
            'name' => $request->customer_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_no' => $request->phone_no,
            'cnic' => $request->cnic,
        ];

        $check = Customer::where('email',$request->email)->first();

        if($check === null){
            $insertdata = Customer::create($data);
            $customerid = $insertdata->id;
        }
        else{
            $customerid = $check->id;
        }

            $data1 = [
                'customer_id' => $customerid,
                'pakage_id' => $request->pakage,
                'user_id' => auth()->user()->id,
                'price' => $request->pakage_price,
                'status' => $request->status,
            ];

            $insertdata1 = Connection::create($data1);

            if($request->status == 'paid'){
                $data3 = [
                    'user_id' => auth()->user()->id,
                    'customer_id' => $customerid,
                    'pakage_id' => $request->pakage,
                    'connect_id' => $insertdata1->id,
                    'price' => $request->pakage_price
                ];

                Transaction::create($data3);
            }
            return redirect()->route('conncetion_list')->with('message', 'Connection Added Sccuessfully!');;

    }

    public function getpakage(Request $request){
        $id = $request->pakage_id;
        if($id != null){
            $pakagedata = pakages::findOrFail($id);
            return response()->json(['status' => 'yes' ,'data' => $pakagedata ]);
        }
        else{
            return response()->json(['status' => 'no' ,'data' => 'Something Went Wrong' ]);
        }
    }

    public function transactionHistory($id){
        $transaction = Transaction::where('user_id',auth()->user()->id)->where('connect_id',$id)->with('pakage','user')->first();
        return view('Transaction.transactionhistory',compact('transaction'));
    }

    public function connectdetail($id){

        $connection =  Connection::where('id',$id)->with('customer','pakage')->first();
        $pakages = pakages::get();
        return view('Connection.conncetdetail',compact('connection','pakages'));
    }

    public function generateTransaction(Request $request){
        $status = $request->status;
        $customerid = $request->customer_id;
        $pakage_id = $request->pakage_id;
        $connectid = $request->connect_id;

        $data3 = [
            'user_id' => auth()->user()->id,
            'customer_id' => $customerid,
            'pakage_id' => $pakage_id,
            'connect_id' => $connectid,
            'price' => $request->pakage_price
        ];

        $transaction = Transaction::create($data3);
        $update = Connection::where('id',$connectid)->update(['status' => $status]);

        if($update){
            return response()->json(['status' => 'yes' ]);
        }
        else{
            return response()->json(['status' => 'no' ]);
        }
    }

    public function connectionHistory($id){
        $connection = Connection::where('user_id',auth()->user()->id)->where('customer_id',$id)->with('customer','pakage')->get();
        return view('Connection.connectionhistory',compact('connection'));
    }

}
