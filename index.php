<?php
// 簡單的 PHP 環境檢查範例
function get_extensions_summary(): string {
    $ext = get_loaded_extensions();
    sort($ext);
    return implode(', ', $ext);
}

$phpVersion = phpversion();
$osInfo = php_uname();
$extensions = get_extensions_summary();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$input = $method === 'POST' ? $_POST : $_GET;
?>
<!doctype html>
<html lang="zh-Hant">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>PHP 環境檢查</title>
<style>body{font-family:Segoe UI,Helvetica,Arial;background:#f7f7f7;padding:20px}pre{background:#fff;padding:10px;border:1px solid #ddd}</style>
</head>
<body>
<h1>PHP 環境檢查</h1>
<ul>
    <li>PHP 版本: <?php echo htmlspecialchars($phpVersion); ?></li>
    <li>作業系統: <?php echo htmlspecialchars($osInfo); ?></li>
    <li>已載入擴充套件數: <?php echo count(explode(',', $extensions)); ?></li>
    <li>請求方法: <?php echo htmlspecialchars($method); ?></li>
</ul>

<h2>已載入擴充（部分）</h2>
<pre><?php echo htmlspecialchars(substr($extensions, 0, 1000)); ?><?php if (strlen($extensions) > 1000) echo '...'; ?></pre>

<h2>輸入回顯（<?php echo htmlspecialchars($method); ?>）</h2>
<pre><?php echo htmlspecialchars(print_r($input, true)); ?></pre>

<h2>測試表單</h2>
<form method="post">
    <label>訊息: <input name="msg" value="Hello"></label>
    <button type="submit">送出</button>
</form>

<p>若要檢視完整的 PHP 資訊，請按 <a href="?phpinfo=1">phpinfo()</a>。</p>

<?php if (isset($_GET['phpinfo']) && $_GET['phpinfo'] == 1) { phpinfo(); } ?>

</body>
</html>
