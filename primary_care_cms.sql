-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Час створення: Квт 27 2021 р., 10:48
-- Версія сервера: 5.6.38
-- Версія PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `primary_care_cms`
--

-- --------------------------------------------------------

--
-- Структура таблиці `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `og_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `articles`
--

INSERT INTO `articles` (`id`, `status`, `alias`, `category_id`, `created_at`, `updated_at`, `views`, `og_image`) VALUES
(2, 1, 'medical-reform-2018', 2, 1522342713, 1551458708, 952, ''),
(3, 1, 'plan-ncph', 3, 1522347394, 1559112878, 691, ''),
(4, 1, 'how-to-choose-a-family-doctor', 2, 1526544520, 1551458737, 1002, ''),
(5, 1, 'plan-ewwi', 1, 1556093382, 1556093628, 575, ''),
(6, 1, 'ophthalmologist-visits', 3, 1557383910, 1570720616, 1360, '/web/uploads/other/ophthalmologist.jpg'),
(7, 1, 'the-ministry-of-health-of-ukraine-lifted-the-age-limits-for-free-measles-vaccination', 3, 1557901813, 1559112921, 649, '/web/uploads/articles/stop-kir.jpg'),
(8, 1, 'how-to-get-the-available-medication', 2, 1558523256, 1558614937, 993, '/web/uploads/articles/nalipka_reimbursacija.png'),
(9, 1, 'change-the-mobile-number-or-terminate-your-doctors-declaration', 2, 1559890314, 1559895778, 1466, '/web/uploads/articles/change_phone_number.jpg'),
(11, 1, 'accounting-for-tangible-assets-inventories', 4, 1576658974, 1576661993, 493, ''),
(12, 1, 'accounting-for-fixed-assets', 4, 1576672406, 1576674740, 400, ''),
(14, 1, 'recommendations-for-those-suspected-or-ill-with-covid-19-who-are-at-home-on-self-isolation', 2, 1584535148, 1584535252, 736, '/web/uploads/articles/Koronavirus.jpg'),
(15, 1, 'order-of-the-ministry-of-health-of-ukraine-organization-of-medical-assistance-to-patients-with-coronavirus-disease-covid-19', 2, 1584607170, 1585552625, 326, '/web/uploads/articles/Covid-19.png'),
(16, 1, 'combating-coronavirus-sars-cov-2', 3, 1587455298, 1616950900, 261, '/web/uploads/articles/Koronavirus.jpg'),
(17, 1, 'financial-statements-2018', 4, 1588143824, 1588144127, 210, ''),
(18, 1, 'financial-statements-2019', 4, 1588144669, 1588145261, 230, ''),
(19, 1, 'may-19-world-family-physicians-day', 3, 1589910061, 1589910147, 194, '/web/uploads/articles/may-19-world-family-physicians-day.jpg'),
(20, 1, 'happy-medical-workers-day-2020', 3, 1592550729, 1592550844, 172, '/web/uploads/articles/medical-workers-day.jpg'),
(21, 1, 'flu', 2, 1600782729, 1600782843, 182, '/web/uploads/articles/pro-gryp.jpg'),
(22, 1, 'financial-statements-2020', 4, 1613034273, 1614271438, 11, ''),
(23, 1, 'automated-working-time-accounting-card-form-number-5', 4, 1615292481, 1615292747, 8, '');

-- --------------------------------------------------------

--
-- Структура таблиці `articles_i18n`
--

