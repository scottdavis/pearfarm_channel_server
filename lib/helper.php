<?php
function distance_of_time_in_words($fromTime, $toTime = 0, $showLessThanAMinute = false) {
    $distanceInSeconds = round(abs($toTime - $fromTime));
    $distanceInMinutes = round($distanceInSeconds / 60);
        
        if ( $distanceInMinutes <= 1 ) {
            if ( !$showLessThanAMinute ) {
                return ($distanceInMinutes == 0) ? 'less than a minute' : '1 minute';
            } else {
                if ( $distanceInSeconds < 5 ) {
                    return 'less than 5 seconds';
                }
                if ( $distanceInSeconds < 10 ) {
                    return 'less than 10 seconds';
                }
                if ( $distanceInSeconds < 20 ) {
                    return 'less than 20 seconds';
                }
                if ( $distanceInSeconds < 40 ) {
                    return 'about half a minute';
                }
                if ( $distanceInSeconds < 60 ) {
                    return 'less than a minute';
                }
                
                return '1 minute';
            }
        }
        if ( $distanceInMinutes < 45 ) {
            return $distanceInMinutes . ' minutes';
        }
        if ( $distanceInMinutes < 90 ) {
            return 'about 1 hour';
        }
        if ( $distanceInMinutes < 1440 ) {
            return 'about ' . round(floatval($distanceInMinutes) / 60.0) . ' hours';
        }
        if ( $distanceInMinutes < 2880 ) {
            return '1 day';
        }
        if ( $distanceInMinutes < 43200 ) {
            return 'about ' . round(floatval($distanceInMinutes) / 1440) . ' days';
        }
        if ( $distanceInMinutes < 86400 ) {
            return 'about 1 month';
        }
        if ( $distanceInMinutes < 525600 ) {
            return round(floatval($distanceInMinutes) / 43200) . ' months';
        }
        if ( $distanceInMinutes < 1051199 ) {
            return 'about 1 year';
        }
        
        return 'over ' . round(floatval($distanceInMinutes) / 525600) . ' years';
}

function autolink($foo) {
 $foo = preg_replace('/(?<!S)([w.]+)(@)([w.]+)b/i', '<a href="mailto:$1@$3">$1@$3</a>', $foo);
 $foo = preg_replace('/(?<!S)((http(s?):\/\/)|(www.))+([w.\/&=#?-~%;]+)b/i', '<a href="http$3://$4$5" target="_blank">http$3://$4$5</a>', $foo); 
 $foo = preg_replace('/(?<!S)((ftp(7?):\/\/)|(ftp.))([w.\/&=#?-~%;]+)b/i', '<a href="ftp$3://$4$5" target="_blank">ftp$3://$4$5</a>', $foo); 
 return $foo;
}
?>