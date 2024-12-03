<?php
  // Set timezone
  date_default_timezone_set("UTC");
   // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
     function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Set default diff to 0
      $diffs[$interval] = 0;
      // Create temp time from time1 and interval
      $ttime = strtotime("+1 " . $interval, $time1);
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
	$time1 = $ttime;
	$diffs[$interval]++;
	// Create new temp time from time1 and interval
	$ttime = strtotime("+1 " . $interval, $time1);
      }
    }
 
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }
 
    // Return string with times
   // implode(", ", $times);
    return $times[0];
  }
  

function compare_dates($date1)
    {
		$date2 = time();
     $blocks = array(
        array('name'=> MessageModule::t('year'),'amount'    =>    60*60*24*365    ),
        array('name'=> MessageModule::t('month'),'amount'    =>    60*60*24*31    ),
        array('name'=> MessageModule::t('week'),'amount'    =>    60*60*24*7    ),
        array('name'=> MessageModule::t('day'),'amount'    =>    60*60*24    ),
        array('name'=> MessageModule::t('hour'),'amount'    =>    60*60        ),
        array('name'=> MessageModule::t('minute'),'amount'    =>    60        ),
        array('name'=> MessageModule::t('second'),'amount'    =>    1        )
        );
   
    $diff = abs($date1-$date2);
   
    $levels = 2;
    $current_level = 1;
    $result = array();
    foreach($blocks as $block)
        {
        if ($current_level > $levels) {break;}
        if ($diff/$block['amount'] >= 1)
            {
            $amount = floor($diff/$block['amount']);
            if ($amount>1) {$plural='s';} else {$plural='';}
            $result[] = $amount.' '.$block['name'].$plural;
            $diff -= $amount*$block['amount'];
            $current_level++;
            }
        }
	//	print_r($result);
    return $result[0].' '.MessageModule::t('ago');
	//  return implode(' ',$result).' ago';
    } 
  
  
  

function getZodiac($date){

	 $new_date=explode("-",$date);
	 $year=$new_date[0];
	 $month=$new_date[1];
	 $day=$new_date[2];
	 
     if(($month==4 && $day>=19)||($month==5 && $day<=13)){
          return "Aries";
     }else if(($month==5 && $day>=14)||($month==6 && $day<=19)){
          return "Taurus";
     }else if(($month==6 && $day>=20)||($month==7 && $day<=20)){
          return "Gemini";
     }else if(($month==7 && $day>=21)||($month==8 && $day<=9)){
          return "Cancer";
     }else if(($month==8 && $day>=10)||($month==9 && $day<=15)){
          return "Leo";
     }else if(($month==9 && $day>=16)||($month==10 && $day<=30)){
          return "Virgo";
     }else if(($month==10 && $day>=31)||($month==11 && $day<=22)){
          return "Libra";
     }else if(($month==11 && $day>=23)||($month==11 && $day<=29)){
          return "Scorpius";
     }else if(($month==11 && $day>=30)||($month==12 && $day<=17)){
          return "Ophiuchus";
     }if(($month==12 && $day>=18 )||($month==1 && $day<=18)){
          return "Sagittarius";
     }else if(($month==1 && $day>=19)||($month==2 && $day<=15)){
          return "Capricornus";
     }else if(($month==2 && $day>=16)||($month==3 && $day<=11)){
          return "Aquarius";
     }else if(($month==3 && $day>=12)||($month==4 && $day<=18)){
          return "Pisces";
     }
		}