CREATE TABLE `articles_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_table_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `articles_i18n`
--

INSERT INTO `articles_i18n` (`id`, `parent_table_id`, `language`, `title`, `body`, `keywords`, `description`) VALUES
(1, 2, 'uk-UA', 'Медична реформа 2018', '<p><strong>Медична реформа&nbsp;розпочнеться в&nbsp;2018 році. Чого від неї чекати пацієнтам&nbsp;та лікарям</strong></p>\r\n\r\n<p><strong>Ваш лікар</strong></p>\r\n\r\n<p style=\"text-align:justify\">Реформа розпочнеться з первинної медичної допомоги, тобто сімейних лікарів, терапевтів та педіатрів. Ви можете звернутися до сімейного лікаря, терапевта або педіатра, як тільки відчуєте необхідність в обстеженні чи лікуванні. У розвинених країнах лікарі первинної меддопомоги без госпіталізації вирішують до 80% медичних звернень за допомогою сучасних знань, базової апаратури та найбільш розповсюджених аналізів та ліків.</p>\r\n\r\n<p style=\"text-align:justify\">Усі ці послуги будуть 100% покриватися з державного бюджету. Ваш лікар стане агентом сім&rsquo;ї в системі охорони здоров&rsquo;я. Він буде слідкувати за здоров&rsquo;ям і повністю забезпечувати первинну діагностику. Для цього лікар має бути мотивований, передусім &mdash; фінансово.</p>\r\n\r\n<p style=\"text-align:justify\">З 2018 року заклади первинної медичної допомоги, які уклали контракт&nbsp;з Національною службою здоров&rsquo;я, почнуть отримувати фінансування за новою моделлю &mdash; щорічну фіксовану виплату за обслуговування кожного пацієнта, з яким лікарі цього закладу підписали договір. Водночас розмір виплати на молодих людей та людей похилого віку суттєво відрізнятиметься з урахуванням збільшення кількості звернень у зв&rsquo;язку з віковими особливостями.</p>\r\n\r\n<p style=\"text-align:justify\">Важливо пам&rsquo;ятати, що заклад первинної ланки отримує за вас кошти і тоді, коли ви здорові. Чим менше ви хворієте, тим менше у лікаря роботи, а доходи ті самі. Так ми стимулюємо лікарів дбати про своїх пацієнтів. Ця модель ефективно працює в усьому світі.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Які послуги надаватиме&nbsp;ваш лікар?</strong></p>\r\n\r\n<p style=\"text-align:justify\">Лікар первинної медичної допомоги &mdash; це спеціаліст, який має всю інформацію про ваше здоров&rsquo;я. Завдяки цьому він бачить взаємозв&rsquo;язки та може визначити, на якій стадії потрібне втручання профільного спеціаліста.</p>\r\n\r\n<p style=\"text-align:justify\">Інформація про стан здоров&rsquo;я пацієнта буде міститися в електронній системі охорони здоров&rsquo;я. Навіть коли громадянин перейде до іншого лікаря, уся інформація буде доступна.</p>\r\n\r\n<p style=\"text-align:justify\">Головний обов&rsquo;язок лікаря первинної медичної допомоги &mdash; вчасно попередити або виявити захворювання на ранній стадії. А також надати невідкладну допомогу при гострих станах і раптових погіршеннях стану здоров&rsquo;я: високій температурі тіла, гострому і раптовому болю, порушенні серцевого ритму, кровотечі, інших станах, захворюваннях, отруєннях і травмах, що потребують невідкладної допомоги.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Чи буде цей лікар саме&nbsp;лікувати?</strong></p>\r\n\r\n<p style=\"text-align:justify\">Так. Лікар первинної допомоги, згідно з відповідним протоколом лікування, обстежує пацієнта та призначає необхідні аналізи, більшість з яких будуть проводитися одразу в амбулаторії. На основі отриманої інформації сімейний лікар приймає рішення про лікування як гострих, так і хронічних станів пацієнта.</p>\r\n\r\n<p style=\"text-align:justify\">За необхідності сімейний лікар дає направлення до профільних спеціалістів.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Що ще входитиме в його&nbsp;обов&rsquo;язки?</strong></p>\r\n\r\n<ol>\r\n	<li>профілактика захворювань у груп ризику;</li>\r\n	<li>вакцинація;</li>\r\n	<li>видача медичних довідок та лікарняних листків;</li>\r\n	<li>видача рецептів за програмою відшкодування вартості ліків &laquo;Доступні ліки&raquo;, у тому числі рецепти на ліки для хронічних хворих.</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Сімейний лікар у селі</strong></p>\r\n\r\n<p style=\"text-align:justify\">У селах сімейного лікаря обирає місцева громада. Тарифні ставки заробітної плати для лікаря первинної допомоги будуть скасовані. Сільські громади, нарешті, зможуть суттєво покращити первинну допомогу. Створивши для лікаря гарні умови життя і праці, села зможуть запросити перспективних спеціалістів. Гідну заробітну плату забезпечить держава.</p>\r\n\r\n<p style=\"text-align:justify\">Кваліфіковані лікарі готові працювати в селах, якщо на додаток до хорошої зарплати вони матимуть житло з водопостачанням і опаленням, обладнане місце роботи та &nbsp;відшкодування витрат на пальне для службового транспорту.</p>\r\n\r\n<p style=\"text-align:justify\">Якщо в селі проживає невелика кількість людей, один сімейний лікар може обслуговувати декілька населених пунктів, які розташовані поряд. У цьому випадку лікар отримує підтримку декількох місцевих громад.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Як буде пов&rsquo;язаний&nbsp;ваш лікар&nbsp;та спеціалізовані&nbsp;медичні заклади</strong></p>\r\n\r\n<p style=\"text-align:justify\">З 2020 року держава покриватиме обстеження, консультацію та призначення лікування лікарем спеціалізованого або високоспеціалізованого медичного закладу тільки за умови направлення від лікаря первинної медичної допомоги. Оскільки, згідно зі статистикою, більшість звернень громадян знаходяться в компетенції сімейного лікаря без залучення профільного спеціаліста або припадають на екстрені виклики.</p>\r\n\r\n<p style=\"text-align:justify\">Сімейний лікар не може виписати направлення до конкретного спеціаліста та/або конкретного закладу. Він тільки зазначає профіль вузькоспеціалізованого лікаря. Пацієнт самостійно вирішує, куди йому звернутися.</p>\r\n\r\n<p style=\"text-align:justify\">До 2020 року звертатися до лікарів спеціалізованих або високоспеціалізованих медичних закладів пацієнти можуть як за направленням, так і самостійно.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Якщо ваш сімейний&nbsp;лікар не доступний</strong></p>\r\n\r\n<p style=\"text-align:justify\">Коли ваш сімейний лікар у відпустці або на лікарняному, заклад первинної медичної допомоги або сам лікар, якщо це приватна практика, забезпечує на цей час заміну. Якщо ви знаходитеся у чужому місті, і вам необхідна первинна медична допомога, можна звернутися до найближчого чергового центру первинної допомоги.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><a href=\"https://berezne-pmd.rv.ua/uk/article/4\"><strong>Як обрати лікаря</strong></a></p>\r\n\r\n<p style=\"text-align:justify\">Ви можете обрати будь-якого терапевта для дорослого, педіатра для дитини або сімейного лікаря для всієї родини незалежно від місяця вашого проживання чи реєстрації.</p>\r\n\r\n<p style=\"text-align:justify\">Якщо ви вже маєте лікаря, який доглядає вас або членів вашої родини, ви до нього звикли і ви йому довіряєте, просто підпишіть з ним декларацію. А Національна служба здоров&rsquo;я України заплатить вашому лікарю за вас. Якщо лікар, який вів вас до початку кампанії з вибору лікаря, не влаштовує, саме час знайти того, кому ви готові довірити своє здоров&rsquo;я.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Де шукати лікаря</strong></p>\r\n\r\n<p>Дізнайтеся про сімейних лікарів, які працюють у найближчих до вас амбулаторіях сімейної медицини або поліклініках.</p>\r\n\r\n<p>Розпитайте сусідів та знайомих, чи подобається їм їхній сімейний лікар, чи влаштовують їх його методи профілактики, обстеження та лікування.</p>\r\n\r\n<p>Зверніться у місцевий відділ охорони здоров&rsquo;я, де вам зможуть надати інформацію про сімейних лікарів у вашому населеному пункті чи районі.</p>\r\n\r\n<p>До початку кампанії з вибору лікаря буде створена єдина відкрита електронна база, прив&rsquo;язана до мапи, де ви також&nbsp;зможете обрати лікаря, до якого зручно та швидко дістатися.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Визначилися з лікарем.&nbsp;Що далі?</strong></p>\r\n\r\n<p>Як тільки буде оголошено про початок кампанії з вибору лікаря, ви зможете підписати декларацію із сімейним лікарем.</p>\r\n\r\n<p>Ви можете підписати декларацію у будь-який час, навіть під час першого звернення.</p>\r\n\r\n<p>Декларація підписується безстроково і діє до моменту, поки ви не вирішите змінити лікаря.</p>\r\n\r\n<p>Поки лікар не набере 2000 пацієнтів, він не може відмовити в підписанні декларації.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Педіатрія</strong></p>\r\n\r\n<p style=\"text-align:justify\">Реформа первинної ланки не скасовує педіатрів. Навпаки &mdash; педіатри отримають фінансові заохочення на тих же умовах, що і сімейні лікарі, адже так само є лікарями первинної медичної допомоги. При цьому річна фіксована виплата на кожну дитину буде навіть вища за середню.</p>\r\n\r\n<p style=\"text-align:justify\">Так само як і сімейного лікаря, громадяни можуть обирати окремо педіатра для своєї дитини. Або обслуговуватися всією сім&rsquo;єю в одного сімейного лікаря. Проте Декларація про вибір лікаря має бути підписана для&nbsp;кожного члена родини окремо.</p>\r\n\r\n<p style=\"text-align:justify\">Педіатр безоплатно вакцинує дітей згідно з календарем профілактичних щеплень</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Екстрена допомога</strong></p>\r\n\r\n<p>Коли громадянину необхідна екстрена спеціалізована допомога, він звертається до будь-якого закладу екстреної допомоги. Лікування випадків, які загрожують життю, будуть покриті державою на 100%.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Спеціалізовані медичні&nbsp;заклади</strong></p>\r\n\r\n<p style=\"text-align:justify\">Реформування моделі фінансування медичних установ спеціалізованої та високоспеціалізованої допомоги розпочнеться з 2020 року. До цього часу відбудеться реформування системи первинної допомоги та буде зібрана необхідна статистика, щоб втілити зміни на вторинній і третинній ланці. На рівні спеціалізованої та високоспеціалізованої допомоги держава сплачуватиме напряму медичному закладу за кожну надану медичну послугу за прозорими та єдиними для всієї країни тарифами. Тариф включатиме усі витрати: і на ліки, і на ремонт обладнання, і на роботу медиків.</p>\r\n\r\n<p style=\"text-align:justify\">Щороку об&rsquo;єм послуг, гарантованих державою, та тарифи будуть затверджуватися Верховною Радою в рамках Державного Бюджету, цей документ матиме назву програма медичних гарантій. Перша програма медичних гарантій буде ухвалена на 2020 рік. Усі тарифи будуть обґрунтованими та відкритими.</p>\r\n\r\n<p style=\"text-align:justify\">Це означає, що в рамках гарантованого державою пакету медичних послуг, держава покриє 100% вартості лікування, включно з витратними матеріалами і ліками.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Червоний список послуг</strong></p>\r\n\r\n<p style=\"text-align:justify\">Одночасно існуватиме так званий червоний список послуг, які не ввійдуть у державний гарантований пакет. Це можуть бути додаткові послуги та ті, які не є життєво необхідними. Наприклад, естетична стоматологія, пластична хірургія та інші. Вартість цих послуг громадяни будуть сплачувати самостійно.</p>\r\n\r\n<p style=\"text-align:justify\">Червоний список послуг так само буде змінюватися з року в рік, залежно від того, який об&rsquo;єм послуг зможе гарантувати держава.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Що найважливіше&nbsp;в системі охорони&nbsp;здоров&rsquo;я?</strong></p>\r\n\r\n<p style=\"text-align:justify\">Гарантія від держави, що за потреби кожен громадянин отримає медичну допомогу, на яку має право за законом і за яку платить податки.</p>\r\n\r\n<p style=\"text-align:justify\">Незважаючи на офіційно безоплатну медицину, часто вже у лікарні нас питають, чи маємо гроші на ліки та лікування.</p>\r\n\r\n<p style=\"text-align:justify\">Чому так?</p>\r\n\r\n<p style=\"text-align:justify\">Проблема не тільки в дефіциті фінансування державної медицини.</p>\r\n\r\n<p style=\"text-align:justify\">Система не функціонує через неефективне використання наявних бюджетних коштів.</p>\r\n\r\n<p style=\"text-align:justify\">Реформа, розроблена командою Міністерства охорони здоров&rsquo;я України спільно з міжнародними експертами, &mdash;&nbsp;це реформа фінансування системи охорони здоров&rsquo;я, щоби кожен українець мав рівний доступ до медичних послуг та ліків, гарантованих та покритих державою.</p>\r\n\r\n<p style=\"text-align:justify\">Саме тому ключовий документ, який має запустити зміни, має назву Закон &laquo;Про державні фінансові гарантії надання медичних послуг та лікарських засобів&raquo;.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Що таке &laquo;фінансові&nbsp;гарантії&raquo;?</strong></p>\r\n\r\n<p style=\"text-align:justify\">Основне завдання держави &mdash; фінансово захистити громадян, тобто оплатити медичні послуги за єдиними та рівними для всіх правилами.</p>\r\n\r\n<p style=\"text-align:justify\">За існуючої системи держава витрачає кошти на утримання будівель лікарень. Натомість нова модель фінансування дозволить усі гроші перенаправити на відновлення та збереження здоров&rsquo;я конкретної людини. Реформа забезпечить максимально можливий фінансовий захист здоров&rsquo;я кожного громадянина України.</p>\r\n\r\n<p style=\"text-align:justify\">Уперше в комунальних медичних установах з&rsquo;явиться поняття медичної послуги та єдиного державного тарифу на кожну послугу. Держава абсолютно прозоро покриватиме усі витрати на надання послуги у межах державног гарантованого пакету напряму конкретному лікарю або медичній установі. А пацієнт, у свою чергу, може обрати будь-який медзаклад і лікаря для отримання медичної послуги та змінити його у будь-який час. Держава оплатить вартість лікування всюди.</p>\r\n\r\n<p style=\"text-align:justify\">Саме так реалізується право громадянина отримувати захист свого здоров`я. А держава надає фінансові гарантії для здійснення цього права.</p>\r\n\r\n<p style=\"text-align:justify\">Прозору та пряму оплату за надані послуги медичним установам або лікарям забезпечуватиме Національна служба здоров&rsquo;я України. НСЗУ не належить жоден із медичних закладів.</p>\r\n\r\n<p style=\"text-align:justify\">Вона контролює, щоби пацієнтам були надані послуги у межах установлених сум та якісно. В межах компетенції служби: отримувати скарги від пацієнтів на якість надання послуг медичними закладами та випадки вимагання додаткових оплат від пацієнтів, непередбачених законодавством.​</p>\r\n', 'Медична реформа', 'Медична реформа 2018'),
(2, 2, 'en-GB', 'Medical reform 2018', '<p>Medical reform will begin in 2018. What to expect from patients and doctors from her<br />\r\n<br />\r\nJanuary 1, 2018<br />\r\n<br />\r\nYour doctor<br />\r\n<br />\r\nThe reform will start with primary care, that is, family doctors, physicians and pediatricians. You can turn to a family doctor, therapist or pediatrician as soon as you feel the need for examination or treatment. In developed countries, primary care physicians without hospitalization resolve up to 80% of medical treatment using modern knowledge, basic equipment and most commonly used analyzes and medications.<br />\r\n<br />\r\nAll these services will be 100% covered by the state budget. Your doctor will be a family agent in the healthcare system. He will monitor health and fully provide primary diagnosis. For this, the doctor must be motivated, above all - financially.<br />\r\n<br />\r\nFrom 2018, primary health care providers who have contracted with the National Health Service will start financing under the new model - an annual flat-rate payment for the maintenance of each patient with whom the doctors of the facility signed the contract. At the same time, the size of the payment for young people and the elderly will differ significantly in view of the increase in the number of appeals due to age characteristics.<br />\r\n<br />\r\nIt is important to remember that the primary link institution receives money for you and when you are healthy. The less you get sick, the less the doctor works, and the income is the same. So, we encourage doctors to take care of their patients. This model operates globally.<br />\r\n<br />\r\n<br />\r\nWhat services will your doctor give you?<br />\r\n<br />\r\nA primary care physician is a specialist who has all the information about your health. Because of this, he sees the relationship and can determine at what stage the intervention of a profile specialist is required.<br />\r\n<br />\r\nInformation about the patient&#39;s health will be contained in the electronic health system. Even when a citizen goes to another doctor, all information will be available.<br />\r\n<br />\r\nThe primary duty of the primary care physician is to prevent or detect early onset of the disease in a timely manner. And also to provide urgent help in acute conditions and sudden deterioration of health: high body temperature, acute and sudden pain, cardiac rhythm disorders, bleeding, other conditions, diseases, poisonings and injuries in need of emergency care.<br />\r\n<br />\r\n<br />\r\nWill this doctor treat the disease?<br />\r\n<br />\r\nSo. The primary care physician, in accordance with the protocol of treatment, examines the patient and assigns the necessary tests, most of which will be carried out immediately in the outpatient clinic. On the basis of the received information, the family doctor decides on the treatment of both acute and chronic conditions of the patient.<br />\r\n<br />\r\nIf necessary, the family doctor gives directions to profile specialists.</p>\r\n\r\n<p>What else will be included in his duties?<br />\r\n<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;prevention of diseases at risk groups;<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;vaccination;<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;issuance of medical certificates and sick leave;<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;Issuing recipes for the cost of the drug &quot;Available medicines&quot;, including recipes for medicines for chronic patients.<br />\r\n<br />\r\n<br />\r\nFamily doctor in the village<br />\r\n<br />\r\nIn the villages of a family doctor, the local community chooses. Tariff wage rates for a primary care physician will be canceled. Rural communities will finally be able to substantially improve their primary care. By creating good conditions for life and work for a doctor, villagers will be able to invite promising specialists. A decent wage will be provided by the state.<br />\r\n<br />\r\nQualified doctors are ready to work in villages if, in addition to having a good salary, they will have accommodation with water and heating, equipped with a job and reimbursement of fuel costs for public transport.<br />\r\n<br />\r\nIf a small number of people live in a village, one family doctor can serve a few settlements that are nearby. In this case, the doctor receives support from several local communities.<br />\r\n<br />\r\n<br />\r\nHow will your doctor and specialized medical institutions be connected?<br />\r\n<br />\r\nFrom 2020, the state will cover the examination, consultation and appointment of a doctor by a specialist or highly specialized medical establishment only upon referral from a primary care physician. As, according to statistics, the majority of appeals of citizens are within the competence of the family doctor without the involvement of a specialist or are in urgent calls.<br />\r\n<br />\r\nA family doctor can not write a referral to a particular specialist and / or a specific institution. He only indicates the profile of a highly specialized doctor. The patient independently decides where to contact him.<br />\r\n<br />\r\nBy 2020, to address the doctors of specialized or highly specialized medical institutions, patients can either on a direction, or on their own.<br />\r\n<br />\r\n<br />\r\nIf your family doctor is not available<br />\r\n<br />\r\nWhen your family doctor is on vacation or at a hospital, a primary health care institution or a doctor, if it is private practice, provides a replacement at this time. If you are in a foreign city and you need primary care, you can go to the nearest next primary care center.<br />\r\n<br />\r\n<br />\r\nHow to choose a doctor<br />\r\n<br />\r\nYou can choose any adult therapist, pediatrician for a child or family doctor for the whole family regardless of the month of your residence or registration.<br />\r\n<br />\r\nIf you already have a doctor who cares for you or your family members, you are accustomed to him and you trust him, just sign a declaration with him. And the National Health Service of Ukraine will pay your doctor for you. If the doctor who led you before the doctor&#39;s choice campaign is not happy, it&#39;s time to find who you are ready to trust your health.<br />\r\n<br />\r\n<br />\r\nWhere to look for a doctor<br />\r\n<br />\r\nFind out about family doctors who work at your nearest family clinics or outpatient clinics.<br />\r\n<br />\r\nAsk neighbors and acquaintances, whether their family doctor likes them, or arrange their methods of prevention, examination and treatment.<br />\r\n<br />\r\nContact your local health department, where you will be able to provide family doctor information in your community or district.<br />\r\n<br />\r\nBefore the start of the doctor&#39;s choice campaign, you will have the only open electronic database attached to the map, where you will also be able to choose a doctor that is convenient and fast to reach.</p>\r\n\r\n<p>Determined by your doctor. What&#39;s next?<br />\r\n<br />\r\nOnce you have announced the start of your doctor&#39;s choice campaign, you will be able to sign a family doctor&#39;s declaration.<br />\r\n<br />\r\nYou can sign a declaration at any time, even during the first application.<br />\r\n<br />\r\nThe declaration is signed indefinitely and is valid until you decide to change your doctor.<br />\r\n<br />\r\nUntil the doctor has collected 2000 patients, he can not refuse to sign the declaration.<br />\r\n<br />\r\n<br />\r\nPediatrics<br />\r\n<br />\r\nPrimary reform does not cancel pediatricians. On the contrary, pediatricians will receive financial incentives under the same conditions as family doctors, since they are also primary care doctors. At the same time, the annual fixed payment for each child will be even higher than the average.<br />\r\n<br />\r\nLike a family doctor, citizens can choose a pediatrician for their child separately. Or to serve the whole family in one family doctor. However, the Declaration on the choice of physician must be signed for each member of the family separately.<br />\r\n<br />\r\nThe pediatrician vaccines children free of charge in accordance with the schedule of preventive vaccinations<br />\r\n<br />\r\n<br />\r\nEmergency help<br />\r\n<br />\r\nWhen a citizen needs urgent specialized assistance, he or she addresses to any emergency facility. The treatment of life-threatening cases will be 100% covered by the state.<br />\r\n<br />\r\n<br />\r\nSpecialized medical facilities<br />\r\n<br />\r\nThe reform of the financing model for medical institutions of specialized and highly specialized care will begin in 2020. By this time, the reform of the primary care system will take place and the necessary statistics will be collected to implement changes in the secondary and tertiary sections. At the level of specialized and highly specialized assistance, the state will pay directly to the medical institution for each medical service provided for transparent and uniform tariffs for the whole country. The tariff will include all expenses: both for medicines, for equipment repair, and for the work of doctors.<br />\r\n<br />\r\nEach year, the volume of services guaranteed by the state and tariffs will be approved by the Verkhovna Rada within the framework of the State Budget, this document will be called the program of medical guarantees. The first program of medical guarantees will be approved for 2020. All tariffs will be reasonable and open.<br />\r\n<br />\r\nThis means that within the state-guaranteed healthcare package, the state will cover 100% of the cost of treatment, including expendable materials and medicines.<br />\r\n<br />\r\n<br />\r\nRed list of services<br />\r\n<br />\r\nAt the same time there will be a so-called red list of services that will not be included in the state guaranteed package. These may be additional services and those that are not vital. For example, aesthetic dentistry, plastic surgery and others. The cost of these services will be paid by citizens on their own.<br />\r\n<br />\r\nThe red list of services will also change from year to year, depending on what volume of services the state can guarantee.</p>\r\n\r\n<p>What is most important in the health system?<br />\r\n<br />\r\nGuarantee from the state that, if necessary, every citizen will receive medical assistance, which is entitled under the law and for which he pays taxes.<br />\r\n<br />\r\nDespite officially unpaid medicine, we are often in the hospital asking us whether we have money for medicine and treatment.<br />\r\n<br />\r\nWhy so?<br />\r\n<br />\r\nThe problem is not only in the lack of financing of public medicine.<br />\r\n<br />\r\nThe system does not function because of inefficient use of available budget funds.<br />\r\n<br />\r\nThe reform, developed by the team of the Ministry of Health of Ukraine together with international experts, is a reform of health care financing so that every Ukrainian has equal access to medical services and medications guaranteed and covered by the state.<br />\r\n<br />\r\nThat is why the key document to be launched is the Law &quot;On State Financial Guarantees for the Provision of Medical Services and Medicines&quot;.<br />\r\n<br />\r\n<br />\r\nWhat are &quot;financial guarantees&quot;?<br />\r\n<br />\r\nThe main task of the state is to financially protect citizens, that is, to pay for medical services on the basis of uniform and equal rules for all.<br />\r\n<br />\r\nUnder the existing system, the state spends money on the maintenance of hospital buildings. Instead, a new financing model will allow all the money to be redirected to restore and maintain the health of a particular person. The reform will provide the maximum possible financial protection of the health of every citizen of Ukraine.<br />\r\n<br />\r\nFor the first time in communal health care institutions there will be a concept of medical service and a single state fare for each service. The state will completely cover all expenses for the provision of services within the boundaries of a state-guaranteed package directly to a specific doctor or medical institution. And the patient, in turn, can choose any medical institution and a doctor to receive a medical service and change it at any time. The state will pay the cost of treatment everywhere.<br />\r\n<br />\r\nThis is how the citizen&#39;s right to receive protection of his health is realized. And the state provides financial guarantees for the exercise of this right.<br />\r\n<br />\r\nTransparent and direct payment for services rendered to medical institutions or doctors will be provided by the National Health Service of Ukraine. NSZU does not belong to any of the medical institutions.<br />\r\n<br />\r\nShe supervises the provision of services to patients in accordance with established amounts and qualitatively. Within the competence of the service: to receive complaints from patients on the quality of services provided by medical institutions and cases of requiring additional payments from patients not provided by law.</p>\r\n', 'Medical reform', 'Medical reform 2018'),
(5, 3, 'uk-UA', 'План заходів Національного тижня громадського здоров\'я', '<p><a href=\"/web/uploads/other/Plan-NCPH.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">План заходів Національного тижня громадського здоров&#39;я</a></p>\r\n', 'громадське здоров\'я', 'План заходів Національного тижня громадського здоров\'я'),
(6, 3, 'en-GB', 'Action Plan for the National Public Health Week', '<p><a href=\"/web/uploads/other/Plan-NCPH.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Action Plan for the National Public Health Week</a></p>\r\n', 'public health', 'Action Plan for the National Public Health Week'),
(7, 4, 'uk-UA', 'Як обрати сімейного лікаря', '<h3>5 простих кроків для укладення декларації з лікарем:</h3>\r\n\r\n<p><strong>Крок 1</strong> Обрати медичний заклад та лікаря</p>\r\n\r\n<p><strong>Крок 2</strong> Звернутися до реєстратури обраного закладу</p>\r\n\r\n<p><strong>Крок 3</strong> Назвати прізвище обраного лікаря та надати документи для введення даних е електронну форму декларації</p>\r\n\r\n<p><strong>Крок 4</strong> Підтвердити вказану інформацію за допомогою СМС, що прийде на вказаний номер телефону. Якщо у пацієнта немає телефону, то для підтвердження можуть бути використані скан/фото паспорта та індивідуальний податковий&nbsp;номер, які будуть завантажені до системи</p>\r\n\r\n<p><strong>Крок 5</strong> Після перевірки даних у декларації підписати два роздруковані примірники разом з обраним лікарем та забрати свій примірник декларації</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Вам необхідно мати:</strong></p>\r\n\r\n<ol>\r\n	<li>Паспорт або ID-картку або посвідку на постійне чи тимчасове проживання та/або свідоцтво про народження дитини</li>\r\n	<li>Індивідуальний податковий номер (за наявності)</li>\r\n	<li>Мобільний телефон (за наявності)</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"/web/uploads/Icons/warning.jpg\" style=\"height:30px; width:30px\" /></strong><strong>Зв</strong><strong>е</strong><strong>рніть увагу</strong></p>\r\n\r\n<p>З кожним членом сім&rsquo;ї має бути укладена окрема декларація.</p>\r\n\r\n<p>Пацієнт може укласти декларацію лише з одним лікарем.</p>\r\n\r\n<p>Якщо Ви укладете декларацію з новим лікарем, попередня автоматично анулюється</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><em>Тепер медична допомога не прив&rsquo;язана до місця прописки, проживання чи розміру хабаря. Кожен українець може вибрати терапевта, педіатра або сімейного лікаря у будь-якому медичному закладі, а гроші за ваше медичне обслуговування заплатить держава. Поки кампанія з вибору лікаря (процес вибору лікаря і укладення договорів) триває у пілотному режимі. Початок національної кампанії - 1 квітня 2018 року.</em></p>\r\n\r\n<p>&nbsp;</p>\r\n', 'сімейний лікар, обрати сімейного лікаря', 'Як обрати сімейного лікаря'),
(8, 4, 'en-GB', 'How to choose a family doctor', '<h3>5 Simple Steps to Make a Doctor&#39;s Declaration:</h3>\r\n\r\n<p><strong>Step 1</strong> Select a health facility and a doctor</p>\r\n\r\n<p><strong>Step 2</strong> Apply to the registry of your chosen institution</p>\r\n\r\n<p><strong>Step 3</strong> Name the chosen doctor&#39;s name and provide documents for entering data is the electronic form of the declaration.</p>\r\n\r\n<p><strong>Step 4 </strong>Confirm the information provided by SMS, which will come to the specified phone number. If the patient does not have a phone, a scan / photo of the passport and an individual tax number that will be downloaded to the system can be used for confirmation</p>\r\n\r\n<p><strong>Step 5</strong> After verifying the data in the declaration, sign two copies with the selected physician and pick up your copy of the declaration.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>You need to have:</strong></p>\r\n\r\n<ol>\r\n	<li>Passport or ID card or certificate for permanent or temporary residence and / or birth certificate</li>\r\n	<li>Individual tax number (if available)</li>\r\n	<li>Mobile phone (if available)</li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><img alt=\"\" src=\"/web/uploads/Icons/warning.jpg\" style=\"height:30px; width:30px\" />Pay attention</strong></p>\r\n\r\n<p>Each member of the family must have a separate declaration.</p>\r\n\r\n<p>The patient can only declare a single doctor.</p>\r\n\r\n<p>If you make a declaration with a new doctor, the previous one is automatically canceled</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Now the medical aid is not tied to the place of registration, residence or size of the bribe. Each Ukrainian can choose a therapist, pediatrician or family doctor in any medical institution, and money for your medical care will be paid by the state. So far, the campaign for choosing a doctor (the process of choosing a doctor and concluding contracts) continues in pilot mode. The start of the national campaign is April 1, 2018.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'family doctor, choose a family doctor', 'How to choose a family doctor'),
(9, 5, 'uk-UA', 'План проведення заходів до Всесвітнього тижня імунізації', '<p><a href=\"/web/uploads/other/Plan-of-events-for-the-World-Week-of-Immunization.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">План проведення заходів до Всесвітнього тижня імунізації</a></p>\r\n', '', 'План проведення заходів до Всесвітнього тижня імунізації'),
(10, 5, 'en-GB', 'Plan of events for the World Week of Immunization', '<p><a href=\"/web/uploads/other/Plan-of-events-for-the-World-Week-of-Immunization.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Plan of events for the World Week of Immunization</a></p>\r\n', '', 'Plan of events for the World Week of Immunization'),
(11, 6, 'uk-UA', 'Окуліст, безкоштовний огляд (Березнівський район)', '<h2><img alt=\"\" src=\"/web/uploads/other/ophthalmologist.jpg\" style=\"float:left; height:248px; margin-right:50px; width:248px\" /><strong><span style=\"background-color:#FFA07A\">О К У Л І С Т</span></strong></h2>\r\n\r\n<h3><strong><span style=\"background-color:#FFA07A\">БЕЗКОШТОВНИЙ ОГЛЯД</span></strong><strong><span style=\"background-color:#FFA07A\"> (для жителів Березнівського району 10.05.2019):</span></strong></h3>\r\n\r\n<ul>\r\n	<li><span style=\"font-size:16px\"><strong><em>Перевірка гостроти зору</em></strong></span></li>\r\n	<li><span style=\"font-size:16px\"><strong><em>Офтальмоскопія очного дна</em></strong></span></li>\r\n	<li><span style=\"font-size:16px\"><strong><em>Виявлення відхилень, патологій очної системи</em></strong></span></li>\r\n	<li><span style=\"font-size:16px\"><strong><em>Корекція гостроти зору</em></strong></span></li>\r\n	<li><span style=\"font-size:16px\"><strong><em>Оптометрія</em></strong></span></li>\r\n	<li><span style=\"font-size:16px\"><strong><em>Рекомендації на рахунок подальшого лікування виявлених патологій</em></strong></span></li>\r\n	<li><span style=\"font-size:16px\"><strong><em>Вимірювання внутрішньоочного тиску</em></strong></span></li>\r\n</ul>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:20px\"><span style=\"background-color:#00FF00\">Прийом буде відбуватися паралельно: в поліклініці 2 лікаря (кабінет 18, кабінет 44), 1 лікар в казначействі</span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:20px\">Фундатори:</span></p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"Окуліст, безкоштовний огляд (Березнівський район)\" src=\"/web/uploads/other/FUNDATORS-Ophthalmologist.jpg\" style=\"height:328px; width:349px\" /></p>\r\n', 'Окуліст, безкоштовний огляд', 'Окуліст, безкоштовний огляд (Березнівський район)'),
(12, 6, 'en-GB', 'Ophthalmologist, free review (Berezne district)', '<h2><img alt=\"\" src=\"/web/uploads/other/ophthalmologist.jpg\" style=\"float:left; height:248px; margin-right:50px; width:248px\" /><strong><strong><span style=\"background-color:#FFA07A\">О К У Л І С Т</span></strong></strong></h2>\r\n\r\n<h3><strong><strong>FREE REVIEW</strong><strong> (for the inhabitants of Berezne 10.05.2019):</strong></strong></h3>\r\n\r\n<ul>\r\n	<li><strong><span style=\"font-size:16px\"><strong><em>Verifying visual acuity</em></strong></span></strong></li>\r\n	<li><strong><span style=\"font-size:16px\"><strong><em>Ophthalmoscopy of the fundus</em></strong></span></strong></li>\r\n	<li><strong><span style=\"font-size:16px\"><strong><em>Detection of deviations, pathologies of the ocular system</em></strong></span></strong></li>\r\n	<li><strong><span style=\"font-size:16px\"><strong><em>Correction of visual acuity</em></strong></span></strong></li>\r\n	<li><strong><span style=\"font-size:16px\"><strong><em>Optometry</em></strong></span></strong></li>\r\n	<li><strong><span style=\"font-size:16px\"><strong><em>Recommendations for further invoicing treatment of the revealed pathologies</em></strong></span></strong></li>\r\n	<li><strong><span style=\"font-size:16px\"><strong><em>Measurement of intraocular pressure</em></strong></span></strong></li>\r\n</ul>\r\n\r\n<p style=\"text-align:center\"><strong><span style=\"font-size:20px\"><span style=\"background-color:#00FF00\">Reception will take place in parallel: in the policlinic 2 doctors (cabinet 18, cabinet 44), 1 doctor in the treasury</span></span></strong></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:20px\">Fundators:</span></p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"Ophthalmologist, free review (Berezne district)\" src=\"/web/uploads/other/FUNDATORS-Ophthalmologist.jpg\" style=\"height:328px; width:349px\" /></p>\r\n', 'Ophthalmologist, free review', 'Ophthalmologist, free review (Berezne district)'),
(13, 7, 'uk-UA', 'Міністерство охорони здоров\'я України скасувало вікові обмеження на безоплатну вакцинацію проти кору', '<h3><img alt=\"Міністерство охорони здоров\'я України скасувало вікові обмеження на безоплатну вакцинацію проти кору\" src=\"/web/uploads/articles/stop-kir.jpg\" style=\"float:left; height:200px; margin-right:10px; width:300px\" /></h3>\r\n\r\n<h3><span style=\"font-size:18px\"><span style=\"background-color:#DDA0DD\">Міністерство охорони здоров&#39;я України скасувало вікові обмеження на безоплатну вакцинацію проти кору</span></span></h3>\r\n\r\n<p><span style=\"font-size:14px\"><strong><em><span style=\"background-color:#00FF00\">Дорослі будь - якого віку тепер теж можуть безоплатно вакцинуватися від кору, паротиту та краснухи вакциною КПК. Також можна вакцинувати немовлят віком від 6 місяців, для яких кір особливо небезпечний.</span></em></strong></span></p>\r\n\r\n<p style=\"text-align:justify\">Згідно <a href=\"http://moz.gov.ua/article/ministry-mandates/nakaz-moz-ukraini-vid-23042019--958-pro-vnesennja-zmin-do-kalendarja-profilaktichnih-scheplen-v-ukraini\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">наказу МОЗ України за № 958 від 23.04.2019 року <strong>&ldquo;</strong>Про внесення змін до Календаря профілактичних щеплень в Україні<strong>&rdquo;</strong></a>, який зареєстровано в Міністерстві юстиції України від 25.04.2019 № 442/33413, вакцинація проти кору, епідемічного паротиту, краснухи проводиться безоплатно всім дорослим без обмеження віку, які контактували з хворим (рекомендовано провести в перші 72 години від моменту контакту), які не хворіли на вказані інфекції та/або не мають зазначеного в медичній документації підтвердження введення двох доз вакцини, або мають негативні результати лабораторного обстеження щодо наявності специфічних антитіл Ig G.</p>\r\n\r\n<p style=\"text-align:justify\">Якщо минуло більше трьох днів від моменту контакту, особам, у яких відсутні клінічні прояви захворювання, з метою забезпечення імунітету на майбутнє у разі неінфікування, проводять вакцинацію негайно (якомога раніше). Рішення про проведення щеплення за таких обставин приймають лікуючий лікар та пацієнт на підставі оцінки ризиків та переваг.</p>\r\n\r\n<p style=\"text-align:justify\">Також за наявності епідемічних показань, пов&rsquo;язаних із можливим ризиком інфікування у випадку контакту дитини з джерелом інфекції (кір, краснуха, епідемічний паротит), дозволяється введення дози вакцини у віці від 6 місяців. У такому випадку введена доза не зараховується як щеплення за віком, а вважається &laquo;нульовою&raquo;. Подальші планові щеплення потрібно проводити за Календарем профілактичних щеплень: в 12 місяців (перша доза вакцини КПК) і 6 років (друга доза).</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Важливо:</strong> щеплення проводиться за відсутності протипоказань, що наведені в інструкції із застосування вакцини, інтервал між дозами КПК&nbsp;має бути не менше одного місяця.</p>\r\n\r\n<p style=\"text-align:justify\">В черговий раз закликаємо всіх хто не отримав щеплення якомога скоріше звернутись до свого сімейного лікаря у лікувально-профілактичний заклад та вакцинуватись проти кору.</p>\r\n\r\n<p style=\"text-align:center\"><strong>Березнівське районне лабораторне відділення Костопільського міжрайонного відділу Державної установи </strong><strong>&ldquo;</strong><strong>Рівненський обласний лабораторний центр </strong><strong>М</strong><strong>іністерства охорони здоров</strong><strong>&rsquo;</strong><strong>я України</strong><strong>&rdquo;</strong></p>\r\n', 'безоплатна вакцинація, кір', 'Міністерство охорони здоров\'я України скасувало вікові обмеження на безоплатну вакцинацію проти кору'),
(14, 7, 'en-GB', 'The Ministry of Health of Ukraine lifted the age limits for free measles vaccination', '<h3><img alt=\"The Ministry of Health of Ukraine lifted the age limits for free measles vaccination\" src=\"/web/uploads/articles/stop-kir.jpg\" style=\"float:left; height:200px; margin-right:10px; width:300px\" /></h3>\r\n\r\n<h3><span style=\"font-size:18px\"><span style=\"background-color:#DDA0DD\">The Ministry of Health of Ukraine lifted the age limits for free measles vaccination</span></span></h3>\r\n\r\n<p><span style=\"font-size:14px\"><strong><em><span style=\"background-color:#00FF00\">Adults of any age can now also be vaccinated free of charge from measles, mumps and rubella with a CPR vaccine. You can also vaccinate infants aged 6 months, for which measles are particularly dangerous.</span></em></strong></span></p>\r\n\r\n<p style=\"text-align:justify\">According to <a href=\"http://moz.gov.ua/article/ministry-mandates/nakaz-moz-ukraini-vid-23042019--958-pro-vnesennja-zmin-do-kalendarja-profilaktichnih-scheplen-v-ukraini\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Order of the Ministry of Health of Ukraine No. 958 dated April 23, 2019 <strong>&ldquo;</strong>On Making Amendments to the Calendar of Prophylactic Vaccinations in Ukraine<strong>&rdquo;</strong></a>, which is registered in the Ministry of Justice of Ukraine as of April 25, 2019, № 442/33413, vaccination against measles, epidemic mumps, rubella is performed free of charge to all adults without age limitation, who were in contact with the patient (recommended to be carried out in the first 72 hours from the moment of contact), who did not hurt for specified infections and / or have no confirmation of the two doses of the vaccine specified in the medical documentation, or have negative results of a laboratory test for the presence of specific IgG antibodies.</p>\r\n\r\n<p style=\"text-align:justify\">If more than three days have elapsed from the moment of contact, persons who do not have clinical manifestations of the disease, in order to ensure immunity to the future in the event of non-infection, vaccinate immediately (as early as possible). The decision to hold an inoculation in such circumstances is taken by the attending physician and the patient based on the assessment of risks and benefits.</p>\r\n\r\n<p style=\"text-align:justify\">Also, in the presence of epidemic indications related to the possible risk of infection in the case of contact of the child with the source of infection (measles, rubella, epidemic parotitis), the dose of the vaccine at the age of 6 months is allowed. In this case, the dose administered is not counted as an age-specific vaccine, but is considered to be &quot;zero&quot;. Further scheduled vaccinations should be carried out according to the Calendar of preventive vaccinations: in 12 months (the first dose of the vaccine of the CPR) and 6 years (the second dose).</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Importantly:</strong><strong> </strong>Inoculation is performed in the absence of the contraindications given in the instructions for the use of the vaccine, the interval between the doses of the CCP should be at least one month.</p>\r\n\r\n<p style=\"text-align:justify\">Once again, we urge all those who have not received the vaccine as soon as possible to apply to their family doctor at a health facility and vaccinate against measles.</p>\r\n\r\n<p style=\"text-align:center\"><strong>Bereznivsky District Laboratory Office of the Kostopil Interregional Department of the State Institution &ldquo;Rivne Regional Laboratory Center Ministry of Health of Ukraine&rdquo;</strong></p>\r\n', 'free vaccination, measles', 'The Ministry of Health of Ukraine lifted the age limits for free measles vaccination');
INSERT INTO `articles_i18n` (`id`, `parent_table_id`, `language`, `title`, `body`, `keywords`, `description`) VALUES
(15, 8, 'uk-UA', 'Як отримати доступні ліки', '<h3 style=\"text-align:justify\"><span style=\"color:#3399cc\">Як отримати доступні ліки?</span><img alt=\"Як отримати доступні ліки\" src=\"/web/uploads/articles/nalipka_reimbursacija.png\" style=\"float:left; height:250px; margin-right:10px; width:200px\" /></h3>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">1. Обрати свого лікаря (<a href=\"https://berezne-pmd.rv.ua/uk/article/how-to-choose-a-family-doctor\">як обрати лікаря</a>) - сімейного лікарі/терапевта/педіатра та укласти з ним декларацію</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">2. Звернутися до лікаря, за необхідності він випише електронний рецепт. Отримати на свій телефон SMS з 16-значним номером рецепту та 4-значним кодом підтвердження</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">3. Звернутися до аптеки, що має наліпку &quot;Тут є ДОСТУПНІ ЛІКИ&quot; та отримати ліки за електронним рецептом - белоплатно або з доплатою</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#0066ff;border-radius:8px;padding:15px;\">\r\n<p style=\"text-align:justify\"><strong><span style=\"color:#FFFFFF\"><span style=\"font-size:18px\">ВАЖЛИВО!</span></span></strong></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#FFFFFF\"><span style=\"font-size:16px\">Перед виписуванням електронного рецепту лікар має переконатися, що дійсний номер телефону пацієнта збігається з номером, вказаним у системі для автентифікації пацієнта. На номер телефону, вказаний у системі, будуть відправлені дані для отримання доступних ліків в аптеці.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#FFFFFF\"><span style=\"font-size:16px\">Якщо номери не збігаються, пацієнт повинен звернутися в НСЗУ для скидання методу автентифікації, після чого подати нову декларацію з правильним номером телефону. Деталі запитуйте у контакт-центрі НСЗУ за номером телефону 1677.</span></span></p>\r\n</div>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#3399cc; font-size:18px\">ЯКІ САМЕ ЛІКАРСЬКІ ЗАСОБИ ПАЦІЄНТ МОЖЕ ОТРИМАТИ ЗА ЕЛЕКТРОННИМ РЕЦЕПТОМ ЗА ПРОГРАМОЮ &quot;ДОСТУПНІ ЛІКИ&quot;?</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">Зверніть увагу, що в електронному рецепті лікар вказує не торгову назву ліків, а міжнародну непатентовану назву (МНН). МНН - одна, а лікарських засобів на її основі може бути декілька.</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">Працівник аптеки пропонує пацієнту варіанти ліків із зазначаною лікарем МНН.</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">Пацієнт сам обирає ліки за вказаною в рецепті МНН. Частина ліків повністю оплачується з державного бюджету і є безоплатною для пацієнта. Частина - з доплатою.</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<div style=\"background:#66cc00;border-radius:8px;padding:15px;\">\r\n<p style=\"text-align:justify\"><span style=\"color:#000000\"><strong><span style=\"font-size:18px\">ВАЖЛИВО!</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#000000\"><span style=\"font-size:16px\">Перш за все, працівник аптеки повинен запропонувати пацієнту БЕЗОПЛАТНІ ліки. А потім - з доплатою.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#000000\"><span style=\"font-size:16px\">Останнім етапом відпуску ліків є введення коду підтвердження, що надійшов у SMS. Тому, будь-ласка, називайте його лише у випадку наявності ліків в аптеці.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#000000\"><span style=\"font-size:16px\">Якщо потрібні ліки відсутні, пацієнт може зветнутися в іншу аптеку, яка бере участь в програмі.</span></span></p>\r\n</div>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#3399cc; font-size:18px\">ПЕРЕЛІК МНН ЗА КАТЕГОРІЯМИ ЗАХВОРЮВАНЬ:</span></p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"font-size:16px\"><img alt=\"\" src=\"/web/uploads/articles/img-icn-heart.png\" style=\"height:26px; width:26px\" />&nbsp;Серцево-судинні:</span></strong></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Аміодарон -&nbsp;</span>синтетичний антиаритмічний препарат ІІІ класу</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Амлодипін -&nbsp;</span>синтетичний препарат,&nbsp;блокатор&nbsp;кальцієвих каналів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Атенолол -&nbsp;</span>антиаритмічний лікарський засіб</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Верапаміл -&nbsp;</span>синтетичний лікарський засіб, що є похідним фенілалкіламіну та відноситься до групи блокаторів кальцієвих каналів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Гідрохлортіазид -&nbsp;</span>синтетичний препарат, що відноситься до групи тіазидних діуретиків</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Спіронолактон -&nbsp;</span>синтетичний стероїдний калійзберігальний діуретичний засіб</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Фуросемід - </span>високоактивний&nbsp;петльовий діуретик</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Дигоксин -&nbsp;</span>серцевий глікозид</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Еналаприл -&nbsp;</span>лікарський засіб, що діє на ренін&ndash;ангіотензинову систему</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Ізосорбіду динітрат -&nbsp;</span>синтетичний лікарський засіб, який відноситься до групи органічних нітратів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Карведилол -&nbsp;</span>синтетичний антигіпертензивний препарат, що відноситься до групи неселективних бета-блокаторів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Клопідогрель -&nbsp;</span>лікарський антитромботичний засіб, антиагрегант</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Метопролол -&nbsp;</span>селективний блокатор &beta;1-рецепторів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Симвастатин -&nbsp;</span>гіполіпідемічний препарат, використовуються для зниження холестеролу й тригліцеридів у крові</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Бісопролол -&nbsp;</span>селективні блокатори бета-адренорецепторів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Нітрогліцерин -&nbsp;</span>вазодилататор</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Лозартал -&nbsp;</span>гальмує ренін-ангіотензинову систему</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"font-size:16px\"><img alt=\"\" src=\"/web/uploads/articles/img-icn-diabetes.png\" style=\"height:26px; width:26px\" />&nbsp;Діабет ІІ типу:</span></strong></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Гліклазид -&nbsp;</span>цукрознижуючий лікарський засіб класу сульфонамідів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Метформін -&nbsp;</span>цукрознижуючий лікарський засіб класу бігуанідів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Глібенкламід -&nbsp;</span>цукрознижуючий лікарський засіб класу сульфонамідів</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"font-size:16px\"><img alt=\"\" src=\"/web/uploads/articles/img-icn-lungs.png\" style=\"height:26px; width:26px\" />&nbsp;Бронхіальна астма:</span></strong></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Беклометазон -&nbsp;</span>синтетичний препарат з групи глюкокортикоїдних гормонів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Будесонід -&nbsp;</span>синтетичний препарат з групи глюкокортикоїдних гормонів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Сальбутамол -&nbsp;</span>селективний бета-2-адреностимулятор</li>\r\n</ul>\r\n', 'доступні ліки', 'Як отримати доступні ліки'),
(16, 8, 'en-GB', 'How to get the available medication', '<h3 style=\"text-align:justify\"><span style=\"color:#3399cc\">How to get the available medication?</span><img alt=\"How to get the available medication\" src=\"/web/uploads/articles/nalipka_reimbursacija.png\" style=\"float:left; height:250px; margin-right:10px; width:200px\" /></h3>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">1. Choose your doctor (<a href=\"https://berezne-pmd.rv.ua/uk/article/how-to-choose-a-family-doctor\">як обрати лікаря</a>) - family doctor/therapist/pediatrician and make a declaration with him</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">2. Apply to a doctor, if necessary, he will issue an electronic recipe. Get your SMS with a 16-digit recipe number and 4-digit verification code</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">3. Apply to a pharmacy with a sticker &quot;There are ACCOMMODATIVE MEDICINES&quot; and get the medicine by electronic recipe - white or with a surcharge</span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div style=\"background:#0066ff;border-radius:8px;padding:15px;\">\r\n<p style=\"text-align:justify\"><strong><span style=\"color:#FFFFFF\"><span style=\"font-size:18px\">IMPORTANTLY!</span></span></strong></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#FFFFFF\"><span style=\"font-size:16px\">Before issuing an electronic recipe, the doctor must make sure that the patient\'s valid telephone number matches the number specified in the system for patient authentication. Data will be sent to the telephone number specified on the system to receive the available drugs at the pharmacy.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#FFFFFF\"><span style=\"font-size:16px\">If the numbers do not match, the patient should contact the NHSU to reset the authentication method, and then submit a new declaration with the correct phone number. Ask for details at the NHSU Contact Center at 1677.</span></span></p>\r\n</div>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#3399cc; font-size:18px\">WHAT ARE THE MEDICINAL PRODUCTS OF THE PATIENT MAY BE OBTAINED BY THE ELECTRONIC RECIPE BY THE PROGRAM &quot;ACCOMMODATIVE MEDICINES&quot;?</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">Please note that in the electronic recipe the doctor indicates not the trade name of the medicine, but the international non-proprietary name (INN). INN - one, and there may be several drugs on its basis.</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">An employee of the pharmacy offers the patient the options for the drug with the appointment of a physician INN.</span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">The patient himself chooses the medication for the prescribed INN recipe. Part of the drug is fully paid from the state budget and is free of charge to the patient. Part - with a surcharge.</span></p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<div style=\"background:#66cc00;border-radius:8px;padding:15px;\">\r\n<p style=\"text-align:justify\"><span style=\"color:#000000\"><strong><span style=\"font-size:18px\">IMPORTANTLY!</span></strong></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#000000\"><span style=\"font-size:16px\">First of all, the pharmacy employee must offer the patient FREE medicine. And then - with a surcharge.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#000000\"><span style=\"font-size:16px\">The final stage of drug dispensing is entering the confirmation code that came in SMS. Therefore, please name it only if there is a drug in the pharmacy.</span></span></p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#000000\"><span style=\"font-size:16px\">If the required medication is not available, the patient may cheer up at another pharmacy participating in the program.</span></span></p>\r\n</div>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:#3399cc; font-size:18px\">LIST OF INN FOR CATEGORIES OF DISEASES:</span></p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"font-size:16px\"><img alt=\"\" src=\"/web/uploads/articles/img-icn-heart.png\" style=\"height:26px; width:26px\" />&nbsp;Серцево-судинні:</span></strong></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Аміодарон -&nbsp;</span>синтетичний антиаритмічний препарат ІІІ класу</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Амлодипін -&nbsp;</span>синтетичний препарат,&nbsp;блокатор&nbsp;кальцієвих каналів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Атенолол -&nbsp;</span>антиаритмічний лікарський засіб</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Верапаміл -&nbsp;</span>синтетичний лікарський засіб, що є похідним фенілалкіламіну та відноситься до групи блокаторів кальцієвих каналів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Гідрохлортіазид -&nbsp;</span>синтетичний препарат, що відноситься до групи тіазидних діуретиків</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Спіронолактон -&nbsp;</span>синтетичний стероїдний калійзберігальний діуретичний засіб</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Фуросемід - </span>високоактивний&nbsp;петльовий діуретик</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Дигоксин -&nbsp;</span>серцевий глікозид</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Еналаприл -&nbsp;</span>лікарський засіб, що діє на ренін&ndash;ангіотензинову систему</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Ізосорбіду динітрат -&nbsp;</span>синтетичний лікарський засіб, який відноситься до групи органічних нітратів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Карведилол -&nbsp;</span>синтетичний антигіпертензивний препарат, що відноситься до групи неселективних бета-блокаторів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Клопідогрель -&nbsp;</span>лікарський антитромботичний засіб, антиагрегант</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Метопролол -&nbsp;</span>селективний блокатор &beta;1-рецепторів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Симвастатин -&nbsp;</span>гіполіпідемічний препарат, використовуються для зниження холестеролу й тригліцеридів у крові</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Бісопролол -&nbsp;</span>селективні блокатори бета-адренорецепторів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Нітрогліцерин -&nbsp;</span>вазодилататор</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Лозартал -&nbsp;</span>гальмує ренін-ангіотензинову систему</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"font-size:16px\"><img alt=\"\" src=\"/web/uploads/articles/img-icn-diabetes.png\" style=\"height:26px; width:26px\" />&nbsp;Діабет ІІ типу:</span></strong></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Гліклазид -&nbsp;</span>цукрознижуючий лікарський засіб класу сульфонамідів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Метформін -&nbsp;</span>цукрознижуючий лікарський засіб класу бігуанідів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Глібенкламід -&nbsp;</span>цукрознижуючий лікарський засіб класу сульфонамідів</li>\r\n</ul>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p style=\"text-align:justify\"><strong><span style=\"font-size:16px\"><img alt=\"\" src=\"/web/uploads/articles/img-icn-lungs.png\" style=\"height:26px; width:26px\" />&nbsp;Бронхіальна астма:</span></strong></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Беклометазон -&nbsp;</span>синтетичний препарат з групи глюкокортикоїдних гормонів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Будесонід -&nbsp;</span>синтетичний препарат з групи глюкокортикоїдних гормонів</li>\r\n	<li style=\"text-align:justify\"><span style=\"font-size:16px\">Сальбутамол -&nbsp;</span>селективний бета-2-адреностимулятор</li>\r\n</ul>', 'available medication', 'How to get the available medication'),
(17, 9, 'uk-UA', 'Зміна номеру мобільного, або припинити декларацію з лікарем', '<h3 style=\"text-align:justify\"><img alt=\"\" src=\"/web/uploads/articles/change_phone_number.jpg\" style=\"float:left; height:150px; margin-right:10px; width:200px\" /><span style=\"background-color:#DDA0DD\">Зміна номеру мобільного, або&nbsp;припинити декларацію з лікарем</span></h3>\r\n\r\n<p style=\"text-align:justify\">Лист НСЗУ щодо подання заяви про внесення змін до інформації, що міститься в елетронній системі охорони здоров&rsquo;я (зміна номеру телефону, припинення декларації)</p>\r\n\r\n<p style=\"text-align:justify\">Національна служба здоров&rsquo;я України своїм листом від <a href=\"/web/uploads/articles/994-18.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><span style=\"background-color:#FFFF00\">02.11.2018 № 994-18 &quot;Щодо подання заяви про внесення змін до інформації, що міститься в електронній системі охорони здоров&rsquo;я&quot;</span></a><span style=\"background-color:#FFFF00\"> </span>надала рекомендовану форму заяви для припинення декларації про вибір лікаря (що надає первинну медичну допомогу), зміну мобільного номеру аутентифікації пацієнта під час укладення декларації,&nbsp;а також перелік документів - додатків до заяви.</p>\r\n\r\n<p style=\"text-align:justify\">Номер телефону &ndash; одна зі складових процедури аутентифікації пацієнта під час укладення декларації. Телефон, який був внесений до електронної системи охорони здоров&rsquo;я під час укладення декларації <span style=\"background-color:#FFFF00\">вперше</span> &ndash; автоматично використовується до всіх наступних декларацій цього пацієнта. Тому&nbsp;якщо номер телефону загубився, змінився або був некоректно введений - просто змінити на інший не вийде, потрібно звертатися до НСЗУ з заявою, час розгляду не менше 30 днів.</p>\r\n\r\n<p style=\"text-align:justify\">Заява та додатки до неї подаються закладом охорони здоров&rsquo;я або пацієнтом (його законним представником) до НСЗУ шляхом надсилання листа одним із засобів (на вибір):&nbsp;</p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\">на електронну адресу НСЗУ<span style=\"background-color:#FFFF00\">&nbsp;</span><a href=\"mailto:info@nszu.gov.ua\"><span style=\"background-color:#FFFF00\">info@nszu.gov.ua</span></a><span style=\"background-color:#FFFF00\"> </span>із накладеним ЕЦП (на&nbsp;<a href=\"https://ca.informjust.ua/sign\" target=\"_blank\">сайті АЦСК</a>), уповноваженої особи закладу охорони здоров&rsquo;я або пацієнта разом з додатками, вказаними у зразку заяви (копія паспорта/свідоцтво по народження/посвідка пацієнта/ ІПН (за наявності));</li>\r\n	<li style=\"text-align:justify\">в паперовій формі на адресу <span style=\"background-color:#FFFF00\">НСЗУ (04073, м.Київ, проспект Степана Бандери, 19)</span>. При цьому заява має бути заповнена в електроному вигляді, роздрукована та підписана власноручним підписом заявника&quot; - йдеться у листі.</li>\r\n</ul>\r\n\r\n<div style=\"background: rgb(102, 204, 0); border-radius: 8px; padding: 15px; text-align: center;\"><span style=\"color:#000000\"><strong><span style=\"font-size:18px\">У разі виникнення запитань щодо подання заяви та додатків до неї, НСЗУ рекомендує звертатись до контактного центру НСЗУ за номером телефону 1677.</span></strong></span></div>\r\n', 'зміна номеру мобільного пацієнта, припинити декларацію', 'Зміна номеру мобільного, або припинити декларацію з лікарем'),
(18, 9, 'en-GB', 'Change the mobile number, or terminate your doctor\'s declaration', '<h3 style=\"text-align:justify\"><img alt=\"\" src=\"/web/uploads/articles/change_phone_number.jpg\" style=\"float:left; height:150px; margin-right:10px; width:200px\" /><span style=\"background-color:#DDA0DD\">Change the mobile number, or terminate your doctor&#39;s declaration</span></h3>\r\n\r\n<p style=\"text-align:justify\">A letter from the NHSU regarding the submission of an application for amendments to the information contained in the electronic health system (change of phone number, termination of the declaration)</p>\r\n\r\n<p style=\"text-align:justify\">National Health Service of Ukraine letter from <a href=\"/web/uploads/articles/994-18.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><span style=\"background-color:#FFFF00\">02.11.2018 № 994-18 &quot;Concerning the submission of an application for amendments to the information contained in the electronic health system</span></a><span style=\"background-color:#FFFF00\"> </span>provided the recommended application form for termination of the decision on the choice of the doctor (providing primary care), the change of the mobile number of the patient&#39;s authentication during the conclusion of the declaration, as well as the list of documents - annexes to the application.</p>\r\n\r\n<p style=\"text-align:justify\">The phone number is one of the components of the patient&#39;s authentication procedure when making a declaration. A telephone that was entered into the electronic health system when making a declaration <span style=\"background-color:#FFFF00\">for the first time</span> &ndash; automatically used for all subsequent declarations of this patient. So&nbsp;if the phone number is lost, changed or was incorrectly entered - simply change to the other will not work, you must contact the NSA with a statement, the time of consideration at least 30 days.</p>\r\n\r\n<p style=\"text-align:justify\">The application and annexes thereto shall be submitted by the health care institution or by the patient (his legal representative) to the NSAU by sending a letter by one of the following means (at your option):</p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\">to the email address of the NHSU<span style=\"background-color:#FFFF00\">&nbsp;</span><a href=\"mailto:info@nszu.gov.ua\"><span style=\"background-color:#FFFF00\">info@nszu.gov.ua</span></a><span style=\"background-color:#FFFF00\"> </span>with overlayed EDS (at&nbsp;<a href=\"https://ca.informjust.ua/sign\" target=\"_blank\">site of ACSK</a>), an authorized person of the healthcare facility or the patient, together with the applications indicated on the application form (copy of the passport / birth certificate / patient / IDN certificate (if available));</li>\r\n	<li style=\"text-align:justify\">in paper form to the address <span style=\"background-color:#FFFF00\">NSAU (04073, Kyiv, prospect Stepan Bandera, 19)</span>. At the same time, the application must be filled in electronically, printed and signed by the applicant&#39;s own handwritten signature - the letter reads.</li>\r\n</ul>\r\n\r\n<div style=\"background: rgb(102, 204, 0); border-radius: 8px; padding: 15px; text-align: center;\"><span style=\"color:#000000\"><strong><span style=\"font-size:18px\">If you have questions about submitting an application and its annexes, the NSAU recommends that you contact the NHSU Contact Center at 1677.</span></strong></span></div>\r\n', 'change the number of the mobile patient, stop the declaration', 'Change the mobile number, or terminate your doctor\'s declaration'),
(21, 11, 'uk-UA', 'Бухгалтерський облік матеріальних цінностей (запасів)', '<p><a href=\"/web/uploads/accounting/act-for-the-installation-of-tmc-and-auto-parts.doc\">АКТ на встановлення ТМЦ та автозапчастин.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/act-to-write-off-medicines-medical-products.doc\">АКТ на списання лікарських засобів, виробів медичного призначення.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/act-to-write-off-tangible-assets.doc\">АКТ на списання матеріальних цінностей.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/act-of-acceptance-and-transfer-of-tangible-assets.doc\">АКТ прийому-передачі матеріальних цінностей.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/act-on-the-use-of-the-vaccine.doc\">АКТ про використання вакцини.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/the-statement-of-the-car.doc\">Відомість роботи автомобіля.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/defect-act-for-current-repair.doc\">ДЕФЕКТНИЙ АКТ на поточний ремонт.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/taking-off-of-solid-fuel.doc\">ЗАБІРНА ВІДОМІСТЬ на використання твердого палива.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/taking-off-information-for-use.doc\">ЗАБІРНА ВІДОМІСТЬ на використання.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/report-on-the-receipt-and-release-use-of-medicines-medicines-medical-devices.doc\">ЗВІТ про надходження і відпуск (використання) бакпрепаратів, лікарських засобів, виробів медичного призначення.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/report-of-motion-of-lubricants-fuel-stamps.doc\">ЗВІТ руху паливо-мастильних матеріалів (талони на паливо).doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/expiration-requirements-for-the-release-internal-movement-of-medicines-and-medical-devices.doc\">НАКЛАДНА-ВИМОГА на відпуск (внутрішнє переміщення) медикаментів та виробів медичного.doc</a></p>\r\n', '', 'Бухгалтерський облік матеріальних цінностей (запасів)'),
(22, 11, 'en-GB', 'Accounting for tangible assets (inventories)', '<p><a href=\"/web/uploads/accounting/act-for-the-installation-of-tmc-and-auto-parts.doc\">АКТ на встановлення ТМЦ та автозапчастин.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/act-to-write-off-medicines-medical-products.doc\">АКТ на списання лікарських засобів, виробів медичного призначення.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/act-to-write-off-tangible-assets.doc\">АКТ на списання матеріальних цінностей.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/act-of-acceptance-and-transfer-of-tangible-assets.doc\">АКТ прийому-передачі матеріальних цінностей.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/act-on-the-use-of-the-vaccine.doc\">АКТ про використання вакцини.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/the-statement-of-the-car.doc\">Відомість роботи автомобіля.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/defect-act-for-current-repair.doc\">ДЕФЕКТНИЙ АКТ на поточний ремонт.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/taking-off-of-solid-fuel.doc\">ЗАБІРНА ВІДОМІСТЬ на використання твердого палива.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/taking-off-information-for-use.doc\">ЗАБІРНА ВІДОМІСТЬ на використання.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/report-on-the-receipt-and-release-use-of-medicines-medicines-medical-devices.doc\">ЗВІТ про надходження і відпуск (використання) бакпрепаратів, лікарських засобів, виробів медичного призначення.doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/report-of-motion-of-lubricants-fuel-stamps.doc\">ЗВІТ руху паливо-мастильних матеріалів (талони на паливо).doc</a></p>\r\n<p><a href=\"/web/uploads/accounting/expiration-requirements-for-the-release-internal-movement-of-medicines-and-medical-devices.doc\">НАКЛАДНА-ВИМОГА на відпуск (внутрішнє переміщення) медикаментів та виробів медичного.doc</a></p>\r\n', '', 'Accounting for tangible assets (inventories)'),
(23, 12, 'uk-UA', 'Бухгалтерський облік основних засобів', '<p><a href=\"/web/uploads/accounting/act-of-commissioning.doc\">Акт введення в експлуатацію.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-internal-movement-of-fixed-assets.doc\">Акт внутрішнього переміщення основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-transfer-to-the-repair-reconstruction-and-modernization-of-fixed-assets.doc\">Акт передачі на ремонт, реконструкцію та модернізацію основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-revaluation-of-fixed-assets.doc\">Акт переоцінки основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-accepting-repaired-reconstructed-and-upgraded-fixed-assets.doc\">Акт приймання відремонтованих, реконструйованих та модернізованих основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-acceptance-and-transfer-of-fixed-assets.doc\">Акт приймання-передачі основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-writing-off-fixed-assets-partial-liquidation.doc\">Акт списання основних засобів (часткової ліквідації).doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-writing-off-vehicles.doc\">Акт списання транспортних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/inventory-card-of-group-accounting-of-fixed-assets.doc\">Інвентарна картка групового обліку основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/inventory-card-for-accounting-for-fixed-assets.doc\">Інвентарна картка обліку об&rsquo;єкта основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/depreciation-of-other-non-current-tangible-assets.doc\">Розрахунок амортизації інших необоротних матеріальних активів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/depreciation-of-other-non-current-tangible-assets.xls\">Розрахунок амортизації інших необоротних матеріальних активів.xls</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/depreciation-of-fixed-assets-except-for-other-tangible-fixed-assets.doc\">Розрахунок амортизації основних засобів (крім інших необоротних матеріальних активів).doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/depreciation-of-fixed-assets-except-for-other-tangible-fixed-assets.xls\">Розрахунок амортизації основних засобів (крім інших необоротних матеріальних активів).xls</a></p>\r\n', 'форми бухгалтерський облік, форми основні засоби', 'Форми для бухгалтерського обліку основних засобів'),
(24, 12, 'en-GB', 'Accounting for fixed assets', '<p><a href=\"/web/uploads/accounting/act-of-commissioning.doc\">Акт введення в експлуатацію.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-internal-movement-of-fixed-assets.doc\">Акт внутрішнього переміщення основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-transfer-to-the-repair-reconstruction-and-modernization-of-fixed-assets.doc\">Акт передачі на ремонт, реконструкцію та модернізацію основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-revaluation-of-fixed-assets.doc\">Акт переоцінки основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-accepting-repaired-reconstructed-and-upgraded-fixed-assets.doc\">Акт приймання відремонтованих, реконструйованих та модернізованих основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-acceptance-and-transfer-of-fixed-assets.doc\">Акт приймання-передачі основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-writing-off-fixed-assets-partial-liquidation.doc\">Акт списання основних засобів (часткової ліквідації).doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/act-of-writing-off-vehicles.doc\">Акт списання транспортних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/inventory-card-of-group-accounting-of-fixed-assets.doc\">Інвентарна картка групового обліку основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/inventory-card-for-accounting-for-fixed-assets.doc\">Інвентарна картка обліку об&rsquo;єкта основних засобів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/depreciation-of-other-non-current-tangible-assets.doc\">Розрахунок амортизації інших необоротних матеріальних активів.doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/depreciation-of-other-non-current-tangible-assets.xls\">Розрахунок амортизації інших необоротних матеріальних активів.xls</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/depreciation-of-fixed-assets-except-for-other-tangible-fixed-assets.doc\">Розрахунок амортизації основних засобів (крім інших необоротних матеріальних активів).doc</a></p>\r\n\r\n<p><a href=\"/web/uploads/accounting/depreciation-of-fixed-assets-except-for-other-tangible-fixed-assets.xls\">Розрахунок амортизації основних засобів (крім інших необоротних матеріальних активів).xls</a></p>\r\n', 'forms of accounting, forms of fixed assets', 'Forms for accounting for fixed assets'),
(27, 14, 'uk-UA', 'Рекомендації для осіб, з підозрою або хворими на COVID-19, які перебувають вдома на самоізоляції ', '<h3><img alt=\"\" src=\"/web/uploads/articles/Koronavirus.jpg\" style=\"float:left; height:120px; margin:10px; width:140px\" /><strong>Рекомендації для осіб, з підозрою або хворими на </strong><strong>COVID</strong><strong>-19</strong><strong>, які перебувають вдома на самоізоляції </strong></h3>\r\n\r\n<p><strong>Залишайтеся вдома за винятком необхідності медичної допомоги</strong></p>\r\n\r\n<p>Ви повинні обмежувати діяльність поза своїм будинком/квартирою, за винятком отримання медичної допомоги. Не ходіть на роботу, до школи чи громадські приміщення. Не користуйтесь громадським транспортом або таксі.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Відокремте себе від інших людей і тварин у своєму будинку/квартирі</strong></p>\r\n\r\n<p>Люди: Наскільки це можливо, ви повинні залишитися в окремій кімнаті і витримувати дистанцію більше 2 метрів від інших членів сім&rsquo;ї і/або сусідів у вашому домі. Також слід використовувати окремий санвузол, якщо він є.&nbsp; Особливо уважно дотримуйтесь цих положень якщо у вашій сім&rsquo;ї є особи, які віднесені до групи ризику (літній вік, наявність хронічних захворювань: серцево-судинні захворювання, цукровий діабет, захворювання легень тощо).&nbsp;</p>\r\n\r\n<p>Тварини: Не контактуйте з домашніми тваринами чи іншими тваринами під час хвороби.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Заздалегідь зателефонуйте і попередьте про відвідування сімейного лікаря (при необхідності цього і наявності можливості)</strong></p>\r\n\r\n<p>Якщо у вас є лікарський прийом, зателефонуйте до лікаря і скажіть, що у вас є або може бути COVID-19. Це допоможе медичному персоналу вжити заходів, щоб вберегти інших людей від зараження чи впливу. Надіньте маску для обличчя перед контактом з медичними працівниками. &nbsp;Ці кроки допоможуть обмежити поширення інфекції.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Носіть маску для обличчя</strong></p>\r\n\r\n<p>Ви повинні носити маску для обличчя, коли ви знаходитесь біля інших людей (наприклад, спільне використання кімнати чи транспортного засобу) або домашніх тварин і перед відвідуванням закладу охорони здоров&rsquo;я, чи приїздом бригади ЕМД.</p>\r\n\r\n<p>Якщо пацієнт не може носити маску для обличчя (наприклад, тому що це спричиняє проблеми з диханням), тоді люди, які живуть з ним, не повинні залишатися в одній кімнаті з пацієнтом, або вони повинні носити маску для обличчя, якщо вони знаходяться з пацієнтом в одній кімнаті.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Дотримуйтесь гігієнічних правил при кашлі чи чханні</strong></p>\r\n\r\n<p>Прикривайте рот і ніс тканиною чи серветкою при кашлі або чханні. Викидайте використані засоби у окремий контейнер для сміття;</p>\r\n\r\n<p>Негайно мийте руки з милом не менше 20 секунд і/або чистіть руки дезінфікуючим засобом на основі спирту, що містить щонайменше 60% спирту, в достатній кількості, щоб покрити всю поверхню рук, та розтираючи антисептик до його висихання. Мило обов&rsquo;язково використовувати при помітному забрудненні рук.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Миття рук</strong></p>\r\n\r\n<p>Часто мийте руки з милом протягом щонайменше 20 секунд. Якщо не має можливості мити руки їх слід обробляти дезінфікуючими засобами на основі &nbsp;60% спирту, покриваючи всі поверхні рук і розтираючи їх разом, поки вони не стануть сухими. Мило і воду обов&rsquo;язково використовувати при помітному забрудненні рук. Не торкайтеся своїх очей, носа і рота з немитими руками.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Уникайте спільного використання особистих предметів домашнього вжитку</strong></p>\r\n\r\n<p>Не слід спільно користуватися посудом, чашками, рушниками або постільною білизною та іншими предметами домашнього вжитку з іншими людьми або домашніми тваринами. Після використання цих предметів їх слід ретельно очистити миючими засобами і водою.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Дезінфекція предметів/поверхонь</strong></p>\r\n\r\n<p>Слід щодня періодично дезінфікувати всі предмети/поверхні, до яких часто торкаються. До них слід віднести: стійки, стільниці, дверні ручки, світильники для ванної, туалети, телефони, клавіатури, планшети та тумбочки тощо&nbsp; та будь-які поверхні де можуть знаходитись біологічні рідини. З метою дезінфекції слід використовувати побутові миючі засоби або серветки. При їх застосуванні слід дотримуватись інструкцій виробника.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Моніторинг стану здоров&rsquo;я</strong></p>\r\n\r\n<p>Якщо Ви знаходитесь вдома на карантині (самоізоляції), слід уважно слідкувати за станом здоров&rsquo;я. Періодично, протягом дня вимірюйте температуру тіла.</p>\r\n\r\n<p>&nbsp;Негайно зверніться до свого лікаря або телефонуйте 103, якщо ваш стан погіршується, а саме:</p>\r\n\r\n<p>1.1. зросла температура тіла (більше 38,0 &deg;С) або у вас з&rsquo;явився озноб або відчуття гарячки і/або</p>\r\n\r\n<p>1.2. з&rsquo;явилося затруднене дихання, задишка і/або</p>\r\n\r\n<p>1.3. постійний кашель і/або</p>\r\n\r\n<p>1.4. стійкий постійний біль в грудній клітці.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Припинення самоізоляції</strong></p>\r\n\r\n<p>Рішення про припинення самоізоляції та запобіжних заходів приймається в кожному випадку окремо та приймається після консультації з медичними працівниками та відповідно до правил встановленими місцевими органами охорони здоров&rsquo;я.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Джерело: <a href=\"https://www.cdc.gov/coronavirus/2019-ncov/if-you-are-sick/steps-when-sick.html\">https://www.cdc.gov/coronavirus/2019-ncov/if-you-are-sick/steps-when-sick.html</a></p>\r\n', 'коронавірус рекомендації, коронавірус самоізоляція', 'Рекомендації для осіб, з підозрою або хворими на COVID-19, які перебувають вдома на самоізоляції'),
(28, 14, 'en-GB', 'Recommendations for those suspected or ill with COVID-19 who are at home on self-isolation', '<p><strong>Recommendations for people suspected or ill with COVID-19 who are at home on self-isolation</strong></p>\r\n\r\n<p><strong>Stay home unless you need medical attention</strong><br />\r\nYou should restrict your activities outside your home / apartment, except for medical assistance. Do not go to work, school or public places. Do not use public transportation or taxis.</p>\r\n\r\n<p>Separate yourself from other people and animals in your home / apartment<br />\r\nPeople: As far as possible, you should stay in a separate room and maintain a distance of more than 2 meters from other family members and / or neighbors in your home. You should also use a separate bathroom, if available. Pay particular attention to these provisions if your family is at risk (old age, chronic conditions: cardiovascular disease, diabetes, lung disease, etc.).</p>\r\n\r\n<p>Animals: Do not come in contact with pets or other animals during illness.</p>\r\n\r\n<p><strong>Call and alert your family doctor in advance (if necessary and available)</strong><br />\r\nIf you have a medication, call your doctor and say you have or may have COVID-19. This will help the medical staff take action to prevent other people from becoming infected or exposed. Wear a face mask before contacting a healthcare provider. These steps will help limit the spread of the infection.</p>\r\n\r\n<p><strong>Wear a face mask</strong><br />\r\nYou must wear a face mask when you are near other people (such as sharing a room or vehicle) or pets, and before attending a healthcare facility or the arrival of an EMD team.<br />\r\nIf the patient cannot wear a face mask (for example, because it causes breathing problems), then people living with him should not stay in the same room with the patient, or they must wear a face mask if they are with the patient. in one room.</p>\r\n\r\n<p><strong>Follow hygiene rules when coughing or sneezing</strong><br />\r\nCover your mouth and nose with a cloth or cloth when coughing or sneezing. Dispose of used equipment in a separate trash bin;<br />\r\nWash your hands immediately with soap for at least 20 seconds and / or clean your hands with an alcohol-based disinfectant containing at least 60% alcohol in sufficient quantity to cover the entire surface of your hands and rubbing the antiseptic until dry. Be sure to use soap when the hands are clearly soiled.</p>\r\n\r\n<p><strong>Hand washing</strong><br />\r\nWash your hands frequently with soap for at least 20 seconds. If it is not possible to wash their hands, they should be treated with 60% alcohol-based disinfectants, covering all surfaces of the hands and rubbing them together until they are dry. Be sure to use soap and water when your hands are soiled. Do not touch your eyes, nose or mouth with unwashed hands.</p>\r\n\r\n<p><strong>Avoid sharing personal household items</strong><br />\r\nDo not share utensils, cups, towels or bedding and other household items with other people or pets. After using these items, they should be thoroughly cleaned with detergents and water.</p>\r\n\r\n<p><br />\r\n<strong>Disinfection of objects / surfaces</strong><br />\r\nAll objects / surfaces that are frequently touched should be periodically disinfected. These include: racks, countertops, door handles, bathroom fixtures, toilets, phones, keyboards, tablets and bedside tables, etc. and any surfaces where biological fluids may be present. Household cleaners or wipes should be used for disinfection. When used, follow the manufacturer&#39;s instructions.</p>\r\n\r\n<p><strong>Health monitoring</strong><br />\r\nIf you are quarantined (self-isolation) at home, you should monitor your health closely. Periodically, during the day, measure body temperature.<br />\r\n&nbsp;Contact your doctor immediately or call 103 if your condition deteriorates, namely:<br />\r\n1.1. body temperature has increased (more than 38.0 &deg; C) or you have a fever or feeling feverish and / or<br />\r\n1.2. had difficulty breathing, shortness of breath and / or<br />\r\n1.3. persistent cough and / or<br />\r\n1.4. persistent constant chest pain.</p>\r\n\r\n<p><strong>Termination of self-isolation</strong><br />\r\nThe decision to discontinue self-isolation and precautionary measures shall be taken on a case-by-case basis and shall be made after consultation with healthcare professionals and in accordance with the rules established by the local health authorities.</p>\r\n\r\n<p><br />\r\nSource: https://www.cdc.gov/coronavirus/2019-ncov/if-you-are-sick/steps-when-sick.html</p>\r\n', 'coronavirus recommendations, coronavirus self-isolation', 'Recommendations for those suspected or ill with COVID-19 who are at home on self-isolation'),
(29, 15, 'uk-UA', 'Наказ МОЗ України \"Організація надання медичної допомоги хворим на коронавірусну хворобу (COVID-19)\"', '<h3><img alt=\"\" src=\"/web/uploads/articles/Covid-19.png\" style=\"float:left; height:177px; margin-left:10px; margin-right:10px; width:384px\" /><strong><a href=\"https://moz.gov.ua/article/ministry-mandates/nakaz-moz-ukraini-vid-13032020--663-pro-optimizaciju-zahodiv-schodo-nedopuschennja-zanesennja-i-poshirennja-na-teritorii-ukraini-vipadkiv-covid-19\" target=\"_blank\"><span style=\"background-color:#FFFF00\">Наказ МОЗ України від 13.03.2020 № 663 &quot;Про оптимізацію заходів щодо недопущення занесення і поширення на території України випадків COVID-19&quot; з документами (<span style=\"color:#FF0000\">перехід на сайт МОЗУ</span>)</span></a></strong></h3>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:14px\"><span style=\"color:#FFFF00\"><strong><span style=\"background-color:#FF0000\">!!!Наказ МОЗ України від 13.03.2020 №663 втратив свою чинність!!!</span></strong></span></span></p>\r\n\r\n<h3><strong><a href=\"https://moz.gov.ua/article/ministry-mandates/nakaz-moz-ukraini-vid-28032020--722-organizacija-nadannja-medichnoi-dopomogi-hvorim-na-koronavirusnu-hvorobu-covid-19\" target=\"_blank\"><span style=\"background-color:#FFFF00\">Наказ МОЗ України від 28.03.2020 № 722 &quot;Організація надання медичної допомоги хворим на коронавірусну хворобу (COVID-19)&quot; (</span><span style=\"color:#FF0000\"><span style=\"background-color:#FFFF00\">перехід на сайт МОЗУ</span></span><span style=\"background-color:#FFFF00\">)</span></a></strong></h3>\r\n', 'Наказ МОЗ України 663, 722, недопущення занесення Covid-19, надання медичної допомоги хворим на COVID-19', 'Наказ МОЗ України Організація надання медичної допомоги хворим на коронавірусну хворобу (COVID-19)'),
(30, 15, 'en-GB', 'Order of the Ministry of Health of Ukraine \"Organization of Medical Assistance to Patients with Coronavirus Disease (COVID-19)\"', '<h3><img alt=\"\" src=\"/web/uploads/articles/Covid-19.png\" style=\"float:left; height:177px; margin-left:10px; margin-right:10px; width:384px\" /><strong><a href=\"https://moz.gov.ua/article/ministry-mandates/nakaz-moz-ukraini-vid-13032020--663-pro-optimizaciju-zahodiv-schodo-nedopuschennja-zanesennja-i-poshirennja-na-teritorii-ukraini-vipadkiv-covid-19\" target=\"_blank\"><span style=\"background-color:#FFFF00\">Order of the Ministry of Health of Ukraine dated 13.03.2020 No. 663 &quot;On Optimization of Measures to Prevent COVID-19 Cases and Dissemination in the Territory of Ukraine&quot; with documents (<span style=\"color:#FF0000\">go to the Ministry of Health of Ukraine</span>)</span></a></strong></h3>\r\n', 'Ministry of Health of Ukraine Order 663, preventing Covid-19 from entering', 'Order of the Ministry of Health of Ukraine Organization of Medical Assistance to Patients with Coronavirus Disease (COVID-19)'),
(31, 16, 'uk-UA', 'Боротьба з Коронавірусом (SARS-CoV-2)', '<h3 style=\"text-align:center\"><span style=\"color:#FF0000\"><span style=\"font-size:22px\"><strong>Боротьба з Коронавірусом (SARS-CoV-2)</strong></span></span></h3>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#0000FF\"><span style=\"font-size:14px\"><strong>Команда &quot;КНП&nbsp;Березнівського ЦПМД&quot; безстрашно&nbsp;бореться з небезпечною інфекцією</strong></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:20px\"><strong><a href=\"https://covid19.gov.ua\" target=\"_blank\"><span style=\"color:#FF0000\"><span style=\"background-color:#FFFF00\">Все що потрібно знати про новий коронавірус?</span></span></a></strong></span></p>\r\n\r\n<p style=\"text-align:center\"><strong><span style=\"font-size:20px\"><a href=\"https://berezne-pmd.rv.ua/uk/article/recommendations-for-those-suspected-or-ill-with-covid-19-who-are-at-home-on-self-isolation\"><span style=\"color:#008000\"><span style=\"background-color:#FFFF00\">Рекомендації для осіб, з підозрою або хворими на COVID-19, які перебувають вдома на самоізоляції!!!</span></span></a></span></strong></p>\r\n\r\n<table align=\"center\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/articles/Combating-Coronavirus-1.jpg\" style=\"height:347px; width:260px\" /></td>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/articles/Combating-Coronavirus-2.jpg\" style=\"height:348px; width:260px\" /></td>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/articles/Combating-Coronavirus-3.jpg\" style=\"height:276px; width:300px\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/articles/Combating-Coronavirus-4.jpg\" style=\"height:347px; width:260px\" /></td>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/articles/IMG_20200326_143212-2.jpg\" style=\"height:347px; width:260px\" /></td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Боротьба з Коронавірусом (SARS-CoV-2)', 'Боротьба з Коронавірусом (SARS-CoV-2)');
INSERT INTO `articles_i18n` (`id`, `parent_table_id`, `language`, `title`, `body`, `keywords`, `description`) VALUES
(32, 16, 'en-GB', 'Combating Coronavirus (SARS-CoV-2)', '<h3 style=\"text-align:center\"><span style=\"color:#FF0000\"><span style=\"font-size:22px\"><strong>Fighting Coronavirus (SARS-CoV-2)</strong></span></span></h3>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#0000FF\"><span style=\"font-size:14px\"><strong>Bereznivsky CPMD team fights dangerous infection fearlessly</strong></span></span></p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:20px\"><strong><a href=\"https://covid19.gov.ua\" target=\"_blank\"><span style=\"color:#FF0000\"><span style=\"background-color:#FFFF00\">All you need to know about the new coronavirus?</span></span></a></strong></span></p>\r\n\r\n<p style=\"text-align:center\"><strong><span style=\"font-size:20px\"><a href=\"https://berezne-pmd.rv.ua/uk/article/recommendations-for-those-suspected-or-ill-with-covid-19-who-are-at-home-on-self-isolation\"><span style=\"color:#008000\"><span style=\"background-color:#FFFF00\">Recommendations for those suspected or ill with COVID-19 who are at home on self-isolation!!!</span></span></a></span></strong></p>\r\n\r\n<table align=\"center\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/combating-coronavirus/Combating-Coronavirus-1.jpg\" style=\"height:347px; width:260px\" /></td>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/combating-coronavirus/Combating-Coronavirus-2.jpg\" style=\"height:348px; width:260px\" /></td>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/combating-coronavirus/Combating-Coronavirus-3.jpg\" style=\"height:276px; width:300px\" /></td>\r\n		</tr>\r\n		<tr>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/combating-coronavirus/Combating-Coronavirus-4.jpg\" style=\"height:347px; width:260px\" /></td>\r\n			<td><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/combating-coronavirus/IMG_20200326_143212-2.jpg\" style=\"height:347px; width:260px\" /></td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Combating Coronavirus (SARS-CoV-2)', 'Combating Coronavirus (SARS-CoV-2)'),
(33, 17, 'uk-UA', 'Фінансові звіти 2018', '<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>Звіти КНП &quot;БЕРЕЗНІВСЬКИЙ РАЙОННИЙ ЦЕНТР ПМД&quot; за 2018</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"1\"><strong>Фінансові:</strong></td>\r\n			<td><a href=\"/web/uploads/reports/financial-report-of-the-small-business-entity-for-2018.pdf\" onclick=\"window.open(this.href, \'2018\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Фінансовий звіт суб&#39;єкта малого підприємництва за 2018 рік.</strong></a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Фінансові звіти 2018', 'Фінансові звіти 2018'),
(34, 17, 'en-GB', 'Financial statements 2018', '<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>MPE &quot;BEREZNIV DISTRICT CENTER PMD&quot; reports 2018</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"1\"><strong>Financial:</strong></td>\r\n			<td><strong><a href=\"/web/uploads/reports/Financial-Report-of-the-Small-Business-Entity-for-2018.pdf\" onclick=\"window.open(this.href, \'FinancialReportoftheSmallBusinessEntityfor2018\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Financial Report of the Small Business Entity for 2018</a></strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Financial statements 2018', 'Financial statements 2018'),
(35, 18, 'uk-UA', 'Фінансові звіти 2019', '<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>Звіти КНП &quot;БЕРЕЗНІВСЬКИЙ РАЙОННИЙ ЦЕНТР ПМД&quot; за 2019</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"11\"><strong>Фінансові:</strong></td>\r\n			<td><a href=\"/web/uploads/reports/financial-plan-2019.pdf\" onclick=\"window.open(this.href, \'2019\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Фінансовий план на 2019 рік.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-report-of-small-business-entity-for-I-quarter-2019.pdf\" onclick=\"window.open(this.href, \'2019\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Фінансовий звіт суб&#39;єкта малого підприємництва за І квартал 2019 року.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-implementation-of-the-financial-plan-for-the-first-quarter-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Звіт про виконання фінансового плану за І квартал 2019 року.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-implementation-of-the-financial-plan-for-the-first-half-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Звіт про виконання фінансового плану за І півріччя 2019 року.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-report-of-the-small-business-entity-for-the-first-half-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Фінансовий звіт суб&#39;єкта малого підприємництва за І півріччя 2019 року.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-the-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-third-quarter-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Інформація про надходження і використання благодійних пожерт від фізичних та юридичних осіб за ІІІ квартал 2019</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/the-financial-statement-of-the-small-business-entity-for-9-months-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Фінансовий звіт суб&#39;єкта малого підприємництва за 9 місяців 2019 року</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-the-implementation-of-the-financial-plan-for-9-months-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Звіт про виконання фінансового плану за 9 місяців 2019 року</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-plan-with-explanatory-note-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Фінансовий план з пояснювальною запискою на 2020 рік</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-about-the-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-4th-quarter-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Інформація про надходження і використання благодійних пожертв від фізичних та юридичних осіб за 4 квартал 2019 року</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/2019-financial-plan-implementation-report.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Звіт про виконання фінансового плану за 2019 рік</strong></a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Фінансові звіти 2019', 'Фінансові звіти 2019'),
(36, 18, 'en-GB', 'Financial statements 2019', '<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\"><strong>MPE &quot;BEREZNIV DISTRICT CENTER PMD&quot; reports 2019</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"11\"><strong>Financial:</strong></td>\r\n			<td><strong><a href=\"/web/uploads/reports/Financial-plan-2019.pdf\" onclick=\"window.open(this.href, \'Financialplan2019\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Financial plan 2019</a></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong><a href=\"/web/uploads/reports/Financial-report-of-small-business-entity-for-I-quarter-2019.pdf\" onclick=\"window.open(this.href, \'2019\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Financial report of small business entity for I quarter 2019</a></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong><a href=\"/web/uploads/reports/report-on-implementation-of-the-financial-plan-for-the-first-quarter-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Report on implementation of the financial plan for the first quarter of 2019.</a></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong><a href=\"/web/uploads/reports/report-on-implementation-of-the-financial-plan-for-the-first-half-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Report on implementation of the financial plan for the first half of 2019.</a></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong><a href=\"/web/uploads/reports/financial-report-of-the-small-business-entity-for-the-first-half-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Financial report of the small business entity for the first half of 2019.</a></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-the-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-third-quarter-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Information on the receipt and use of charitable donations from individuals and legal entities for the third quarter of 2019</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/the-financial-statement-of-the-small-business-entity-for-9-months-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>The financial statement of the small business entity for 9 months 2019</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-the-implementation-of-the-financial-plan-for-9-months-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Report on the implementation of the financial plan for 9 months 2019</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-plan-with-explanatory-note-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Financial plan with explanatory note for 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-about-the-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-4th-quarter-of-2019.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Information about the receipt and use of charitable donations from individuals and legal entities for the 4th quarter of 2019</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/2019-financial-plan-implementation-report.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>2019 Financial Plan Implementation Report</strong></a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Financial statements 2019', 'Financial statements 2019'),
(37, 19, 'uk-UA', '19 травня Всесвітній день сімейного лікаря', '<p><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/articles/may-19-world-family-physicians-day.jpg\" style=\"height:409px; width:600px\" /></p>\r\n', '19 травня,  Всесвітній день сімейного лікаря', '19 травня Всесвітній день сімейного лікаря'),
(38, 19, 'en-GB', 'May 19 World Family Physician\'s Day', '<p><img alt=\"\" class=\"thumbnail\" src=\"/web/uploads/articles/may-19-world-family-physicians-day.jpg\" style=\"height:409px; width:600px\" /></p>\r\n', 'May 19,  World Family Physician\'s Day', 'May 19 World Family Physician\'s Day'),
(39, 20, 'uk-UA', 'З днем медичного працівника 2020', '<h3 style=\"text-align:center\"><img alt=\"\" src=\"/web/uploads/articles/medical-workers-day.jpg\" style=\"float:left; height:374px; margin-right:10px; width:512px\" />Вітаємо З днем медичного працівника 2020</h3>\r\n\r\n<p style=\"text-align:justify\"><span style=\"color:rgb(10, 10, 10); font-family:proximanova-regular,sans-serif; font-size:16px\">Дорогі медичні працівники, колеги! Прийміть найщиріші вітання із професійним святом. Ви представляєте одну з найшляхетніших професій, адже оберігаєте найбільший дар Господній &ndash; людське життя! У цьому жертовному, щоденному служінні часто не маєте права на спокій, відпочинок, власні емоції чи навіть страх. І вдень і вночі Ви були поруч, аби встигнути допомогти хворому! У надважкий час Ви на цілодобовій сторожі людського життя. Кожен із Вас виконує надважливу функцію лікування та порятунку українців: чи то на прийомі в поліклініці, чи в операційній. Нехай же Господь за Вашу мужність пошле міцного здоров&#39;я та сил. Дякуємо Вам за все, ангели-охоронці в білих халатах!</span></p>\r\n', 'День медичного працівника 2020', 'Вітаємо З днем медичного працівника 2020'),
(40, 20, 'en-GB', 'Happy Medical Worker\'s Day 2020', '<h3 style=\"text-align:center\"><img alt=\"\" src=\"/web/uploads/articles/medical-workers-day.jpg\" style=\"float:left; height:374px; margin-right:10px; width:512px\" />Congratulations on the Day of the Medical Worker 2020</h3>\r\n\r\n<p style=\"text-align:justify\"><span style=\"font-size:16px\">Dear medical workers, colleagues! Please accept my sincere congratulations on your professional holiday. You represent one of the noblest professions, because you protect the greatest gift of the Lord - human life! In this sacrificial, daily service, you often do not have the right to rest, rest, your own emotions, or even fear. You were there day and night to help the patient! In extremely difficult times, you are on round-the-clock guard of human life. Each of you performs a vital function of treatment and rescue of Ukrainians: whether at a clinic or operating room. May the Lord send you for good health and strength for your courage. Thank you for everything, guardian angels in white coats!</span></p>\r\n', 'Happy Medical Worker\'s Day 2020', 'Congratulations on the Day of the Medical Worker 2020'),
(41, 21, 'uk-UA', 'Грип', '<h3><br />\r\n<img alt=\"\" src=\"/web/uploads/articles/pro-gryp.jpg\" style=\"float:left; height:250px; margin:5px; width:200px\" />Про грип</h3>\r\n\r\n<p><strong>До уваги суб&rsquo;єктів господарювання щодо необхідності здійснення вакцинації</strong></p>\r\n\r\n<p><strong>Грип</strong> - це гостре інфекційне респіраторне захворювання вірусної природи. Вірус грипу дуже контагиоз ( &laquo;заразний&raquo;) - тобто його потрапляння в організм людини у великому відсотку випадків призводить до розвитку захворювання. <a name=\"H1-SYMPTOMY-HRYPU\"></a></p>\r\n\r\n<p><strong>Симптоми грипу</strong></p>\r\n\r\n<p>Характерними ознаками захворювання є дуже швидке - протягом 3-4 годин - наростання симптомів інтоксикації: підйом температури до 39 &deg; С і вище, що супроводжується сильним ознобом, слабкістю, ломота в м&#39;язах, суглобах, сильним головним болем, а також різзю в очах, сльозотечею, світлобоязню. Паралельно з інтоксикацією з&#39;являються респіраторні симптоми:&nbsp;<a href=\"https://healthday.in.ua/narmed/likuemo-bil-u-gorli-vdoma-legko-ta-shvidko\" title=\"біль в горлі\">біль у горлі</a>, сухий, часто - виснажливий, кашель,&nbsp;<a href=\"https://healthday.in.ua/narmed/likuiemo-nezhyt-shvydko\">рясна нежить</a>. Іноді відзначаються болі в животі і рідкі випорожнення. Висока температура при грипі може зберігатися до декількох днів, досить часто вона погано піддається впливу жарознижувальних препаратів. При відсутності ускладнень захворювання триває 7-10 днів. Протягом цього часу його симптоми поступово йдуть, хоча загальна слабкість може зберігатися ще до двох тижнів.<a name=\"H7-PROFILAKTYKA-HRYPU\"></a></p>\r\n\r\n<p><strong>Профілактика грипу</strong></p>\r\n\r\n<p>Щорічна вакцинація є найефективнішим засобом для захисту організму від вірусів грипу. Вакцина захищає від усіх актуальних штамів грипу, є безпечною і ефективною.</p>\r\n\r\n<p>Найкращий час для проведення вакцинації &mdash; напередодні грипозного сезону (у вересні). Якщо такої можливості не було, то вакцинуватися можна і впродовж всього сезону. Всупереч поширеному міфу, це не ослаблює, а посилює здатність організму протистояти грипу.</p>\r\n\r\n<p>Вакцинування від грипу дозволить уникнути одночасного інфікування грипом і коронавірусом.</p>\r\n\r\n<p><strong>ЯК ПРОЙТИ ВАКЦИНАЦІЮ</strong></p>\r\n\r\n<p><strong>1. Зверніться до свого сімейного лікаря, терапевта чи педіатра</strong></p>\r\n\r\n<p>Лікар огляне вас, визначить, чи немає проитпоказань, а також надасть поради щодо транспотування вакцини, адже вона вимагає збереження холодового ланцюга.</p>\r\n\r\n<p><a name=\"_dx_frag_StartFragment\"></a><strong>2. Придбайте вакцину в аптеці вашого міста чи безпосередньо у клініці</strong></p>\r\n\r\n<p>Від часу придбання вакицини до її введення має пройти не більше двох годин, інакще є ризик, що вакцина&nbsp;втратить свої захисні властивості. Тому важливо зберегти чек для визначення точної дати й часу придбання вакцини.</p>\r\n\r\n<p>Доставити вакцину до кабінету щеплень важливо без порушень холодового ланцюга. Інакше вакцина може втратити свої якості. У пригоді стане спеціальна сумка з холодовим елементом, яку можна придбати або ж отримати під заставу в аптеці (близько 200 грн). Також деякі аптеки надають послугу безкоштовної доставки вакцини.</p>\r\n\r\n<p><strong>3.&nbsp;Отримайте щеплення</strong></p>\r\n\r\n<p>Вакцинацію здійснюють у кабінетах щеплень або кабінеті сімейного лікаря, якщо він облаштований для цього.</p>\r\n\r\n<p>Відповідно до розпорядження голови облдержадміністрації від 12.11.2019 № 937 &bdquo;Про затвердження плану заходів з готовності в міжепідемічний період та реагування під час епідемічного підйому захворюваності на грип та гострі респіраторні вірусні інфекції в Рівненській області на 2019 - 2024 роки&rdquo; (із змінами) та листа управління охорони здоров&rsquo;я облдержадміністрації від 04.09.2020 № вих-3838/01-13/20 доводимо до відома суб&rsquo;єктів господарювання, що здійснюють діяльність у сфері торговельного обслуговування населення, про необхідність проведення вакцинації від грипу, особливо серед осіб, що входять до професійних груп ризику (зокрема, продавці, особи, що працюють в багатолюдних місцях).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Бережіть своє здоров&rsquo;я!</strong></p>\r\n', 'Про Грип', 'Про Грип'),
(42, 21, 'en-GB', 'Flu', '<h3><br />\r\n<img alt=\"\" src=\"/web/uploads/articles/pro-gryp.jpg\" style=\"float:left; height:250px; margin:5px; width:200px\" />Про грип</h3>\r\n\r\n<p><strong>До уваги суб&rsquo;єктів господарювання щодо необхідності здійснення вакцинації</strong></p>\r\n\r\n<p><strong>Грип</strong> - це гостре інфекційне респіраторне захворювання вірусної природи. Вірус грипу дуже контагиоз ( &laquo;заразний&raquo;) - тобто його потрапляння в організм людини у великому відсотку випадків призводить до розвитку захворювання. <a name=\"H1-SYMPTOMY-HRYPU\"></a></p>\r\n\r\n<p><strong>Симптоми грипу</strong></p>\r\n\r\n<p>Характерними ознаками захворювання є дуже швидке - протягом 3-4 годин - наростання симптомів інтоксикації: підйом температури до 39 &deg; С і вище, що супроводжується сильним ознобом, слабкістю, ломота в м&#39;язах, суглобах, сильним головним болем, а також різзю в очах, сльозотечею, світлобоязню. Паралельно з інтоксикацією з&#39;являються респіраторні симптоми:&nbsp;<a href=\"https://healthday.in.ua/narmed/likuemo-bil-u-gorli-vdoma-legko-ta-shvidko\" title=\"біль в горлі\">біль у горлі</a>, сухий, часто - виснажливий, кашель,&nbsp;<a href=\"https://healthday.in.ua/narmed/likuiemo-nezhyt-shvydko\">рясна нежить</a>. Іноді відзначаються болі в животі і рідкі випорожнення. Висока температура при грипі може зберігатися до декількох днів, досить часто вона погано піддається впливу жарознижувальних препаратів. При відсутності ускладнень захворювання триває 7-10 днів. Протягом цього часу його симптоми поступово йдуть, хоча загальна слабкість може зберігатися ще до двох тижнів.<a name=\"H7-PROFILAKTYKA-HRYPU\"></a></p>\r\n\r\n<p><strong>Профілактика грипу</strong></p>\r\n\r\n<p>Щорічна вакцинація є найефективнішим засобом для захисту організму від вірусів грипу. Вакцина захищає від усіх актуальних штамів грипу, є безпечною і ефективною.</p>\r\n\r\n<p>Найкращий час для проведення вакцинації &mdash; напередодні грипозного сезону (у вересні). Якщо такої можливості не було, то вакцинуватися можна і впродовж всього сезону. Всупереч поширеному міфу, це не ослаблює, а посилює здатність організму протистояти грипу.</p>\r\n\r\n<p>Вакцинування від грипу дозволить уникнути одночасного інфікування грипом і коронавірусом.</p>\r\n\r\n<p><strong>ЯК ПРОЙТИ ВАКЦИНАЦІЮ</strong></p>\r\n\r\n<p><strong>1. Зверніться до свого сімейного лікаря, терапевта чи педіатра</strong></p>\r\n\r\n<p>Лікар огляне вас, визначить, чи немає проитпоказань, а також надасть поради щодо транспотування вакцини, адже вона вимагає збереження холодового ланцюга.</p>\r\n\r\n<p><a name=\"_dx_frag_StartFragment\"></a><strong>2. Придбайте вакцину в аптеці вашого міста чи безпосередньо у клініці</strong></p>\r\n\r\n<p>Від часу придбання вакицини до її введення має пройти не більше двох годин, інакще є ризик, що вакцина&nbsp;втратить свої захисні властивості. Тому важливо зберегти чек для визначення точної дати й часу придбання вакцини.</p>\r\n\r\n<p>Доставити вакцину до кабінету щеплень важливо без порушень холодового ланцюга. Інакше вакцина може втратити свої якості. У пригоді стане спеціальна сумка з холодовим елементом, яку можна придбати або ж отримати під заставу в аптеці (близько 200 грн). Також деякі аптеки надають послугу безкоштовної доставки вакцини.</p>\r\n\r\n<p><strong>3.&nbsp;Отримайте щеплення</strong></p>\r\n\r\n<p>Вакцинацію здійснюють у кабінетах щеплень або кабінеті сімейного лікаря, якщо він облаштований для цього.</p>\r\n\r\n<p>Відповідно до розпорядження голови облдержадміністрації від 12.11.2019 № 937 &bdquo;Про затвердження плану заходів з готовності в міжепідемічний період та реагування під час епідемічного підйому захворюваності на грип та гострі респіраторні вірусні інфекції в Рівненській області на 2019 - 2024 роки&rdquo; (із змінами) та листа управління охорони здоров&rsquo;я облдержадміністрації від 04.09.2020 № вих-3838/01-13/20 доводимо до відома суб&rsquo;єктів господарювання, що здійснюють діяльність у сфері торговельного обслуговування населення, про необхідність проведення вакцинації від грипу, особливо серед осіб, що входять до професійних груп ризику (зокрема, продавці, особи, що працюють в багатолюдних місцях).</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Бережіть своє здоров&rsquo;я!</strong></p>\r\n', 'About the Flu', 'About the Flu'),
(43, 22, 'uk-UA', 'Фінансові звіти 2020', '<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"background-color:#FFFF00\"><strong>Звіти КНП &quot;БЕРЕЗНІВСЬКИЙ ЦЕНТР ПМД&quot;</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"14\"><strong>Фінансові:</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/S0110012-1st-2nd-the-financial-statement-of-a-small-business-entity.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>S0110012 1-м, 2-м. Фінансовий звіт суб&#39;єкта малого підприємництва</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-1st-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Інформація про надходження і використання благодійних пожертв від фізичних та юридичних осіб за 1 квартал 2020 року</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-report-of-small-business-entity-for-I-quarter-2020.pdf\" onclick=\"window.open(this.href, \'2019\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Фінансовий звіт суб&#39;єкта малого підприємництва за І квартал 2020 року.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-implementation-of-the-financial-plan-for-the-first-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Звіт про виконання фінансового плану за І квартал 2020 року.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-2nd-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Інформація про надходження і використання благодійних пожертв від фізичних та юридичних осіб за 2 квартал 2020 року</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-implementation-of-the-financial-plan-for-the-first-half-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Звіт про виконання фінансового плану за І півріччя 2020 року.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/1st-2nd-the-financial-statement-of-a-small-business-entity-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>1-м, 2-м. Фінансовий звіт суб&#39;єкта малого підприємництва.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-3rd-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Інформація про надходження і використання благодійних пожертв від фізичних та юридичних осіб за 3 квартал 2020 року</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-report-of-a-small-business-entity-for-9-months-of-2020.pdf\" onclick=\"window.open(this.href, \'2019\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Фінансовий звіт суб&#39;єкта малого підприємництва за 9 місяців 2020 року.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-the-implementation-of-the-financial-plan-for-9-months-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Звіт про виконання фінансового плану за 9 місяців 2020 року.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-4rd-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Інформація про надходження і використання благодійних пожертв від фізичних та юридичних осіб за 4 квартал 2020 року</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-the-implementation-of-the-financial-plan-for-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Звіт про виконання фінансового плану за 2020 рік</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-report-of-a-small-business-entity-for-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Фінансовий звіт суб&rsquo;єкта малого підприємництва за 2020 рік</strong></a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Фінансові звіти 2020', 'Фінансові звіти 2020'),
(44, 22, 'en-GB', 'Financial statements 2020', '<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"background-color:#FFFF00\"><strong>MPE &quot;BEREZNIVSKIY CENTER PMD&quot; reports</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"14\"><strong>Financial:</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/S0110012-1st-2nd-the-financial-statement-of-a-small-business-entity.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>S0110012 1st, 2nd. The financial statement of a small business entity</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-1st-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Information on receipt and use of charitable donations from individuals and legal entities for the 1st quarter of 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-report-of-small-business-entity-for-I-quarter-2020.pdf\" onclick=\"window.open(this.href, \'2019\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Financial report of small business entity for I quarter 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-implementation-of-the-financial-plan-for-the-first-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Report on implementation of the financial plan for the first quarter of 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-2nd-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Information on receipt and use of charitable donations from individuals and legal entities for the 2nd quarter of 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-implementation-of-the-financial-plan-for-the-first-half-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Report on implementation of the financial plan for the first half of 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/1st-2nd-the-financial-statement-of-a-small-business-entity-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>1st 2nd the financial statement of a small business entity 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-3rd-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Information on receipt and use of charitable donations from individuals and legal entities for the 3rd quarter of 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-report-of-a-small-business-entity-for-9-months-of-2020.pdf\" onclick=\"window.open(this.href, \'2019\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Financial report of a small business entity for 9 months of 2020.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-the-implementation-of-the-financial-plan-for-9-months-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Report on the implementation of the financial plan for 9 months of 2020.</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/information-on-receipt-and-use-of-charitable-donations-from-individuals-and-legal-entities-for-the-4rd-quarter-of-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Information on receipt and use of charitable donations from individuals and legal entities for the 4rd quarter of 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/report-on-the-implementation-of-the-financial-plan-for-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Report on the implementation of the financial plan for 2020</strong></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td><a href=\"/web/uploads/reports/financial-report-of-a-small-business-entity-for-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=no,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\"><strong>Financial report of a small business entity for 2020</strong></a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Financial statements 2020', 'Financial statements 2020'),
(45, 23, 'uk-UA', 'Автоматизований табель обліку робочого часу. Типова форма № П-5', '<p>Автоматизований табель обліку робочого часу&nbsp;- типова форма № П-5, наказ Держкомстату України від 05.12.2008 № 489, дозволяє в автоматичному режимі розрахувати кількість днів та годин для працівників державної установи. Достатньо лише ввести ПІП працівника, кількість відпрацьованого часу та вибрати з випадаючого списку тип робочих годин - далі програма все зробить сама. Ви отримаєте готовий макет для друку. На разі табель підтримує 16 працівників, але якщо Ви &quot;дружите&quot; з Excel - зможете переробити під свої потреби... :)</p>\r\n\r\n<p>Опис:</p>\r\n\r\n<ul>\r\n	<li>\r\n	<p>табель являє собою екселівський файл який виконує розрахунки відповідно до введеної інформації;</p>\r\n	</li>\r\n	<li>\r\n	<p>файл складається з чотирьох сторінок: Дані, ДрукКоди, ДрукТабель, Підсумки;</p>\r\n	</li>\r\n	<li>\r\n	<p>всі розрахунки виконуються автоматично;</p>\r\n	</li>\r\n</ul>\r\n\r\n<p><em>Алгоритм роботи з табелем:</em></p>\r\n\r\n<ul>\r\n	<li>на сторінці Дані вносимо вхідну інформацію про працівників, відпрацьовані години необхідно вносити через &quot;:&quot; (двокрапку, наприклад - 7:15), тип робочих годин вибираємо з випадаючого списку;</li>\r\n</ul>\r\n\r\n<p><img alt=\"\" src=\"https://github.com/YuriiRadio/Automated-working-time-accounting-card.-Form-number-5/raw/master/tabel1.png\" style=\"background-color:var(--color-bg-primary); border-style:none; box-sizing:initial; max-width:100%\" /></p>\r\n\r\n<p><img alt=\"\" src=\"https://github.com/YuriiRadio/Automated-working-time-accounting-card.-Form-number-5/raw/master/tabel2.png\" style=\"background-color:var(--color-bg-primary); border-style:none; box-sizing:initial; max-width:100%\" /></p>\r\n\r\n<ul>\r\n	<li>вводимо місяць за який складається табель;</li>\r\n</ul>\r\n\r\n<p><img alt=\"\" src=\"https://github.com/YuriiRadio/Automated-working-time-accounting-card.-Form-number-5/raw/master/tabel3.png\" style=\"background-color:var(--color-bg-primary); border-style:none; box-sizing:initial; max-width:100%\" /></p>\r\n\r\n<ul>\r\n	<li>вводимо звітний період, дату заповнення, тих хто буде підписувати документ;</li>\r\n</ul>\r\n\r\n<p><img alt=\"\" src=\"https://github.com/YuriiRadio/Automated-working-time-accounting-card.-Form-number-5/raw/master/tabel4.png\" style=\"background-color:var(--color-bg-primary); border-style:none; box-sizing:initial; max-width:100%\" /></p>\r\n\r\n<ul>\r\n	<li>на сторінці ДрукТабель - отримуємо готовий до друку табель... - радуємось :)</li>\r\n</ul>\r\n\r\n<p><img alt=\"\" src=\"https://github.com/YuriiRadio/Automated-working-time-accounting-card.-Form-number-5/raw/master/tabel5.png\" style=\"background-color:var(--color-bg-primary); border-style:none; box-sizing:initial; max-width:100%\" /></p>\r\n\r\n<ul>\r\n	<li>друкуємо в два етапи: спочатку сторінку ДрукКоди, перевертаємо сторінку і друкуємо ДрукТабель :)</li>\r\n</ul>\r\n\r\n<p><strong><a href=\"https://github.com/YuriiRadio/Automated-working-time-accounting-card.-Form-number-5/raw/master/Tabel-Blank-Form%E2%84%965-ukr_16x.xls\">Завантажити</a></strong></p>\r\n', 'Автоматизований табель обліку робочого часу', 'Автоматизований табель обліку робочого часу - типова форма № П-5, наказ Держкомстату України від 05.12.2008 № 489'),
(46, 23, 'en-GB', 'Automated working time accounting card. Form number 5', '', 'Automated timesheet ', 'Automated timesheet - standard form № P-5, order of the State Statistics Committee of Ukraine dated 05.12.2008 № 489 ');

-- --------------------------------------------------------

--
-- Структура таблиці `article_categories`
--

CREATE TABLE `article_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `article_categories`
--

INSERT INTO `article_categories` (`id`, `status`, `alias`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'news', 0, 1522257061, 1551458672),
(2, 1, 'medicine', 0, 1524849966, 1551458679),
(3, 1, 'events', 0, 1558938004, 1558938004),
(4, 1, 'other', 0, 1576659033, 1576659033);

-- --------------------------------------------------------

--
-- Структура таблиці `article_categories_i18n`
--

CREATE TABLE `article_categories_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_table_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `article_categories_i18n`
--

INSERT INTO `article_categories_i18n` (`id`, `parent_table_id`, `language`, `name`, `keywords`, `description`) VALUES
(1, 1, 'uk-UA', 'Новини', 'Новини', 'Новини'),
(2, 1, 'en-GB', 'News', 'News', 'News'),
(3, 2, 'uk-UA', 'Медицина', 'Медицина', 'Медицина'),
(4, 2, 'en-GB', 'Medicine', 'Medicine', 'Medicine'),
(5, 3, 'uk-UA', 'Події', 'Події', 'Події'),
(6, 3, 'en-GB', 'Events', 'Events', 'Events'),
(7, 4, 'uk-UA', 'Інше', 'Інше', 'Інше'),
(8, 4, 'en-GB', 'Other', 'Other', 'Other');

-- --------------------------------------------------------

--
-- Структура таблиці `banners`
--

CREATE TABLE `banners` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL,
  `position` enum('top','bottom','left','right','center') NOT NULL,
  `url_link` varchar(255) NOT NULL,
  `img_src` varchar(50) NOT NULL,
  `to_date` int(10) UNSIGNED NOT NULL,
  `clicks` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `banners`
--

INSERT INTO `banners` (`id`, `status`, `position`, `url_link`, `img_src`, `to_date`, `clicks`, `created_at`, `updated_at`) VALUES
(1, 1, 'bottom', 'https://moz.gov.ua', '1-15735452565848.png', 1640901600, 11, 1573545136, 1612460827),
(2, 1, 'bottom', 'https://nszu.gov.ua', '2-15735600011697.jpg', 1640901600, 5, 1573546871, 1612460845),
(4, 1, 'bottom', ' https://ukrline.com.ua/?ref=85318', '4-15735760585458.jpg', 1640901600, 17, 1573568599, 1612460863),
(6, 1, 'bottom', 'https://nabu.gov.ua', '-15801326269093.png', 1640901600, 1, 1580132626, 1612460872),
(7, 1, 'bottom', 'https://dbr.gov.ua', '-15801980245099.png', 1640901600, 5, 1580198024, 1612460882),
(8, 1, 'bottom', 'https://www.gp.gov.ua/ua/index.html', '-15801982281039.png', 1640901600, 2, 1580198228, 1612460892);

-- --------------------------------------------------------

--
-- Структура таблиці `banners_i18n`
--

CREATE TABLE `banners_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_table_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `banners_i18n`
--

INSERT INTO `banners_i18n` (`id`, `parent_table_id`, `language`, `name`) VALUES
(1, 1, 'uk-UA', 'Міністерство охорони здоров\'я України'),
(2, 1, 'en-GB', 'Ministry of Health of Ukraine'),
(3, 2, 'uk-UA', 'Національна служба здоров\'я України'),
(4, 2, 'en-GB', 'National Health Service of Ukraine'),
(7, 4, 'uk-UA', 'UkrLine'),
(8, 4, 'en-GB', 'UkrLine'),
(11, 6, 'uk-UA', 'Національне антикорупційне бюро України'),
(12, 6, 'en-GB', 'NATIONAL ANTI-CORRUPTION BUREAU OF UKRAINE'),
(13, 7, 'uk-UA', 'Державне бюро розслідувань'),
(14, 7, 'en-GB', 'State Bureau of Investigation'),
(15, 8, 'uk-UA', 'Офіс Генерального Прокурора'),
(16, 8, 'en-GB', 'Attorney General\'s Office');

-- --------------------------------------------------------

--
-- Структура таблиці `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) NOT NULL,
  `department_type_id` int(10) NOT NULL,
  `region_id` int(10) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `zip_code` int(6) NOT NULL,
  `building` varchar(20) NOT NULL,
  `latitude` float(8,6) DEFAULT NULL,
  `longitude` float(8,6) DEFAULT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `departments`
