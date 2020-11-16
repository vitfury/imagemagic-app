<!DOCTYPE html>
<html lang="en">
    <head>
     @include ("common.head")
    </head>
    <body>
        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                    @include("common.header")
                    @yield('content')
                </main>
            </div>
            @include("common.footer")
        </div>
       @include("common.scripts")
    </body>
</html>