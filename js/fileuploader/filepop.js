/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Fileuploader
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
function playerOpen(soundfiledesc,soundfilepath) {
    var UniqueID = 100; // Make each link open in a new window
    var newWinOffset = 300; // Position of first pop-up
    PlayWin = window.open('',UniqueID,'width=320,height=160,top=' + newWinOffset +',left=500,resizable=1,scrollbars=1,titlebar=0,toolbar=0,menubar=0,status=0,directories=0,personalbar=0');
    PlayWin.focus();

    var winContent = "<HTML><HEAD><TITLE>" + soundfiledesc + "</TITLE><style>.form-button-alt{background-color:#618499; border:1px solid #406A83;color:#FFFFFF; cursor:pointer; font-family:arial,sans-serif !important; font-size:12px !important; font-size-adjust:none !important; font-stretch:normal !important; font-style:normal !important; font-variant:normal !important; font-weight:bold !important; line-height:normal !important; overflow:visible; padding:1px 8px; text-align:center; vertical-align:middle; width:auto;}</style></HEAD><BODY bgcolor='#FAF7EE'>";
    winContent += "<p style='font-weight: bold; font-size:15px; color:#E26703; font-family:Verdana,sans-serif; line-height:1.5; clear: both;'>" + soundfiledesc + "</p>";

    winContent += "<OBJECT width='300' height='42'>";
    winContent += "<param name='SRC' value='" + soundfilepath + "'>";
    winContent += "<param name='AUTOPLAY' VALUE='true'>";
    winContent += "<param name='CONTROLLER' VALUE='true'>";
    winContent += "<param name='BGCOLOR' VALUE='#faf7ee'>";
    winContent += "<EMBED SRC='" + soundfilepath + "' AUTOSTART='TRUE' LOOP='FALSE' WIDTH='300' HEIGHT='42' CONTROLLER='TRUE' BGCOLOR='#faf7ee'></EMBED>";
    winContent += "</OBJECT>";

    winContent += "<DIV align='center' style='margin-top: 3px; clear: both;'><button onclick='javascript:window.close();' class='form-button-alt' type='button'><span>Close</span></button></DIV>";
    winContent += "</BODY></HTML>";

    PlayWin.document.write(winContent);
    PlayWin.document.close(); // "Finalizes" new window
    UniqueID = UniqueID + 0 // set to "1" to make each link open in new window
    newWinOffset = newWinOffset + 0 // subsequent pop-ups will be this many pixels lower
}
function playerAviOpen(soundfiledesc,soundfilepath) {
    var UniqueID = 100; // Make each link open in a new window
    var newWinOffset = 300; // Position of first pop-up
    PlayWin = window.open('',UniqueID,'width=350,height=360,top=' + newWinOffset +',left=500,resizable=1,scrollbars=1,titlebar=0,toolbar=0,menubar=0,status=0,directories=0,personalbar=0');
    PlayWin.focus();

    var winContent = "<HTML><HEAD><TITLE>" + soundfiledesc + "</TITLE><style>.form-button-alt{background-color:#618499; border:1px solid #406A83;color:#FFFFFF; cursor:pointer; font-family:arial,sans-serif !important; font-size:12px !important; font-size-adjust:none !important; font-stretch:normal !important; font-style:normal !important; font-variant:normal !important; font-weight:bold !important; line-height:normal !important; overflow:visible; padding:1px 8px; text-align:center; vertical-align:middle; width:auto;}</style></HEAD><BODY bgcolor='#FAF7EE'>";
    winContent += "<p style='font-weight: bold; font-size:15px; color:#E26703; font-family:Verdana,sans-serif; line-height:1.5; clear: both;'>" + soundfiledesc + "</p>";

    winContent += "<object type='video/quicktime' data='"+soundfilepath+"' width='320' height='280'>";
    winContent += "<param name='pluginurl' value='http://www.apple.com/quicktime/download/' />";
    winContent += "<param name='controller' value='true' />";
    winContent += "<param name='autoplay' value='true' />";
    winContent += "<param name='BGCOLOR' VALUE='#faf7ee'>";
    winContent += "</object>";
    //winContentie += "<object classid='clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B' codebase='http://www.apple.com/qtactivex/qtplugin.cab' width='624' height='352'><param name='src' value='"+soundfilepath+"'/><param name='controller' value='false' /><param name='autoplay' value='true' /></object>";

    winContent += "<DIV align='center' style='margin-top: 3px; clear: both;'><button onclick='javascript:window.close();' class='form-button-alt' type='button'><span>Close</span></button></DIV>";
    winContent += "</BODY></HTML>";

    PlayWin.document.write(winContent);
    PlayWin.document.close(); // "Finalizes" new window
    UniqueID = UniqueID + 0 // set to "1" to make each link open in new window
    newWinOffset = newWinOffset + 0 // subsequent pop-ups will be this many pixels lower
}
function playerFlvOpen(soundfiledesc,soundfilepath,soundPlayerPath) {
    var UniqueID = 100; // Make each link open in a new window
    var newWinOffset = 300; // Position of first pop-up
    PlayWin = window.open('',UniqueID,'width=350,height=360,top=' + newWinOffset +',left=500,resizable=1,scrollbars=1,titlebar=0,toolbar=0,menubar=0,status=0,directories=0,personalbar=0');
    PlayWin.focus();

    var winContent = "<HTML><HEAD><TITLE>" + soundfiledesc + "</TITLE><style>.form-button-alt{background-color:#618499; border:1px solid #406A83;color:#FFFFFF; cursor:pointer; font-family:arial,sans-serif !important; font-size:12px !important; font-size-adjust:none !important; font-stretch:normal !important; font-style:normal !important; font-variant:normal !important; font-weight:bold !important; line-height:normal !important; overflow:visible; padding:1px 8px; text-align:center; vertical-align:middle; width:auto;}</style></HEAD><BODY bgcolor='#FAF7EE'>";
    winContent += "<p style='font-weight: bold; font-size:15px; color:#E26703; font-family:Verdana,sans-serif; line-height:1.5; clear: both;'>" + soundfiledesc + "</p>";

    winContent += '<embed width="320" height="280" flashvars="height=280&width=320&displayheight=280&file='+soundfilepath+'&image='+soundPlayerPath+'bg.jpg&backcolor=0x333333&frontcolor=0xaaaaaa&lightcolor=0xeeeeee&link='+soundfilepath+'&amp;showstop=true&volume=100&callback=analytics" allowfullscreen="true" allowscriptaccess="always" wmode="transparent" quality="high" name="player1" id="player1" src="'+soundPlayerPath+'player.swf" type="application/x-shockwave-flash"></embed>';

    winContent += "<DIV align='center' style='margin-top: 3px; clear: both;'><button onclick='javascript:window.close();' class='form-button-alt' type='button'><span>Close</span></button></DIV>";
    winContent += "</BODY></HTML>";

    PlayWin.document.write(winContent);
    PlayWin.document.close(); // "Finalizes" new window
    UniqueID = UniqueID + 0 // set to "1" to make each link open in new window
    newWinOffset = newWinOffset + 0 // subsequent pop-ups will be this many pixels lower
}
function playerMovOpen(soundfiledesc,soundfilepath) {
    var UniqueID = 100; // Make each link open in a new window
    var newWinOffset = 300; // Position of first pop-up
    PlayWin = window.open('',UniqueID,'width=320,height=360,top=' + newWinOffset +',left=500,resizable=1,scrollbars=1,titlebar=0,toolbar=0,menubar=0,status=0,directories=0,personalbar=0');
    PlayWin.focus();

    var winContent = "<HTML><HEAD><TITLE>" + soundfiledesc + "</TITLE><style>.form-button-alt{background-color:#618499; border:1px solid #406A83;color:#FFFFFF; cursor:pointer; font-family:arial,sans-serif !important; font-size:12px !important; font-size-adjust:none !important; font-stretch:normal !important; font-style:normal !important; font-variant:normal !important; font-weight:bold !important; line-height:normal !important; overflow:visible; padding:1px 8px; text-align:center; vertical-align:middle; width:auto;}</style></HEAD><BODY bgcolor='#FAF7EE'>";
    winContent += "<p style='font-weight: bold; font-size:15px; color:#E26703; font-family:Verdana,sans-serif; line-height:1.5; clear: both;'>" + soundfiledesc + "</p>";

    winContent += "<OBJECT width='320' height='280'>";
    winContent += "<param name='SRC' value='" + soundfilepath + "'>";
    winContent += "<param name='AUTOPLAY' VALUE='true'>";
    winContent += "<param name='CONTROLLER' VALUE='true'>";
    winContent += "<param name='BGCOLOR' VALUE='#faf7ee'>";
    winContent += "<EMBED SRC='" + soundfilepath + "' AUTOSTART='TRUE' LOOP='FALSE' WIDTH='300' HEIGHT='280' CONTROLLER='TRUE' BGCOLOR='#faf7ee'></EMBED>";
    winContent += "</OBJECT>";

    winContent += "<DIV align='center' style='margin-top: 3px; clear: both;'><button onclick='javascript:window.close();' class='form-button-alt' type='button'><span>Close</span></button></DIV>";
    winContent += "</BODY></HTML>";

    PlayWin.document.write(winContent);
    PlayWin.document.close(); // "Finalizes" new window
    UniqueID = UniqueID + 0 // set to "1" to make each link open in new window
    newWinOffset = newWinOffset + 0 // subsequent pop-ups will be this many pixels lower
}