--

INSERT INTO `departments` (`id`, `parent_id`, `status`, `department_type_id`, `region_id`, `alias`, `phone`, `email`, `zip_code`, `building`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 1, 7, 'agpfm-berezne-2', '+380999999999', 'mail@gmail.com', 34600, '3', 51.008717, 26.750908, 1523711918, 1618149996),
(2, 0, 1, 1, 7, 'agpfm-berezne-1', '+380999999999', 'mail@gmail.com', 34600, '15', 51.004539, 26.753489, 1523713520, 1533818967),
(3, 0, 1, 1, 6, 'agpfm-balashivka', '+380999999999', 'mail@gmail.com', 34640, '22', 51.002991, 26.951580, 1523713924, 1533819044),
(4, 0, 1, 1, 8, 'agpfm-bystrychi', '+380999999999', 'mail@gmail.com', 34644, '90', 50.880260, 26.915350, 1523714412, 1576503727),
(5, 0, 1, 1, 13, 'agpfm-vitkovychi', '+380999999999', 'mail@gmail.com', 34622, '1', 51.063999, 26.771839, 1523714606, 1524486945),
(6, 0, 1, 1, 20, 'agpfm-gorodysche', '+380999999999', 'mail@gmail.com', 34607, '2', 51.021519, 26.741461, 1523714924, 1523986639),
(7, 0, 1, 1, 24, 'agpfm-druhiv', '+380999999999', 'mail@gmail.com', 34643, '108', 50.887112, 26.797911, 1523715070, 1533559838),
(8, 0, 1, 1, 25, 'agpfm-zirne', '+380999999999', 'mail@gmail.com', 34609, '1а', 50.981998, 26.726685, 1523715201, 1557817717),
(9, 0, 1, 1, 34, 'agpfm-malynsk', '+380999999999', 'mail@gmail.com', 34610, '122/5', 51.098412, 26.543989, 1523814977, 1533560397),
(10, 0, 1, 1, 38, 'agpfm-mokvyn', '+380999999999', 'mail@gmail.com', 34634, '91А', 50.962414, 26.798693, 1523815397, 1576504390),
(11, 0, 1, 1, 46, 'agpfm-prysluch', '+380999999999', 'mail@gmail.com', 34642, '10/2', 50.925034, 26.869001, 1523815542, 1533560485),
(12, 0, 1, 1, 50, 'agpfm-tyshycya', '+380999999999', 'mail@gmail.com', 34620, '105а/1', 51.095039, 26.738079, 1523815779, 1533560806),
(13, 0, 1, 1, 49, 'agpfm-sosnove', '+380999999999', 'mail@gmail.com', 34652, '46/10', 50.821400, 26.992092, 1523815960, 1523815960),
(14, 13, 1, 2, 2, 'fop-adamivka', '+380999999999', 'mail@gmail.com', 34652, '70', 50.838741, 26.945980, 1523816178, 1524041049),
(15, 26, 1, 2, 56, 'fop-antonivka', '+380999999999', 'mail@gmail.com', 34630, '31', 50.985458, 26.571280, 1523816513, 1549014513),
(16, 0, 1, 1, 4, 'agpfm-bilka', '+380999999999', 'mail@gmail.com', 34633, '6', 50.946217, 26.742466, 1523967135, 1576489246),
(17, 13, 1, 2, 5, 'fop-bilchaky', '+380999999999', 'mail@gmail.com', 34655, '3', 50.805519, 27.150961, 1523967303, 1524041269),
(18, 0, 1, 1, 9, 'agpfm-bogushi', '+380999999999', 'mail@gmail.com', 34621, '8', 51.107559, 26.741110, 1523967502, 1596457542),
(19, 9, 1, 2, 10, 'fop-bronne', '+380999999999', 'mail@gmail.com', 34611, '65г', 51.082539, 26.638330, 1523967663, 1527169242),
(20, 26, 1, 2, 17, 'fop-velyke-pole', '+380999999999', 'mail@gmail.com', 34631, '9', 50.912750, 26.611790, 1523968008, 1549014536),
(21, 13, 1, 2, 18, 'fop-glybochok', '+380999999999', 'mail@gmail.com', 34652, '40а', 50.784130, 27.058229, 1523968267, 1524054310),
(22, 16, 1, 2, 19, 'fop-golybne', '+380999999999', 'mail@gmail.com', 34632, '6', 50.892078, 26.694031, 1523968466, 1570441898),
(23, 3, 1, 2, 37, 'fop-myhalyn', '+380999999999', 'mail@gmail.com', 34666, '15', 51.033470, 26.934931, 1523968669, 1524040520),
(24, 7, 1, 2, 21, 'fop-grushivka', '+380999999999', 'mail@gmail.com', 34651, '12', 50.818039, 26.821360, 1523968864, 1524054431),
(25, 13, 1, 2, 23, 'fop-gubkiv', '+380999999999', 'mail@gmail.com', 34654, '45a', 50.828369, 27.043909, 1523969069, 1524054480),
(26, 0, 1, 1, 27, 'agpfm-kamyanka', '+380999999999', 'mail@gmail.com', 34630, '2', 50.972721, 26.640881, 1523969236, 1549014187),
(27, 5, 1, 2, 29, 'fop-knyazivka', '+380999999999', 'mail@gmail.com', 34662, '24', 51.114590, 26.778620, 1523969401, 1524054562),
(28, 26, 1, 2, 31, 'fop-kurgany', '+380999999999', 'mail@gmail.com', 34663, '8', 50.997849, 26.648359, 1523969525, 1549014573),
(29, 3, 1, 2, 32, 'fop-linchin', '+380999999999', 'mail@gmail.com', 34664, '61', 51.101528, 26.956980, 1524039621, 1524039621),
(30, 9, 1, 2, 35, 'fop-malushka', '+380999999999', 'mail@gmail.com', 34665, '24', 51.164558, 26.596371, 1524039859, 1524039903),
(31, 13, 1, 2, 36, 'fop-marynyn', '+380999999999', 'mail@gmail.com', 34655, '11а', 50.808262, 27.115700, 1524040150, 1536050185),
(32, 13, 1, 2, 39, 'fop-mochulyanka', '+380999999999', 'mail@gmail.com', 34615, '24', 50.892422, 27.115330, 1524040911, 1524040911),
(33, 10, 1, 2, 40, 'fop-novy-mokvyn', '+380999999999', 'mail@gmail.com', 34635, '49', 50.928028, 26.780710, 1524042051, 1524042051),
(34, 12, 1, 2, 42, 'fop-orlivka', '+380999999999', 'mail@gmail.com', 34608, '47a', 51.058578, 26.718349, 1524042314, 1524042314),
(35, 0, 1, 1, 44, 'agpfm-poliske', '+380999999999', 'mail@gmail.com', 34650, '30', 50.846401, 26.812290, 1524042522, 1598960415),
(36, 2, 1, 2, 45, 'fop-polyany', '+380999999999', 'mail@gmail.com', 34612, '105a', 51.056019, 26.650940, 1524042685, 1524042744),
(37, 3, 1, 2, 47, 'fop-sivky', '+380999999999', 'mail@gmail.com', 34625, '19', 50.974190, 27.204269, 1524042905, 1524042905),
(38, 13, 1, 2, 48, 'fop-sovpa', '+380999999999', 'mail@gmail.com', 34657, '2б', 50.775520, 26.940121, 1524043090, 1524043090),
(39, 13, 1, 2, 51, 'fop-hmelivka', '+380999999999', 'mail@gmail.com', 34656, '4a', 50.779041, 26.986900, 1524043365, 1524043365),
(40, 11, 1, 2, 52, 'fop-hotyn-1', '+380999999999', 'mail@gmail.com', 34667, '39', 50.954460, 26.853239, 1524043539, 1524055443),
(41, 26, 1, 2, 53, 'fop-yablunne', '+380999999999', 'mail@gmail.com', 34668, '17', 50.953480, 26.632240, 1524051858, 1549014614),
(42, 9, 1, 2, 54, 'fop-yarynivka', '+380999999999', 'mail@gmail.com', 34613, '1', 51.021278, 26.551319, 1524052514, 1524052514),
(43, 3, 1, 2, 55, 'fop-yackovychi', '+380999999999', 'mail@gmail.com', 34641, '97', 50.957329, 26.968130, 1524053045, 1524053045),
(44, 11, 1, 2, 52, 'fop-hotyn-2', '+380999999999', 'mail@gmail.com', 34667, '3г', 50.942429, 26.840469, 1524055569, 1536050455),
(45, 13, 1, 2, 11, 'fop-villya', '+380999999999', 'mail@gmail.com', 34624, '10а', 50.864231, 26.963381, 1524055982, 1536050349);

