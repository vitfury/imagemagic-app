<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stickerpack creator</title>
        <link type="text/css" href="https://uicdn.toast.com/tui-color-picker/v2.2.6/tui-color-picker.css" rel="stylesheet">
        <link type="text/css" href="/dist/tui-image-editor.css" rel="stylesheet">
        <link
            href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Caveat:wght@400;700&family=Marck+Script&family=Pacifico&family=Play:wght@400;700&family=Press+Start+2P&family=Roboto:wght@400;700&display=swap"
            rel="stylesheet">
        @include("common.head")
        <style>
            @import url(http://fonts.googleapis.com/css?family=Noto+Sans);

            html, body {
                height: 100%;
                margin: 0;
            }
        </style>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"
                integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    </head>
    <body>


        @include ("common.invisible-fonts")
        <div class="editorheight">
            <div class="bootstrap row no-gutters editorheight">
            <!-- <div class="col-2 sidebar-wrapper">
                                @include("sidebar")
                </div> -->

                <!-- <div class="col-10 editorheight">
                <div id="tui-image-editor-container"></div>
                        </div> -->
                <div class="progressbar-overlay image-loader-overlay">
                    <div class="progressbar-container">
                        <img src="/img/loader.gif" alt="" class="progressbar-picture">
                        <div class="progressbar-text">Processing your image...</div>
                    </div>
                </div>
                <div class="col-12 editorheight">
                    <div id="tui-image-editor-container"></div>
                </div>

                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.0/fabric.js"></script>
                <script type="text/javascript" src="https://uicdn.toast.com/tui.code-snippet/v1.5.0/tui-code-snippet.min.js"></script>
                <script type="text/javascript" src="https://uicdn.toast.com/tui-color-picker/v2.2.6/tui-color-picker.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
                <script type="text/javascript" src="/dist/tui-image-editor.min.js"></script>
                <script type="text/javascript" src="/js/theme/black-theme.js"></script>
                <script>

                    var sticker = {
                        id: {{$id ?? 0}},
                        json: '{!! $json ?? '' !!}',
                    }
                    // Image editor
                    var locale_ru_RU = {
                        //Filter
                        'Filter': 'Фильтр',
                        'Grayscale': 'Черно белый',
                        'Invert': 'Инвертировать цвета',
                        'Sepia': 'Светлая сепия',
                        'Sepia2': 'Темная сепия',
                        'Sharpen': 'Улучшить резкость',
                        'Brightness': 'Яркость',
                        'Noise': 'Шум',
                        'Pixelate': "Запикселить",
                        'Tint': 'Оттенок',
                        'Multiply': 'Затемнить',
                        'Blend': 'Осветлить',
                        //Upload image
                        'Mask': 'Изображение',
                        'Load': 'Загрузить',
                        'Remove Background': 'убрать фон',
                        //Erase
                        'Erase': 'Ластик',
                        'Eraser width': 'Размер',
                        //Draw
                        'Draw': 'Рисовать',
                        'Free': 'Кисть',
                        'Straight': 'Линия',
                        'Color': 'Цвет',
                        'Range': 'Размер',
                        //Text
                        'Text': 'Текст',
                        'Font family': 'Шрифты',
                        'Bold': 'Жирный',
                        'Italic': 'Курсив',
                        'Underline': 'Подчеркнуть',
                        'Left': 'Слева',
                        'Center': 'Центрировать',
                        'Right': 'Справа',
                        'Text color': 'Цвет текста',
                        'Text size': 'Размер текста',
                        'Stroke size': 'Толщина обводки',
                        'Stroke color': 'Цвет обводки',
                        'Stroke form': 'Форма обводки',
                        'Soft': 'Облако',
                        'Chainsaw': 'Пила',
                        'Pixelize': 'Пиксель',
                        'Fishbone': 'Рыбья кость',
                        //Icon
                        'Icon': 'Иконка',
                        'Arrow': 'Стрелка',
                        'Arrow-2': 'Стрелка-2',
                        'Arrow-3': 'Стрелка-3',
                        'Star-1': 'Звезда',
                        'Star-2': 'Звезда-2',
                        'Polygon': 'Многоугольник',
                        'Location': 'Местонахождение',
                        'Heart': 'Сердце',
                        'Bubble': 'Сообщение',
                        'Custom icon': 'Загрузить иконку',
                        //Flip
                        'Flip': 'Отзеркалить',
                        'Flip X': 'По вертикали',
                        'Flip Y': 'По горизонтали',
                        'Reset': 'Сбросить',
                        //Rotate
                        'Rotate': 'Вращение',
                        'Angle': 'Градус',
                        //Shape
                        'Shape': 'Фигуры',
                        'Rectangle': 'Квадрат',
                        'Circle': 'Круг',
                        'Triangle': 'Трехугольник',
                        'Fill': 'Цвет заливки',
                        'Stroke': 'Цвет фигуры',
                        'Stroke width': 'Ширина линий',
                        //ETC
                        'Undo': 'Шаг назад',
                        'Redo': 'Шаг вперед',
                        'Delete': 'Удалить',
                        'DeleteAll': 'Удалить всё',
                        // etc...
                    };
                    var locale_en_EN = {
                        'Mask': 'Add Image',
                        'Load Mask Image': 'Load Image'
                    }
                </script>
                <script type="text/javascript" src="/js/editor.js"></script>
                <script>
                    Editor.Init();
                </script>
            </div>
        </div>
    </body>
</html>
