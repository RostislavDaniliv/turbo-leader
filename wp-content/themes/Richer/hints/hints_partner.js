

    var enjoyhint_instance = new EnjoyHint({});

    var enjoyhint_script_steps = [
        {
            'next .menu-item-8275': '<strong>Архив онлайн мероприятий</strong><br>Здесь находятся все записи онлайн мероприятий. Вы видите архив который доступен для вашей клубной карты. Для того чтобы получить доступ к полному архиву, пройдите VIP Верификацию после посещения ближайшего Стартового тренинга для партнеров.',
            'shape': 'circle',

            'nextButton': {className: "next-cls", text: "Понятно"},
            'skipButton': {className: "skip-cls", text: "Пропустить!"}
        },

        {
            'next .menu-item-8267' : '<strong>Рабочая тетрадь</strong><br>В рабочей тетради отображаются все контакты людей, которые зарегистрировались через ваш партнерский сайт. <strong>Это самый главный раздел системы</strong>.',
            'shape': 'circle',
            'nextButton': {className: "next-cls", text: "Понятно"},
            'skipButton': {className: "skip-cls", text: "Пропустить!"}

        },

        {
            'next .menu-item-7483' : '<strong>Партнерский сайт</strong><br>Это ваш партнерский сайт на который вы приглашаете людей. Для того чтобы его активировать, настройте свой аккаунт в разделе <strong>«Мой профиль»</strong>.',
            'shape': 'circle',
            'nextButton': {className: "next-cls", text: "Понятно"},
            'skipButton': {className: "skip-cls", text: "Пропустить!"}

        },

        {
            'next .menu-item-8207' : '<strong>Быстрый доступ к компании</strong><br>Из этого меню вы сможете быстро перейти к бэк-офису и другим ресурсам компании.',

            'nextButton': {className: "next-cls", text: "Понятно"},
            'skipButton': {className: "skip-cls", text: "Пропустить!"},

            onBeforeStart:function(){
                jQuery(document).ready(function($) {
                $('a.toggleMenu').click();

            });
            }

        },
        {
            'next .menu-item-7352' : '<strong>Клубные карты</strong><br>Раздел с описанием клубных карт и привелегий, которые они дают. Если у вас не самая высшая клубная карта, изучите <strong>Архив Тренингов</strong> или посетите ближайшее онлайн мероприятие <strong>«Стартовый тренинг для партнеров»</strong>.',

            'nextButton': {className: "next-cls", text: "Понятно"},
            'skipButton': {className: "skip-cls", text: "Пропустить!"},

            onBeforeStart:function(){
                jQuery(document).ready(function($) {

                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });
            }

        },
		
        {
            'next .menu-item-6995' : '<strong>Меню управления</strong><br>В меню управления вы можете изменить свой пароль, а также подключить все необходимые оповещения. Обязательно подключите пуш-уведомления и установите расширение для браузера Гугл Хром, чтобы не пропустить важных событий в системе.',

            'showSkip' : false,
            'nextButton': {className: "next-cls", text: "Понятно"},

            onBeforeStart:function(){
                jQuery(document).ready(function($) {

                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    return false;
                });
            }

        }

    ];

    enjoyhint_instance.set(enjoyhint_script_steps);
    enjoyhint_instance.run();

