<header class="">
  <div class="inHeader clear">
      <div class="drawer" id="menubtn">
        <img src="./image/icon/btnOpen.png">
      </div>
      <div class="inTitleBox">
        <h1><a href="<?= SITE_URL.'/index.php' ?>">
    <?= SITE_TITLE?></a></h1>
      </div>
      <div class="loginInfoBox">
        <?php if($app->isLoggedIn()): ?>
          <p><a href="./userAccount.php">アカウント
        <?php else: ?>
          <p><a href="./login.php">ログイン
        <?php endif; ?>
          </a></p>
      </div>
  </div><!-- inHeader -->
</header>


  <nav class="drwerMenuBox">
    <div class="inDrwerMenuBox">
        <?php if($app->isLoggedIn()): ?>
          <h2 class="greet">こんにちは<?= h($app->me()->userName);?>さん</h2>
          <ul>
            <li><a href="userAccount.php">アカウント管理</a></li>
            <li><a href="createQuest.php">アンケートを作成する</a></li>
            <li><form action="logout.php" method="post" id="logout">
              <p><input type="submit" value="ログアウト">
              <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>"></p>
            </form></li>
          </ul>

        <?php else :?>
          <ul>
          <li class="login"><a href="login.php">ログイン</a></li>
          <li class="signup"><a href="signup.php">アカウント作成はこちら</a></li>
        </ul>
        <?php endif; ?>
    </div>
  </nav>




<div class="overlay"></div>
