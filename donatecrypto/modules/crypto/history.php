<?php
if (!defined('FLUX_ROOT')) exit;

$this->loginRequired();

$txnTable = Flux::config('FluxTables.invoiceTable');

/** Completed Transactions **/

$sqlpartial  = "WHERE account_id = ? AND status = '1' ";
$sqlpartial .= "ORDER BY created_at DESC";

$sql = "SELECT COUNT(id) AS total FROM {$server->loginDatabase}.$txnTable $sqlpartial";
$sth = $server->connection->getStatement($sql);

$sth->execute(array($session->account->account_id));
$completedTotal = $sth->fetch()->total;

$col = "*";
$sql = "SELECT $col FROM {$server->loginDatabase}.$txnTable $sqlpartial";
$sth = $server->connection->getStatement($sql);

$sth->execute(array($session->account->account_id));
$completedTxn = $sth->fetchAll();

/** Pending or Failed Transactions **/

$sqlpartial  = "WHERE account_id = ? AND status = '0' ";
$sqlpartial .= "ORDER BY created_at DESC";

$sql = "SELECT COUNT(id) AS total FROM {$server->loginDatabase}.$txnTable $sqlpartial";
$sth = $server->connection->getStatement($sql);

$sth->execute(array($session->account->account_id));
$pendingTotal = $sth->fetch()->total;

$col = "*";
$sql = "SELECT $col FROM {$server->loginDatabase}.$txnTable $sqlpartial";
$sth = $server->connection->getStatement($sql);

$sth->execute(array($session->account->account_id));
$pendingTxn = $sth->fetchAll();


?>
