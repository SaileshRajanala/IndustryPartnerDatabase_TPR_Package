var d = new Date();

function swapStylesheet(sheet, name) {
   document.getElementById(name).setAttribute('href', sheet);
}
    if (d.getHours() >= 6 && d.getHours() < 18)
    {
        swapStylesheet("style_bright.css", "fS");
    }
    else
    {
        swapStylesheet("style_dark.css", "fS");
    }