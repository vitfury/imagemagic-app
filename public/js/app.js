var App = {
    Api: {
        Request: function (route, method, data, success, error) {
            $.ajax({
                method: method,
                url: "/api/"+route,
                headers: {
                    'token': window.user.token
                },
                data: data,
                success: function(response) {
                    if (typeof(success) === 'function') {
                        success(response);
                    }
                },
                error: function(response) {
                    if(response.status === 401) {
                        location.href = '/login';
                    }
                    if (typeof(error) === 'function') {
                        error(response);
                    }
                }
            });
        },
        CreateSticker: function (sticker, success, error) {
            App.Api.Request('sticker/create', "post", sticker, success, error);
        },
        SaveSticker: function (id, sticker, success, error) {
            App.Api.Request('sticker/save/'+id, "post", sticker, success, error);
        },
        OpenSticker: function (id, success, error) {
            App.Api.Request('sticker/get/'+id, "get", {}, success, error);
        },
        RemoveBackground: function (data, success, error) {
            App.Api.Request('image/removeBackground', "post", data, success, error);
        },
        Resize: function (data, success, error) {
            App.Api.Request('image/resize', "post", data, success, error);
        }
    }
}
