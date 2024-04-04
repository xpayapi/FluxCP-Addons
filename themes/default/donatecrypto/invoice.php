
<?php
	$currency         = Flux::config('DonationCurrency');
    function cFormat($number,$decimal=8){
      global $settings;
      return bcdiv(format_amount_with_no_e($number), 1, $decimal)+0;
    }
    function format_amount_with_no_e($float){
        $parts = explode('E', $float);
        if (count($parts) === 2) {
            $exp = abs(end($parts)) + strlen($parts[0]);
            $decimal = number_format($float, $exp);
            return rtrim($decimal, '.0');
        } else {
            return $float;
        }
    }
?>

<?php if ($invoice->status): ?>
<p>This invoice is already being processed and return <em>Success</em> please check your account.</p>
<?php else: ?>
    <h4 class="card-title">Deposit <?=$invoice->currency;?> Confirmation</h4>
    <table class="table">
        <tbody>
        <tr align="center">
            <td colspan="2"><img id="coin_payment_image" src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=<?=$invoice->address;?>" alt="Deposit {$depocoin.coin|escape:html}"><br/><p>QR Image Address</p></td>
        </tr>
        <tr>
            <th>Coin</th>
            <td><?=$invoice->currency;?></td>
        </tr>
        <tr>
            <th>Amount</th>
            <td><?=$this->formatCurrency($invoice->amount);?> <?=$currency;?></td>
        </tr>
        <tr>
            <th>Amount in Coin</th>
            <td><?=cFormat($invoice->amount_in_coin);?> <?=$invoice->currency;?></td>
        </tr>
        <tr>
        <td colspan="3">
            <div class="_form" id="_form">Please send exactly <b><span style="cursor:pointer;border-bottom: 2px dotted #FF8D03!important;" onclick="copy('copyAmount')" id="copyAmount"><?=cFormat($invoice->amount_in_coin);?> <?=$invoice->currency;?></span></b> to <i style="cursor:pointer;color:#666699;border-bottom: 2px dotted #FF8D03!important;" onclick="copy('copyAddress')" id="copyAddress"><?=$invoice->address;?></i><br></div>
        </td>
        </tr>
        <tr>
        <td colspan="3">
            <p>After payment was successfully, please wait some minutes (depends on coin network) for the transactions will be automatically success and your balance will be credited soon.
        </td>
        </tr>
        </tbody>
    </table>
<?php endif ?>
