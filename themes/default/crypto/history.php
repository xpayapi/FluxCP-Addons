<?php if (!defined('FLUX_ROOT')) exit; ?>
<h2>Crypto Donation History</h2>
<h3>Transactions: Completed</h3>
<?php if ($completedTxn): ?>
<p>You have <?php echo number_format($completedTotal) ?> completed transaction(s).</p>
<table class="vertical-table">
	<tr>
		<th>Transaction</th>
		<th>Payment Date</th>
		<th>Amount in USD</th>
		<th>Currency</th>
		<th>Amount in Coin</th>
		<th>Credits</th>
	</tr>
	<?php foreach ($completedTxn as $txn): ?>
	<tr>
		<td><?php echo htmlspecialchars($txn->order_id) ?></td>
		<td><?php echo $this->formatDateTime($txn->created_at) ?></td>
		<td><?php echo number_format($txn->amount) ?></td>
		<td><?php echo htmlspecialchars($txn->currency) ?></td>
		<td><?php echo number_format($txn->amount_in_coin) ?></td>
		<td><?php echo number_format($txn->amount_credits) ?></td>
	</tr>
	<?php endforeach ?>
</table>
<?php else: ?>
<p>You have no completed transactions.</p>
<?php endif ?>

<h3>Transactions: Pending/Failed</h3>
<?php if ($pendingTxn): ?>
<p>You have <?php echo number_format($pendingTotal) ?> held transaction(s).</p>
<table class="vertical-table">
	<tr>
		<th>Transaction</th>
		<th>Payment Date</th>
		<th>Amount in USD</th>
		<th>Currency</th>
		<th>Amount in Coin</th>
		<th>Credits</th>
	</tr>
	<?php foreach ($pendingTxn as $txn): ?>
	<tr>
		<td><?php echo htmlspecialchars($txn->order_id) ?></td>
		<td><?php echo $this->formatDateTime($txn->created_at) ?></td>
		<td><?php echo number_format($txn->amount) ?></td>
		<td><?php echo htmlspecialchars($txn->currency) ?></td>
		<td><?php echo number_format($txn->amount_in_coin) ?></td>
		<td><?php echo number_format($txn->amount_credits) ?></td>
	</tr>
	<tr>
		<td colspan="6">
			↳ Address to Pay:
			<strong><?php echo htmlspecialchars($txn->address) ?></strong>
		</td>
	</tr>
	<?php endforeach ?>
</table>
<?php else: ?>
<p>You have no held transactions.</p>
<?php endif ?>