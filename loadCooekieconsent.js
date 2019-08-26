$.ajax({
    dataType: "json",
    type: "POST",
    url: '/cookieconsent/getData',
    success: function (response) {
        initCookieconsent(response);
    }
});

function initCookieconsent(data) {
    if (data['layout'] == 'wire') {
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": data['popup-color']
                },
                "button": {
                    "background": 'transparent',
                    "text": data['button-color'],
                    "border": data['button-color']
                }
            },
            "theme": data['layout'],
            "position": data['position'],
            "static": data['static'],
            "content": {
                "message": data['text'],
                "dismiss": data['button-text'],
                "link": data['link-text'],
                "href": data['href']
            }
        });
    } else {
        window.cookieconsent.initialise({
            "palette": {
                "popup": {
                    "background": data['popup-color']
                },
                "button": {
                    "background": data['button-color']
                }
            },
            "theme": data['layout'],
            "position": data['position'],
            "static": data['static'],
            "content": {
                "message": data['text'],
                "dismiss": data['button-text'],
                "link": data['link-text'],
                "href": data['href']
            }
        });
    }
}