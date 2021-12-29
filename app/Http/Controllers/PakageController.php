<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\pakages;

class PakageController extends Controller
{



    public function pakagelistview(){
        if(auth()->check()) {
           $pakages =  pakages::get();
            return view('Pakage.PakageView' , compact('pakages'));
        }

        return redirect()->route('login');
    }

    public function addpakageview(){
        return view('Pakage/addpakage');
    }

    public function addpakage(Request $request){

        if(auth()->user()->id != null) {

            $validator = Validator::make($request->all(), [
                'pakage_name' => 'required',
                'duration' => 'required',
                'discription' => 'required',
                'price' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $data = [
                'pakage_name'  => $request->pakage_name,
                'duration'  => $request->duration,
                'discription'  => $request->discription,
                'price' => $request->price,
            ];

            $insertdata = pakages::create($data);

            if ($insertdata) {
                return redirect()->route('pakage_list')->with('message', 'pakage Create Successfully!');
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }

        }
        else{
            return redirect()->route('login');
        }
    }

    public function deletePakage($id){

        $_return = [
            'error' => false,
            'success' => false,
            'message' => ''
        ];
        if(auth()->user()->id != null) {

            $delete = pakages::where($id)->delete();

            if ($delete) {
                $_return['success'] = true;
                $_return['message'] = 'Deleted Successfully';

            } else {
                $_return['error'] = true;
                $_return['message'] = 'Something Went Wrong';
            }
            return redirect()->route('pakage_list')->with($_return);
        }
        else{
            return redirect()->route('login');
        }
    }

    public function editPakageView($id){
        if(auth()->user()->id != null) {

            $pakage = pakages::where('id',$id)->first();

            return view('Pakage/editpakage',compact('pakage'));
        }
        else{
            return redirect()->route('login');
        }
    }

    public function updatePakage(Request $request,$id){
        if(auth()->user()->id != null) {

            $validator = Validator::make($request->all(), [
                'pakage_name' => 'required',
                'duration' => 'required',
                'discription' => 'required',
                'price' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $data = [
                'pakage_name'  => $request->pakage_name,
                'duration'  => $request->duration,
                'discription'  => $request->discription,
                'price' => $request->price,
            ];

            $updatedata = pakages::where('id',$id)->update($data);

            if($updatedata){
                return redirect()->route('pakage_list')->with('message', 'Updated Sccuessfully!');
            }
            else{
                return redirect()->back()->with('error', 'Something Went Wrong');
            }


        }
        else{
            return redirect()->route('login');
        }
    }

    public function connectionview($id){
        if(auth()->user()->id != null) {
            $pakage = pakages::where('id',$id)->first();
            return view('Pakage/buyconnection',compact('pakage'));
        }
        else{
            return redirect()->route('login');
        }
    }

    public function Pakagepurchased(Request $request,$id){

        if(auth()->user()->id != null) {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'phone_no' => 'required',
                'cnic' => 'required',
                'address'=>'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }


            $pakage = pakages::where('id',$id)->first();

            $transaction = new Transaction();
            $transaction->user_id = auth()->user()->id;
            $transaction->pakage_id = $pakage->id;
            $transaction->price = $pakage->price;
            $transaction->name = $request->name;
            $transaction->email = $request->email;
            $transaction->phone_no = $request->phone_no;
            $transaction->cnic = $request->cnic;
            $transaction->address = $request->address;

            if($transaction->save()){
                $transation = Transaction::where('user_id',auth()->user()->id)->with('pakage','user')->get();
                return view('Pakage/transaction',compact('transation'));
            }
            else{
                return redirect()->back()->with('error','Something Went Wrong');
            }


        }
        else{
            return redirect()->route('login');
        }
    }

    public function transactionhistory(){
        if(auth()->user()->id != null) {
            $transation = Transaction::query();
            if(auth()->user()->usertype_id == 2){
                $transation->where('user_id',auth()->user()->id);

            }
            $transation = $transation->with('pakage','user')->get();
            return view('Pakage/transaction',compact('transation'));
        }
        else{
            return redirect()->route('login');
        }
    }

}
