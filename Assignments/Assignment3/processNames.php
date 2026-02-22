<?php

function addClearNames(): string
{
    /
    if (isset($_POST["clear"])) {
        return "";
    }

    
    $existingList = "";
    if (isset($_POST["namelist"])) {
        $existingList = trim($_POST["namelist"]);
    }

   
    $namesArray = [];
    if ($existingList !== "") {
        $namesArray = explode("\n", $existingList);
    }

    
    if (isset($_POST["add"])) {
        $fullName = "";
        if (isset($_POST["fullname"])) {
            $fullName = trim($_POST["fullname"]);
        }

        
        if ($fullName !== "") {
            $parts = explode(" ", $fullName);
            $first = $parts[0];
            $last  = $parts[1];

            $formatted = $last . ", " . $first;
            array_push($namesArray, $formatted);
        }
    }

    
    sort($namesArray);
    return implode("\n", $namesArray);
}