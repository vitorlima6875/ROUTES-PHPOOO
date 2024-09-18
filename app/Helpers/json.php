<?php


  function isJson(string $data)
  {
    Json_decode($data);
    return json_decode($data);

    
  }