function fileUploaderPopup1(options){
    this.options = {
        title: '_blank',
        url: '#',
        width: 600,
        height: 500
    }
    Object.extend(this.options, options || {});
    window.open(this.options.url, this.options.title, 'width='+this.options.width+',height='+this.options.height);
}


var fileUploaderPopup = {
    open: function(options)
    {
        this.options = {
            url: '#',
            width: 600,
            height: 500,
            name:"_blank",
            location:"no",
            menubar:"no",
            toolbar:"no",
            status:"yes",
            scrollbars:"yes",
            resizable:"yes",
            left:"",
            top:"",
            normal:false
        }
        Object.extend(this.options, options || {});

        if (this.options.normal){
            this.options.menubar = "yes";
            this.options.status = "yes";
            this.options.toolbar = "yes";
            this.options.location = "yes";
        }

        this.options.width = this.options.width < screen.availWidth?this.options.width:screen.availWidth;
        this.options.height=this.options.height < screen.availHeight?this.options.height:screen.availHeight;
        var openoptions = 'width='+this.options.width+',height='+this.options.height+',location='+this.options.location+',menubar='+this.options.menubar+',toolbar='+this.options.toolbar+',scrollbars='+this.options.scrollbars+',resizable='+this.options.resizable+',status='+this.options.status
        if (this.options.top!="")openoptions+=",top="+this.options.top;
        if (this.options.left!="")openoptions+=",left="+this.options.left;
        window.open(this.options.url, this.options.name,openoptions );
        return false;
    }
}