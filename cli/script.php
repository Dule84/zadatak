<?php

        
        $data = file_get_contents('https://admin.b2b-carmarket.com//test/project');

        $array = explode("<br>", str_replace('"',"",$data));
        
        $keys = array_filter(explode(",", trim($array[0])));

        $arr = array_slice($array, 1, count($array));
        
        foreach($arr as $a){
            $value = array_filter(explode(",",trim($a)));
            $assoc[] = array_combine($keys, $value);
        }
        
        $hash = array();
        $array_out = array();

        foreach($assoc as $item) {
            $hash_key = $item['ModelID'].'|'.$item['BuyerID'];
            if(!array_key_exists($hash_key, $hash)) {
                $hash[$hash_key] = sizeof($array_out);
                array_push($array_out, array(
                    'ModelID' => $item['ModelID'],
                    'BuyerID' => $item['BuyerID'],
                    'count' => 0,
                ));
            }
            $array_out[$hash[$hash_key]]['count'] += 1;
        }

        echo '<pre>', print_r($array_out), '<pre>';
        /*foreach($array_out as $arrs){
            echo 'Buyer with id ' .$arrs['BuyerID'].' bought '.$arrs['count'].' cars with id ' .$arrs['ModelID'].'<br>';
        } */   
