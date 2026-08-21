<?php
declare(strict_types=1);

const ADMIN_PASSWORD_HASH = '$2y$10$k9xHo7RevfjmzA9fS2rLzeNliZyguX15kgtTtkQpx0.ZrUGLLpy7S';
const JSON_PATH  = __DIR__ . '/update-desktop.json';
const STATE_DIR  = __DIR__ . '/../../storage/app/update-admin';
const LOCK_FILE  = STATE_DIR . '/attempts.json';
const PASSWORD_FILE = STATE_DIR . '/password.hash';
const MAX_ATTEMPTS = 5;
const LOCKOUT_SECONDS = 600;
const LARAVEL_ROOT = __DIR__ . '/../..';

header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');
header('Content-Type: text/html; charset=utf-8');

session_name('upd_admin_sess');
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/app/',
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
]);
session_start();

if (!is_dir(STATE_DIR)) {
    @mkdir(STATE_DIR, 0770, true);
}

function read_attempts(): array
{
    if (!is_file(LOCK_FILE)) {
        return ['count' => 0, 'locked_until' => 0];
    }
    $data = json_decode((string) @file_get_contents(LOCK_FILE), true);
    if (!is_array($data)) {
        return ['count' => 0, 'locked_until' => 0];
    }
    return ['count' => (int) ($data['count'] ?? 0), 'locked_until' => (int) ($data['locked_until'] ?? 0)];
}
function write_attempts(array $data): void
{
    @file_put_contents(LOCK_FILE, json_encode($data), LOCK_EX);
}
function register_failed_attempt(): void
{
    $data = read_attempts();
    $data['count']++;
    if ($data['count'] >= MAX_ATTEMPTS) {
        $data['locked_until'] = time() + LOCKOUT_SECONDS;
        $data['count'] = 0;
    }
    write_attempts($data);
}
function clear_attempts(): void
{
    write_attempts(['count' => 0, 'locked_until' => 0]);
}
function is_locked_out(): int
{
    $data = read_attempts();
    $remaining = $data['locked_until'] - time();
    return $remaining > 0 ? $remaining : 0;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}
function csrf_check(): bool
{
    return isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}

function scb_current_password_hash(): string
{
    if (is_file(PASSWORD_FILE)) {
        $stored = trim((string) @file_get_contents(PASSWORD_FILE));
        if ($stored !== '') {
            return $stored;
        }
    }
    return ADMIN_PASSWORD_HASH;
}

function scb_env(string $key, string $default = ''): string
{
    static $envVars = null;
    if ($envVars === null) {
        $envVars = [];
        $envPath = LARAVEL_ROOT . '/.env';
        if (is_file($envPath)) {
            $lines = @file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];
            foreach ($lines as $line) {
                $line = trim($line);
                if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                    continue;
                }
                [$k, $v] = explode('=', $line, 2);
                $k = trim($k);
                $v = trim($v);
                if (strlen($v) >= 2 && (($v[0] === '"' && $v[-1] === '"') || ($v[0] === "'" && $v[-1] === "'"))) {
                    $v = substr($v, 1, -1);
                }
                $envVars[$k] = $v;
            }
        }
    }
    return $envVars[$key] ?? $default;
}

function scb_db(): PDO
{
    static $pdo = null;
    if ($pdo === null) {
        $host = scb_env('DB_HOST', '127.0.0.1');
        $port = scb_env('DB_PORT', '3306');
        $name = scb_env('DB_DATABASE');
        $user = scb_env('DB_USERNAME');
        $pass = scb_env('DB_PASSWORD');
        $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
    return $pdo;
}

if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: update-admin.php');
    exit;
}

$error = '';
$success = '';
$authed = !empty($_SESSION['authed']);

