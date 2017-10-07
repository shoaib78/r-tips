<?php
function convertCurrency($amount, $from, $to){
    /*$data = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from&to=$to");
    preg_match("/<span class=bld>(.*)<\/span>/",$data, $converted);
    if(!empty($converted)){
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        $result =  number_format(round($converted, 3),4);
    }else{
        $result = number_format((float)0, 4, '.', '') ;
    }
    return $result;*/
    $amount    = urlencode($amount);
    $from    = urlencode($from);
    $to        = urlencode($to);
    $url    = "http://www.google.com/ig/calculator?hl=en&q=$amount$from=?$to";
    $ch     = @curl_init();
    $timeout= 0;

    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($ch,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

    $rawdata = curl_exec($ch);
    curl_close($ch);
    $data = explode('"', $rawdata);
    $data = explode(' ', $data['3']);
    $var = $data['0'];
    return round($var,3);
}

?>


<tr>
    <td><img src="<?php echo base_url() ?>assets/images/us.png"/></td>
    <td class="active"><?php echo number_format((float)1, 4, '.', ''); ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "USD", "EUR");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "USD", "GBP");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "USD", "INR");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "USD", "AUD");
        ?></td>
</tr>
<?php /*
<tr>
    <td><img src="<?php echo base_url() ?>assets/images/eur.png"/></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "EUR", "USD");
        ?></td>
    <td class="active"><?php echo number_format((float)1, 4, '.', ''); ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "EUR", "GBP");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "EUR", "INR");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "EUR", "AUD");
        ?></td>
</tr>
<tr>
    <td><img src="<?php echo base_url() ?>assets/images/gbp.png"/></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "GBP", "USD");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "GBP", "EUR");
        ?></td>
    <td class="active"><?php echo number_format((float)1, 4, '.', ''); ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "GBP", "INR");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "GBP", "AUD");
        ?></td>
</tr>
<tr>
    <td><img src="<?php echo base_url() ?>assets/images/ind.png"/></td>

    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "INR", "USD");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "INR", "EUR");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "INR", "GBP");
        ?></td>
    <td class="active"><?php echo number_format((float)1, 4, '.', ''); ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "INR", "AUD");
        ?></td>
</tr>
<tr>
    <td><img src="<?php echo base_url() ?>assets/images/aud.png"/></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "AUD", "USD");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "AUD", "EUR");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "AUD", "GBP");
        ?></td>
    <td><?php echo convertCurrency(number_format((float)1, 4, '.', ''), "AUD", "INR");
        ?></td>
    <td class="active"><?php echo number_format((float)1, 4, '.', ''); ?></td>
</tr>
		*/?>
