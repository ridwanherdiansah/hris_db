<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Holiday_model extends CI_Model {

    private $country = 'ID';

    public function getTotalHolidays($year, $month, $tanggal) {
        $url = "https://date.nager.at/api/v3/PublicHolidays/$year/ID";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $parsed = json_decode($result); 
        // echo "<pre>".print_r($parsed,true)."</pre>";
        // var_dump($parsed);
        $temp = [];
        foreach($parsed as $item){
            $date = explode("-",$item->date);
            $yearItem = $date[0];
            $monthItem = $date[1];
            $dateItem = $date[2];
            $isMatch = ($yearItem.$monthItem.$dateItem) === ($year.$month.$tanggal);
            if($isMatch){
                $temp[] = $item;
            }
        }

        return count($temp);
        
    }
}