-- --------------------------------------------------------

--
-- Структура таблиці `departments_i18n`
--

CREATE TABLE `departments_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_table_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `departments_i18n`
--

INSERT INTO `departments_i18n` (`id`, `parent_table_id`, `language`, `name`, `street`, `body`) VALUES
(1, 1, 'uk-UA', 'АЗПСМ Березне №2', 'Набережна', '<p><strong>Амбулаторія загальної практики сімейної медицини (АЗПСМ) №2</strong></p>\r\n'),
(2, 1, 'en-GB', 'AGPFM Berezne 2', 'Naberezgna', '<p><strong>Outpatient clinic of general practice of family medicine №2</strong></p>\r\n'),
(3, 2, 'uk-UA', 'АЗПСМ Березне №1', 'Київська', '<p><strong>Амбулаторія загальної практики сімейної медицини (АЗПСМ) №1</strong></p>\r\n'),
(4, 2, 'en-GB', 'AGPFM Berezne 1', 'Kyivska', '<p><strong>Outpatient clinic of general practice of family medicine №1</strong></p>\r\n'),
(5, 3, 'uk-UA', 'АЗПСМ с. Балашівка', 'Лісна', '<p><strong>Амбулаторія загальної практики сімейної медицини (АЗПСМ) с.Балашівка</strong></p>\r\n'),
(6, 3, 'en-GB', 'AGPFM v. Balashivka', 'Lisna', '<p>AGPFM v. Balashivka</p>\r\n'),
(7, 4, 'uk-UA', 'АЗПСМ с. Бистричі', 'Шевченка', '<p>АЗПСМ с.Бистричі</p>\r\n'),
(8, 4, 'en-GB', 'AGPFM v. Bystrychi', 'Shevchenka', ''),
(9, 5, 'uk-UA', 'АЗПСМ с. Вітковичі', 'Першотравнева', ''),
(10, 5, 'en-GB', 'AGPFM v. Vitkovychi', 'Pershotravneva', ''),
(11, 6, 'uk-UA', 'АЗПСМ с. Городище', 'Вербова', ''),
(12, 6, 'en-GB', 'AGPFM v. Gorodysche', 'Verbova', ''),
(13, 7, 'uk-UA', 'АЗПСМ с. Друхів', 'Шевченка', ''),
(14, 7, 'en-GB', 'AGPFM v. Druhiv', 'Shevchenka', ''),
(15, 8, 'uk-UA', 'АЗПСМ с. Зірне', 'Джерельна', ''),
(16, 8, 'en-GB', 'AGPFM v. Zirne', 'Sonyachna', ''),
(17, 9, 'uk-UA', 'АЗПСМ с. Малинськ', 'Центральна', ''),
(18, 9, 'en-GB', 'AGPFM v. Malynsk', 'Centralna', ''),
(19, 10, 'uk-UA', 'АЗПСМ с. Моквин', 'Надслучанська', ''),
(20, 10, 'en-GB', 'AGPFM v. Mokvyn', 'Nadsluchanska', ''),
(21, 11, 'uk-UA', 'АЗПСМ с. Прислуч', 'Андріївська', ''),
(22, 11, 'en-GB', 'AGPFM v. Prysluch', 'Andriivka', ''),
(23, 12, 'uk-UA', 'АЗПСМ с. Тишиця', 'Незалежності', ''),
(24, 12, 'en-GB', 'AGPFM v. Tyshycya', 'Nezalezgnosti', ''),
(25, 13, 'uk-UA', 'АЗПСМ смт. Соснове', 'Шкільна', ''),
(26, 13, 'en-GB', 'AGPFM uv. Sosnove', 'Shkilna', ''),
(27, 14, 'uk-UA', 'ФАП с. Адамівка', 'Березнівська', ''),
(28, 14, 'en-GB', 'FOP v. Adamivka', 'Bereznivska', ''),
(29, 15, 'uk-UA', 'ФАП с. Антонівка', 'Молодіжна', ''),
(30, 15, 'en-GB', 'FOP v. Antonivka', 'Molodizgna', ''),
(31, 16, 'uk-UA', 'АЗПСМ с. Білка', 'Тополева', ''),
(32, 16, 'en-GB', 'AGPFM v. Bilka', 'Topoleva', ''),
(33, 17, 'uk-UA', 'ФАП с. Більчаки', 'Шкільна', ''),
(34, 17, 'en-GB', 'FOP v. Bilchaky', 'Shkilna', ''),
(35, 18, 'uk-UA', 'АЗПСМ с. Богуші', 'Лісова', ''),
(36, 18, 'en-GB', 'AGPFM v. Bogushi', 'Lisova', ''),
(37, 19, 'uk-UA', 'ФАП с. Бронне', 'Андріївська', ''),
(38, 19, 'en-GB', 'FOP v. Bronne', 'Andriivska', ''),
(39, 20, 'uk-UA', 'ФАП с. Велике Поле', 'Молодіжна', ''),
(40, 20, 'en-GB', 'FOP v. Velyke Pole', 'Molodizhna', ''),
(41, 21, 'uk-UA', 'ФАП с. Глибочок', 'Корецька', ''),
(42, 21, 'en-GB', 'FOP v. Glybochok', 'Koretska', ''),
(43, 22, 'uk-UA', 'ФАП с. Голубне', 'Ярового', ''),
(44, 22, 'en-GB', 'FOP v. Golybne', 'Yarovoho', ''),
(45, 23, 'uk-UA', 'ФАП с. Михалин', 'Незалежності', ''),
(46, 23, 'en-GB', 'FOP v. Myhalyn', 'Nezalezhnosti', ''),
(47, 24, 'uk-UA', 'ФАП с. Грушівка', 'Гагаріна', ''),
(48, 24, 'en-GB', 'FOP v. Gryshivka', 'Gagarina', ''),
(49, 25, 'uk-UA', 'ФАП с. Губків', 'Шевченка', ''),
(50, 25, 'en-GB', 'FOP v. Gubkiv', 'Shevchenka', ''),
(51, 26, 'uk-UA', 'АЗПСМ с. Кам’янка', 'Нова', ''),
(52, 26, 'en-GB', 'AGPFM v. Kamyanka', 'Nova', ''),
(53, 27, 'uk-UA', 'ФАП с. Князівка', 'Незалежності', ''),
(54, 27, 'en-GB', 'FOP v. Knyazivka', 'Nezalezhnosti', ''),
(55, 28, 'uk-UA', 'ФАП с. Кургани', 'Кузнецова', ''),
(56, 28, 'en-GB', 'FOP v. Kurgany', 'Kuznetsova', ''),
(57, 29, 'uk-UA', 'ФАП с. Лінчин', 'Незалежності', ''),
(58, 29, 'en-GB', 'FOP v. Linchin', 'Nezalezhnosti', ''),
(59, 30, 'uk-UA', 'ФАП с. Малушка', 'Кузнецова', ''),
(60, 30, 'en-GB', 'FOP v. Malushka', 'Kuznetsova', ''),
(61, 31, 'uk-UA', 'ФАП с. Маринин', 'Шевченка', ''),
(62, 31, 'en-GB', 'FOP v. Marynyn', 'Marynyn', ''),
(63, 32, 'uk-UA', 'ФАП с. Мочулянка', 'Центральна', ''),
(64, 32, 'en-GB', 'FOP v. Mochulyanka', 'Tsentralna', ''),
(65, 33, 'uk-UA', 'ФАП с. Новий Моквин', 'Кірова', ''),
(66, 33, 'en-GB', 'FOP v. Novy Mokvyn', 'Kirova', ''),
(67, 34, 'uk-UA', 'ФАП с. Орлівка', 'Незалежності', ''),
(68, 34, 'en-GB', 'FOP v. Orlivka', 'Nezalezhnosti', ''),
(69, 35, 'uk-UA', 'АЗПСМ с. Поліське', 'Кузнецова', ''),
(70, 35, 'en-GB', 'AGPFM  v. Polike', 'Kuznetsova', ''),
(71, 36, 'uk-UA', 'ФАП с. Поляни', 'Лесі Українки', ''),
(72, 36, 'en-GB', 'FOP v. Polyany', 'Lesi Ukrainky', ''),
(73, 37, 'uk-UA', 'ФАП с. Сівки', 'Молодіжна', ''),
(74, 37, 'en-GB', 'FOP v. Sivky', '', ''),
(75, 38, 'uk-UA', 'ФАП с. Совпа', 'Центральна', ''),
(76, 38, 'en-GB', 'FOP v. Sovpa', 'Tsentralna', ''),
(77, 39, 'uk-UA', 'ФАП с. Хмелівка', 'Набережна', ''),
(78, 39, 'en-GB', 'FOP v. Hmelivka', 'Naberezhna', ''),
(79, 40, 'uk-UA', 'ФАП с. Хотин(1)', 'Лесі Українки', ''),
(80, 40, 'en-GB', 'FOP v. Hotyn(1)', 'Lesi Ukrainky', ''),
(81, 41, 'uk-UA', 'ФАП с. Яблунне', 'Шевченка', ''),
(82, 41, 'en-GB', 'FOP v. Yablunne', 'Shevchenka', ''),
(83, 42, 'uk-UA', 'ФАП с. Яринівка', 'Шкільна', ''),
(84, 42, 'en-GB', 'FOP v. Yarynivka', 'Shkilna', ''),
(85, 43, 'uk-UA', 'ФАП с. Яцьковичі', 'Шевченка', ''),
(86, 43, 'en-GB', 'FOP v. Yackovychi', 'Shevchenka', ''),
(87, 44, 'uk-UA', 'ФАП с. Хотин(2)', 'Андріївська', ''),
(88, 44, 'en-GB', 'FOP v. Hotyn(2)', 'Andriivska', ''),
(89, 45, 'uk-UA', 'ФАП с. Вілля', 'Центральна', ''),
(90, 45, 'en-GB', 'FOP v. Villya', 'Tsentralna', '');

-- --------------------------------------------------------

--
-- Структура таблиці `department_types`
--

CREATE TABLE `department_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `department_types`
--

