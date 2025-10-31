<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>[RU] | Gold Luxury Republic</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <div class="logo">
                <a href="index.php">[RU] | Gold Luxury Republic</a>
            </div>
            <nav class="nav">
                <a href="index.php" class="<?php echo $current_page == 'index.php' ? 'active' : ''; ?>">Главная</a>
                <a href="divisions.php" class="<?php echo $current_page == 'divisions.php' ? 'active' : ''; ?>">Подразделения</a>
                <a href="planets.php" class="<?php echo $current_page == 'planets.php' ? 'active' : ''; ?>">Планеты</a>
                <a href="charter.php" class="<?php echo $current_page == 'charter.php' ? 'active' : ''; ?>">Устав</a>
                <a href="contacts.php" class="<?php echo $current_page == 'contacts.php' ? 'active' : ''; ?>">Контакты</a>
            </nav>
        </div>
    </header>
    <main>