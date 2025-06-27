# Flux CP Addons
Ragnarok Flux Control Panel (FluxCP) for rAthena servers.

<h1>Requirements</h1>
<ul>
<li>PHP 5.2 Min</li>
<li>PDO and PDO-MYSQL extensions for PHP5 (including PHP_MYSQL support)</li>
<li>MySQL 5</li>
<li>Account in https://xpayapi.com for creating <strong>Merchant ID</strong> and <strong>Merchant Password Key</strong></li>
</ul>

<h1>Installation</h1>
<ul>
<li>1. Copy downloaded zip file to your Ragnarok Flux CP > Addons folder then Extract (Rename folder "Fluxcp-Addons" to "crypto").</li>
<li>2. Upload database.sql to your MySQL database</li>
<li>3. Copy folder "lib" to your "lib" folder in Ragnarok FLUX CP</li>
<li>4. Register account at xPayapi https://xpayapi.com/</li>
<li>5. Create new merchant</li>
<li>6. Set up merchant.
<br/>- Title => Merchant Title
<br/>- Domain => Your Flux CP domain
<br/>- URL notifications about the payment of the invoice => https://yourdomain.com/?module=crypto&action=notify
<br/>- URL Pages with a message about successful payment =>  https://yourdomain.com/?module=crypto&action=process
<br/>- URL Pages with a failure message when paying => https://yourdomain.com/?module=crypto&action=cancel</li>
<li>7. Access link https://your.site.com/?module=crypto
<li>8. Done, Test it!</li>
</ul>

<h1>What Cryptocoin Include?</h1>
<ul>
<li>Bitcoin</li>
<li>Ethereum</li>
<li>Litecoin</li>
<li>Dogecoin</li>
<li>Dash</li>
<li>Binance Coin (BEP20)</li>
<li>Tron</li>
<li>Ripple XRP</li>
<li>Solana</li>
<li>Tether TRC20</li>
<li>Tether BEP20</li>
<li>Tether ERC20</li>
</ul>

<h1>Support?</h1>
<ul>
<li>xpayapi@gmail.com</li>
<li>Telegram https://t.me/xpayapi</li>
<li>Discord xpayapi</li>
</ul>