INSERT INTO `department_types` (`id`, `created_at`, `updated_at`) VALUES
(1, 1523465267, 1523465267),
(2, 1523465347, 1523465347);

-- --------------------------------------------------------

--
-- Структура таблиці `department_types_i18n`
--

CREATE TABLE `department_types_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_table_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `department_types_i18n`
--

INSERT INTO `department_types_i18n` (`id`, `parent_table_id`, `language`, `name`) VALUES
(1, 1, 'uk-UA', 'Амбулаторія'),
(2, 1, 'en-GB', 'Outpatient clinic'),
(3, 2, 'uk-UA', 'ФАП'),
(4, 2, 'en-GB', 'FOP');

-- --------------------------------------------------------

--
-- Структура таблиці `doctors`
--

CREATE TABLE `doctors` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL,
  `doctor_specialization_id` int(10) UNSIGNED NOT NULL,
  `doctor_category_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `experience` int(3) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `img_src` varchar(50) NOT NULL,
  `img_src_small` varchar(50) NOT NULL,
  `schedule` varchar(20) NOT NULL,
  `number_patients` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `allowed_number_patients` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `views` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `doctors`
--

INSERT INTO `doctors` (`id`, `status`, `doctor_specialization_id`, `doctor_category_id`, `department_id`, `experience`, `email`, `phone`, `img_src`, `img_src_small`, `schedule`, `number_patients`, `allowed_number_patients`, `views`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 1, 27, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1180, 900, 2879, 1523470848, 1619507215),
(2, 1, 2, 2, 2, 37, 'mail@gmail.com', '+380999999999', '', '', '8-17', 627, 450, 1656, 1523716754, 1619507241),
(3, 1, 2, 2, 9, 28, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1961, 1800, 1470, 1523817856, 1614674008),
(4, 1, 2, 2, 2, 38, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1784, 1800, 1299, 1523818045, 1619507403),
(5, 1, 1, 4, 2, 5, 'mail@gmail.com', '+380999999999', '', '', '8-17', 956, 900, 1940, 1523818258, 1614674315),
(6, 0, 2, 2, 2, 23, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1615, 1800, 1554, 1523818491, 1604218729),
(7, 0, 1, 2, 2, 33, 'mail@gmail.com', '+380999999999', '', '', '8-17', 645, 450, 194, 1523818632, 1561708001),
(8, 1, 2, 2, 4, 39, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1855, 1800, 896, 1523819019, 1614674175),
(9, 0, 3, 2, 13, 38, 'mail@gmail.com', '+380999999999', '', '', '9-18', 330, 1000, 587, 1523946767, 1596627827),
(10, 1, 3, 2, 13, 37, 'mail@gmail.com', '+380999999999', '', '', '9-18', 337, 900, 932, 1523946977, 1614674221),
(11, 1, 2, 2, 13, 37, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1257, 1800, 1193, 1523947381, 1614674254),
(12, 1, 2, 2, 12, 36, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1887, 1800, 828, 1523948059, 1614674413),
(13, 0, 2, 2, 2, 36, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1345, 1800, 773, 1523948264, 1604218755),
(14, 1, 2, 2, 13, 22, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1857, 1800, 672, 1523948596, 1614674439),
(15, 1, 2, 2, 2, 36, 'mail@gmail.com', '+380999999999', '', '', '8-17', 2015, 1800, 1387, 1523948890, 1614674456),
(16, 1, 2, 3, 2, 6, 'mail@gmail.com', '+380999999999', '', '', '8-17', 2030, 1800, 1311, 1523949235, 1614674472),
(17, 1, 2, 2, 5, 21, 'mail@gmail.com', '+380999999999', '', '', '9-18', 2251, 1800, 728, 1523956106, 1614674510),
(18, 1, 2, 3, 11, 24, 'mail@gmail.com', '+380999999999', '', '', '9-18', 2085, 1800, 1384, 1523956334, 1614674529),
(19, 1, 2, 1, 1, 1, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1772, 1800, 559, 1523956666, 1614674348),
(20, 1, 2, 4, 6, 11, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1640, 1800, 1110, 1523956975, 1614674545),
(21, 1, 2, 2, 2, 38, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1022, 900, 1037, 1523964526, 1614674116),
(22, 1, 2, 2, 3, 17, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1824, 1800, 767, 1523964728, 1614674196),
(23, 0, 2, 3, 2, 5, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1786, 1800, 1176, 1523965700, 1609751703),
(24, 1, 2, 3, 2, 23, 'mail@gmail.com', '+380999999999', '', '', '8-17', 2032, 1800, 1225, 1523965849, 1614674652),
(25, 1, 2, 1, 2, 11, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1938, 1800, 1041, 1523966003, 1614674699),
(26, 1, 2, 2, 13, 27, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1398, 1800, 2731, 1523966266, 1614674961),
(27, 1, 2, 2, 1, 37, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1849, 1800, 1478, 1523966488, 1614675081),
(28, 1, 2, 4, 2, 26, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1380, 900, 1429, 1523966655, 1614675122),
(29, 0, 2, 1, 11, 2, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1097, 1800, 269, 1535457306, 1571232801),
(30, 1, 2, 1, 10, 2, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1863, 1800, 915, 1535702996, 1614674391),
(31, 1, 2, 1, 8, 2, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1968, 1800, 765, 1535704371, 1614674609),
(32, 1, 2, 1, 26, 2, 'mail@gmail.com', '+380999999999', '', '', '8-17', 1448, 1800, 1214, 1535704756, 1614674272),
(33, 1, 2, 1, 7, 2, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1724, 1800, 1653, 1535715248, 1614674489),
(35, 0, 3, 3, 2, 9, 'mail@gmail.com', '+380999999999', '', '', '8-17', 343, 2000, 1521, 1549620134, 1619460446),
(36, 1, 2, 1, 16, 1, 'mail@gmail.com', '+380999999999', '', '', '8-17', 928, 1800, 742, 1570441325, 1614674734),
(37, 1, 2, 1, 18, 1, 'mail@gmail.com', '+380999999999', '', '', '9-18', 1254, 1800, 485, 1597663698, 1614674369),
(38, 1, 3, 1, 2, 3, 'mail@gmail.com', '+380999999999', '', '', '8-17', 581, 1000, 314, 1604650830, 1614674680),
(39, 0, 2, 1, 7, 5, 'mail@gmail.com', '+380999999999', '', '', '9-18', 17, 900, 77, 1605600703, 1609834343),
(40, 1, 3, 3, 2, 7, 'mail@gmail.com', '+380999999999', '', '', '8-12', 693, 1000, 335, 1607071169, 1614674293);

