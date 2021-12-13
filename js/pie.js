document.oncontextmenu=function(){
        return!1
    },
    window.sidebar&&(
        document.onmousedown=function(e){
            var t=e.target;
            return"SELECT"==t.tagName.toUpperCase()||"INPUT"==t.tagName.toUpperCase()||"TEXTAREA"==t.tagName.toUpperCase()||"PASSWORD"==t.tagName.toUpperCase()?!0:!1
        }
    )