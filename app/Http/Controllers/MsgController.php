<?php

namespace App\Http\Controllers;

use App\Interfaces\MsgRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\MsgRequest;
use Illuminate\Http\Response;
use App\Mail\Notification;
use File;
use Mail;
 
class MsgController extends Controller
{
    private MsgRepositoryInterface $MsgRepository;

    public function __construct(MsgRepositoryInterface $MsgRepository)
    {
        $this->MsgRepository = $MsgRepository;
    }

    public function index(): String
    {
        $msgs =  "Welcome to Message API Service, You can access all routes with /api";

        return  $msgs;
    }

    public function allmsg(): Object
    {
        $msgs =  $this->MsgRepository->getAllMessages();

        return  $msgs;
    }

    public function sendmsg(MsgRequest $request): Object
    {  

      
        $path = public_path('uploads');
        $attachment = $request->file('attachment');
        $attachmentname = time().'.'.$attachment->getClientOriginalExtension();
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $attachment->move($path, $attachmentname);
        $filename = $path.'/'.$attachmentname;

        $msgDetails = $request->only(
            'name', 'email',  'message') +
            [ 
            'attachment' => $filename
        ];

        try {
            Mail::to(env('MAIL_FROM_ADDRESS'))->send(new Notification($filename, $path, $msgDetails ));
        } catch (\Exception $e) {
             
           // return response()->json(['success'=>'failed','message' => $e->getMessage()], Response::HTTP_SERVICE_UNAVAILABLE);
        }

       $record = $this->MsgRepository->SendMessage($msgDetails);
       if ($record ) {
        $message = "Message successfully sent";
     
        return response()->json(['success'=>'true','message' => $message, 'data'=> $record], Response::HTTP_CREATED);
       }
       $message = "Message sending failed";
       return  response()->json($record, $message, Response::HTTP_BAD_REQUEST);
    }
}