-- --------------------------------------------------------

--
-- Структура таблиці `doctors_i18n`
--

CREATE TABLE `doctors_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_table_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL,
  `institute` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `doctors_i18n`
--

INSERT INTO `doctors_i18n` (`id`, `parent_table_id`, `language`, `name`, `institute`, `body`) VALUES
(1, 1, 'uk-UA', 'Іванов Іван Іванович', 'У 1992 році закінчив Буковинський державний медичний університет. Кандидат медичних наук', '<p><strong>Прийом ведеться в</strong> 5 кабінеті (другий поверх)</p>\r\n\r\n<p><strong>Медсестра:</strong> Іванова Іванна Іванівна</p>\r\n\r\n<p style=\"text-align:justify\"><strong>Іванов Іван Іванович</strong> - лікар вищої кваліфікаційної категорії з організації управління охороною здоров&rsquo;я та загальної практики-сімейної медицини, Кандидат медичних наук.</p>\r\n'),
(2, 1, 'en-GB', 'Ivanov Ivan Ivanovych', 'In 1992, he graduated from the Bukovinian State Medical University. Candidate of Medical Sciences', '<p>Reception is conducted in 5 rooms (second floor)</p>\r\n'),
(3, 2, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1982 році закінчила Тернопільський державний медичний університет імені І.Я. Горбачевського', '<p><strong>Прийом ведеться в 46 кабінеті (другий поверх)</strong></p>\r\n\r\n<p><strong>Медсестра: </strong>Іванова Іванна Іванівна</p>\r\n'),
(4, 2, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1982, she graduated from the I. Horbachevsky Ternopil State Medical University ', '<p><strong>Reception is conducted in 46 rooms (second floor)</strong></p>\r\n'),
(5, 3, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1991 році закінчила Петрозаводський державний університет', ''),
(6, 3, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1991, she graduated from the Petrozavodsk State University', ''),
(7, 4, 'uk-UA', 'Іванов Іван Іванович', 'У 1981 році закінчив Тернопільський державний медичний університет імені І.Я. Горбачевського', '<p><strong>Прийом ведеться</strong> в 43 кабінеті (другий поверх)</p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Іванова Іванна Іванівна</p>\r\n'),
(8, 4, 'en-GB', 'Ivanov Ivan Ivanovych', 'In 1981 he graduated from the I. Horbachevsky Ternopil State Medical University', '<p>Reception is conducted in 43 rooms (second floor)</p>\r\n'),
(9, 5, 'uk-UA', 'Іванова Іванна Іванівна', 'У 2013 році закінчила Національний медичний університет імені О. О. Богомольця', '<p><strong>Прийом ведеться</strong> в 19 кабінеті (перший поверх)</p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Глущук Алла Іванівна</p>\r\n'),
(10, 5, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 2013, she graduated from theBogomolets National Medical University', '<p>Reception is conducted in 19 rooms (ground floor)</p>\r\n'),
(11, 6, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1995 році закінчила Тернопільський державний медичний університет імені І.Я. Горбачевського', '<p>Прийом ведеться в 44 кабінеті (другий поверх)</p>\r\n'),
(12, 6, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1995, she graduated from the I. Horbachevsky Ternopil State Medical University', '<p>Reception is conducted in 44 rooms (second floor)</p>\r\n'),
(13, 7, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1985 році закінчила Буковинський державний медичний університет', ''),
(14, 7, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1985, she graduated from the Bukovinian State Medical University', ''),
(15, 8, 'uk-UA', 'Іванов Іван Іванович', 'У 1980 році закінчив Тернопільський державний медичний університет імені І.Я. Горбачевського', ''),
(16, 8, 'en-GB', 'Ivanov Ivan Ivanovych', 'In 1980, he graduated from the I. Horbachevsky Ternopil State Medical University', ''),
(17, 9, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1980 році закінчила Тернопільський державний медичний університет імені І.Я. Горбачевського', ''),
(18, 9, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1980, she graduated from the I. Horbachevsky Ternopil State Medical University', ''),
(19, 10, 'uk-UA', 'Іванов Іван Іванович', 'У 1982 році закінчив Тернопільський державний медичний університет імені І.Я. Горбачевського', ''),
(20, 10, 'en-GB', 'Ivanov Ivan Ivanovych', 'In 1982, he graduated from the I. Horbachevsky Ternopil State Medical University', ''),
(21, 11, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1982 році закінчила Тернопільський державний медичний університет імені І.Я. Горбачевського', ''),
(22, 11, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1982, she graduated from the I. Horbachevsky Ternopil State Medical University', ''),
(23, 12, 'uk-UA', 'Іванов Іван Іванович', 'У 1983 році закінчив Тернопільський державний медичний університет імені І.Я. Горбачевського', ''),
(24, 12, 'en-GB', 'Ivanov Ivan Ivanovych', 'In 1983, he graduated from the I. Horbachevsky Ternopil State Medical University', ''),
(25, 13, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1983 році закінчила Тернопільський державний медичний університет імені І.Я. Горбачевського', '<p><strong>Прийом ведеться в 47 кабінеті (другий поверх)</strong></p>\r\n'),
(26, 13, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1983, she graduated from the I. Horbachevsky Ternopil State Medical University', '<p><strong>Reception is conducted in 47 rooms (second floor)</strong></p>\r\n'),
(27, 14, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1997 році закінчила Ужгородський національний університет', ''),
(28, 14, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1997, she graduated from the Uzhhorod National University', ''),
(29, 15, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1983 році закінчила Вінницький національний медичний університет ім. М.І. Пирогова', '<p><strong>Прийом ведеться в </strong>17 кабінеті (перший поверх)</p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Вознюк Ольга Романівна</p>\r\n'),
(30, 15, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1983, she graduated from the National Pirogov Memorial Medical University, Vinnytsya', '<p><strong>Reception is conducted in 17 rooms (ground floor)</strong></p>\r\n'),
(31, 16, 'uk-UA', 'Іванова Іванна Іванівна', 'У 2012 році закінчила Івано-Франківський національний медичний університет', '<p><strong>Прийом ведеться в </strong>44 кабінеті (другий поверх)</p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Гризовська Юлія Вікторівна</p>\r\n'),
(32, 16, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 2012, she graduated from the Ivano-Frankivsk National Medical University', '<p><strong>Reception is conducted in </strong>44 rooms (second floor)</p>\r\n'),
(33, 17, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1998 році закінчила Буковинський державний медичний університет', ''),
(34, 17, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1998, she graduated from the Bukovinian State Medical Univeristy', ''),
(35, 18, 'uk-UA', 'Іванов Іван Іванович', 'У 1995 році закінчив Львівський національний медичний університет імені Данила Галицького', ''),
(36, 18, 'en-GB', 'Ivanov Ivan Ivanovych', 'In 1995, he graduated from the Lviv National Medical University named after Danylo Halytsky', ''),
(37, 19, 'uk-UA', 'Іванова Іванна Іванівна', 'У 2018 році закінчила Державний заклад \"Дніпропетровська медична академія Міністерства охорони здоров’я України\"', '<p>Прийом ведеться в <strong>10 кабінеті (другий поверх)</strong></p>\r\n\r\n<p>Медсестра: <strong>Данильчук Юлія</strong></p>\r\n'),
(38, 19, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 2018 she graduated from the State Institution \"Dnipropetrovsk Medical Academy of the Ministry of Health of Ukraine\"', '<p>Reception is conducted in 10 rooms (second floor)</p>\r\n'),
(39, 20, 'uk-UA', 'Іванова Іванна Іванівна', 'У 2008 році закінчила Івано-Франківський національний медичний університет', ''),
(40, 20, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 2008, she graduated from the Ivano-Frankivsk National Medical University', ''),
(41, 21, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1981 році закінчила Тернопільський державний медичний університет імені І.Я. Горбачевського', '<p>Прийом ведеться в 46 кабінеті (другий поверх)</p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Шевчук Оксана Олександрівна</p>\r\n'),
(42, 21, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1981, she graduated from the I. Horbachevsky Ternopil State Medical University', '<p>Reception is conducted in 46&nbsp;rooms (second floor)</p>\r\n'),
(43, 22, 'uk-UA', 'Іванов Іван Іванович', 'У 2001 році закінчив Тернопільський державний медичний університет імені І.Я. Горбачевського', ''),
(44, 22, 'en-GB', 'Ivanov Ivan Ivanovych', 'In 2001, he graduated from the I. Horbachevsky Ternopil State Medical University', ''),
(45, 23, 'uk-UA', 'Іванова Іванна Іванівна', 'У 2013 році закінчила Запорізький державний медичний університет', '<p><strong>Прийом ведеться в 16 кабінеті (перший поверх)</strong></p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Власюк Руслана Вікторівна</p>\r\n'),
(46, 23, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 2013, she graduated from the Zaporozhye State Medical University', '<p><strong>Reception is conducted in 16 rooms (ground floor)</strong></p>\r\n'),
(47, 24, 'uk-UA', 'Іванова Іванна Іванівна', 'У 1996 році закінчила Івано-Франківський національний медичний університет', '<p><strong>Прийом ведеться в 51 кабінеті (другий поверх)</strong></p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Назарчук Інна Олександрівна</p>\r\n'),
(48, 24, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 1996, she graduated from the Ivano-Frankivsk National Medical University', '<p><strong>Reception is conducted in 51&nbsp;rooms (second floor)</strong></p>\r\n'),
(49, 25, 'uk-UA', 'Іванова Іванна Іванівна', 'У 2007 році закінчила Запорізький державний медичний університет', '<p><strong>Прийом ведеться в 20 кабінеті (перший поверх)</strong></p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Литвинчук Людмила Володимирівна</p>\r\n'),
(50, 25, 'en-GB', 'Ivanova Ivanna Ivanivna', 'In 2007, she graduated from theZaporozhye State Medical University', '<p><strong>Reception is conducted in 20 rooms (ground floor)</strong></p>\r\n'),
(51, 26, 'uk-UA', 'Чижевська Руслана Михайлівна', 'У 1992 році Дніпропетровська медична академія', ''),
(52, 26, 'en-GB', 'Chyzhevska Ruslana Mykhailivna', 'In 1992, she graduated from the Dnipropetrovsk vedikal akademy', ''),
(53, 27, 'uk-UA', 'Шушунова Олена Володимирівна', 'У 1982 році закінчила Амурська державна медична академія', '<p><strong>Прийом ведеться </strong>в 12 кабінеті (другий поверх)</p>\r\n\r\n<p><strong>Медсестра:</strong> Походзіло Надія Анатоліївна</p>\r\n'),
(54, 27, 'en-GB', 'Shushunova Olena Volodymyrivna', 'In 1982, she graduated from the Amur State Medical Academy', '<p><strong>Reception is conducted in 12 rooms (second floor)</strong></p>\r\n'),
(55, 28, 'uk-UA', 'Яновець Людмила Степанівна', 'У 1993 році закінчила Тернопільський державний медичний університет імені І.Я. Горбачевського', '<p><strong>Прийом ведеться в 18 кабінеті (перший поверх)</strong></p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Гребінець Наталія Аркадіївна</p>\r\n'),
(56, 28, 'en-GB', 'Yanovets Liudmyla Stepanivna', 'In 1993, she graduated from the I. Horbachevsky Ternopil State Medical University', '<p><strong>Reception is in 18 rooms (ground floor)</strong></p>\r\n'),
(57, 29, 'uk-UA', 'Приндюк Вікторія Андріївна', 'У 2016 році закінчила Національний медичний університет імені О. О. Богомольця', ''),
(58, 29, 'en-GB', 'Pryndyuk Viktorija Andriivna', 'In 2016, she graduated from theBogomolets National Medical University', ''),
(59, 30, 'uk-UA', 'Коломейчук Катерина Леонідівна', 'У 2016 році закінчила Національний медичний університет імені О. О. Богомольця', '<p><strong>Медсестра:&nbsp;</strong>Андрощук Ірина Олександрівна</p>\r\n'),
(60, 30, 'en-GB', 'Kolomeichuk Kateryna Leonidivna', 'In 2016, she graduated from theBogomolets National Medical University', '<p><strong>Nurse:&nbsp;</strong>Androshchuk Iryna Oleksandrivna</p>\r\n'),
(61, 31, 'uk-UA', 'Скороходов Святослав Віталійович', 'У 2016 році закінчив Вінницький національний медичний університет ім. М.І. Пирогова', ''),
(62, 31, 'en-GB', 'Skorokhodov Sviatoslav Vitaliiovych', 'In 2016, hi graduated from the National Pirogov Memorial Medical University, Vinnytsya', ''),
(63, 32, 'uk-UA', 'Євтушок Ольга Вікторівна', 'У 2016 році закінчила Львівський національний медичний університет імені Данила Галицького', '<p><strong>Медсестра:</strong>&nbsp;Яростюк Ольга Юріївна</p>\r\n'),
(64, 32, 'en-GB', 'Yevtushok Olha Viktorivna', 'In 2016, she graduated from the Lviv National Medical University named after Danylo Halytsky', ''),
(65, 33, 'uk-UA', 'Марчук Мирослава Романівна', 'У 2016 році закінчила Національний медичний університет імені О. О. Богомольця', ''),
(66, 33, 'en-GB', 'Marchuk Myroslava Romanivna', 'In 2016, she graduated from theBogomolets National Medical University', ''),
(69, 35, 'uk-UA', 'Таргоній Наталія Олексіївна', 'У 2009 році закінчила Вінницький національний медичний університет ім. М.І. Пирогова', '<p><strong>Прийом ведеться в 6&nbsp;кабінеті (перший поверх)</strong></p>\r\n\r\n<p><strong>Медсестра:&nbsp;</strong>Тригуба Олена</p>\r\n'),
(70, 35, 'en-GB', 'Tarhonii Nataliia Oleksiivna', 'In 2009, she graduated from the National Pirogov Memorial Medical University, Vinnytsya', '<p><strong>Reception is conducted in 6&nbsp;rooms (ground floor)</strong></p>\r\n'),
(71, 36, 'uk-UA', 'Ціпан Ірина Петрівна', 'У 2017 році закінчила Буковинський державний медичний університет', ''),
(72, 36, 'en-GB', 'Tsipan Iryna Petrivna', 'In 2017, she graduated from the Bukovinian State Medical University.', ''),
(73, 37, 'uk-UA', 'Коваль Юлія Сергіївна', 'У 2018 році закінчила Національний медичний університет імені О. О. Богомольця', '<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Медсестри:&nbsp;</td>\r\n			<td><strong>Осійчук Юлія Василівна</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Захарчук Ольга Петрівна</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
(74, 37, 'en-GB', 'Koval Yuliia Serhiivna', 'In 2018, she graduated from theBogomolets National Medical University', '<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Nurses:&nbsp;</td>\r\n			<td><strong>Osiichuk Yuliia Vasylivna</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td><strong>Zakharchuk Olha Petrivna</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),
(75, 38, 'uk-UA', 'Трофимчук Оксана Павлівна', 'У 2017 році закінчила Івано-Франківський національний медичний університет', '<p><strong>Прийом ведеться в </strong>47 кабінеті (другий поверх)</p>\r\n\r\n<p><strong>Медсестра:</strong>&nbsp;Паламарчук Сніжана Олександрівна</p>\r\n'),
(76, 38, 'en-GB', 'Trofymchuk Oksana Pavlivna', 'In 2017, she graduated from the Ivano-Frankivsk National Medical University', '<p><strong>Reception is conducted in 47 rooms (second floor)</strong></p>\r\n'),
(77, 39, 'uk-UA', 'Усач Андрій Володимирович', 'У 2013 році закінчив Національний медичний університет імені О. О. Богомольця', ''),
(78, 39, 'en-GB', 'Usach Andrii Volodymyrovych', 'In 2013 he graduated from the Bogomolets National Medical University', ''),
(79, 40, 'uk-UA', 'Єзерська Наталія Василівна', 'У 2009 році закінчила Львівський національний медичний університет імені Данила Галицького', '<p><strong>Прийом ведеться</strong> в 48 кабінеті (другий поверх)</p>\r\n\r\n<p><strong>Медсестра: </strong>Ковпак Ніна Миколаївна</p>\r\n'),
(80, 40, 'en-GB', 'Yezerska Nataliia Vasylivna', 'In 2009, she graduated from the Lviv National Medical University named after Danylo Halytsky', '<p><strong>Reception is conducted in</strong> 48 rooms (second floor)</p>\r\n\r\n<p><strong>Nurse:</strong> Kovpak Nina Mykolaivna</p>\r\n');

-- --------------------------------------------------------

--
-- Структура таблиці `doctor_categories`
--

CREATE TABLE `doctor_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `doctor_categories`
--

