<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Meeting;

class MeetingController extends Controller
{
    //
    private $APIEndpoint = "https://meet.gclub.id/bigbluebutton/api/";
    private $sharedKey = "7NwyUPvv5DJeiNjSgEeqLW6R5u2ZUkofWGu7ekU40";
    private $create = "create";
    private $isMeetingRunning = "isMeetingRunning";
    private $join = "join";

    public function get_meeting(Request $request) {
        Meeting::get();
    }

    public function post_meeting(Request $request) {
        $meeting = new Meeting;
        $meeting->name = $request->input('name');
        $meeting->meetingID = str_replace(' ','_',$request->input('name')).rand(0,999999); 
        $meeting->attendeePW = 'a'.rand(10000, 99999);
        $meeting->moderatorPW = 'm'.rand(10000, 99999);
        $meeting->user_id = auth()->user()->id;
        $meeting->save();
        return redirect()->back();
    }

    public function join(Request $request, $id) {
        $meeting = Meeting::find($id);
        if (auth()->check()) {
            if (auth()->user()->type == 'moderator' || auth()->user()->type == 'admin') {
                $password = $meeting->moderatorPW;
            } else {
                $password = $meeting->attendeePW;
            }
        } else {
            $password = $meeting->attendeePW;
        }

        // Cek meeting jalan tidak
        $param_check = 'meetingID='.$meeting->meetingID;
        $string = $this->isMeetingRunning.$param_check;
        $checksum = sha1($string.$this->sharedKey);
        $url_check = $this->APIEndpoint.$this->isMeetingRunning.'?'.$param_check.'&checksum='.$checksum;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_check);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        $data = simplexml_load_string($output);

        if ($data->running == "false") {
            // Create meeting jika belum jalan
            $param_create = 'allowStartStopRecording=true'
                .'&record=true'
                .'&meetingID='.$meeting->meetingID
                .'&recordID='.$meeting->meetingID
                .'&name='.urlencode($meeting->name)
                .'&attendeePW='.$meeting->attendeePW
                .'&moderatorPW='.$meeting->moderatorPW;
            $string = $this->create.$param_create;
            $checksum = sha1($string.$this->sharedKey);
            $url_create = $this->APIEndpoint.$this->create.'?'.$param_create.'&checksum='.$checksum;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_create);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            $data = simplexml_load_string($output);
        }

        // Join meeting
        if (auth()->check()) {
            $fullName = urlencode(auth()->user()->name);
        } else {
            $fullName = urlencode($request->input('name'));
        }
        $param_join = 'meetingID='.$meeting->meetingID.'&fullName='.$fullName.'&password='.$password;
        $string = $this->join.$param_join;
        $checksum = sha1($string.$this->sharedKey);
        $url_join = $this->APIEndpoint.$this->join.'?'.$param_join.'&checksum='.$checksum;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_join);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        header('Location: '.$url_join);
    }

    public function delete(Request $request) {
        $id = $request->input('id');
        Meeting::find($id)->delete();
        return redirect()->back();
    }
}
