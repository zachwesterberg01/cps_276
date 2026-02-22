<?php

function addClearNames(): string
{
    // If Clear Names button clicked
    if (isset($_POST["clear"])) {
        return "";
    }

    // Start with the existing list (textarea content)
    $existingList = "";
    if (isset($_POST["namelist"])) {
        $existingList = trim($_POST["namelist"]);
    }

    // Convert existing list into array
    $namesArray = [];
    if ($existingList !== "") {
        $namesArray = explode("\n", $existingList);
    }

    // If Add Name button clicked, add the new formatted name
    if (isset($_POST["add"])) {
        $fullName = "";
        if (isset($_POST["fullname"])) {
            $fullName = trim($_POST["fullname"]);
        }

        // Assignment note says we can assume "First Last" always
        if ($fullName !== "") {
            $parts = explode(" ", $fullName);
            $first = $parts[0];
            $last  = $parts[1];

            $formatted = $last . ", " . $first;
            array_push($namesArray, $formatted);
        }
    }

    // Sort and convert back to one string with \n
    sort($namesArray);
    return implode("\n", $namesArray);
}