INSERT INTO `doctor_categories` (`id`, `created_at`, `updated_at`) VALUES
(1, 1523381199, 1523381199),
(2, 1523381338, 1523381338),
(3, 1523381410, 1523381428),
(4, 1523381410, 1523382055);

-- --------------------------------------------------------

--
-- Структура таблиці `doctor_categories_i18n`
--

CREATE TABLE `doctor_categories_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_table_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `doctor_categories_i18n`
--

INSERT INTO `doctor_categories_i18n` (`id`, `parent_table_id`, `language`, `name`) VALUES
(1, 1, 'uk-UA', 'Спеціаліст'),
(2, 1, 'en-GB', 'Specialist'),
(3, 2, 'uk-UA', 'Вища'),
(4, 2, 'en-GB', 'Higher'),
(5, 3, 'uk-UA', 'Перша'),
(6, 3, 'en-GB', 'First'),
(7, 4, 'uk-UA', 'Друга'),
(8, 4, 'en-GB', 'Second');

-- --------------------------------------------------------

--
-- Структура таблиці `doctor_images`
--

CREATE TABLE `doctor_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `doctor_id` int(10) UNSIGNED NOT NULL,
  `is_main` tinyint(1) UNSIGNED NOT NULL,
  `img_src` varchar(50) NOT NULL,
  `img_src_thumb` varchar(50) NOT NULL,
  `img_alt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблиці `doctor_specializations`
--

CREATE TABLE `doctor_specializations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `doctor_specializations`
--

INSERT INTO `doctor_specializations` (`id`, `created_at`, `updated_at`) VALUES
(1, 1523463005, 1523463005),
(2, 1523463043, 1523463043),
(3, 1523463066, 1523463066);

-- --------------------------------------------------------

--
-- Структура таблиці `doctor_specializations_i18n`
--

CREATE TABLE `doctor_specializations_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_table_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `doctor_specializations_i18n`
--

INSERT INTO `doctor_specializations_i18n` (`id`, `parent_table_id`, `language`, `name`) VALUES
(1, 1, 'uk-UA', 'Педіатр'),
(2, 1, 'en-GB', 'Pediatrician'),
(3, 2, 'uk-UA', 'Сімейний лікар'),
(4, 2, 'en-GB', 'Family doctor'),
(5, 3, 'uk-UA', 'Терапевт'),
(6, 3, 'en-GB', 'Therapist');

-- --------------------------------------------------------

--
-- Структура таблиці `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(255) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `regions`
--

INSERT INTO `regions` (`id`, `parent_id`, `alias`, `created_at`, `updated_at`) VALUES
(1, 0, 'bereznovsky', 1523645039, 1523646003),
(2, 1, 'adamivka', 1523645458, 1523646011),
(3, 1, 'ivanivka', 1523645807, 1523646021),
(4, 1, 'bilka', 1523646860, 1523646860),
(5, 1, 'bilchaky', 1523646946, 1523647008),
(6, 1, 'balashivka', 1523646988, 1523647022),
(7, 1, 'berezne', 1523647061, 1523647061),
(8, 1, 'bystrychi', 1523647144, 1523647230),
(9, 1, 'bogushi', 1523647181, 1523647241),
(10, 1, 'bronne', 1523647217, 1523647249),
(11, 1, 'villya', 1523647312, 1523647363),
(12, 1, 'vilhivka', 1523647348, 1523647348),
(13, 1, 'vitkovychi', 1523647408, 1523647449),
(14, 1, 'vedmedivka', 1523647441, 1523647441),
(15, 1, 'velyki-selyscha', 1523647505, 1523647782),
(16, 1, 'velyka-kuplya', 1523647550, 1523647550),
(17, 1, 'velyke-pole', 1523647585, 1523647774),
(18, 1, 'glybochok', 1523647615, 1523647615),
(19, 1, 'golybne', 1523647640, 1523647640),
(20, 1, 'gorodysche', 1523647671, 1523647671),
(21, 1, 'grushivka', 1523647708, 1523647708),
(22, 1, ' gryshivska-guta', 1523647828, 1523647828),
(23, 1, 'gubkiv', 1523647859, 1523647870),
(24, 1, 'druhiv', 1523692086, 1523692086),
(25, 1, 'zirne', 1523692117, 1523692117),
(26, 1, 'zamostyche', 1523692190, 1523692190),
(27, 1, 'kamyanka', 1523692221, 1523692221),
(28, 1, 'karachun', 1523692249, 1523692249),
(29, 1, 'knyazivka', 1523692300, 1523692300),
(30, 1, 'kolodyazne', 1523692338, 1523692338),
(31, 1, 'kurgany', 1523692384, 1523692384),
(32, 1, 'linchin', 1523692414, 1523692414),
(33, 1, 'levachi', 1523692448, 1523692497),
(34, 1, 'malynsk', 1523692487, 1523692487),
(35, 1, 'malushka', 1523692522, 1523704853),
(36, 1, 'marynyn', 1523692578, 1523692578),
(37, 1, 'myhalyn', 1523692607, 1523692607),
(38, 1, 'mokvyn', 1523692642, 1523692642),
(39, 1, 'mochulyanka', 1523692674, 1523692674),
(40, 1, 'novy-mokvyn', 1523692743, 1523704842),
(41, 1, 'ozirci', 1523692777, 1618082142),
(42, 1, 'orlivka', 1523692801, 1523692801),
(43, 1, 'pidgalo', 1523692879, 1523692879),
(44, 1, 'poliske', 1523692935, 1523692940),
(45, 1, 'polyany', 1523692970, 1523692970),
(46, 1, 'prysluch', 1523693001, 1523693001),
(47, 1, 'sivky', 1523693031, 1523693031),
(48, 1, 'sovpa', 1523693054, 1523693054),
(49, 1, 'sosnove', 1523693193, 1523693193),
(50, 1, 'tyshycya', 1523693241, 1523693241),
(51, 1, 'hmelivka', 1523704034, 1523704034),
(52, 1, 'hotyn', 1523704062, 1523704242),
(53, 1, 'yablunne', 1523704100, 1523704251),
(54, 1, 'yarynivka', 1523704178, 1523704178),
(55, 1, 'yackovychi', 1523704220, 1523704220),
(56, 1, 'antonivka', 1523816593, 1523816593);

-- --------------------------------------------------------

--
-- Структура таблиці `regions_i18n`
--

CREATE TABLE `regions_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_table_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `regions_i18n`
--

INSERT INTO `regions_i18n` (`id`, `parent_table_id`, `language`, `name`) VALUES
(1, 1, 'uk-UA', 'Березнівський район'),
(2, 1, 'en-GB', 'Bereznovsky district'),
(3, 2, 'uk-UA', 'с. Адамівка'),
(4, 2, 'en-GB', 'v. Adamivka'),
(5, 3, 'uk-UA', 'с. Іванівка'),
(6, 3, 'en-GB', 'v. Ivanivka'),
(7, 4, 'uk-UA', 'с. Білка'),
(8, 4, 'en-GB', 'v. Bilka'),
(9, 5, 'uk-UA', 'с. Більчаки'),
(10, 5, 'en-GB', 'v. Bilchaky'),
(11, 6, 'uk-UA', 'с. Балашівка'),
(12, 6, 'en-GB', 'v. Balashivka'),
(13, 7, 'uk-UA', 'м. Березне'),
(14, 7, 'en-GB', 't. Berezne'),
(15, 8, 'uk-UA', 'с. Бистричі'),
(16, 8, 'en-GB', 'v. Bystrychi'),
(17, 9, 'uk-UA', 'с. Богуші'),
(18, 9, 'en-GB', 'v. Bogushi'),
(19, 10, 'uk-UA', 'с. Бронне'),
(20, 10, 'en-GB', 'v. Bronne'),
(21, 11, 'uk-UA', 'с. Вілля'),
(22, 11, 'en-GB', 'v. Villya'),
(23, 12, 'uk-UA', 'с. Вільхівка'),
(24, 12, 'en-GB', 'v. Vilhivka'),
(25, 13, 'uk-UA', 'с. Вітковичі'),
(26, 13, 'en-GB', 'v. Vitkovychi'),
(27, 14, 'uk-UA', 'с. Ведмедівка'),
(28, 14, 'en-GB', 'v. Vedmedivka'),
(29, 15, 'uk-UA', 'с. Великі Селища'),
(30, 15, 'en-GB', 'v. Velyki Selyscha'),
(31, 16, 'uk-UA', 'с. Велика Купля'),
(32, 16, 'en-GB', 'v. Velyka Kuplya'),
(33, 17, 'uk-UA', 'с. Велике Поле'),
(34, 17, 'en-GB', 'v. Velyke Pole'),
(35, 18, 'uk-UA', 'с. Глибочок'),
(36, 18, 'en-GB', 'v. Glybochok'),
(37, 19, 'uk-UA', 'с. Голубне'),
(38, 19, 'en-GB', 'v. Golybne'),
(39, 20, 'uk-UA', 'с. Городище'),
(40, 20, 'en-GB', 'v. Gorodysche'),
(41, 21, 'uk-UA', 'с. Грушівка'),
(42, 21, 'en-GB', 'v. Grushivka'),
(43, 22, 'uk-UA', 'с. Грушівська Гута'),
(44, 22, 'en-GB', 'v. Gryshivska Guta'),
(45, 23, 'uk-UA', 'с. Губків'),
(46, 23, 'en-GB', 'v. Gubkiv'),
(47, 24, 'uk-UA', 'с. Друхів'),
(48, 24, 'en-GB', 'v. Druhiv'),
(49, 25, 'uk-UA', 'с. Зірне'),
(50, 25, 'en-GB', 'v. Zirne'),
(51, 26, 'uk-UA', 'с. Замостище'),
(52, 26, 'en-GB', 'v. Zamostyche'),
(53, 27, 'uk-UA', 'с. Кам\'янка'),
(54, 27, 'en-GB', 'v. Kamyanka'),
(55, 28, 'uk-UA', 'с. Карачун'),
(56, 28, 'en-GB', 'v. Karachun'),
(57, 29, 'uk-UA', 'с. Князівка'),
(58, 29, 'en-GB', 'v. Knyazivka'),
(59, 30, 'uk-UA', 'с. Колодязне'),
(60, 30, 'en-GB', 'v. Kolodyazne'),
(61, 31, 'uk-UA', 'с. Кургани'),
(62, 31, 'en-GB', 'v. Kurgany'),
(63, 32, 'uk-UA', 'с. Лінчин'),
(64, 32, 'en-GB', 'v. Linchin'),
(65, 33, 'uk-UA', 'с. Левачі'),
(66, 33, 'en-GB', 'v. Levachi'),
(67, 34, 'uk-UA', 'с. Малинськ'),
(68, 34, 'en-GB', 'v. Malynsk'),
(69, 35, 'uk-UA', 'с. Малушка'),
(70, 35, 'en-GB', 'v. Malushka'),
(71, 36, 'uk-UA', 'с. Маринин'),
(72, 36, 'en-GB', 'v. Marynyn'),
(73, 37, 'uk-UA', 'с. Михалин'),
(74, 37, 'en-GB', 'v. Myhalyn'),
(75, 38, 'uk-UA', 'с. Моквин'),
(76, 38, 'en-GB', 'v. Mokvyn'),
(77, 39, 'uk-UA', 'с. Мочулянка'),
(78, 39, 'en-GB', 'v. Mochulyanka'),
(79, 40, 'uk-UA', 'с. Новий Моквин'),
(80, 40, 'en-GB', 'v. Novy Mokvyn'),
(81, 41, 'uk-UA', 'с. Озірці'),
(82, 41, 'en-GB', 'v. Ozirci'),
(83, 42, 'uk-UA', 'с. Орлівка'),
(84, 42, 'en-GB', 'v. Orlivka'),
(85, 43, 'uk-UA', 'с. Підгало'),
(86, 43, 'en-GB', 'v. Pidgalo'),
(87, 44, 'uk-UA', 'с. Поліське'),
(88, 44, 'en-GB', 'v. Poliske'),
(89, 45, 'uk-UA', 'с. Поляни'),
(90, 45, 'en-GB', 'v. Polyany'),
(91, 46, 'uk-UA', 'с. Прислуч'),
(92, 46, 'en-GB', 'v. Prysluch'),
(93, 47, 'uk-UA', 'с. Сівки'),
(94, 47, 'en-GB', 'v. Sivky'),
(95, 48, 'uk-UA', 'с. Совпа'),
(96, 48, 'en-GB', 'v. Sovpa'),
(97, 49, 'uk-UA', 'смт. Соснове'),
(98, 49, 'en-GB', 'uv. Sosnove'),
(99, 50, 'uk-UA', 'с. Тишиця'),
(100, 50, 'en-GB', 'v. Tyshycya'),
(101, 51, 'uk-UA', 'с. Хмелівка'),
(102, 51, 'en-GB', 'v. Hmelivka'),
(103, 52, 'uk-UA', 'с. Хотин'),
(104, 52, 'en-GB', 'v. Hotyn'),
(105, 53, 'uk-UA', 'с. Яблунне'),
(106, 53, 'en-GB', 'v. Yablunne'),
(107, 54, 'uk-UA', 'с. Яринівка'),
(108, 54, 'en-GB', 'v. Yarynivka'),
(109, 55, 'uk-UA', 'с. Яцьковичі'),
(110, 55, 'en-GB', 'v. Yackovychi'),
(111, 56, 'uk-UA', 'с. Антонівка'),
(112, 56, 'en-GB', 'v. Antonivka');

-- --------------------------------------------------------

--
-- Структура таблиці `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `param` varchar(128) NOT NULL,
  `value` text NOT NULL,
  `default` text NOT NULL,
  `label` varchar(255) NOT NULL,
  `type` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `settings`
--

INSERT INTO `settings` (`id`, `param`, `value`, `default`, `label`, `type`) VALUES
(1, 'CACHE.TIME_MENU', '3600', '3600', 'Time to cache menu', 'Integer'),
(2, 'APP.NAME', 'Березне ПМД', 'ПМД', 'The application name', 'string'),
(3, 'CACHE.TIME_PAGE', '3600', '3600', 'Time to cache page', 'integer'),
(4, 'DOCTOR.IMG_WIDTH', '1024', '400', 'Doctor image width', 'integer'),
(5, 'DOCTOR.IMG_HEIGHT', '768', '450', 'Doctor image height', 'integer'),
(8, 'DOCTOR.IMG_WIDTH_SMALL', '360', '200', 'Doctor image width small', 'integer'),
(9, 'DOCTOR.IMG_HEIGHT_SMALL', '240', '250', 'Doctor image height small', 'integer'),
(10, 'SITE.KEYWORDS', 'первинна допомога, сімейний лікар,  ПМД,  терапевт, педіатр', 'Rent an apartment, find a home, find a temporary home, to find a room, find an apartment', 'Site keywords', 'string'),
(11, 'SITE.DESCRIPTION', 'Березнівський районний центр первинної медичної допомоги є комунальним закладом охорони здоров’я Березнівської районної ради, що надає первинну медичну допомогу (ПМД) населенню Березнівського району.', 'Rent an apartment or room.', 'Site description', 'string'),
(12, 'DOCTOR.MAX_IMAGES', '9', '9', 'Doctor max images', 'integer'),
(13, 'DOCTOR.CART_COUNT', '9', '9', 'Doctor cart count', 'integer'),
(14, 'USER.PASSWORD_WRONG_EXPIRE', '3600', '3600', 'User password wrong expire', 'integer'),
(15, 'EMAIL.SUPPORT_EMAIL', 'mail@mail.com, mail2@mail.com', 'mail@mail.com', 'Support Email', 'string'),
(16, 'USER.PASSWORD_RESET_TOKEN_EXPIRE', '3600', '3600', 'User password reset token expire', 'integer'),
(17, 'GOOGLE.MAP_API', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 'XXXXXXXXX', 'Google Map API', 'string'),
(18, 'SITE.HEAD', '<!-- Global site tag (gtag.js) - Google Analytics -->\r\n    <script async src=\"https://www.googletagmanager.com/gtag/js?id=UA-111111111-1\"></script>\r\n    <script>\r\n    window.dataLayer = window.dataLayer || [];\r\n    function gtag(){dataLayer.push(arguments);}\r\n    gtag(\'js\', new Date());\r\n\r\n    gtag(\'config\', \'UA-111111111-1\');\r\n    </script>\r\n\r\n<meta name=\"verify-admitad\" content=\"1a1a1a1a1a\" />', 'false', 'Site head scripts, if not need - set false', 'text'),
(19, 'BANNER.IMG_WIDTH', '170', '170', 'Banner image width', 'integer'),
(20, 'BANNER.IMG_HEIGHT', '120', '170', 'Banner image height', 'integer'),
(21, 'LANGUAGES', 'a:3:{i:0;a:5:{s:6:\"status\";i:1;s:7:\"default\";i:1;s:4:\"name\";s:20:\"Українська\";s:3:\"url\";s:2:\"uk\";s:5:\"local\";s:5:\"uk-UA\";}i:1;a:5:{s:6:\"status\";i:1;s:7:\"default\";i:0;s:4:\"name\";s:7:\"English\";s:3:\"url\";s:2:\"en\";s:5:\"local\";s:5:\"en-GB\";}i:2;a:5:{s:6:\"status\";i:0;s:7:\"default\";i:0;s:4:\"name\";s:14:\"Русский\";s:3:\"url\";s:2:\"ru\";s:5:\"local\";s:5:\"ru-RU\";}}', 'a:2:{i:0;a:5:{s:6:\"status\";i:1;s:7:\"default\";i:1;s:4:\"name\";s:20:\"Українська\";s:3:\"url\";s:2:\"uk\";s:5:\"local\";s:5:\"uk-UA\";}i:1;a:5:{s:6:\"status\";i:1;s:7:\"default\";i:0;s:4:\"name\";s:7:\"English\";s:3:\"url\";s:2:\"en\";s:5:\"local\";s:5:\"en-GB\";}}', 'Application languages', 'text');

-- --------------------------------------------------------

--
-- Структура таблиці `static_pages`
--

CREATE TABLE `static_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `alias` varchar(255) NOT NULL,
  `position` enum('footer','header') NOT NULL DEFAULT 'footer',
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL,
  `views` int(10) UNSIGNED NOT NULL,
  `og_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `static_pages`
--

INSERT INTO `static_pages` (`id`, `status`, `alias`, `position`, `created_at`, `updated_at`, `views`, `og_image`) VALUES
(1, 1, 'about', 'header', 1480535402, 1619507528, 0, '/web/uploads/site/about-us.png'),
(3, 1, 'contact', 'header', 1551457143, 1619507570, 0, ''),
(4, 1, 'cookie-policy', 'footer', 1551457406, 1551774301, 0, ''),
(5, 1, 'reports', 'header', 1554124831, 1619507596, 0, '/web/uploads/site/public-info.png');

-- --------------------------------------------------------

--
-- Структура таблиці `static_pages_i18n`
--

