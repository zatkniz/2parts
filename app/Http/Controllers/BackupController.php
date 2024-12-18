<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Fund;
class BackupController extends Controller
{
    public function backup(){
        $fund = Fund::where('isOffer' , 1)->where( 'created_at', '<', Carbon::now()->subDays(30))->delete();
        $dt = Carbon::parse(Carbon::today());
        $api_url = 'https://content.dropboxapi.com/2/files/upload'; //dropbox api url
        $filename = asset('backup/backup-'.$dt->day.$dt->month.$dt->year.'.sql');
        $headers = array('Authorization: Bearer HBAdsYnrWfAAAAAAAAAACBHDVTIZuEi_ex9ePxYlGSrrqr5PZ5np1KXvpH34Yyxp',
            'Content-Type: application/octet-stream',
            'Dropbox-API-Arg: '.
            json_encode(
                array(
                    "path"=> '/'. basename('backup-'.$dt->day.$dt->month.$dt->year.'.sql'),
                    "mode" => "add",
                    "autorename" => true,
                    "mute" => false
                )
            )
    
        );
        // $myfile = fopen($filename, "r") or die("Unable to open file!");
        ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0)'); 
        // echo ($filename);
        echo file_get_contents($filename);
        $data = file_get_contents($filename);
        // fclose($myfile);
        $ch = curl_init($api_url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_POST,true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $response = curl_exec($ch);
        curl_close($ch);
    }
}
