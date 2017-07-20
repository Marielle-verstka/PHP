<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shop</title>
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
<!-- TopBar. Место для контактной информации и кнопок соцсетей-->
<div class="b-topbar">
    <div class="topbar">
        <span class="topbar__location">Днепр</span>
        <a href="tel:+380988888888" class="topbar__telephone">+380988888888</a>
    </div>
</div>
<!-- ***HEADER*** -->
<header class="header">
    <!-- Здесь еще должна быть корзина и кнопка авторизации -->
    <div class="header__line">
        <!-- Logo -->
        <a href="#" class="header__logo">LOGO
            <img src="" alt="" class="logo">
        </a>
        <!-- Menu -->
        <nav class="menu" style="font-size: 16px; color: #000;">
            <ul class="b-menu">
            <?php
                require_once "menu.php";
                if ($menu):
            ?>
                <?php foreach ($menu as $item): ?>
                    <?php if ($item -> visible): ?>
                        <?php if ($item -> menu_id == 1): ?>
                            <li class="menu__item">
                                <a href="<?php echo $item -> url ?>" class="menu__link"><?php echo $item -> name ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
<!--            </ul>-->
<!--            <ul class="b-menu">-->
<!--                <li class="menu__item"><a href="" class="menu__link">Главная</a></li>-->
<!--                <li class="menu__item"><a href="" class="menu__link sale">Акции</a></li>-->
<!--                <li class="menu__item"><a href="" class="menu__link">Оплата и доставка</a></li>-->
<!--                <li class="menu__item"><a href="" class="menu__link">Контакты</a></li>-->
<!--                <li class="menu__item"><a href="" class="menu__link">Поддержка</a></li>-->
<!--            </ul>-->
        </nav>
    </div>
    <div class="header__line header__line-search">
        <!-- Строка и иконка каталог-->
        <div class="category">
            <span class="category__icon">
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
                <span class="line"></span>
            </span>
            <span class="category__caption">Каталог товаров</span>
        </div>
        <!-- Поиск -->
        <form action="" method="get" id="search" class="search">
            <input type="text" name="q" autocomplete="off" class="search__input" placeholder="Что вы хотите купить?">
            <button type="submit" class="search__button">Найти</button>
        </form>
    </div>
</header>
<!-- ***CONTENT*** -->
<div class="b-content">
    <!-- ***ASIDE (left)*** -->
    <aside>
        <!-- Категории -->
        <div class="b-categories">
            <ul class="categories">
                <li class="categories__item"><a href="" class="categories__link">Категория 1</a></li>
                <li class="categories__item"><a href="" class="categories__link">Категория 2</a></li>
                <li class="categories__item"><a href="" class="categories__link">Категория 3</a></li>
                <li class="categories__item"><a href="" class="categories__link">Категория 4</a></li>
                <li class="categories__item"><a href="" class="categories__link">Категория 5</a></li>
                <li class="categories__item"><a href="" class="categories__link">Категория 6</a></li>
                <li class="categories__item"><a href="" class="categories__link">Категория 7</a></li>
                <li class="categories__item"><a href="" class="categories__link">Категория 8</a></li>
                <li class="categories__item"><a href="" class="categories__link">Категория 9</a></li>
                <li class="categories__item"><a href="" class="categories__link">Категория 10</a></li>
            </ul>
        </div>
    </aside>
    <!-- ***MAIN*** -->
    <div class="container">
        <main class="b-main">
            <!-- Вывод товара -->
            <?php
                require_once "products.php";
                if($products):
            ?>
                <?php foreach ($products as $product): ?>
                    <?php if ($product -> visible): ?>
                        <div class="b-preview">
                            <div class="preview">
                                <span class="preview__date"><?php echo date('m.d.y',strtotime($product -> created)); ?></span>
                                <a href="" class="preview__img">
                                    <img src="img/hw.jpg" alt="">
                                </a>
                                <div class="preview__info">
                                    <a href="<?php echo $product -> url; ?>" class="preview__title"><?php echo $product -> name; ?></a>
                                    <span class="preview__price"><?php echo ceil($product -> variant -> price); ?> грн.</span>
                                    <span class="preview__article"></span>
                                    <?php if (count($product -> variants) > 1): ?>
                                        <select class="preview__select">
                                            <?php foreach ($product -> variants as $item) :?>
                                                <?php if ($item -> id != $product -> variant -> id): ?><!-- Предупреждает выводв селект товара из массива variant-->
                                                    <option value=""><?php echo ceil($item -> price); ?> грн.</option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                    <div class="preview__control">
                                        <div class="preview__b-more">
                                            <span class="preview__more">Подробнее</span>
                                        </div>
                                        <button type="button" class="buy">
                                            <span>Купить</span>
                                        </button>
                                        <!-- Рopup для подробнее-->
                                        <div class="preview__b-popup">
                                            <div class="preview__popup">
<!--                                                <div class="popup__img">-->
<!--                                                    <img src="">-->
<!--                                                </div>-->
                                                <div class="popup__info">
                                                    <span class="popup__content">В комплекте 1 машинка</span>
                                                    <span class="popup__content">Масштаб машинки 1:64</span>
                                                    <span class="popup__content">Возраст: для детей от 3 лет</span>
                                                    <span class="popup__content">Спешите! Осталось <span class="<?php echo $product -> variant -> stock == 0 ? "red" : "green"?>"> <?php echo ceil($product -> variant -> stock); ?></span> шт.</span> <!--Если товара 0, то делаем цвет вывода красным, иначе зеленым -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </main>
        <!-- Новинки-->
        <section class="b-novelties">
            <div class="novelties">
                <h3 class="novelties__title">Новинки</h3>
                    <?php
                        require_once "products.php";
                        if($products):
                    ?>
                        <?php foreach ($products as $product): ?>
                            <?php if ($product -> visible): ?>
                                <div class="novelty">
                                    <span class="novelty__title"><?php echo $product -> name; ?></span>
                                    <span class="novelty__price"><?php echo ceil($product -> variant -> price); ?> грн.</span>
                                    <div class="novelty__b-popup">
                                        <div class="novelty__popup">
                                            <div class="novelty__popup-img"><img src="" alt=""></div>
                                            <div class="novelty__popup-content">
                                                <a href="<?php echo $product -> url; ?>" class="novelty__popup-title"><?php echo $product -> name; ?></a>
                                                <span class="novelty__popup__price">Стоимость: <?php echo ceil($product -> variant -> price); ?> грн.</span>
                                                <span class="novelty__popup__stock">Количество товаров на складе: <?php echo ceil($product -> variant -> stock); ?> шт.</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
            </div>
        </section>
    </div>
</div>
</body>
</html>