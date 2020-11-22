var Editor = {
    Instance: {},
    Sticker:{
        id:0
    },
    Init: function() {
        Editor.Sticker = window.sticker;
        window.imageEditor = Editor.Instance = new tui.ImageEditor('#tui-image-editor-container', {
            includeUI: {
                loadImage: {
                    path: '/img/new.png',
                    name: 'Sticker'
                },
                theme: blackTheme, // or whiteTheme
                locale: locale_en_EN,
                initMenu: 'mask',
                menuBarPosition: 'left'
            },
            cssMaxWidth: 700,
            cssMaxHeight: 500,
            usageStatistics: false
        });


        // Editor.Instance.
        if(Editor.Sticker.json) {
            const canvas = Editor.Instance._graphics.getCanvas();
            canvas.loadFromJSON(
                Editor.Sticker.json,
                canvas.renderAll.bind(canvas)
            );
        }

        window.onresize = function () {
            Editor.Instance.ui.resizeEditor();
            Editor.UI.UpdateLoaderPositon();
        }
        setTimeout(function () {
            Editor.UI.UpdateLoaderPositon();
        }, 3000);
    },
    UI: {
        UpdateLoaderPositon: function() {
            var canvasOffset = $('.lower-canvas').offset();
            var lowerCanvasWidth = $('.lower-canvas').width();
            var lowerCanvasHeight = $('.lower-canvas').height();
            var progressBarWidth = $('.progressbar-container').outerWidth();
            $('.image-loader-overlay').show();
            var progressBarHeight = $('.progressbar-container').innerHeight();
            $('.image-loader-overlay').hide();
            var offsetTop = canvasOffset.top + (lowerCanvasHeight / 2) - (progressBarHeight / 2);
            var offsetLeft = canvasOffset.left + (lowerCanvasWidth / 2) - (progressBarWidth / 2);
            $('.progressbar-container').css('top', offsetTop);
            $('.progressbar-container').css('left', offsetLeft);
        },
        ShowModalLoader: function(){
            $('.progressbar-overlay').show();
        },
        HideModalLoader: function(){
            $('.progressbar-overlay').hide();
        }
    },
    Actions: {
        GetSticker: function() {
            return {
                name: "sticker",
                image: Editor.Instance.toDataURL({ format: 'svg', quality: 1 }).split('base64'+',')[1],
                json: JSON.stringify(Editor.Instance._graphics._canvas.toJSON())
            };
        },
        StartEditingSession: function(event) {
            if(Editor.Sticker.id) {
                return;
            }
            var callback = function(response) {
                Editor.Sticker.id = response.data.id;
                history.replaceState([], 'Editing Document', '/editor/'+Editor.Sticker.id);
                Editor.Actions.HandleEditorChanged();
            };
            App.Api.CreateSticker(
                Editor.Actions.GetSticker(),
                callback
            );
        },
        HandleEditorChanged: function() {
            App.Api.SaveSticker(
                Editor.Sticker.id,
                Editor.Actions.GetSticker(),
            );
        }
    }
}
