<?php

function xmlDatas($users_data){

  $dom = new DomDocument();

  $users = $dom->createElement("users");

  foreach($users_data as $user_data) {

    $user = $dom->createElement("user");
    
    $ip = $dom->createElement("ip");
    $ip_data = $dom->createTextNode($user_data["ip"]);
    $nav = $dom->createElement("nav");
    $nav_data = $dom->createTextNode($user_data["nav"]);
    $time = $dom->createElement("time");
    $time_data = $dom->createTextNode($user_data["time"]);
    
    $ip->appendChild($ip_data);
    $nav->appendChild($nav_data);
    $time->appendChild($time_data);

    $user->appendChild($ip);
    $user->appendChild($nav);
    $user->appendChild($time);
    
    $users->appendChild($user);
  }

  $dom->appendChild($users);

  $dom->save("log/user.xml");
  $dom->saveXML();
}

?>