if (!$authed && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $lockedFor = is_locked_out();
    if ($lockedFor > 0) {
        $error = 'تعداد تلاش‌های ناموفق زیاد بوده. لطفاً ' . ceil($lockedFor / 60) . ' دقیقه دیگر تلاش کنید.';
    } elseif (!csrf_check()) {
        $error = 'درخواست نامعتبر است، صفحه را رفرش کنید.';
    } elseif (password_verify((string) $_POST['password'], scb_current_password_hash())) {
        session_regenerate_id(true);
        $_SESSION['authed'] = true;
        clear_attempts();
        header('Location: update-admin.php');
        exit;
    } else {
        register_failed_attempt();
        $error = 'رمز عبور اشتباه است.';
    }
    $authed = !empty($_SESSION['authed']);
}

if ($authed && isset($_GET['download'])) {
    $ticketId = (int) $_GET['download'];
    $ticket = null;
    try {
        $stmt = scb_db()->prepare('SELECT * FROM scanbridge_support_tickets WHERE id = :id');
        $stmt->execute(['id' => $ticketId]);
        $ticket = $stmt->fetch() ?: null;
    } catch (Throwable $e) {
        $ticket = null;
    }
    if ($ticket) {
        $filePath = LARAVEL_ROOT . '/storage/app/' . $ticket['stored_path'];
        if (is_file($filePath)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename((string) $ticket['original_filename']) . '"');
            header('Content-Length: ' . (string) filesize($filePath));
            readfile($filePath);
            exit;
        }
    }
    http_response_code(404);
    echo 'فایل پیدا نشد.';
    exit;
}

if ($authed && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save') {
    if (!csrf_check()) {
        $error = 'درخواست نامعتبر است، صفحه را رفرش کنید.';
    } else {
        $version = trim((string) ($_POST['version'] ?? ''));
        $message = trim((string) ($_POST['message'] ?? ''));
        $url = trim((string) ($_POST['url'] ?? ''));
        if ($version === '') {
            $error = 'فیلد نسخه نمی‌تواند خالی باشد.';
        } elseif ($url !== '' && filter_var($url, FILTER_VALIDATE_URL) === false) {
            $error = 'لینک دانلود معتبر نیست.';
        } else {
            $payload = [
                'version' => $version,
                'message' => $message,
                'url' => $url,
            ];
            $json = json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            if (file_put_contents(JSON_PATH, $json, LOCK_EX) !== false) {
                $success = 'با موفقیت ذخیره شد.';
                try {
                    $stmt = scb_db()->prepare('INSERT INTO scanbridge_update_history (version, message, url, published_at) VALUES (:version, :message, :url, NOW())');
                    $stmt->execute(['version' => $version, 'message' => $message, 'url' => $url]);
                } catch (Throwable $e) {
                    $success .= ' (توجه: ثبت در تاریخچه ناموفق بود - جدول scanbridge_update_history را بررسی کنید.)';
                }
            } else {
                $error = 'خطا در نوشتن فایل. دسترسی نوشتن را بررسی کنید.';
            }
        }
    }
}

if ($authed && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'reply') {
    if (!csrf_check()) {
        $error = 'درخواست نامعتبر است، صفحه را رفرش کنید.';
    } else {
        $ticketId = (int) ($_POST['ticket_id'] ?? 0);
        $replyText = trim((string) ($_POST['reply_text'] ?? ''));
        if ($ticketId <= 0 || $replyText === '') {
            $error = 'متن پاسخ نمی‌تواند خالی باشد.';
        } else {
            try {
                $stmt = scb_db()->prepare(
                    'UPDATE scanbridge_support_tickets
                     SET admin_reply = :reply, status = "answered", replied_at = NOW(), delivered_to_app_at = NULL, updated_at = NOW()
                     WHERE id = :id'
                );
                $stmt->execute(['reply' => $replyText, 'id' => $ticketId]);
                $success = 'پاسخ ذخیره شد - با اولین بررسی وضعیت لایسنس توسط برنامه‌ی کاربر (حداکثر تا ۶ ساعت دیگر، یا با باز کردن مجدد برنامه)، توی «پیام‌ها»ش نمایش داده می‌شود.';
            } catch (Throwable $e) {
                $error = 'خطا در ذخیره‌ی پاسخ: ' . $e->getMessage();
            }
        }
    }
}
if ($authed && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'close_ticket') {
    if (!csrf_check()) {
        $error = 'درخواست نامعتبر است، صفحه را رفرش کنید.';
    } else {
        $ticketId = (int) ($_POST['ticket_id'] ?? 0);
        try {
            $stmt = scb_db()->prepare('UPDATE scanbridge_support_tickets SET status = "closed", updated_at = NOW() WHERE id = :id');
            $stmt->execute(['id' => $ticketId]);
            $success = 'تیکت بسته شد.';
        } catch (Throwable $e) {
            $error = 'خطا: ' . $e->getMessage();
        }
    }
}

