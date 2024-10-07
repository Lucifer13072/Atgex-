<nav class="navbar" style="background-color: #3b4244" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="nav-link" href="#">Atgex админ панель</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="main.php">Главная</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="news_manager.php">Менеджер новостей</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user_manager.php">Менеджер пользователей</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="chat.php">Рабочий чат</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="https://62.109.3.46:1501/roundcube/?_task=mail&_mbox=INBOX">Почта</a>
        </li>
        <form class='nav-item' method="post" action="/../scripts/php/logout.php">
            <button class='nav-link' type="submit">Выйти из аккаунта</button>
        </form>
      </ul>
    </div>
  </div>
</nav>