CREATE TABLE `static_pages_i18n` (
  `id` int(10) UNSIGNED NOT NULL,
  `static_page_id` int(10) UNSIGNED NOT NULL,
  `language` varchar(5) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `static_pages_i18n`
--

INSERT INTO `static_pages_i18n` (`id`, `static_page_id`, `language`, `title`, `body`, `keywords`, `description`) VALUES
(1, 1, 'en-GB', 'About us', '<p><strong>MNCE &quot;БЕРЕЗНІВСЬКИЙ ЦЕНТР PMC&quot;</strong></p>\r\n\r\n<p><strong>Full name:</strong> MUNICIPAL NON-COMMERCIAL ENTERPRISE &quot;БЕРЕЗНІВСЬКИЙ PRIMARY MEDICAL CARE CENTER&quot; OF BEREZNE CITY COUNCIL OF RIVNE DISTRICT OF RIVNE REGION</p>\r\n\r\n<p><strong>Legal entity identification code (USREOU):</strong> 11111111</p>\r\n\r\n<p><strong>Legal form:</strong> NON-COMMERCIAL ENTERPRISE</p>\r\n\r\n<p><strong>Address:</strong> 34600, Рівненська обл., Березнівський район, місто Березне, вулиця Набережна, будинок 3</p>\r\n\r\n<p><strong>Head (<a href=\"https://berezne-pmd.rv.ua/web/uploads/reports/constitution-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">according to the statute</a>):</strong> Ivanov Ivan Ivanovych</p>\r\n\r\n<p><strong>Activity:</strong> 86.21 General medical practice</p>\r\n\r\n<p><strong>Date and number of state registration:</strong> Date of state registration: 14.11.2011 Date of recording: 07.05.2018 Record number: 0000000000000</p>\r\n\r\n<p><strong>Owners of 15.01.2021:</strong> БЕРЕЗНІВСЬКА МІСЬКА РАДА РІВНЕНСЬКОГО РАЙОНУ РІВНЕНСЬКОЇ ОБЛАСТІ, Код ЄДРПОУ: 11111111</p>\r\n\r\n<p>Центр створений рішенням Березнівської районної ради від 28 жовтня 2011 року №244.</p>\r\n\r\n<p>КОМУНАЛЬНЕ НЕКОМЕРЦІЙНЕ ПІДПРИЄМСТВО &quot;БЕРЕЗНІВСЬКИЙ ЦЕНТР ПЕРВИННОЇ МЕДИЧНОЇ ДОПОМОГИ&quot; БЕРЕЗНІВСЬКОЇ МІСЬКОЇ РАДИ РІВНЕНСЬКОГО РАЙОНУ РІВНЕНСЬКОЇ ОБЛАСТІ (далі - Підприємство) є закладом охорони здоров&rsquo;я &mdash; комунальним унітарним некомерційним неприбутковим підприємством, що надає первинну медичну допомогу та здійснює управління медичним обслуговуванням територіальної громади Березнівської міської ради, вживає заходів з профілактики захворювань населення та підтримання громадського здоров&rsquo;я</p>\r\n\r\n<p>The company is guided by the Constitution of Ukraine, Laws of Ukraine, resolutions of the Verkhovna Rada of Ukraine, acts of the President of Ukraine and the Cabinet of Ministers of Ukraine, mandatory for all health care institutions, the Commercial Code of Ukraine, the Civil Code of Ukraine, the Budget Code of Ukraine, work of Ukraine, orders and instructions of the Ministry of Health of Ukraine, general regulations of other central executive bodies, relevant decisions of local executive bodies, local governments, authorized management body, this Statute and other normative documents.</p>\r\n\r\n<p>The enterprise is a non-profit legal entity, independent balance sheet, seal with the name of the established sample.</p>\r\n', 'About us', 'About us'),
(2, 1, 'uk-UA', 'Про нас', '<p><strong>КНП &quot;БЕРЕЗНІВСЬКИЙ ЦЕНТР ПМД&quot;</strong></p>\r\n\r\n<p><strong>Повна назва:</strong> КОМУНАЛЬНЕ НЕКОМЕРЦІЙНЕ ПІДПРИЄМСТВО &quot;БЕРЕЗНІВСЬКИЙ ЦЕНТР ПЕРВИННОЇ МЕДИЧНОЇ ДОПОМОГИ&quot; БЕРЕЗНІВСЬКОЇ МІСЬКОЇ РАДИ РІВНЕНСЬКОГО РАЙОНУ РІВНЕНСЬКОЇ ОБЛАСТІ</p>\r\n\r\n<p><strong>Ідентифікаційний код юридичної особи (ЄДРПОУ):</strong> 11111111</p>\r\n\r\n<p><strong>Організаційно-правова форма:</strong> КОМУНАЛЬНЕ ПІДПРИЄМСТВО</p>\r\n\r\n<p><strong>Адреса:</strong> 34600, Рівненська обл., Березнівський район, місто Березне, вулиця Набережна, будинок 3</p>\r\n\r\n<p><strong>Керівник (згідно <a href=\"https://berezne-pmd.rv.ua/web/uploads/reports/constitution-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=no,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">статуту</a>):</strong>&nbsp;<strong>Іванов Іван Іванович</strong></p>\r\n\r\n<p><strong>Вид діяльності:</strong> 86.21 Загальна медична практика</p>\r\n\r\n<p><strong>Дата та номер державної реєстрації:</strong> Дата державної реєстрації: 14.11.2011 Дата запису: 07.05.2018 Номер запису: 0000000000000</p>\r\n\r\n<p><strong>Власники на 15.01.2021:</strong> БЕРЕЗНІВСЬКА МІСЬКА РАДА РІВНЕНСЬКОГО РАЙОНУ РІВНЕНСЬКОЇ ОБЛАСТІ, Код ЄДРПОУ: 11111111</p>\r\n\r\n<p>Центр створений рішенням Березнівської районної ради від 28 жовтня 2011 року №244.</p>\r\n\r\n<p>КОМУНАЛЬНЕ НЕКОМЕРЦІЙНЕ ПІДПРИЄМСТВО &quot;БЕРЕЗНІВСЬКИЙ ЦЕНТР ПЕРВИННОЇ МЕДИЧНОЇ ДОПОМОГИ&quot; БЕРЕЗНІВСЬКОЇ МІСЬКОЇ РАДИ РІВНЕНСЬКОГО РАЙОНУ РІВНЕНСЬКОЇ ОБЛАСТІ (далі - Підприємство) є закладом охорони здоров&rsquo;я &mdash; комунальним унітарним некомерційним неприбутковим підприємством, що надає первинну медичну допомогу та здійснює управління медичним обслуговуванням територіальної громади Березнівської міської ради, вживає заходів з профілактики захворювань населення та підтримання громадського здоров&rsquo;я</p>\r\n\r\n<p>Підприємство у своїй діяльності керується Конституцією України, Законами України, постановами Верховної Ради України, актами Президента України та Кабінету Міністрів України, загальнообов&rsquo;язковими для всіх закладів охорони здоров&rsquo;я, Господарським кодексом України, Цивільним кодексом України, Бюджетним кодексом України, Кодексом законів про працю України, наказами та інструкціями Міністерства охорони здоров&rsquo;я України, загальнообов&rsquo;язковими нормативними актами інших центральних органів виконавчої влади, відповідними рішеннями місцевих органів виконавчої влади, органів місцевого самоврядування, уповноваженого органу управління, цим Статутом та іншими нормативними документами.</p>\r\n\r\n<p>Підприємство є неприбутковою юридичною особою, самостійний баланс, печатку зі своїм найменуванням встановленого зразка.</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:16px\"><strong>Хронологія</strong></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\">Свою роботу комунальний заклад охорони здоров&#39;я &ldquo;Березнівський районний центр первинної медичної допомоги&rdquo; Березнівської районної ради розпочав з 01.01.2012 року.</li>\r\n	<li style=\"text-align:justify\">КЗОЗ &rdquo;Березнівський районний центр ПМД&rdquo; отримав ліцензію&nbsp; серія АЕ № 281181, дата прийняття та номер рішення про видачу ліцензії &ndash; 22 серпня 2013 року № 34.&nbsp;&nbsp;</li>\r\n	<li style=\"text-align:justify\">З 01.01.2014 року, після утворення Соснівської АЗПСМ, структурними підрозділами Центру обслуговується&nbsp; все населення району.</li>\r\n	<li style=\"text-align:justify\">В листопаді 2014 року КЗОЗ &ldquo;Березнівський районний центр ПМД&rdquo; акредитований на І категорію.&nbsp;</li>\r\n	<li style=\"text-align:justify\">З 02.01.2015 року кількість ліжок &ldquo;Д&rdquo; стаціонару збільшено з 80 до 100, а з 02.01.2018 року кількість ліжок денного стаціонару збільшена до 105, в 2019 році &ndash; до 112.</li>\r\n	<li style=\"text-align:justify\">У грудні 2015 року отримана ліцензія для впровадження діяльності, пов&#39;язаної з обігом наркотичних засобів, психотропних речовин і прекурсорів.</li>\r\n	<li style=\"text-align:justify\">01.12.2016 року створено 3 нових АЗПСМ (Городищенська, Зірненська, Березнівська №2).</li>\r\n	<li style=\"text-align:justify\">07.05.2018 року шляхом реорганізації КЗОЗ &ldquo;Березнівський районний центр ПМД&rdquo; перетворено в комунальне некомерційне підприємство &ldquo;Березнівський районний центр первинної медичної допомоги&rdquo; Березнівської районної ради.</li>\r\n	<li style=\"text-align:justify\">Наказом МОЗ України №1265 від 05.07.2018 затверджена видача ліцензії на провадження господарської діяльності з медичної практики КНП &ldquo;Березнівський районний центр первинної медичної допомоги&rdquo; Березнівської районної ради.</li>\r\n	<li style=\"text-align:justify\">04.10.2018 року отримана ліцензія для впровадження діяльності, пов&#39;язаної з обігом наркотичних засобів, психотропних речовин і прекурсорів.</li>\r\n	<li style=\"text-align:justify\">З 01.08.2018 року після закінчення інтернатури приступили до роботи 6 лікарів загальної практики-сімейної медицини.</li>\r\n	<li style=\"text-align:justify\">Нових лікарів на постійній основі отримали Друхівська, Білківська, Кам&rsquo;янська, Моквинська та Зірненська АЗПСМ.</li>\r\n	<li style=\"text-align:justify\">15.08.2018 року укладено договір з Національною службою здоров&rsquo;я України про медичне обслуговування населення за програмою медичних гарантій.</li>\r\n	<li style=\"text-align:justify\">Впродовж 2017-2020 років в районі працює урядова програма &laquo;Доступні ліки&raquo;.</li>\r\n	<li style=\"text-align:justify\">В грудні 2018 року заклад акредитований на І категорію.</li>\r\n	<li style=\"text-align:justify\">Протягом 2018-2020 років в районі збудовано та введено в експлуатацію 4 нових АЗПСМ з житлом для лікаря в с. Бистричі, с. Зірне, с. Білка, с. Богуші.&nbsp;</li>\r\n	<li style=\"text-align:justify\">З 01.09.2019 р. наказом по Центру утворена Білківська АЗПСМ та призначено завідувачку &ndash; сімейного лікаря.&nbsp;</li>\r\n	<li style=\"text-align:justify\">З 01.09.2020 року наказом по Центру утворена Богушівська АЗПСМ та призначено завідувачку &ndash; сімейного лікаря&nbsp;</li>\r\n	<li style=\"text-align:justify\">По проекту Світового Банку в 2020 році завершена&nbsp; реконструкція та капітальний ремонт 10 об&#39;єктів &ndash; підрозділів Центру (Тишицька АЗПСМ, Моквинська АЗПСМ, Друхівська АЗПСМ, Малинська АЗПСМ, Прислуцька АЗПСМ, Балашівська АЗПСМ, Вітковицька АЗПСМ, Кам&#39;янська АЗПСМ, ФАП с. Поляни, ФАП с. Поліське)</li>\r\n	<li style=\"text-align:justify\">Після проведення реконструкції та капітального ремонту ФАПи с. Польське та с. Поляни&nbsp; будуть реорганізовані в АЗПСМ</li>\r\n	<li style=\"text-align:justify\">15.01.2021 року&nbsp; назву закладу змінено на&nbsp; КНП &ldquo;Березнівський центр ПМД&rdquo; Березнівської міської ради Рівненського району Рівненської області (наказ по Центру № 9 від 15.01.2021 р.)</li>\r\n</ul>\r\n\r\n<p style=\"text-align:center\"><span style=\"font-size:16px\"><strong>Основна мета діяльності Центру</strong></span></p>\r\n\r\n<ul>\r\n	<li style=\"text-align:justify\">Збереження та відновлення здоров&rsquo;я населення шляхом удосконалення організації, форм і методів надання медичної допомоги населенню;</li>\r\n	<li style=\"text-align:justify\">Оптимізація мережі закладів охорони здоров&rsquo;я з пріоритетним розвитком первинної медичної допомоги на засадах загальної практики-сімейної медицини;</li>\r\n	<li style=\"text-align:justify\">Оснащення підрозділів Центру інвентарем, лікувально-діагностичною апаратурою, оргтехнікою, меблями, іншим обладнанням, санітарним транспортом, удосконалення матеріально-технічної бази;</li>\r\n	<li style=\"text-align:justify\">Поліпшення кадрового забезпечення закладів первинної медичної допомоги; Оптимізація надання медичної допомоги - регулювання маршруту пацієнта;</li>\r\n	<li style=\"text-align:justify\">Зниження рівня захворюваності, інвалідності та смертності населення, зокрема від серцево-судинних, судинно-мозкових захворювань, туберкульозу, ВІЛ/СНІДу, онкологічних захворювань, травматизму, в т.ч. шляхом диспансеризації населення;</li>\r\n	<li style=\"text-align:justify\">Забезпечення населення доступною, своєчасною, якісною та ефективною первинною медичною допомогою;</li>\r\n	<li style=\"text-align:justify\">Забезпечення керованості та безперервності медичної допомоги. Модернізація та реформування первинного рівня надання медичної допомоги, зокрема, в рамках проекту Світового банку &ldquo;Поліпшення охорони здоров&rsquo;я на службі у людей&rdquo;.</li>\r\n</ul>\r\n', 'Про нас', 'Про нас'),
(5, 3, 'uk-UA', 'Контакти', '<p><strong>Адреса:</strong> <a href=\"https://berezne-pmd.rv.ua/uk/department/agpfm-berezne-2\">34600, Рівненська обл., Березнівський район, місто Березне, вулиця Набережна, будинок 3</a></p>\r\n\r\n<p><strong>Телефон:</strong> +380999999999</p>\r\n\r\n<p><strong>E-mail:</strong> mail@gmail.com</p>\r\n', 'Звязатися з нами', 'Звязатися з нами'),
(6, 3, 'en-GB', 'Contact', '<p><strong>Address:</strong> 34600, Rivne region, Bereznovsky district, city Berezne, Naberezhnaya street, house 3</p>\r\n\r\n<p><strong>Phone:</strong> +380999999999</p>\r\n\r\n<p><strong>Email:</strong> mail@gmail.com</p>\r\n', 'Contact us', 'Contact us'),
(7, 4, 'uk-UA', 'Політика cookie', '<p>Наш сайт використовує файли <strong>cookie (куки)</strong>, щоб відрізнити вас від інших користувачів нашого сайту. Це дозволяє зручно переглядати наш сайт, а також дозволяє покращити його. Для того, щоб продовжити роботу з Сайтом, необхідно прийняти використання файлів cookie.</p>\r\n\r\n<p>Файли <strong>cookie </strong>- це невеликі файли, що складаються з букв і цифр, які зберігаються вашим браузером на жорсткому диску комп&#39;ютера.</p>\r\n\r\n<p><strong>Ми використовуємо такі файли cookie:</strong></p>\r\n\r\n<p><strong>Основні cookie. </strong>Це файли, необхідні для правильного функціонування нашого Сайту. До них відносяться, наприклад, файли cookie, які дозволяють вводити захищені території нашого сайту, використовувати електронну систему оплати.</p>\r\n\r\n<p><strong>Аналітичні / технічні файли cookie. </strong>Вони дозволяють оцінити і підрахувати кількість відвідувачів, а також зрозуміти, як вони орієнтуються на Сайті при роботі з ним. Це допомагає нам вдосконалювати роботу сайту, наприклад, шляхом оптимізації пошуку, що робить його простим і ефективним.</p>\r\n\r\n<p><strong>Функціональні файли cookie.</strong> Ці файли потрібні для того, щоб розпізнати вас під час повторного входу на веб-сайт. Це дозволяє нам персоналізувати вміст Сайту відповідно до ваших потреб, вітати вас за назвою і запам&#39;ятовувати ваші уподобання (наприклад, ваш вибір мови).</p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" class=\"table table-hover table-bordered\">\r\n	<caption><strong>Файли cookie, що використовуються на нашому веб-сайті, наведені нижче.</strong></caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\">Назва файлу cookie</th>\r\n			<th scope=\"col\">Термін служби cookie</th>\r\n			<th scope=\"col\">Опис і призначення файлів cookie</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>PHPSESSID</td>\r\n			<td style=\"text-align:center\">Session</td>\r\n			<td>Ідентифікатор сеансу - це змінна сеансу, за яким ідентифікується клієнт (браузер). Цей унікальний ідентифікатор призначається клієнту (браузеру), щоб повернути його на наступний запит. За замовчуванням ідентифікатор сеансу в PHP позначається як PHPSESSID.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_csrf</td>\r\n			<td style=\"text-align:center\">Session</td>\r\n			<td>Зберігає токен для запобігання атак CSRF. Файл cookie встановлюється, коли користувач відвідує веб-сайт.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_language</td>\r\n			<td style=\"text-align:center\">30 днів</td>\r\n			<td>Використовується для запам&#39;ятовування мови веб-сайту.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_identity</td>\r\n			<td style=\"text-align:center\">30 днів</td>\r\n			<td>Використовується для запам&#39;ятовування авторизації користувача на веб-сайті.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\" style=\"text-align:center\"><strong>Файли cookie, що використовуються іншими мережевими сервісами на нашому веб-сайті.</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>_ga</td>\r\n			<td style=\"text-align:center\">2 роки</td>\r\n			<td>Аналітичні cookie від Google Analytics. Дозволяє розрізняти користувачів.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_gid</td>\r\n			<td style=\"text-align:center\">24&nbsp;години</td>\r\n			<td>Аналітичні cookie від Google Analytics. Дозволяє розрізняти користувачів.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_gat_gtag_UA_118810134_1</td>\r\n			<td style=\"text-align:center\">1 хвилина</td>\r\n			<td>Аналітичні cookie від Google Analytics. Обмежує частоту запитів.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Зверніть увагу, що треті сторони (наприклад, рекламні мережі або зовнішні постачальники послуг, такі як аналіз веб-трафіку) можуть також використовувати файли cookie. Ми не контролюємо цей процес. Ці файли cookie, швидше за все, є аналітичними / технічними файлами.</p>\r\n\r\n<p>Ви можете блокувати файли cookie, активуючи певний параметр у вашому браузері, який дозволяє відмовитися від встановлення всіх або частини файлів cookie. Проте, у разі блокування cookies у інтернет-браузері (включаючи необхідні файли cookie), ви можете втратити доступ до всіх або декількох розділів нашого сайту.</p>\r\n', 'Політика cookie', 'Політика cookie'),
(8, 4, 'en-GB', 'Cookie policy', '<p>Our Site uses <strong>cookies </strong>to distinguish you from other users of our site. This allows you to conveniently view our Site, and also makes it possible to improve it. In order to continue working with the Site, you need to accept the use of cookies.</p>\r\n\r\n<p><strong>Cookies </strong>are small files consisting of letters and numbers that are stored by your browser on the hard disk of your computer.</p>\r\n\r\n<p><strong>We use the following cookies:</strong></p>\r\n\r\n<p><strong>Essential cookies.</strong> These are the files necessary for the correct operation of our Site. These include, for example, cookies that allow you to enter protected areas of our Site, use an electronic payment system.</p>\r\n\r\n<p><strong>Analytical / technical cookies. </strong>They allow us to estimate and count the number of visitors, as well as to understand how they navigate the Site when working with it. This helps us to make improvements to the work of the site, for example, by optimizing the search, making it simple and effective.</p>\r\n\r\n<p><strong>Functional cookies.</strong> These files are needed in order to recognize you when you re-enter the website. This allows us to personalize the content of the Site to your needs, greet you by name and remember your preferences (for example, your choice of language).</p>\r\n\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" class=\"table table-hover table-bordered\">\r\n	<caption><strong>Cookies used on our website are listed below.</strong></caption>\r\n	<thead>\r\n		<tr>\r\n			<th scope=\"col\"><strong>Cookie name</strong></th>\r\n			<th scope=\"col\"><strong>Cookie lifetime</strong></th>\r\n			<th scope=\"col\"><strong>Cookie description and purpose</strong></th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>PHPSESSID</td>\r\n			<td style=\"text-align:center\">Session</td>\r\n			<td>The session identifier is the session variable by which the client (browser) is identified. This unique identifier is assigned to the client (browser) in order to return it on the next request. By default, the session ID in PHP is denoted as PHPSESSID.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_csrf</td>\r\n			<td style=\"text-align:center\">Session</td>\r\n			<td>Stores the token for preventing CSRF attacks. The cookie is set when a user visits the website.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_language</td>\r\n			<td style=\"text-align:center\">30 days</td>\r\n			<td>Used to memorize the language of the website.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_identity</td>\r\n			<td style=\"text-align:center\">30 days</td>\r\n			<td>Used to memorize the user&#39;s authorization on the website.</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"3\" style=\"text-align:center\"><strong>Cookies used by other network services on your website.</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>_ga</td>\r\n			<td style=\"text-align:center\">2 years</td>\r\n			<td>Analytic cookie by Google Analytics.&nbsp;Used to distinguish users.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_gid</td>\r\n			<td style=\"text-align:center\">24 hours</td>\r\n			<td>Analytic cookie by Google Analytics.&nbsp;Used to distinguish users.</td>\r\n		</tr>\r\n		<tr>\r\n			<td>_gat_gtag_UA_118810134_1</td>\r\n			<td style=\"text-align:center\">1 minute</td>\r\n			<td>Analytic cookie by Google Analytics. Limits the frequency of requests.</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Please note that third parties (for example, ad networks or external service providers such as web traffic analysis) may also use cookies. We do not control this process. These cookies are most likely analytical / technical cookies.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You can block cookies by activating a specific setting in your browser, which allows you to refuse to set all or part of cookies. However, in the case of blocking cookies in the Internet browser (including essential cookies), you may lose access to all or several sections of our Site.</p>\r\n', 'Cookie policy', 'Cookie policy'),
(9, 5, 'uk-UA', 'Публічна інформація', '<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"background-color:#FFFF00\"><strong>Установчі документи КНП &quot;БЕРЕЗНІВСЬКИЙ ЦЕНТР ПМД&quot;</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>Загальні:</strong></td>\r\n			<td><strong><a class=\"btn btn-info\" href=\"/web/uploads/reports/constitution-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Статут</a></strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"background-color:#FFFF00\"><strong>Звіти КНП &quot;БЕРЕЗНІВСЬКИЙ ЦЕНТР ПМД&quot;</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"1\"><strong>Фінансові:</strong></td>\r\n			<td><strong><a class=\"btn btn-info\" href=\"/uk/article/financial-statements-2018\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Фінансові звіти за 2018 рік.</a></strong>&nbsp; <strong><a class=\"btn btn-info\" href=\"/uk/article/financial-statements-2019\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Фінансові звіти за 2019 рік.</a></strong>&nbsp; <strong><a class=\"btn btn-info\" href=\"/uk/article/financial-statements-2020\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Фінансові звіти за 2020 рік.</a></strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td style=\"background-color:#FFFF00\"><strong>Форми первинних документів бухгалтерського обліку з 01.01.2020 <a href=\"/web/uploads/accounting/order-on-approval-of-forms-of-primary-documents.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">(Наказ про затвердження)</a></strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong><a class=\"btn btn-success\" href=\"/uk/article/accounting-for-tangible-assets-inventories\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Бухгалтерський облік матеріальних цінностей (запасів):</a></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong><a class=\"btn btn-success\" href=\"/uk/article/accounting-for-fixed-assets\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Бухгалтерський облік основних засобів:</a></strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Публічна інформація Березне ПМД, фінансові звіти Березне ПМД, статистичні звіти Березне ПМД, установчі документи Березне ПМД', 'Публічна інформація КНП БЕРЕЗНІВСЬКИЙ РАЙОННИЙ ЦЕНТР ПМД: фінансові, статистичні, установчі документи'),
(10, 5, 'en-GB', 'Public information', '<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"background-color:#FFFF00\"><strong>The constituent documents of the MPE &quot;BEREZNIVSKIY CENTER PMD&quot; </strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong>General:</strong></td>\r\n			<td><strong><a class=\"btn btn-info\" href=\"/web/uploads/reports/constitution-2020.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Constitution</a></strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td colspan=\"2\" style=\"background-color:#FFFF00\"><strong>MPE &quot;BEREZNIVSKIY CENTER PMD&quot; reports</strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td rowspan=\"1\"><strong>Financial:</strong></td>\r\n			<td><strong><a class=\"btn btn-info\" href=\"/uk/article/financial-statements-2018\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">2018 Financial Statements</a></strong>&nbsp; <strong><a class=\"btn btn-info\" href=\"/uk/article/financial-statements-2019\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">2019 Financial Statements</a></strong>&nbsp; <strong><a class=\"btn btn-info\" href=\"/uk/article/financial-statements-2010\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">2020 Financial Statements</a></strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<table class=\"table table-bordered table-hover\">\r\n	<thead>\r\n		<tr>\r\n			<td style=\"background-color:#FFFF00\"><strong>Forms of primary accounting documents from 01.01.2020 <a href=\"/web/uploads/accounting/order-on-approval-of-forms-of-primary-documents.pdf\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">(Order for approval)</a></strong></td>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td><strong><a class=\"btn btn-success\" href=\"/uk/article/accounting-for-tangible-assets-inventories\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Accounting for tangible assets (inventories):</a></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td><strong><a class=\"btn btn-success\" href=\"/uk/article/accounting-for-fixed-assets\" onclick=\"window.open(this.href, \'\', \'resizable=yes,status=yes,location=yes,toolbar=no,menubar=no,fullscreen=no,scrollbars=no,dependent=no\'); return false;\">Accounting for fixed assets:</a></strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'Public information Bereznya PMD, financial reports Berezne PMD, statistical reports Berezne PMD', 'Public information BEREZNIV DISTRICT CENTER PMD reports: financial, statistical');

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `role` tinyint(1) UNSIGNED NOT NULL DEFAULT '2',
  `ip` varchar(39) NOT NULL,
  `last_ip` varchar(39) NOT NULL,
  `wrong_logins` varchar(12) NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  `updated_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `auth_key`, `password_reset_token`, `email`, `status`, `role`, `ip`, `last_ip`, `wrong_logins`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$13$PVRw.q9ml/29UUhpPYw5weaKVTxFwD1fF3Se9SeGImOdiVvsZFqWC', 'vu4aGQHEE7iyPD7_BT2vlQlApgPq4yx9', NULL, 'mail@gmail.com', 1, 1, '127.0.0.1', '127.0.0.1', '', 1522347394, 1619508010),
(7, 'testuser', '$2y$13$8XXbX7M5I8NdrrBJQvg0KOyFEwfIHg0K0fA9WAJdhihCrfe2ATvM6', '', NULL, 'testuser@mail.com', 1, 2, '127.0.0.1', '127.0.0.1', '', 1522347394, 1619508140);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `articles_i18n`
--
ALTER TABLE `articles_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `article_categories`
--
ALTER TABLE `article_categories`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `article_categories_i18n`
--
ALTER TABLE `article_categories_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `banners_i18n`
--
ALTER TABLE `banners_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Індекси таблиці `departments_i18n`
--
ALTER TABLE `departments_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `department_types`
--
ALTER TABLE `department_types`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `department_types_i18n`
--
ALTER TABLE `department_types_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `doctors_i18n`
--
ALTER TABLE `doctors_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `doctor_categories`
--
ALTER TABLE `doctor_categories`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `doctor_categories_i18n`
--
ALTER TABLE `doctor_categories_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `doctor_images`
--
ALTER TABLE `doctor_images`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `doctor_specializations`
--
ALTER TABLE `doctor_specializations`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `doctor_specializations_i18n`
--
ALTER TABLE `doctor_specializations_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `regions_i18n`
--
ALTER TABLE `regions_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `param` (`param`);

--
-- Індекси таблиці `static_pages`
--
ALTER TABLE `static_pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- Індекси таблиці `static_pages_i18n`
--
ALTER TABLE `static_pages_i18n`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблиці `articles_i18n`
--
ALTER TABLE `articles_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблиці `article_categories`
--
ALTER TABLE `article_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `article_categories_i18n`
--
ALTER TABLE `article_categories_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `banners_i18n`
--
ALTER TABLE `banners_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблиці `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблиці `departments_i18n`
--
ALTER TABLE `departments_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT для таблиці `department_types`
--
ALTER TABLE `department_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблиці `department_types_i18n`
--
ALTER TABLE `department_types_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT для таблиці `doctors_i18n`
--
ALTER TABLE `doctors_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT для таблиці `doctor_categories`
--
ALTER TABLE `doctor_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблиці `doctor_categories_i18n`
--
ALTER TABLE `doctor_categories_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблиці `doctor_images`
--
ALTER TABLE `doctor_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблиці `doctor_specializations`
--
ALTER TABLE `doctor_specializations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблиці `doctor_specializations_i18n`
--
ALTER TABLE `doctor_specializations_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблиці `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблиці `regions_i18n`
--
ALTER TABLE `regions_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT для таблиці `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблиці `static_pages`
--
ALTER TABLE `static_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблиці `static_pages_i18n`
--
ALTER TABLE `static_pages_i18n`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