if ($authed && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'change_password') {
    if (!csrf_check()) {
        $error = 'درخواست نامعتبر است، صفحه را رفرش کنید.';
    } else {
        $currentPassword = (string) ($_POST['current_password'] ?? '');
        $newPassword = (string) ($_POST['new_password'] ?? '');
        $newPasswordConfirm = (string) ($_POST['new_password_confirmation'] ?? '');
        if (!password_verify($currentPassword, scb_current_password_hash())) {
            $error = 'رمز فعلی اشتباه است.';
        } elseif (strlen($newPassword) < 8) {
            $error = 'رمز جدید باید حداقل ۸ کاراکتر باشد.';
        } elseif ($newPassword !== $newPasswordConfirm) {
            $error = 'تکرار رمز جدید با رمز جدید یکسان نیست.';
        } else {
            $newHash = password_hash($newPassword, PASSWORD_BCRYPT);
            if (file_put_contents(PASSWORD_FILE, $newHash, LOCK_EX) !== false) {
                $success = 'رمز عبور با موفقیت تغییر کرد.';
            } else {
                $error = 'خطا در نوشتن فایل رمز. دسترسی نوشتن پوشه‌ی ' . htmlspecialchars(STATE_DIR) . ' را بررسی کنید.';
            }
        }
    }
}

$current = ['version' => '', 'message' => '', 'url' => ''];
if (is_file(JSON_PATH)) {
    $decoded = json_decode((string) @file_get_contents(JSON_PATH), true);
    if (is_array($decoded)) {
        $current['version'] = (string) ($decoded['version'] ?? '');
        $current['message'] = (string) ($decoded['message'] ?? '');
        $current['url'] = (string) ($decoded['url'] ?? '');
    }
}

$tab = 'update';
if (isset($_GET['tab']) && in_array($_GET['tab'], ['support', 'password'], true)) {
    $tab = $_GET['tab'];
}
$updateHistory = [];
$supportTickets = [];
$openTicketCount = 0;
$dbError = '';
if ($authed && $tab !== 'password') {
    try {
        if ($tab === 'update') {
            $updateHistory = scb_db()->query('SELECT * FROM scanbridge_update_history ORDER BY published_at DESC LIMIT 20')->fetchAll();
        } else {
            $supportTickets = scb_db()->query(
                'SELECT t.*, c.name AS customer_name, c.mobile AS customer_mobile,
                        l.license_key AS license_key, l.plan AS license_plan, l.expires_at AS license_expires_at
                 FROM scanbridge_support_tickets t
                 LEFT JOIN scanbridge_customers c ON c.id = t.customer_id
                 LEFT JOIN scanbridge_licenses l ON l.id = t.license_id
                 ORDER BY (t.status = "new") DESC, t.created_at DESC
                 LIMIT 100'
            )->fetchAll();
        }
        $openTicketCount = (int) scb_db()->query('SELECT COUNT(*) AS c FROM scanbridge_support_tickets WHERE status = "new"')->fetch()['c'];
    } catch (Throwable $e) {
        $dbError = 'اتصال به دیتابیس یا خواندن اطلاعات با خطا مواجه شد - احتمالاً باید ابتدا «php artisan migrate» را روی سرور اجرا کنید. (' . $e->getMessage() . ')';
    }
} elseif ($authed) {
    try {
        $openTicketCount = (int) scb_db()->query('SELECT COUNT(*) AS c FROM scanbridge_support_tickets WHERE status = "new"')->fetch()['c'];
    } catch (Throwable $e) {
        // ignore - badge count only
    }
}

$token = csrf_token();
$lockedFor = is_locked_out();

