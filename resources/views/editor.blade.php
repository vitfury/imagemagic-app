<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stickerpack creator</title>
        <link type="text/css" href="https://uicdn.toast.com/tui-color-picker/v2.2.6/tui-color-picker.css" rel="stylesheet">
        <link type="text/css" href="../dist/tui-image-editor.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="../css/fontimport.css">
        @include("common.head")
        <style>
            @import url(http://fonts.googleapis.com/css?family=Noto+Sans);
            html, body {
                height: 100%;
                margin: 0;
            }
        </style>
        <script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
    </head>
    <body>



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
        <script type="text/javascript" src="../dist/tui-image-editor.js"></script>
        <!-- <script type="text/javascript" src="http://0.0.0.0:8080/dist/tui-image-editor.js"></script> -->
        <script type="text/javascript" src="js/theme/white-theme.js"></script>
        <script type="text/javascript" src="js/theme/black-theme.js"></script>
        <script>
         // Image editor
         var locale_ru_RU = { 
                //Filter
                'Filter':'Фильтр',
                'Grayscale':'Черно белый',
                'Invert': 'Инвертировать цвета',
                'Sepia': 'Светлая сепия',
                'Sepia2':'Темная сепия',
                'Sharpen':'Улучшить резкость',
                'Brightness':'Яркость',
                'Noise':'Шум',
                'Pixelate':"Запикселить",
                'Tint':'Оттенок',
                'Multiply':'Затемнить',
                'Blend':'Осветлить',
                //Upload image
                'Mask': 'Изображение',
                'Load': 'Загрузить',
                'Remove Background': 'убрать фон',
                //Erase
                'Erase':'Ластик',
                'Eraser width':'Размер',
                //Draw
                'Draw':'Рисовать',
                'Free':'Кисть',
                'Straight':'Линия',
                'Color':'Цвет',
                'Range':'Размер',
                //Text
                'Text':'Текст',
                'Font family':'Шрифты',
                'Bold':'Жирный',
                'Italic':'Курсив',
                'Underline':'Подчеркнуть',
                'Left':'Слева',
                'Center':'Центрировать',
                'Right':'Справа',
                'Text color':'Цвет текста',
                'Text size':'Размер текста',
                'Stroke size':'Толщина обводки',
                'Stroke color':'Цвет обводки',
                'Stroke form':'Форма обводки',
                'Soft':'Облако',
                'Chainsaw':'Пила',
                'Pixelize':'Пиксель',
                'Fishbone':'Рыбья кость',
                //Icon
                'Icon':'Иконка',
                'Arrow':'Стрелка',
                'Arrow-2':'Стрелка-2',
                'Arrow-3':'Стрелка-3',
                'Star-1':'Звезда',
                'Star-2':'Звезда-2',
                'Polygon':'Многоугольник',
                'Location':'Местонахождение',
                'Heart':'Сердце',
                'Bubble':'Сообщение',
                'Custom icon':'Загрузить иконку',
                //Flip
                'Flip':'Отзеркалить',
                'Flip X':'По вертикали',
                'Flip Y':'По горизонтали',
                'Reset':'Сбросить',
                //Rotate
                'Rotate':'Вращение',
                'Angle':'Градус',
                //Shape
                'Shape':'Фигуры',
                'Rectangle':'Квадрат',
                'Circle':'Круг',
                'Triangle':'Трехугольник',
                'Fill':'Цвет заливки',
                'Stroke':'Цвет фигуры',
                'Stroke width':'Ширина линий',
                //ETC
                'Undo':'Шаг назад',
                'Redo':'Шаг вперед',
                'Delete':'Удалить',
                'Delete all':'Удалить всё',
                    // etc...
                     };
         var locale_en_EN = {
             'Mask': 'Add Image',
             'Load Mask Image': 'Load Image'
         }
         var imageEditor = new tui.ImageEditor('#tui-image-editor-container', {
             includeUI: {
                 loadImage: {
                     path: 'img/new.png',
                     name: 'Sticker'
                 },
                 theme: blackTheme, // or whiteTheme
                 locale: locale_ru_RU,
                 initMenu: 'mask',
                 menuBarPosition: 'left'
             },
             cssMaxWidth: 700,
             cssMaxHeight: 500,
             usageStatistics: false
         });
         window.onresize = function() {
             imageEditor.ui.resizeEditor();
             loaderPosition();
         }

         function loaderPosition() {
             var canvasOffset = $('.lower-canvas').offset();
             var lowerCanvasWidth = $('.lower-canvas').width();
             var lowerCanvasHeight = $('.lower-canvas').height();
             var progressBarWidth = $('.progressbar-container').outerWidth();
             $('.image-loader-overlay').show();
             var progressBarHeight = $('.progressbar-container').innerHeight();
             $('.image-loader-overlay').hide();
             var offsetTop = canvasOffset.top + (lowerCanvasHeight/2) - (progressBarHeight/2);
             var offsetLeft = canvasOffset.left + (lowerCanvasWidth/2) - (progressBarWidth/2);
             $('.progressbar-container').css('top', offsetTop);
             $('.progressbar-container').css('left', offsetLeft);
         }

         setTimeout(function(){
             loaderPosition();
         }, 3000);


        </script>
     </div>
    </body>
</html>
