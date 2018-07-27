<?php

namespace App\Http\Controllers;

use App\TransactionEmail;
use Illuminate\Http\Request;
use Validator, Mail;

class MailerController extends Controller
{
    public function sendEmailForMpaa(Request $request){
        $request_data = $request->only('name', 'email', 'lastname', 'comments');

        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;

        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'comments' => 'required'
        ];

        $validator = Validator::make($request_data, $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->messages()]);
        }

        $subject = "Web form enquiry";
        try {
            Mail::send('email.mpaa', ["name" => $name, "lastname" => $lastname, "email" => $email, "comments" => $request->comments],
                function ($mail) use ($email, $name, $lastname, $subject) {
                    $mail->from($email, $name.' '.$lastname);
                    $mail->to(getenv('MPAA_MAIL_FROM_ADDRESS'), getenv('MPAA_MAIL_FROM_NAME'));
                    $mail->cc($email);
                    $mail->subject($subject);
                });

            return response()->json(['success' => true, 'message' => 'Thanks for signing up! Please check your email to complete your registration.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Whoops! Looks like something went wrong.']);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\TransactionEmail  $transactionEmail
     * @return \Illuminate\Http\Response
     */
    public function show(TransactionEmail $transactionEmail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TransactionEmail  $transactionEmail
     * @return \Illuminate\Http\Response
     */
    public function edit(TransactionEmail $transactionEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TransactionEmail  $transactionEmail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionEmail $transactionEmail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TransactionEmail  $transactionEmail
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionEmail $transactionEmail)
    {
        //
    }
}
