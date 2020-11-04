

    var enjoyhint_instance = new EnjoyHint({});

    var enjoyhint_script_steps = [
        {
            'next .menu-item-8268': '<strong>Ваш менеджер</strong><br>Если у Вас есть вопросы или вам нужна помощь, обратитесь к вашему менеджеру.',
            'shape': 'circle',

            'nextButton': {className: "next-cls", text: "Понятно"},
            'skipButton': {className: "skip-cls", text: "Пропустить!"}
        },
		
        {
            'next .vc_btn3-icon-left vc_btn3-color-inverse' : '<strong>Кнопка входа на онлайн мероприятие</strong><br>Обратите внимание, что кнопка станет активной за 10 минут до начала мероприятия. Если этого не случилось, просто обновите страницу.',
            'shape': 'circle',
            'showSkip' : false,
            'nextButton': {className: "next-cls", text: "Понятно"}

        },



    ];

    enjoyhint_instance.set(enjoyhint_script_steps);
    enjoyhint_instance.run();

