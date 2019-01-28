<?php

class Names{
    
    public function generateName() {
        
        $names = array(
            'Christopher',
            'Ryan',
            'Ethan',
            'John',
            'Zoey',
            'Sarah',
            'Michelle',
            'Samantha',
        );
        
        $random_name = $names[mt_rand(0, sizeof($names) - 1)];
        
        return $random_name;
    }
    
    public function generateSurname() {
        
        $surnames = array(
            'Walker',
            'Thompson',
            'Anderson',
            'Johnson',
            'Tremblay',
            'Peltier',
            'Cunningham',
            'Simpson',
            'Mercado',
            'Sellers'
        );
        
        $random_surname = $surnames[mt_rand(0, sizeof($surnames) - 1)];
        
        return $random_surname;
    }
}