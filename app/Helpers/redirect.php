<?php


function redirect (string $to)
{
    return header("location: {$to}");
}