function scb_status_badge(string $status): string
{
    return match ($status) {
        'answered' => '<span class="badge badge-done">پاسخ داده شد</span>',
        'closed' => '<span class="badge badge-ignored">بسته شد</span>',
        default => '<span class="badge badge-new">جدید</span>',
    };
}
?>
<!doctype html>
<html lang="fa" dir="rtl">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<title>آپدیت و پشتیبانی</title>
<style>
  @font-face {
    font-family: 'Pinar';
    src: url('/fonts/Pinar-DS1-FD-Regular.woff2') format('woff2');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
  }
  * { box-sizing: border-box; }
  html, body { height: 100%; }
  body {
    font-family: 'Pinar', Tahoma, Arial, sans-serif;
    background: #f8fafc;
    margin: 0;
    color: #0f172a;
    line-height: 1.9;
    display: flex;
    flex-direction: column;
  }
  .wrap { flex: 1 0 auto; max-width: 900px; margin: 0 auto; padding: 40px 16px; width: 100%; }
  .card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 10px 30px rgba(15,23,42,.07);
    border: 1px solid #e5e7eb;
    padding: 26px;
  }
  .login-card { max-width: 440px; margin: 0 auto; }
  h1 { font-size: 21px; margin: 0 0 6px; color: #1e3a8a; }
  label {
    display: block;
    font-size: 14px;
    margin-bottom: 6px;
    margin-top: 16px;
    font-weight: bold;
  }
  input[type=text], input[type=password], textarea {
    width: 100%;
    padding: 11px 13px;
    border: 1px solid #d1d5db;
    border-radius: 12px;
    font-size: 14px;
    font-family: inherit;
    background: #fff;
  }
  textarea { min-height: 80px; resize: vertical; }
  button, .btn {
    margin-top: 20px;
    padding: 11px 20px;
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    color: #fff;
    border: none;
    border-radius: 12px;
    font-size: 14px;
    font-weight: bold;
    font-family: inherit;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(30,58,138,.25);
    text-decoration: none;
    display: inline-block;
  }
  button:hover, .btn:hover { filter: brightness(1.08); }
  button.secondary, .btn.secondary {
    background: #f1f5f9;
    color: #334155;
    box-shadow: none;
  }
  .msg-error {
    background: #fee2e2;
    color: #991b1b;
    padding: 10px 14px;
    border-radius: 12px;
    font-size: 14px;
    margin-bottom: 14px;
  }
  .msg-success {
    background: #dcfce7;
    color: #166534;
    padding: 10px 14px;
    border-radius: 12px;
    font-size: 14px;
    margin-bottom: 14px;
  }
  .hint {
    background: #eff6ff;
    color: #1e40af;
    border: 1px solid #bfdbfe;
    border-radius: 12px;
    padding: 10px 14px;
    font-size: 13px;
    margin-bottom: 14px;
  }
  .top-header {
    background: linear-gradient(135deg, #1e3a8a, #2563eb);
    color: #fff;
    border-radius: 20px;
    padding: 22px 26px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 14px;
    margin-bottom: 20px;
    box-shadow: 0 10px 30px rgba(30,58,138,.2);
  }
  .top-header h1 { margin: 0; font-size: 22px; color: #fff; }
  .top-header small { display: block; opacity: .85; margin-top: 5px; font-size: 13px; }
  .top-header-actions { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; }
  .pill-btn {
    background: rgba(255,255,255,.14);
    border: 1px solid rgba(255,255,255,.35);
    color: #fff;
    border-radius: 12px;
    height: 44px;
    min-width: 110px;
    padding: 0 18px;
    margin: 0;
    box-shadow: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-family: inherit;
    font-size: 14px;
    font-weight: bold;
    line-height: 1;
    text-decoration: none;
    cursor: pointer;
  }
  .pill-btn:hover { background: rgba(255,255,255,.3); filter: none; }
  .tabs { display: flex; gap: 8px; margin-bottom: 20px; }
  .tab-link {
    display: inline-block;
    padding: 10px 20px;
    border-radius: 999px;
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
    color: #334155;
    background: #f1f5f9;
  }
  .tab-link.active {
    background: linear-gradient(135deg,#1e3a8a,#2563eb);
    color: #fff;
  }
  .badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: bold;
  }
  .badge-new { background: #eff6ff; color: #2563eb; }
  .badge-done { background: #f0fdf4; color: #15803d; }
  .badge-ignored { background: #f1f5f9; color: #64748b; }
  table { width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 10px; }
  th, td { text-align: right; padding: 9px 8px; border-bottom: 1px solid #f1f5f9; vertical-align: top; }
  th { color: #64748b; font-size: 12px; }
  .empty { color: #94a3b8; font-size: 14px; padding: 10px 0; }
  .ticket { border: 1px solid #e5e7eb; border-radius: 14px; padding: 16px; margin-bottom: 14px; background: #f9fafb; }
  .ticket-head { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; margin-bottom: 8px; }
  .ticket-customer { font-weight: bold; font-size: 14px; }
  .ticket-meta { font-size: 12px; color: #64748b; margin-bottom: 8px; }
  .license-key { direction: ltr; font-family: monospace; font-size: 12px; }
  .ticket-reply-box { background: #eff6ff; border-radius: 10px; padding: 10px 12px; font-size: 13px; margin-top: 8px; color: #1e3a8a; }
  .ticket-actions { display: flex; gap: 8px; margin-top: 10px; align-items: flex-start; flex-wrap: wrap; }
  .ticket-actions form { display: flex; flex-direction: column; flex: 1; min-width: 220px; }
  .ticket-actions textarea { margin-bottom: 8px; }
  .current-box {
    background: #f9fafb;
    border: 1px dashed #d1d5db;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12px;
    color: #6b7280;
    margin-top: 20px;
  }
  .field { position: relative; display: flex; align-items: center; line-height: normal; }
  .field input { padding-left: 44px; width: 100%; }
  .eye {
    position: absolute; left: 8px; top: 50%; transform: translateY(-50%);
    width: 36px; height: 36px; border: 0; border-radius: 10px;
    background: #eef2ff; color: #1e3a8a; cursor: pointer;
    display: flex; align-items: center; justify-content: center; padding: 0;
    margin: 0; box-shadow: none;
  }
  .eye:hover { background: #e0e7ff; }
  .eye svg { width: 20px; height: 20px; pointer-events: none; }
</style>
</head>
<body>
<div class="wrap">
<?php if (!$authed): ?>
  <div class="card login-card">
  <h1>ورود به آپدیت و پشتیبانی</h1>
  <?php if ($error): ?><div class="msg-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <form method="post">
    <input type="hidden" name="csrf" value="<?= htmlspecialchars($token) ?>">
    <label for="password">رمز عبور</label>
    <div class="field">
      <input type="password" id="password" name="password" autofocus required <?= $lockedFor > 0 ? 'disabled' : '' ?>>
      <button class="eye" type="button" onclick="togglePassword('password', this)" title="نمایش رمز"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg></button>
    </div>
    <button type="submit" <?= $lockedFor > 0 ? 'disabled' : '' ?>>ورود</button>
  </form>
  </div>
<?php else: ?>
  <div class="top-header">
    <div>
      <h1>آپدیت و پشتیبانی</h1>
      <small>مدیریت نسخه‌ی دسکتاپ و رسیدگی به تیکت‌های پشتیبانی مشتریان</small>
    </div>
    <div class="top-header-actions">
      <a href="?tab=password" class="pill-btn">تغییر رمز</a>
      <a href="?logout=1" class="pill-btn">خروج</a>
    </div>
  </div>

  <?php if ($tab !== 'password'): ?>
  <div class="tabs">
    <a class="tab-link <?= $tab === 'update' ? 'active' : '' ?>" href="?tab=update">بروزرسانی</a>
    <a class="tab-link <?= $tab === 'support' ? 'active' : '' ?>" href="?tab=support">پشتیبانی<?= $openTicketCount > 0 ? ' (' . $openTicketCount . ')' : '' ?></a>
  </div>
  <?php endif; ?>

  <?php if ($error): ?><div class="msg-error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
  <?php if ($success): ?><div class="msg-success"><?= htmlspecialchars($success) ?></div><?php endif; ?>
  <?php if ($dbError): ?><div class="msg-error"><?= htmlspecialchars($dbError) ?></div><?php endif; ?>

  <?php if ($tab === 'password'): ?>
    <div class="card login-card">
      <h1>تغییر رمز عبور</h1>
      <div class="hint">رمز جدید حداقل باید ۸ کاراکتر باشد.</div>
      <form method="post">
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($token) ?>">
        <input type="hidden" name="action" value="change_password">
        <label for="current_password">رمز فعلی</label>
        <div class="field">
          <input type="password" id="current_password" name="current_password" autofocus required>
          <button class="eye" type="button" onclick="togglePassword('current_password', this)" title="نمایش رمز"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg></button>
        </div>
        <label for="new_password">رمز جدید</label>
        <div class="field">
          <input type="password" id="new_password" name="new_password" required minlength="8">
          <button class="eye" type="button" onclick="togglePassword('new_password', this)" title="نمایش رمز"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg></button>
        </div>
        <label for="new_password_confirmation">تکرار رمز جدید</label>
        <div class="field">
          <input type="password" id="new_password_confirmation" name="new_password_confirmation" required minlength="8">
          <button class="eye" type="button" onclick="togglePassword('new_password_confirmation', this)" title="نمایش رمز"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg></button>
        </div>
        <button type="submit">ذخیره رمز جدید</button>
      </form>
      <div style="margin-top:14px;">
        <a class="btn secondary" href="?tab=update">بازگشت به پنل</a>
      </div>
    </div>

  <?php elseif ($tab === 'update'): ?>
    <div class="card">
      <form method="post">
        <input type="hidden" name="csrf" value="<?= htmlspecialchars($token) ?>">
        <input type="hidden" name="action" value="save">
        <label for="version">نسخه (version)</label>
        <input type="text" id="version" name="version" value="<?= htmlspecialchars($current['version']) ?>" placeholder="مثال: 1.2.3" required>
        <label for="message">پیام بروزرسانی (message)</label>
        <textarea id="message" name="message" placeholder="متن پیامی که به کاربر نمایش داده می‌شود"><?= htmlspecialchars($current['message']) ?></textarea>
        <label for="url">لینک دانلود (url)</label>
        <input type="text" id="url" name="url" value="<?= htmlspecialchars($current['url']) ?>" placeholder="https://...">
        <button type="submit">ذخیره</button>
      </form>
      <div class="current-box">
        مسیر فایل: <?= htmlspecialchars(JSON_PATH) ?>
      </div>
    </div>

    <div class="card" style="margin-top:18px;">
      <div class="section-title" style="font-weight:bold; margin-bottom:6px;">تاریخچه‌ی نسخه‌های منتشرشده</div>
      <?php if (!$updateHistory): ?>
        <div class="empty">هنوز نسخه‌ای در تاریخچه ثبت نشده (فقط نسخه‌هایی که از همین صفحه ذخیره شوند، از این به بعد اینجا نمایش داده می‌شوند).</div>
      <?php else: ?>
        <table>
          <tr><th>نسخه</th><th>پیام</th><th>لینک</th><th>تاریخ انتشار</th></tr>
          <?php foreach ($updateHistory as $row): ?>
            <tr>
              <td><?= htmlspecialchars((string) $row['version']) ?></td>
              <td><?= nl2br(htmlspecialchars((string) $row['message'])) ?></td>
              <td style="direction:ltr; text-align:left;"><?php if ($row['url']): ?><a href="<?= htmlspecialchars((string) $row['url']) ?>" target="_blank" rel="noopener"><?= htmlspecialchars((string) $row['url']) ?></a><?php endif; ?></td>
              <td><?= htmlspecialchars((string) $row['published_at']) ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
    </div>

  <?php else: ?>
    <div class="card">
      <div class="section-title" style="font-weight:bold; margin-bottom:6px;">تیکت‌های پشتیبانی</div>
      <?php if (!$supportTickets): ?>
        <div class="empty">هنوز هیچ گزارش تشخیصی‌ای از پنل مشتری‌ها آپلود نشده است.</div>
      <?php else: ?>
        <?php foreach ($supportTickets as $t): ?>
          <div class="ticket">
            <div class="ticket-head">
              <div class="ticket-customer"><?= htmlspecialchars((string) ($t['customer_name'] ?? '—')) ?> — <?= htmlspecialchars((string) ($t['customer_mobile'] ?? '—')) ?></div>
              <?= scb_status_badge((string) $t['status']) ?>
            </div>
            <div class="ticket-meta">
              <?php if ($t['license_key']): ?>
                لایسنس: <span class="license-key"><?= htmlspecialchars((string) $t['license_key']) ?></span>
                (<?= htmlspecialchars((string) $t['license_plan']) ?>، انقضا: <?= htmlspecialchars((string) ($t['license_expires_at'] ?? '—')) ?>)
              <?php else: ?>
                لایسنسی برای این تیکت ثبت نشده.
              <?php endif; ?>
              &middot; ارسال‌شده: <?= htmlspecialchars((string) $t['created_at']) ?>
            </div>
            <div>
              <a class="btn secondary" style="margin-top:0; padding:8px 16px; font-size:13px;" href="?tab=support&download=<?= (int) $t['id'] ?>">دانلود فایل: <?= htmlspecialchars((string) $t['original_filename']) ?></a>
            </div>
            <?php if ($t['customer_note']): ?>
              <div class="ticket-reply-box" style="background:#f9fafb; color:#334155;">یادداشت مشتری: <?= nl2br(htmlspecialchars((string) $t['customer_note'])) ?></div>
            <?php endif; ?>
            <?php if ($t['admin_reply']): ?>
              <div class="ticket-reply-box">پاسخ ثبت‌شده: <?= nl2br(htmlspecialchars((string) $t['admin_reply'])) ?></div>
            <?php endif; ?>
            <?php if ($t['status'] !== 'closed'): ?>
            <div class="ticket-actions">
              <form method="post">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars($token) ?>">
                <input type="hidden" name="action" value="reply">
                <input type="hidden" name="ticket_id" value="<?= (int) $t['id'] ?>">
                <textarea name="reply_text" placeholder="پاسخی که توی «پیام‌ها»ی برنامه‌ی همین کاربر نشان داده می‌شود..."></textarea>
                <button type="submit" style="margin-top:0;">ارسال پاسخ</button>
              </form>
              <form method="post" onsubmit="return confirm('این تیکت بدون پاسخ بسته شود؟');">
                <input type="hidden" name="csrf" value="<?= htmlspecialchars($token) ?>">
                <input type="hidden" name="action" value="close_ticket">
                <input type="hidden" name="ticket_id" value="<?= (int) $t['id'] ?>">
                <button type="submit" class="secondary" style="margin-top:0;">بستن بدون پاسخ</button>
              </form>
            </div>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  <?php endif; ?>

<?php endif; ?>
</div>
<style>footer.site-footer{position:relative!important;z-index:999!important;clear:both!important;background:#0f172a!important;color:#cbd5e1!important;padding:26px 20px!important;text-align:center!important;border-top:2px solid #3b82f6!important;line-height:2!important;}footer.site-footer a{color:#93c5fd!important;font-weight:bold!important;margin:0 8px!important;text-decoration:none!important;}footer.site-footer a:hover{color:#fff!important;text-decoration:underline!important;}</style><footer class="site-footer"><div><a href="/privacy">حریم خصوصی</a> | <a href="/terms">شرایط استفاده</a> | <a href="https://wa.me/989136346309">پشتیبانی واتساپ</a><div style="margin-top:8px;font-size:13px;color:#94a3b8;">© 1405 Scanbridge — تمامی حقوق محفوظ است.</div></div></footer>
<script>
function togglePassword(id,btn){
var el=document.getElementById(id);if(!el)return;
var open='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>';
var closed='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-10-8-10-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 10 8 10 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>';
if(el.type==='password'){el.type='text';btn.innerHTML=closed;}
else{el.type='password';btn.innerHTML=open;}
}
</script>
</body>
</html>
