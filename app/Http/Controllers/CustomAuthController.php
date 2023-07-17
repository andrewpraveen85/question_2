<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Payment;

class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
      
    public function loginConfirm(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->withSuccess('Signed in');
        }
        return redirect("login")->withSuccess('Login details are not valid');
    }
    
    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
    
        
    public function dashboard()
    {
        if(Auth::check()){
            $patient = Patient::orderBy('id', 'DESC')->get()->toArray();
            return view('dashboard',['patient'=>$patient,]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function patientInsert()
    {
        if(Auth::check()){
            return view('patientInsert');
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function patientInsertConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'patient_nic' => 'required',
                'patient_name' => 'required',
                'patient_dob' => 'required',
                'patient_tell' => 'required',
                'patient_status' => 'required',
                'patient_photo' => 'required|image|max:2048',
            ]);
            $fileName = time() . '.' . $request->patient_photo->extension();
            $request->patient_photo->storeAs('public/images', $fileName);
            $patient = Patient::create([
                'patient_nic' => $request->input('patient_nic'),
                'patient_name' => $request->input('patient_name'),
                'patient_dob' => $request->input('patient_dob'),
                'patient_tell' => $request->input('patient_tell'),
                'patient_notes' => $request->input('patient_notes'),
                'patient_status' => $request->input('patient_status'),
                'patient_photo' => $fileName,
            ]);
            return redirect()->route('patient.select', ['id'=>$patient->id]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function patientSelect($id)
    {
        if(Auth::check()){
            $patient = Patient::where('id', $id)->first();
            $prescription = Prescription::where('patient_id', $id)->get()->toArray();
            return view('patientSelect',['patient'=>$patient,'prescription'=>$prescription]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function patientUpdate($id)
    {
        if(Auth::check()){
            $patient = Patient::where('id', $id)->first();
            return view('patientUpdate',['patient'=>$patient,]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function patientUpdateConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'patient_nic' => 'required',
                'patient_name' => 'required',
                'patient_dob' => 'required',
                'patient_tell' => 'required',
                'patient_status' => 'required',
                'patient_photo' => 'image|max:2048',
            ]);
            $Opatient = Patient::where('id', $request->input('patient_id'))->first();
            $fileName = $Opatient->patient_photo;
            if ($request->hasFile('patient_photo')) {
                $fileName = time() . '.' . $request->patient_photo->extension();
                $request->patient_photo->storeAs('public/images', $fileName);
            }
            Patient::where('id', $request->input('patient_id'))->update([
                'patient_nic' => $request->input('patient_nic'),
                'patient_name' => $request->input('patient_name'),
                'patient_dob' => $request->input('patient_dob'),
                'patient_tell' => $request->input('patient_tell'),
                'patient_notes' => $request->input('patient_notes'),
                'patient_status' => $request->input('patient_status'),
                'patient_photo' => $fileName,
            ]);
            return redirect()->route('patient.select', ['id'=>$request->input('patient_id')]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function prescriptionInsert($pid)
    {
        if(Auth::check()){
            $patient = Patient::where('id', $pid)->first();
            return view('prescriptionInsert',['patient'=>$patient]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function prescriptionInsertConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'prescription_date' => 'required',
                'patient_id' => 'required',
                'prescription_description' => 'required',
                'prescription_status' => 'required',
            ]);
            $prescription = Prescription::create([
                'prescription_date' => $request->input('prescription_date'),
                'patient_id' => $request->input('patient_id'),
                'prescription_description' => $request->input('prescription_description'),
                'prescription_price' => $request->input('prescription_price'),
                'prescription_status' => $request->input('prescription_status'),
            ]);
            return redirect()->route('prescription.select', ['id'=>$prescription->id]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function prescriptionSelect($id)
    {
        if(Auth::check()){
            $prescription = Prescription::where('id', $id)->first();
            $patient = Patient::where('id', $prescription->patient_id)->first();
            $payment = Payment::where('prescription_id', $id)->get()->toArray();
            return view('prescriptionSelect',['patient'=>$patient,'prescription'=>$prescription, 'payment'=>$payment]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function prescriptionUpdate($id)
    {
        if(Auth::check()){
            $prescription = Prescription::where('id', $id)->first();
            $patient = Patient::where('id', $prescription->patient_id)->first();
            return view('prescriptionUpdate',['patient'=>$patient,'prescription'=>$prescription]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function prescriptionUpdateConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'prescription_date' => 'required',
                'prescription_description' => 'required',
                'prescription_id' => 'required',
            ]);
            Prescription::where('id', $request->input('prescription_id'))->update([
                'prescription_date' => $request->input('prescription_date'),
                'prescription_description' => $request->input('prescription_description'),
                'prescription_price' => $request->input('prescription_price'),
            ]);
            return redirect()->route('prescription.select', ['id'=>$request->input('prescription_id')]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function paymentInsert($ppid)
    {
        if(Auth::check()){
            $prescription = Prescription::where('id', $ppid)->first();
            $patient = Patient::where('id', $prescription->patient_id)->first();
            return view('paymentInsert',['patient'=>$patient,'prescription'=>$prescription]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function paymentInsertConfirm(Request $request)
    {
        if(Auth::check()){
            $request->validate([
                'prescription_id' => 'required',
                'payment_amount' => 'required',
                'payment_type' => 'required',
            ]);
            $prescription = Prescription::where('id', $request->input('prescription_id'))->first();
            $Allpayment = Payment::where('prescription_id', $request->input('prescription_id'))->get();
            $totalPaid = 0;
            foreach($Allpayment as $row){
                $totalPaid = $totalPaid + $row->payment_amount;
            }
            if($totalPaid >= $prescription->prescription_price){
                Prescription::where('id', $request->input('prescription_id'))->update([
                    'prescription_status' => 0,
                ]);
            }else{
                $payment = Payment::create([
                    'prescription_id' => $request->input('prescription_id'),
                    'payment_amount' => $request->input('payment_amount'),
                    'payment_type' => $request->input('payment_type'),
                ]);
            }
            return redirect()->route('payment.select', ['id'=>$payment->id]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function paymentSelect($id)
    {
        if(Auth::check()){
            $payment = Payment::where('id', $id)->first();
            $prescription = Prescription::where('id', $payment->prescription_id)->first();
            $patient = Patient::where('id', $prescription->patient_id)->first();
            $payments = Payment::where('prescription_id', $payment->prescription_id)->get()->toArray();
            return view('paymentSelect',['patient'=>$patient,'prescription'=>$prescription, 'payments'=>$payments, 'payment'=>$payment]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function reportToday($date)
    {
        if(Auth::check()){
            $from = $date.' 00:00:00';
            $to = $date.' 23:59:59';
            $payments = Payment::where('created_at', '>=', $from)->where('updated_at','<=', $to)->get();
            $total = 0;
            foreach($payments as $row){
                $total = $total + $row->payment_amount;
            }
            return view('reportDate',['payments'=>$payments->toArray(), 'total'=>$total]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    
    public function reportDate(Request $request)
    {
        if(Auth::check()){
             $request->validate([
                'date' => 'required',
            ]);
            $from = $request->input('date').' 00:00:00';
            $to = $request->input('date').' 23:59:59';
            $payments = Payment::where('created_at', '>=', $from)->where('updated_at','<=', $to)->get();
            $total = 0;
            foreach($payments as $row){
                $total = $total + $row->payment_amount;
            }
            return view('reportDate',['payments'=>$payments->toArray(), 'total'=>$total]);
        }
        return redirect("login")->withSuccess('You are not allowed to access');
    }
}
