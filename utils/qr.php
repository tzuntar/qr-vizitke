<?php

/**
 * Generates a QR code using a web API
 * @param string $data the data to embed into the code
 * @param string $bgColor optional hexadecimal background color
 * (defaults to #F9F9F9)
 * @return string the resulting QR code in an <svg> tag
 * @example echo makeQR("PNK-384927934-234f323e-2349");
 */
function makeQR(string $data, string $bgColor = 'F9F9F9'): string {
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "http://api.qrserver.com/v1/create-qr-code/?data=$data&size=200x200&format=svg&bgcolor=$bgColor",
        CURLOPT_CUSTOMREQUEST => 'GET'
    ]);
    $response = curl_exec($curl);
    curl_close($curl);
    // rtrim because of a bug resulting in a stray '1' at the end of the tag
    return rtrim($response, '1');
}
