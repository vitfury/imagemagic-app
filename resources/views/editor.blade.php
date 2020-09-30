<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Stickerpack creator</title>
        <link type="text/css" href="https://uicdn.toast.com/tui-color-picker/v2.2.6/tui-color-picker.css" rel="stylesheet">
        <link type="text/css" href="../dist/tui-image-editor.css" rel="stylesheet">
        @include("common.head")
        <style>
            @import url(http://fonts.googleapis.com/css?family=Noto+Sans);
            html, body {
                height: 100%;
                margin: 0;
            }
        </style>
    </head>
    <body>
       <div class="editorheight">
           <div class="bootstrap row no-gutters editorheight">
               <div class="col-3 blackleftside">
                 @include("sidebar")
</div>
               
               <div class="col-9 editorheight">
               <div id="tui-image-editor-container"></div>
               </div>
           </div>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/3.6.0/fabric.js"></script>
        <script type="text/javascript" src="https://uicdn.toast.com/tui.code-snippet/v1.5.0/tui-code-snippet.min.js"></script>
        <script type="text/javascript" src="https://uicdn.toast.com/tui-color-picker/v2.2.6/tui-color-picker.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/1.3.3/FileSaver.min.js"></script>
        <script type="text/javascript" src="../dist/tui-image-editor.js"></script>
        <script type="text/javascript" src="js/theme/white-theme.js"></script>
        <script type="text/javascript" src="js/theme/black-theme.js"></script>
        <script>
         // Image editor
         var imageEditor = new tui.ImageEditor('#tui-image-editor-container', {
             includeUI: {
                 loadImage: {
                     path: 'img/sampleImage2.png',
                     name: 'SampleImage'
                 },
                 theme: blackTheme, // or whiteTheme
                 initMenu: 'filter',
                 menuBarPosition: 'bottom'
             },
             cssMaxWidth: 700,
             cssMaxHeight: 500,
             usageStatistics: false
         });
         window.onresize = function() {
             imageEditor.ui.resizeEditor();
         }
        </script>
     </div>
    </body>
</html>