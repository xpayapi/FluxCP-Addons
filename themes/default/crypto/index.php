
<?php
	$currency         = Flux::config('DonationCurrency');
	$dollarAmount     = (float)+Flux::config('CreditExchangeRate');
	$creditAmount     = 1;
	$rateMultiplier   = 10;
	
	while ($dollarAmount < 1) {
		$dollarAmount  *= $rateMultiplier;
		$creditAmount  *= $rateMultiplier;
	}
?>

<h2>Donate</h2>
<?php if (Flux::config('AcceptDonations')): ?>
    
	<?php if (!empty($errorMessage)): ?>
		<p class="red"><?php echo htmlspecialchars($errorMessage) ?></p>
	<?php endif ?>


	<p>By donating, you're supporting the costs of <em>running</em> this server and <em>maintaining</em> it.  In return, you will be rewarded <span class="keyword">donation credits</span> that you may use to purchase items from our in-game item cash shop.</p>
    
	<div class="generic-form-div" style="margin-bottom: 10px">
		<table class="generic-form-table">
			<tr>
				<th><label>Current Credit Exchange Rate:</label></th>
				<td><p><?php echo $this->formatCurrency($dollarAmount) ?> <?php echo htmlspecialchars($currency) ?>
				= <?php echo number_format($creditAmount) ?> credit(s).</p></td>
			</tr>
		</table>
	</div>

	<?php if ($donationAmount && $donationType && $donationCredits): ?>
    <?php if ($donationType == "bitcoin"): ?>
        <p><em class="text-danger">Please wait,</em> redirecting to payments...</p>
        <meta http-equiv="refresh" content="5; url=<?php echo $redirect_url ?>">
    <?php elseif ($donationType == "tether"): ?>
        <p><em class="text-danger">Please wait,</em> redirecting to payments...</p>
        <meta http-equiv="refresh" content="5; url=<?php echo $redirect_url ?>">
    <?php endif ?>

    <?php else: ?>

        <form action="<?php echo $this->url ?>" method="post">
        <h3 class="mb-4">Step 1. <small>Choose your Crypto coin.</small></h3>

        <table class="horizontal-table">
            <thead>
                <th>
                    <td>Processing</td>
                    <td>Min Amount</td>
                </th>
            </thead>
            <tbody>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="bitcoin" value="bitcoin" required></td>
                    <td><img src="/themes/default/./img/payments/bitcoin.png"> <label for="bitcoin">Bitcoin</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountBTC'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="ethereum" value="ethereum" required></td>
                    <td><img src="/themes/default/./img/payments/ethereum.png"> <label for="ethereum">Ethereum</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountETH'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="litecoin" value="litecoin" required></td>
                    <td><img src="/themes/default/./img/payments/litecoin.png"> <label for="litecoin">Litecoin</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountLTC'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="dogecoin" value="dogecoin" required></td>
                    <td><img src="/themes/default/./img/payments/dogecoin.png"> <label for="dogecoin">Dogecoin</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountDOGE'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="dash" value="dash" required></td>
                    <td><img src="/themes/default/./img/payments/dash.png"> <label for="dash">Dash</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountDASH'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="binancecoin" value="binancecoin" required></td>
                    <td><img src="/themes/default/./img/payments/binancecoin.png"> <label for="binancecoin">Binance Coin</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountBNB'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="tron" value="tron" required></td>
                    <td><img src="/themes/default/./img/payments/tron.png"> <label for="tron">Tron</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountTRON'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="tron_trc20" value="tron_trc20" required></td>
                    <td><img src="/themes/default/./img/payments/tethertrc20.png"> <label for="tron_trc20">Tether TRC20</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountTETHER'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="binancesmartchain_bep20" value="binancesmartchain_bep20" required></td>
                    <td><img src="/themes/default/./img/payments/tetherbep20.png"> <label for="binancesmartchain_bep20">Tether BEP20</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountTETHER'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
                <tr>
                    <td width="1%"><input type="radio" name="payment_type" id="ethereum_erc20" value="ethereum_erc20" required></td>
                    <td><img src="/themes/default/./img/payments/tethererc20.png"> <label for="ethereum_erc20">Tether ERC20</label></td>
                    <td><p style="color:orange"><?php echo htmlspecialchars(Flux::config('MinDonationAmountTETHER'))." ";echo htmlspecialchars(Flux::config('DonationCurrency')); ?></p></td>
                </tr>
            </tbody>
        </table>

        <h3 class="mb-4">Step 2. <small>Enter an amount you would like to donate.</small></h3>

        <div class="row">
        <div class="col-lg-12">
            <div class="single-menu">

                    <?php echo $this->moduleActionFormInputs($params->get('module')) ?>
                    <input type="hidden" name="setamount" value="1" />
                    <p class="enter-donation-amount">
                        <input class="money-input form-control" type="text" name="amount" placeholder="Amount in USD" aria-label="Amount in USD" aria-describedby="basic-addon2"
                            value="<?php echo htmlspecialchars($params->get('amount') ?: 0) ?>"
                            size="<?php echo (strlen((string)+Flux::config('CreditExchangeRate')) * 2) + 2 ?>"  required/>
                            <span class="input-group-text" id="basic-addon2">in <?php echo htmlspecialchars(Flux::config('DonationCurrency')) ?></span>
                        or
                        <input class="credit-input form-control" type="text" name="credit-amount" placeholder="Amount in Credits" aria-label="Amount in Credits" aria-describedby="basic-addon2"
                        value="<?php echo htmlspecialchars(intval($params->get('amount') * Flux::config('CreditExchangeRate'))) ?>"
                            size="<?php echo (strlen((string)+Flux::config('CreditExchangeRate')) * 2) + 2 ?>"  required/>
                            <span class="input-group-text" id="basic-addon2">in Credits</span>
                    </p>
                    <input onclick='return confirm("Are you sure you choose the right payment type and amount?")' type="submit" value="Process Donation" class="submit_button btn btn-primary" />
            
            </div>
        </div>
                    
    </div>

    </form>

<?php endif ?>

<?php else: ?>
	<p><?php echo Flux::message('NotAcceptingDonations') ?></p>
<?php endif ?>
