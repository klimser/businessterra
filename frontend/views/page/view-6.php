<?php

use yii\bootstrap4\Html;
use himiklab\yii2\recaptcha\ReCaptcha;

/* @var $this \yii\web\View */
/* @var $page common\models\Page */
/* @var $webpage common\models\Webpage */

//$this->params['breadcrumbs'][] = $page->title;

$nowDate = new \DateTime();
$targetDate = new \DateTime('2018-10-20 09:00:00');
$this->registerJs(<<<SCRIPT
    MainPage.nowDate = new Date("{$nowDate->format(DateTime::ATOM)}");
    MainPage.targetDate = new Date("{$targetDate->format(DateTime::ATOM)}");
    MainPage.init();
    $('[data-toggle="popover"]').popover();
    window.setInterval(function(){MainPage.setTimeRemaining();}, 1000);
SCRIPT
); ?>

<div id="yakuba">
    <header>
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-4 order-last col-sm-3 col-md-2 order-sm-first text-center pt-3 pt-sm-0 mb-5">
                    Ташкент
                    <div class="red-text font-weight-black date">23</div>
                    <div class="font-weight-bold">января</div>
                </div>
                <div class="col-4 col-sm-3 col-md-2">
                    <img src="<?= Yii::$app->homeUrl; ?>assets/grunt/images/bt-logo.svg" class="img-fluid" alt="Business Terra">
                </div>
                <div class="w-100 d-sm-none"></div>
            </div>
            <div class="row mt-5 mt-sm-3">
                <div class="col font-weight-black text-uppercase text-right header-title">
                    продажи
                </div>
            </div>
            <div class="row">
                <div class="col text-uppercase text-right header-title">
                    в условиях
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-9 col-sm-8 col-md-7 col-lg-5 text-right">
                    <img src="<?= Yii::$app->homeUrl; ?>assets/grunt/images/yakuba/hard.svg" class="img-fluid" alt="жёсткой">
                </div>
            </div>
            <div class="row">
                <div class="col text-uppercase text-right header-title">
                    конкуренции
                </div>
            </div>
            <div class="row justify-content-between align-items-end mt-3">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5">
                    <div class="row">
                        <div class="col-6">
                            <button class="btn btn-block red-button-outline text-uppercase text-left px-1 px-sm-3 py-1" data-toggle="modal" data-target="#program_frame">программа<br> курса</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-block red-button text-uppercase text-center px-1 px-sm-3 py-3" onclick="MainPage.launchModal();">купить билет</button>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-sm-4 col-md-6 col-lg-7 order-sm-first font-italic pt-3 pt-sm-0">
                    Владимир <span class="red-text">Якуба</span>
                </div>
            </div>
        </div>
    </header>

    <?php /*
    <div class="container speaker-info">
        <div class="row d-md-none">
            <div class="col speaker-bg">
                <span class="red-label">Впервые в Ташкенте</span><br>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-5">
                <span class="red-label d-none d-md-inline">Впервые в Ташкенте</span><br><br>
                <h1>Дмитрий Карнаухов</h1>
                <dl class="main-list">
                    <dt>Бизнес с нуля</dt>
                    <dd>
                        С чего начать? Как выбрать нишу?<br>
                        Стоит ли вкладывать деньги и сколько?
                    </dd>

                    <dt>Поколение Z</dt>
                    <dd>
                        Что такое поколение Z?<br>
                        Что важно знать о поколении?<br>
                        Как работать с таким поколением?
                    </dd>

                    <dt>Найм персонала</dt>
                    <dd>
                        Кого нанимать чтобы вырасти?<br>
                        Как собрать команду мечты?<br>
                        Мотивация персонала
                    </dd>
                </dl>
                <div class="red-bold-frame">
                    <h3>VIP ужин</h3>
                    <ul class="list-unstyled vawes-bg list-over">
                        <li>Закрытая встреча с 20-ти участниками</li>
                        <li>Личный разбор каждого участника</li>
                    </ul>
                </div>
            </div>
            <div class="d-none d-md-block col-md-6 col-lg-7 speaker-bg"></div>
        </div>
    </div>


    <div class="bg-1">
        <div class="container">
            <div class="py-5 text-center">
                <div class="timer-block">
                    <iframe width="560" height="315" style="max-width: 100%;" src="https://www.youtube.com/embed/1lgbjXv9UpE" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <?php /*<div class="block-title">Успейте приобрести билет по самой низкой цене!</div>
                    <div class="font-thin">До вашего очень полезного семинара осталось:</div>
                    <div class="timer">
                        <div class="remain-time-block">
                            <div class="remain remain-day"></div>
                            <div class="remain remain-hour"></div>
                            <div class="remain remain-minute"></div>
                            <div class="remain remain-second"></div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="remain-titles-block">
                            <div class="remain-title">дней</div>
                            <div class="remain-title">часов</div>
                            <div class="remain-title">минут</div>
                            <div class="remain-title">секунд</div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <button class="red-label-button" onclick="MainPage.launchModal();">Приобрести билет</button>* / ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Этот Бизнес-интенсив именно для вас если:</h2>
        <div class="row icons-container">
            <div class="col-12 col-sm-6 col-md-4">
                <div class="icon-block text-center">
                    <div class="icon-pic icon-pic-1"></div>
                    <div class="text-center">
                        Хотите прокачать<br> свои лидерские навыки
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="icon-block text-center">
                    <div class="icon-pic icon-pic-2"></div>
                    <div class="text-center">
                        Хотите запустить<br> бизнес без потерь
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="icon-block text-center">
                    <div class="icon-pic icon-pic-3"></div>
                    <div class="text-center">
                        Хотите научится управлять<br> сотрудниками качественно
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="icon-block text-center">
                    <div class="icon-pic icon-pic-4"></div>
                    <div class="text-center">
                        Работаете в топ-менеджменте<br> или на управленческой должности
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="icon-block text-center">
                    <div class="icon-pic icon-pic-5"></div>
                    <div class="text-center">
                        В поисках новых идей,<br> инсайтов чтобы двигаться вперед
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4">
                <div class="icon-block text-center">
                    <div class="icon-pic icon-pic-6"></div>
                    <div class="text-center">
                        Хотите наконец-то<br> заработать на своём деле
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-2">
        <div class="container">
            <h2>ПРИХОДИТЕ НА МАСТЕР-КЛАСС СО СВОЕЙ КОМАНДОЙ ЧТОБЫ</h2>
            <div class="row icons-container">
                <div class="col-12 col-sm-4">
                    <div class="icon-block-red text-center">
                        <div class="icon-pic icon-pic-7"></div>
                        <div class="text-center">
                            Быть продуктивнее вместе с командой
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="icon-block-red text-center">
                        <div class="icon-pic icon-pic-8"></div>
                        <div class="text-center">
                            Вдохновить на новые идеи
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="icon-block-red text-center">
                        <div class="icon-pic icon-pic-9"></div>
                        <div class="text-center">
                            Раньше всех увеличить свои показатели
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="speaker-biografy-block container vawes-bg">
        <div class="row">
            <div class="col-12 col-sm-7 col-sm-push-5 speaker-biografy">
                <h2>Дмитрий Карнаухов</h2>
                <dl>
                    <dt>Образование:</dt>
                    <dd>Кандидат психологических наук;</dd>
                    <dd>2 образования МВА</dd>

                    <dt>Опыт:</dt>
                    <dd>Практик с 13-летним опытом работы в должности Директора по персоналу в крупных компаниях, в том числе в «тысячниках» из списка Forbes;</dd>
                    <dd>Бизнес-тренер с опытом проведения ряда управленческих тренингов в масштабах России и СНГ</dd>

                    <dt>Компетенции:</dt>
                    <dd>Автор более 40 научных статей и публикаций в области психологии и управления персоналом;</dd>
                    <dd>Официальный Спикер компании "Head Hunter", официальный спикер компании "Деловая среда" от Сбербанка; </dd>
                    <dd>Основатель компании «Д.А. Консалт», тренинговой компании и кадрового агентства HR365;</dd>
                    <dd>В рамках БМ: Тренер, член команды "300 тигров Петра Осипова", член экспертного совета HR-ов, автор мастер-классов, приглашенный спикер на тренерстве по темам управления персоналом, один из Админов чатов БМ.</dd>

                    <dt>Заказчики:</dt>
                    <dd>Многие Тренеры БМ. За 4 года закрыл больше 600 разных вакансий в РФ, Украине, Казахстане, без учёта массподбора.</dd>
                </dl>
            </div>
            <div class="col-12 col-sm-5 col-sm-pull-7 speaker-portrait"></div>
        </div>
    </div>

    <div class="bg-3">
        <div class="container">
            <h2>Выберите билет, подходящий именно Вам:</h2>
            <div class="row tariffs-block">
                <div class="col-12 col-sm-4">
                    <div class="tariff-block text-center">
                        <div class="block-title">Platinum</div>
                        (1 490 000 сум)
                        <div class="block-body">
                            <ul class="list-unstyled">
                                <li>Программа мастер-класса</li>
                                <li>2 кофе-брейка и обед</li>
                                <li>Сертификат о прохождении</li>
                                <li>VIP ужин</li>
                                <li>Личный разбор</li>
                            </ul>
                        </div>
                        <button class="order-button" onclick="MainPage.launchModal();">ЗАКАЗАТЬ БИЛЕТ</button>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="tariff-block text-center">
                        <div class="block-title">Gold</div>
                        (990 000 сум)
                        <div class="block-body">
                            <ul class="list-unstyled extra-padding">
                                <li>Программа мастер-класса</li>
                                <li>2 кофе-брейка и обед</li>
                                <li>Сертификат о прохождении</li>
                                <li>Места в середине зала</li>
                            </ul>
                        </div>
                        <button class="order-button" onclick="MainPage.launchModal();">ЗАКАЗАТЬ БИЛЕТ</button>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="tariff-block last-tariff-block text-center">
                        <div class="block-title">Silver</div>
                        (790 000 сум)
                        <div class="block-body">
                            <ul class="list-unstyled extra-padding">
                                <li>Программа мастер-класса</li>
                                <li>2 кофе-брейка и обед</li>
                                <li>Сертификат о прохождении</li>
                                <li>Места в конце зала</li>
                            </ul>
                        </div>
                        <button class="order-button" onclick="MainPage.launchModal();">ЗАКАЗАТЬ БИЛЕТ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container vawes-bg order-block">
        <div class="timer-block">
            <div class="block-title">Оставьте заявку на мастер класс и получите полный тайминг</div>
            <div class="font-thin">До вашего очень полезного семинара осталось:</div>
            <div class="timer">
                <div class="remain-time-block">
                    <div class="remain remain-day"></div>
                    <div class="remain remain-hour"></div>
                    <div class="remain remain-minute"></div>
                    <div class="remain remain-second"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="remain-titles-block">
                    <div class="remain-title">дней</div>
                    <div class="remain-title">часов</div>
                    <div class="remain-title">минут</div>
                    <div class="remain-title">секунд</div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="row order_form">
            <?= Html::beginForm(\yii\helpers\Url::to(['order/create']), 'post', ['onsubmit' => 'return MainPage.completeOrder(this);']); ?>
                <div class="order_form_body">
                    <input type="hidden" name="order[subject]" value="Дмитрий Карнаухов">
                    <div class="col-12 col-sm-6 col-md-5">
                        <input name="order[name]" class="form-control" required minlength="2" maxlength="50" placeholder="Ваше имя"><br>
                        <div class="input-group"><span class="input-group-addon">+998</span>
                            <input type="tel" name="order[phoneFormatted]" class="form-control order-phone" maxlength="11" pattern="\d{2} \d{3}-\d{4}" required placeholder="Ваш номер телефона">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4">
                        <?= ReCaptcha::widget(['name' => 'order[reCaptcha]', 'theme' => 'dark']) ?>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3">
                        <button class="complete-button">Получить тайминг</button>
                    </div>
                </div>
                <div class="order_form_extra hidden"></div>
            <?= Html::endForm(); ?>
            </div>
        </div>
    </div>

    <div class="bg-1">
        <div class="container">
            <div class="timer-block">
                <div class="font-thin">Партнёры:</div>
                <br>
                <div>
                    <div class="row">
                        <div class="col-12 col-sm-4 partner-logo logo-sm"></div>
                        <div class="col-12 col-sm-4 partner-logo logo-nmc"></div>
                        <div class="col-12 col-sm-4 partner-logo logo-5p"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="vawes-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-4">
                    <div class="red-icon icon icon-location float-left"></div>
                    <div class="float-left">Ташкент Business Terra,<br> Oybek street, 16</div>
                </div>
                <div class="col-12 col-sm-4 col-md-3">
                    <div class="red-icon icon icon-bell float-left"></div>
                    <div class="float-left">20 октября<br> с 9.00 до 19.00</div>
                </div>
                <div class="col-12 col-sm-4 col-md-3 col-md-offset-2">
                    <a class="font-bigger" href="tel:+99890-965-83-31">+99890 965 83 31</a><br>
                    <a class="font-bigger" href="tel:+99890-178-28-07">+99890 178 28 07</a><br>
                    <button class="red-button" onclick="MainPage.launchModal();">Обратный звонок</button>
                </div>
            </div>
            <div class="row" style="padding-top: 15px;">
                <div class="col-12 text-center">
                    Сайт сделал <a href="https://sergey-klimov.ru"><b>Сергей Климов</b></a>
                </div>
            </div>
        </div>
    </footer>
 */ ?>

    <div id="program_frame" class="modal fade program_frame" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Программа</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <dl>
                        <dt>КОНКУРЕНТНЫЕ «БОИ» в продажах</dt>
                        <dd>6 новых трендов продаж 2018 года. УПЦ – показатель. 8 пунктов первых 60 секунд: что делают сильные конкуренты и почему они быстрее? Как становиться «своим» с первых секунд холодного контакта. 3 правила повышенной «симпатии» на другом конце телефонной трубки. Как опережать конкурентов – новые технологии «разведки». Что делать, если твое предложение клиенту аналогично с предложением конкурента? Жесткая конкуренция – источник новых возможностей.</dd>
                        <dt>ТЕЛЕФОННЫЕ ПРОДАЖИ в новом стиле</dt>
                        <dd>Презентация лично и по телефону. Алгоритм составления «легких» скриптов под компанию. Как это делают другие? Подходы «Ростелеком», «Кирби», «Биткойновцев», «Спортмастер». Базовый ППВУ – скрипт. 8 принципов составления идеальных скриптов. Как переводить каждый звонок в режим «легко».</dd>
                        <dt>Реалити-звонок. Переговоры со сложным клиентом.</dt>
                        <dt>ПРОДАЖИ через РЕКОМЕНДАЦИИ</dt>
                        <dd>4 стадии получения «мягких» рекомендаций. Как проверить - любит ли клиент рекомендовать? 8 правил рекомендательного маркетинга. Принцип “медового месяца”. Личные и онлайн рекомендации. Как рассказывать истории и вовлекать клиента. Построение коммуникаций с клиентом. 1+3.</dd>
                        <dt>БЕСКОНТАКТНЫЕ ПРОДАЖИ</dt>
                        <dd>12 инструментов для автопродаж: Quiz лэндинг, автоворонки продаж, спам по-белому, видео-презентации, автовебинары и онлайн трансляции, инстаграм-продажи, рассылка вконтакте, чат-боты и автопродавцы. Роботы онлайн продаж. Самые короткие пути к клиенту: от мессенджеров до Instagram-продаж. Приемы 15-60, аккуратное давление, геолокация вместо адресов, скрипты онлайн-дожима. Как снизить стоимость клиентов в 3 раза? Геймификация: как научить клиента покупать, играя, и получать удовольствие?</dd>
                        <dt>ЛИЧНЫЕ ПРОДАЖИ 1Х1</dt>
                        <dd>3 скрипта для безальтернативного назначения личной встречи. 2 составляющие жесткого подтверждения переговоров. Как управлять «дистанцией», не скатываясь в «панибратство». 3 инструмента для снижения страха и повышения уверенности: «А это поможет?», «Страх-опасность», «Вариации». Техника min-lim. 5 вариантов расположения на переговорах. Атмосфера на встрече (интонация, громкость, жесты и др.). 3 стандарта позиции ВВП. Методы запоминания имен. Поглаживания или комплименты: метод ИКС.</dd>
                        <dt>КАК ПРОДАВАТЬ «ДОРОГО»? ЛИЧНЫЙ БРЕНД ПРОДАВЦА</dt>
                        <dd>5 векторов личного брендинга для переговорщика: стиль, «бренд-бук с собой», профили в социальных сетях, работа со СМИ, участие в мероприятиях. Брендинг с бюджетом «0».</dd>
                        <dt>ВОЗРАЖЕНИЯ И КОНТРМАНИПУЛЯЦИИ</dt>
                        <dd>Как пресечь «наезды» клиентов? 16 новых приемов обработки возражений. Приемы сизый-зеленый, «УТП», «наезд», «может быть», «100% через полгода», прием уточнений, «давай сначала», лектор, «придирка к деталям», «взгляд в прошлое», радоваться-грустить, «почему», «разбор», «признание» и пр. Что делать, если продажам мешает «откат»?</dd>
                        <dt>САМОАВТОМАТИЗАЦИЯ ОТДЕЛА ПРОДАЖ и БИЗНЕС-ПРОЦЕССЫ</dt>
                        <dd>ИКТ – CRM – Напоминание – Действие. SNW-анализ. Зоны влияния сотрудников. Как исключить конфликт интересов менеджеров. 1000-5000. ОБ/АБ – деление. ABCD-анализ. Как научить менеджера расставлять приоритеты и не тратить силы на «прохожих». 2 главных показателя для коммерческого директора. Ежедневные пятиминутки и эффективные совещания за 28 минут. Как удерживать «уходящих клиентов». Способы «взращивания» клиента.</dd>
                        <dt>САМОМОТИВАЦИЯ НА ПОДВИГИ</dt>
                        <dd>Как «зажечь себя?». Простая модель зарплаты: «Б-А-Д», конкурсы, дисциплина «рублем». Почти нефинансовые приемы: доска с планом, «короткие деньги», «должность как в Банке Москвы», «Переходящий приз», «Геймификация от МВИДЕО» и др. Мотивационные выступления 1х1 и с клиентами.</dd>
                        <dt>СКРЫТЫЕ РЕСУРСЫ МЕНЕДЖЕРОВ ПО ПРОДАЖАМ</dt>
                        <dd>6 «помощников» менеджера по продажам. «Умный» офис и рабочее место. Эмоциональная разгрузка в рабочее время. 3 формата корпоративного обучения для новичков.</dd>
                    </dl>
                </div>
                <div class="modal-footer">
                    <a class="btn red-button-outline" href="<?= Yii::$app->homeUrl; ?>uploads/yakuba-program.pdf"><span class="fas fa-download"></span> скачать программу</a>
                </div>
            </div>
        </div>
    </div>

    <div id="order_form" class="modal fade order_form" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <?= Html::beginForm(\yii\helpers\Url::to(['order/create']), 'post', ['onsubmit' => 'return MainPage.completeOrder(this);']); ?>
                <div class="modal-header border-bottom border-danger">
                    <h5 class="modal-title">Выберите билет, подходящий именно Вам</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <?php
                            $limit1 = new \DateTime('2019-01-01 00:00:00');
                            $limit2 = new \DateTime('2019-01-20 00:00:00');
                            $nowDate = new \DateTime();
                        ?>
                        <div class="col">
                            <button type="button" class="btn btn-lg btn-block red-button" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-html="true" data-content="Программа мастер-класса<br> 2 кофе-брейка и обед<br> Сертификат о прохождении<br> VIP ужин<br> Личный разбор">
                                Platinum<br>
                                <small>
                                <?php
                                    if ($nowDate < $limit1) echo '1 290 000';
                                    elseif ($nowDate < $limit2) echo '1 490 000';
                                    else echo '1 790 000';
                                ?>
                                </small>
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-lg btn-block red-button" data-toggle="popover" data-trigger="focus" data-placement="bottom" data-html="true" data-content="Программа мастер-класса<br> 2 кофе-брейка и обед<br> Сертификат о прохождении">
                                Gold<br>
                                <small>
                                <?php
                                    if ($nowDate < $limit1) echo '790 000';
                                    elseif ($nowDate < $limit2) echo '890 000';
                                    else echo '1 290 000';
                                ?>
                                </small>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center pt-2">
                            <small>
                            <?php
                                if ($nowDate < $limit1) echo 'успейте оставить заявку, цены действительны до ' . $limit1->format('d.m.Y');
                                elseif ($nowDate < $limit2) echo 'успейте оставить заявку, цены действительны до ' . $limit2->format('d.m.Y');
                            ?>
                            </small>
                        </div>
                    </div>
                    <div class="order_form_body mt-3 pt-3 border-top">
                        <input type="hidden" name="order[subject]" value="Владимир Якуба">
                        <div class="form-group">
                            <label for="order-name">Ваше имя</label>
                            <input name="order[name]" id="order-name" class="form-control" required minlength="2" maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="order-phone">Ваш номер телефона</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+998</span>
                                </div>
                                <input type="tel" name="order[phoneFormatted]" id="order-phone" class="form-control order-phone" maxlength="11" pattern="\d{2} \d{3}-\d{4}" required>
                            </div>
                        </div>
                        <?= ReCaptcha::widget(['name' => 'order[reCaptcha]', 'theme' => 'dark']) ?>
                    </div>
                    <div class="order_form_extra hidden"></div>
                </div>
                <div class="modal-footer border-top border-danger">
                    <button type="button" class="btn red-button-outline" data-dismiss="modal">отмена</button>
                    <button class="btn red-button">оставить заявку</button>
                </div>
                <?= Html::endForm(); ?>
            </div>
        </div>
    </div>
</div>