<?php

/**
 * Encode text to Morse Code.
 *
 * @param  string  $text  text to encode
 * @return string encoded text
 * @throws \Exception
 */
function encode(string $text): string
{
    $text = strtoupper($text); // Makes sure the string is uppercase
    $MORSE_CODE = array( // Array containing morse code translations
        "A" => ".-",
        "B" => "-...",
        "C" => "-.-.",
        "D" => "-..",
        "E" => ".",
        "F" => "..-.",
        "G" => "--.",
        "H" => "....",
        "I" => "..",
        "J" => ".---",
        "K" => "-.-",
        "L" => ".-..",
        "M" => "--",
        "N" => "-.",
        "O" => "---",
        "P" => ".--.",
        "Q" => "--.-",
        "R" => ".-.",
        "S" => "...",
        "T" => "-",
        "U" => "..-",
        "V" => "...-",
        "W" => ".--",
        "X" => "-..-",
        "Y" => "-.--",
        "Z" => "--..",
        "1" => ".----",
        "2" => "..---",
        "3" => "...--",
        "4" => "....-",
        "5" => ".....",
        "6" => "-....",
        "7" => "--...",
        "8" => "---..",
        "9" => "----.",
        "0" => "-----",
        " " => "/"
    );

    $encodedText = ""; // Stores the encoded text
    foreach (str_split($text) as $c) { // Going through each character
        if (array_key_exists($c, $MORSE_CODE)) { // Checks if it is a valid character
            $encodedText .= $MORSE_CODE[$c] . " "; // Appends the correct character
        } else {
            throw new \Exception("Invalid character: $c");
        }
    }
    substr_replace($encodedText, "", -1); // Removes trailing space
    return $encodedText;
}

/**
 * Decode Morse Code to text.
 * @param  string  $text  text to decode
 * @throws \Exception
 */
function decode(string $text): string
{
    $MORSE_CODE = array( // An array containing morse code to text translations
        ".-" => "A",
        "-..." => "B",
        "-.-." => "C",
        "-.." => "D",
        "." => "E",
        "..-." => "F",
        "--." => "G",
        "...." => "H",
        ".." => "I",
        ".---" => "J",
        "-.-" => "K",
        ".-.." => "L",
        "--" => "M",
        "-." => "N",
        "---" => "O",
        ".--." => "P",
        "--.-" => "Q",
        ".-." => "R",
        "..." => "S",
        "-" => "T",
        "..-" => "U",
        "...-" => "V",
        ".--" => "W",
        "-..-" => "X",
        "-.--" => "Y",
        "--.." => "Z",
        ".----" => "1",
        "..---" => "2",
        "...--" => "3",
        "....-" => "4",
        "....." => "5",
        "-...." => "6",
        "--..." => "7",
        "---.." => "8",
        "----." => "9",
        "-----" => "0",
        "/" => " "
    );

    $decodedText = ""; // Stores the decoded text
    foreach (explode(" ", $text) as $c) { // Going through each group
        if (array_key_exists($c, $MORSE_CODE)) { // Checks if it is a valid character
            $decodedText .= $MORSE_CODE[$c]; // Appends the correct character
        } else {
            if ($c) { // Makes sure that the string is not empty to prevent trailing spaces or extra spaces from breaking this
                throw new \Exception("Invalid character: $c");
            }
        }
    }
    return $decodedText;
}

function xorCipher(string $input_string, string $key)
{
    $key_len = strlen($key);
    $result = array();

    for ($idx = 0; $idx < strlen($input_string); $idx++) {
        array_push($result, $input_string[$idx] ^ $key[$idx % $key_len]);
    }

    return join("", $result);
}

function checkPalindromeString(string $string, bool $caseInsensitive = true): string
{
    //removing spaces
    $string = trim($string);

    if (empty($string)) {
        throw new \Exception('You are given empty string. Please give a non-empty string value');
    }

    /**
     * for case-insensitive
     * lowercase string conversion
     */
    if ($caseInsensitive) {
        $string = strtolower($string);
    }

    if ($string !== strrev($string)) {
        return $string . " - not a palindrome string." . PHP_EOL;
    }

    return $string . " - a palindrome string." . PHP_EOL;
}
function findDistance($str1, $str2)
{
    $lenStr1 = strlen($str1);
    $lenStr2 = strlen($str2);
    if ($lenStr1 == 0) {
        return $lenStr2;
    }

    if ($lenStr2 == 0) {
        return $lenStr1;
    }

    $distanceVectorInit = [];
    $distanceVectorFinal = [];

    for ($i = 0; $i < $lenStr1 + 1; $i++) {
        $distanceVectorInit[] = 0;
        $distanceVectorFinal[] = 0;
    }

    for ($i = 0; $i < $lenStr1 + 1; $i++) {
        $distanceVectorInit[$i] = $i;
    }

    for ($i = 0; $i < $lenStr2; $i++) {
        $distanceVectorFinal[0] = $i + 1;

        // use formula to fill in the rest of the row
        for ($j = 0; $j < $lenStr1; $j++) {
            $substitutionCost = 0;
            if ($str1[$j] == $str2[$i]) {
                $substitutionCost = $distanceVectorInit[$j];
            } else {
                $substitutionCost = $distanceVectorInit[$j] + 1;
            }

            $distanceVectorFinal[$j + 1] = min($distanceVectorInit[$j + 1] + 1, min($distanceVectorFinal[$j] + 1, $substitutionCost));
        }

        $distanceVectorInit = $distanceVectorFinal;
    }


    return $distanceVectorFinal[$lenStr1];
}
