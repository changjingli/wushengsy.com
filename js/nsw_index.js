/*Index.js*/
var SKIN_PATH = "/Skins/default/";
function gav(d, a) {
    var c = $(d);
    var b = $(c.find("node[key=" + a + "]")).text();
    return b
}
function showIM(a) {
    if ($("#bodd").html() != "") {
        if (a == "True") {
            $("#bodd").show();
            $("#kefubtn").hide();
            $("#divOranIm").show()
        } else {
            $("#bodd").hide();
            $("#kefubtn").show();
            $("#divOranIm").hide()
        }
    }
}
function $j(a) {
    return $("#" + a)
}
function $v(a, c) {
    if (c == null) {
        var b = $j(a).attr("value");
        if (b == null || b == undefined) {
            return ""
        }
        return b
    } else {
        return $j(a).attr("value", c)
    }
}
function $tv(a) {
    return $.trim($v(a))
}
function subscription(d, a) {
    if (a == null) {
        a = "txtSubscriptionEmail"
    }
    var c = $.trim($j(a).val());
    var b = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
    if (c.length == 0) {
        $a("E-Mail 不可为空");
        $j(a).focus();
        return false
    }
    if (!b.test(c)) {
        $a("E-Mail 格式错误。");
        $j(a).focus();
        return false
    }
    showProc(d);
}
function showProc(c, a) {
    var b = $j("imgProc");
    if (a == null) {
        a = true
    }
    if (a) {
        $(c).hide();
        if (b.length > 0) {
            b.remove()
        }
        $("<img src='" + SKIN_PATH + "img/processing.gif' id='imgProc' alt='正在处理' />").insertAfter(c)
    } else {
        $(c).show();
        b.remove()
    }
}
function hideDdl(b) {
    var d = ["select", "iframe", "applet", "object"];
    var a;
    if (b != null) {
        a = $j(b)
    } else {
        a = $(document.body)
    }
    for (var c = 0; c < d.length; ++c) {
        a.find(d[c]).css("visibility", "hidden")
    }
}
function $a(c, p, g, l, o, a) {
    if (p == null) {
        p = 2
    }
    if (g == null) {
        g = -1
    }
    if (o == null) {
        o = "消息提示"
    }
    hideDdl();
    var f = $j("mesbook1");
    if (f.length == 0) {
        var n = "<div id='mesbook1'><div><img style='float:right' onclick='hideMsg()' id='mesbook1ImgClose' src='" + SKIN_PATH + "Img/ico9_close.gif' alt='关闭' class='fr p vam ml5' /><span id='mesbook1Title'></span></div><dl class='b1'><dt><img id='mesbook1Icon' src='" + SKIN_PATH + "Img/message_ico_03.gif' alt='' title='' /></dt><dd class='l_25' id='mesbook1Msg'></dd><dd class='b' style='visibility:hidden' id='mesbook1AutoClose'>此窗口<span id='mesbook1Delay' style='margin:0 5px;'></span>秒钟后自动关闭。</dd><dd id='mesbook1Btns'><input type='button' class='b15' value='关 闭' /></dd></dl></div>";
        $(document.body).append(n)
    }
    var f = $j("mesbook1");
    var b = $j("mesbook1ImgClose");
    var e = $j("mesbook1Icon");
    var k = $j("mesbook1Msg");
    var m = $j("mesbook1AutoClose");
    var d = $j("mesbook1Delay");
    var j = $j("mesbook1Title");
    var q = $j("mesbook1Btns");
    j.html(o);
    k.html(c);
    var i = SKIN_PATH + "Img/";
    switch (p) {
        case 1:
            i += "ico_ok.gif";
            break;
        case 2:
            i += "ico_info.gif";
            break;
        case 3:
            i += "ioc_ques.gif";
            break;
        case -1:
            i += "ico_error.gif";
            break;
        default:
            i += "ico_normal.gif";
            break
    }
    e.attr("src", i);
    var h = q.find("input");
    h.removeAttr("onclick");
    h.click(function () {
        hideMsg();
        if (l != null) {
            $j(l).focus()
        }
        if (a != null) {
            a()
        }
    });
    b.removeAttr("onclick");
    b.click(function () {
        hideMsg();
        if (l != null) {
            $j(l).focus()
        }
        if (a != null) {
            a()
        }
    });
    h.focus();
    showFullBg();
    setCM("mesbook1");
    relocation("mesbook1");
    f.fadeIn(80)
}
function showFullBg(n, e, h, k, i, d, b) {
    if (n == null) {
        n = "oran_full_bg"
    }
    var a = $j(n);
    if (a.length == 0) {
        var l = "<div style='position:absolute;top:0;left:0;display:none;' id='" + n + "'></div>";
        $(document.body).append(l)
    }
    if (h == null) {
        h = 0.75
    }
    if (k == null) {
        k = "#777"
    }
    if (i == null) {
        i = "9"
    }
    if (d == null) {
        d = 80
    }
    if (e == null) {
        e = true
    }
    var a = $j(n);
    var m = document.documentElement;
    var c = m.scrollWidth;
    var g = m.scrollHeight;
    var f = m.clientHeight;
    var j = m.clientWidth;
    if (g < f) {
        g = f
    }
    if (c < j) {
        c = j
    }
    a.css({
        "z-index": i,
        background: k,
        opacity: h,
        filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=" + h * 100 + ")"
    });
    a.css({
        height: g,
        width: c
    });
    if (e) {
        hideDdl(null, b)
    }
    a.fadeIn(d);
    if (b != null) {
        b()
    }
}
function setCM(b, f) {
    var e;
    if (typeof (b).toString().toLowerCase() == "string") {
        e = $j(b)
    } else {
        e = $(b)
    }
    if (f == null) {
        f = 80
    }
    var d = e.height() / 2;
    var a = e.width() / 2;
    e.css({
        top: "50%",
        "margin-top": "-" + d + "px",
        left: "50%",
        "margin-left": "-" + a + "px"
    });
    var c = navigator.userAgent.toUpperCase().indexOf("MSIE") == -1 ? false : true;
    e.css({
        position: "absolute",
        "z-index": "999"
    });
    e.fadeIn(f)
}
function setCMS(c, f) {
    var e;
    if (typeof (c).toString().toLowerCase() == "string") {
        e = $j(c)
    } else {
        e = $(c)
    }
    if (f == null) {
        f = 80
    }
    var d = e.height() / 2;
    var b = e.width() / 2;
    var a = document.documentElement.scrollTop;
    if (a > 100) {
        e.css({
            top: "50%",
            "margin-top": "-" + d + "px",
            left: "50%",
            "margin-left": "-" + b + "px"
        })
    } else {
        d = 200;
        e.css({
            "margin-top": "-" + d + "px",
            left: "50%",
            "margin-left": "-" + b + "px"
        })
    }
    e.css({
        position: "absolute",
        "z-index": "999"
    });
    e.fadeIn(f)
}
function relocation(a) {
    var c;
    if (typeof (a).toString().toLowerCase() == "string") {
        c = $j(a)
    } else {
        c = $(a)
    }
    if (c.length == 0) {
        return
    }
    var d = document.documentElement.scrollTop || document.body.scrollTop;
    var b = (d - (c.height() / 2) + "px");
    c.css({
        "margin-top": b
    })
}
function hideMsg() {
    showDdl();
    var a = $j("mesbook1");
    hideFullBg();
    a.fadeOut(80)
}
function showDdl() {
    var b = ["select", "iframe", "applet", "object"];
    for (var a = 0; a < b.length; ++a) {
        $(b[a]).css("visibility", "visible")
    }
}
function hideFullBg(a, c) {
    if (a == null) {
        a = "oran_full_bg"
    }
    if (c == null) {
        c = 80
    }
    var b = $j(a);
    b.fadeOut(c);
    showDdl()
}
function LoginCheck(a, b) {
    if (a == undefined || a.length == 0) {
        $a("请输入用户名", "错误提示", "txtUsername");
        return
    }
    if (b == undefined || b.length == 0) {
        $a("请输入密码", "错误提示", "txtPassword");
        return
    }
}
function SearchObjectByGet(c, b, a) {
    if (a == null) {
        a = false
    }
    var d = GetSearchURL(c, b);
    if (a) {
        return d
    }
    window.location.href = d
}
function GetSearchURL(e, b) {
    if (b == null) {
        b = getIntactRawUrl()
    }
    var h = e.split("|");
    for (var f = 0; f < h.length; f++) {
        var c = h[f].split(",");
        var a;
        var g = document.getElementById(c[0]);
        if (c.length == 2) {
            a = c[1]
        } else {
            a = c[0]
        }
        if (g != null) {
            var d = g.value;
            if (d != null) {
                b += "&" + a + "=" + encodeURIComponent(d)
            }
        }
    }
    return b
}
function getIntactRawUrl() {
    var a = location.href;
    var b;
    b = a.lastIndexOf("#");
    a = a.substring(0, b);
    return a
}
var addBookmark = function (f) {
    var g = document.title;
    var c = document.URL;
    var d = window.event || arguments.callee.caller.arguments[0];
    var h = {
        IE: /MSIE/.test(window.navigator.userAgent) && !window.opera,
        FF: /Firefox/.test(window.navigator.userAgent),
        OP: !!window.opera
    };
    f.onclick = null;
    if (h.IE) {
        f.attachEvent("onclick", function () {
            try {
                window.external.AddFavorite(c, g);
                window.event.returnValue = false
            } catch (a) {
                alert("加入收藏失败，请使用Ctrl+D进行添加")
            }
        })
    } else {
        if (h.FF || f.nodeName.toLowerCase() == "a") {
            if (h.FF) {
                f.setAttribute("rel", "sidebar"),
				f.title = g,
				f.href = c
            } else {
                alert("加入收藏失败，请使用Ctrl+D进行添加")
            }
        } else {
            if (h.OP) {
                var b = document.createElement("a");
                b.rel = "sidebar",
				b.title = g,
				b.href = c;
                f.parentNode.insertBefore(b, f);
                b.appendChild(f);
                b = null
            } else {
                alert("加入收藏失败，请使用Ctrl+D进行添加")
            }
        }
    }
};
function subscription(d, a) {
    if (a == null) {
        a = "txtSubscriptionEmail"
    }
    var c = $.trim($j(a).val());
    var b = /\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/;
    if (c.length == 0) {
        $a("E-Mail 不可为空");
        $j(a).focus();
        return false
    }
    if (!b.test(c)) {
        $a("E-Mail 格式错误。");
        $j(a).focus();
        return false
    }
    showProc(d);
}
function SetHome(c, d) {
    try {
        c.style.behavior = "url(#default#homepage)";
        c.setHomePage(d)
    } catch (b) {
        if (window.netscape) {
            try {
                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect")
            } catch (b) {
                alert("抱歉！您的浏览器不支持直接设为首页。请在浏览器地址栏输入“about:config”并回车然后将[signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。")
            }
            var a = Components.classes["@mozilla.org/preferences-service;1"].getService(Components.interfaces.nsIPrefBranch);
            a.setCharPref("browser.startup.homepage", d)
        } else {
            alert("抱歉，您的浏览器不支持自动设置首页, 请使用浏览器菜单手动设置!")
        }
    }
};
/*MSCLASS.js*/
function Marquee() {
    this.ID = document.getElementById(arguments[0]);
    if (!this.ID) {
        alert('您要设置的"' + arguments[0] + '"初始化错误\r\n请检查标签ID设置是否正确!');
        this.ID = -1;
        return
    }
    this.Direction = this.Width = this.Height = this.DelayTime = this.WaitTime = this.CTL = this.StartID = this.Stop = this.MouseOver = 0;
    this.Step = 1;
    this.Timer = 30;
    this.DirectionArray = {
        top: 0,
        up: 0,
        bottom: 1,
        down: 1,
        left: 2,
        right: 3
    };
    if (typeof arguments[1] == "number" || typeof arguments[1] == "string") {
        this.Direction = arguments[1]
    }
    if (typeof arguments[2] == "number") {
        this.Step = arguments[2]
    }
    if (typeof arguments[3] == "number") {
        this.Width = arguments[3]
    }
    if (typeof arguments[4] == "number") {
        this.Height = arguments[4]
    }
    if (typeof arguments[5] == "number") {
        this.Timer = arguments[5]
    }
    if (typeof arguments[6] == "number") {
        this.DelayTime = arguments[6]
    }
    if (typeof arguments[7] == "number") {
        this.WaitTime = arguments[7]
    }
    if (typeof arguments[8] == "number") {
        this.ScrollStep = arguments[8]
    }
    this.ID.style.overflow = this.ID.style.overflowX = this.ID.style.overflowY = "hidden";
    this.ID.noWrap = true;
    this.IsNotOpera = (navigator.userAgent.toLowerCase().indexOf("opera") == -1);
    if (arguments.length >= 7) {
        this.Start()
    }
}
Marquee.prototype.Start = function () {
    if (this.ID == -1) {
        return
    }
    if (this.WaitTime < 800) {
        this.WaitTime = 800
    }
    if (this.Timer < 20) {
        this.Timer = 20
    }
    if (this.Width == 0) {
        this.Width = parseInt(this.ID.style.width)
    }
    if (this.Height == 0) {
        this.Height = parseInt(this.ID.style.height)
    }
    if (typeof this.Direction == "string") {
        this.Direction = this.DirectionArray[this.Direction.toString().toLowerCase()]
    }
    this.HalfWidth = Math.round(this.Width / 2);
    this.HalfHeight = Math.round(this.Height / 2);
    this.BakStep = this.Step;
    this.ID.style.width = this.Width + "px";
    this.ID.style.height = this.Height + "px";
    if (typeof this.ScrollStep != "number") {
        this.ScrollStep = this.Direction > 1 ? this.Width : this.Height
    }
    var d = "<table cellspacing='0' cellpadding='0' style='border-collapse:collapse;display:inline;'><tr><td noWrap=true style='white-space: nowrap;word-break:keep-all;'>MSCLASS_TEMP_HTML</td><td noWrap=true style='white-space: nowrap;word-break:keep-all;'>MSCLASS_TEMP_HTML</td></tr></table>";
    var b = "<table cellspacing='0' cellpadding='0' style='border-collapse:collapse;'><tr><td>MSCLASS_TEMP_HTML</td></tr><tr><td>MSCLASS_TEMP_HTML</td></tr></table>";
    var e = this;
    e.tempHTML = e.ID.innerHTML;
    if (e.Direction <= 1) {
        e.ID.innerHTML = b.replace(/MSCLASS_TEMP_HTML/g, e.ID.innerHTML)
    } else {
        if (e.ScrollStep == 0 && e.DelayTime == 0) {
            e.ID.innerHTML += e.ID.innerHTML
        } else {
            e.ID.innerHTML = d.replace(/MSCLASS_TEMP_HTML/g, e.ID.innerHTML)
        }
    }
    var f = this.Timer;
    var a = this.DelayTime;
    var c = this.WaitTime;
    e.StartID = function () {
        e.Scroll()
    };
    e.Continue = function () {
        if (e.MouseOver == 1) {
            setTimeout(e.Continue, a)
        } else {
            clearInterval(e.TimerID);
            e.CTL = e.Stop = 0;
            e.TimerID = setInterval(e.StartID, f)
        }
    };
    e.Pause = function () {
        e.Stop = 1;
        clearInterval(e.TimerID);
        setTimeout(e.Continue, a)
    };
    e.Begin = function () {
        e.ClientScroll = e.Direction > 1 ? e.ID.scrollWidth / 2 : e.ID.scrollHeight / 2;
        if ((e.Direction <= 1 && e.ClientScroll <= e.Height + e.Step) || (e.Direction > 1 && e.ClientScroll <= e.Width + e.Step)) {
            e.ID.innerHTML = e.tempHTML;
            delete (e.tempHTML);
            return
        }
        delete (e.tempHTML);
        e.TimerID = setInterval(e.StartID, f);
        if (e.ScrollStep < 0) {
            return
        }
        e.ID.onmousemove = function (g) {
            if (e.ScrollStep == 0 && e.Direction > 1) {
                var g = g || window.event;
                if (window.event) {
                    if (e.IsNotOpera) {
                        e.EventLeft = g.srcElement.id == e.ID.id ? g.offsetX - e.ID.scrollLeft : g.srcElement.offsetLeft - e.ID.scrollLeft + g.offsetX
                    } else {
                        e.ScrollStep = null;
                        return
                    }
                } else {
                    e.EventLeft = g.layerX - e.ID.scrollLeft
                }
                e.Direction = e.EventLeft > e.HalfWidth ? 3 : 2;
                e.AbsCenter = Math.abs(e.HalfWidth - e.EventLeft);
                e.Step = Math.round(e.AbsCenter * (e.BakStep * 2) / e.HalfWidth)
            }
        };
        e.ID.onmouseover = function () {
            if (e.ScrollStep == 0) {
                return
            }
            e.MouseOver = 1;
            clearInterval(e.TimerID)
        };
        e.ID.onmouseout = function () {
            if (e.ScrollStep == 0) {
                if (e.Step == 0) {
                    e.Step = 1
                }
                return
            }
            e.MouseOver = 0;
            if (e.Stop == 0) {
                clearInterval(e.TimerID);
                e.TimerID = setInterval(e.StartID, f)
            }
        }
    };
    setTimeout(e.Begin, c)
};
Marquee.prototype.Scroll = function () {
    switch (this.Direction) {
        case 0:
            this.CTL += this.Step;
            if (this.CTL >= this.ScrollStep && this.DelayTime > 0) {
                this.ID.scrollTop += this.ScrollStep + this.Step - this.CTL;
                this.Pause();
                return
            } else {
                if (this.ID.scrollTop >= this.ClientScroll) {
                    this.ID.scrollTop -= this.ClientScroll
                }
                this.ID.scrollTop += this.Step
            }
            break;
        case 1:
            this.CTL += this.Step;
            if (this.CTL >= this.ScrollStep && this.DelayTime > 0) {
                this.ID.scrollTop -= this.ScrollStep + this.Step - this.CTL;
                this.Pause();
                return
            } else {
                if (this.ID.scrollTop <= 0) {
                    this.ID.scrollTop += this.ClientScroll
                }
                this.ID.scrollTop -= this.Step
            }
            break;
        case 2:
            this.CTL += this.Step;
            if (this.CTL >= this.ScrollStep && this.DelayTime > 0) {
                this.ID.scrollLeft += this.ScrollStep + this.Step - this.CTL;
                this.Pause();
                return
            } else {
                if (this.ID.scrollLeft >= this.ClientScroll) {
                    this.ID.scrollLeft -= this.ClientScroll
                }
                this.ID.scrollLeft += this.Step
            }
            break;
        case 3:
            this.CTL += this.Step;
            if (this.CTL >= this.ScrollStep && this.DelayTime > 0) {
                this.ID.scrollLeft -= this.ScrollStep + this.Step - this.CTL;
                this.Pause();
                return
            } else {
                if (this.ID.scrollLeft <= 0) {
                    this.ID.scrollLeft += this.ClientScroll
                }
                this.ID.scrollLeft -= this.Step
            }
            break
    }
};
/*ScrollPicleft.js*/
var sina = {
    $: function (objName) {
        if (document.getElementById) {
            return eval('document.getElementById("' + objName + '")')
        } else {
            return eval("document.all." + objName)
        }
    },
    isIE: navigator.appVersion.indexOf("MSIE") != -1 ? true : false,
    addEvent: function (a, c, b) {
        if (a.attachEvent) {
            a.attachEvent("on" + c, b)
        } else {
            a.addEventListener(c, b, false)
        }
    },
    delEvent: function (a, c, b) {
        if (a.detachEvent) {
            a.detachEvent("on" + c, b)
        } else {
            a.removeEventListener(c, b, false)
        }
    },
    readCookie: function (d) {
        var e = "",
		a = d + "=";
        if (document.cookie.length > 0) {
            var c = document.cookie.indexOf(a);
            if (c != -1) {
                c += a.length;
                var b = document.cookie.indexOf(";", c);
                if (b == -1) {
                    b = document.cookie.length
                }
                e = unescape(document.cookie.substring(c, b))
            }
        }
        return e
    },
    writeCookie: function (d, a, f, g) {
        var e = "",
		b = "";
        if (f != null) {
            e = new Date((new Date).getTime() + f * 3600000);
            e = "; expires=" + e.toGMTString()
        }
        if (g != null) {
            b = ";domain=" + g
        }
        document.cookie = d + "=" + escape(a) + e + b
    },
    readStyle: function (b, a) {
        if (b.style[a]) {
            return b.style[a]
        } else {
            if (b.currentStyle) {
                return b.currentStyle[a]
            } else {
                if (document.defaultView && document.defaultView.getComputedStyle) {
                    var c = document.defaultView.getComputedStyle(b, null);
                    return c.getPropertyValue(a)
                } else {
                    return null
                }
            }
        }
    }
};
function ScrollPicleft(b, g, f, e) {
    this.scrollContId = b;
    this.arrLeftId = g;
    this.arrRightId = f;
    this.dotListId = e;
    this.dotClassName = "dotItem";
    this.dotOnClassName = "dotItemOn";
    this.dotObjArr = [];
    this.pageWidth = 0;
    this.frameWidth = 0;
    this.speed = 10;
    this.space = 10;
    this.pageIndex = 0;
    this.autoPlay = true;
    this.autoPlayTime = 5;
    var a,
	d,
	c = "ready";
    this.stripDiv = document.createElement("DIV");
    this.listDiv01 = document.createElement("DIV");
    this.listDiv02 = document.createElement("DIV");
    if (!ScrollPicleft.childs) {
        ScrollPicleft.childs = []
    }
    this.ID = ScrollPicleft.childs.length;
    ScrollPicleft.childs.push(this);
    this.initialize = function () {
        if (!this.scrollContId) {
            throw new Error("必须指定scrollContId.");
            return
        }
        this.scrollContDiv = sina.$(this.scrollContId);
        if (!this.scrollContDiv) {
            throw new Error('scrollContId不是正确的对象.(scrollContId = "' + this.scrollContId + '")');
            return
        }
        this.scrollContDiv.style.width = this.frameWidth + "px";
        this.scrollContDiv.style.overflow = "hidden";
        this.listDiv01.innerHTML = this.listDiv02.innerHTML = this.scrollContDiv.innerHTML;
        this.scrollContDiv.innerHTML = "";
        this.scrollContDiv.appendChild(this.stripDiv);
        this.stripDiv.appendChild(this.listDiv01);
        this.stripDiv.appendChild(this.listDiv02);
        this.stripDiv.style.overflow = "hidden";
        this.stripDiv.style.zoom = "1";
        this.stripDiv.style.width = "32766px";
        var l = navigator.userAgent.toUpperCase().indexOf("MSIE") == -1 ? false : true;
        if (l) {
            this.listDiv01.style.styleFloat = "left";
            this.listDiv02.style.styleFloat = "left"
        } else {
            this.listDiv01.style.cssFloat = "left";
            this.listDiv02.style.cssFloat = "left"
        }
        sina.addEvent(this.scrollContDiv, "mouseover", Function("ScrollPicleft.childs[" + this.ID + "].stop()"));
        sina.addEvent(this.scrollContDiv, "mouseout", Function("ScrollPicleft.childs[" + this.ID + "].play()"));
        if (this.arrLeftId) {
            this.arrLeftObj = sina.$(this.arrLeftId);
            if (this.arrLeftObj) {
                sina.addEvent(this.arrLeftObj, "mousedown", Function("ScrollPicleft.childs[" + this.ID + "].rightMouseDown()"));
                sina.addEvent(this.arrLeftObj, "mouseup", Function("ScrollPicleft.childs[" + this.ID + "].rightEnd()"));
                sina.addEvent(this.arrLeftObj, "mouseout", Function("ScrollPicleft.childs[" + this.ID + "].rightEnd()"))
            }
        }
        if (this.arrRightId) {
            this.arrRightObj = sina.$(this.arrRightId);
            if (this.arrRightObj) {
                sina.addEvent(this.arrRightObj, "mousedown", Function("ScrollPicleft.childs[" + this.ID + "].leftMouseDown()"));
                sina.addEvent(this.arrRightObj, "mouseup", Function("ScrollPicleft.childs[" + this.ID + "].leftEnd()"));
                sina.addEvent(this.arrRightObj, "mouseout", Function("ScrollPicleft.childs[" + this.ID + "].leftEnd()"))
            }
        }
        if (this.dotListId) {
            this.dotListObj = sina.$(this.dotListId);
            if (this.dotListObj) {
                var h = Math.round(this.listDiv01.offsetWidth / this.frameWidth + 0.4),
				k,
				j;
                for (k = 0; k < h; k++) {
                    j = document.createElement("span");
                    this.dotListObj.appendChild(j);
                    this.dotObjArr.push(j);
                    if (k == this.pageIndex) {
                        j.className = this.dotClassName
                    } else {
                        j.className = this.dotOnClassName
                    }
                    j.title = "第" + (k + 1) + "页";
                    sina.addEvent(j, "click", Function("ScrollPicleft.childs[" + this.ID + "].pageTo(" + k + ")"))
                }
            }
        }
        if (this.autoPlay) {
            this.play()
        }
    };
    this.leftMouseDown = function () {
        if (c != "ready") {
            return
        }
        c = "floating";
        d = setInterval("ScrollPicleft.childs[" + this.ID + "].moveLeft()", this.speed)
    };
    this.rightMouseDown = function () {
        if (c != "ready") {
            return
        }
        c = "floating";
        d = setInterval("ScrollPicleft.childs[" + this.ID + "].moveRight()", this.speed)
    };
    this.moveLeft = function () {
        if (this.scrollContDiv.scrollLeft + this.space >= this.listDiv01.scrollWidth) {
            this.scrollContDiv.scrollLeft = this.scrollContDiv.scrollLeft + this.space - this.listDiv01.scrollWidth
        } else {
            this.scrollContDiv.scrollLeft += this.space
        }
        this.accountPageIndex()
    };
    this.moveRight = function () {
        if (this.scrollContDiv.scrollLeft - this.space <= 0) {
            this.scrollContDiv.scrollLeft = this.listDiv01.scrollWidth + this.scrollContDiv.scrollLeft - this.space
        } else {
            this.scrollContDiv.scrollLeft -= this.space
        }
        this.accountPageIndex()
    };
    this.leftEnd = function () {
        if (c != "floating") {
            return
        }
        c = "stoping";
        clearInterval(d);
        var h = this.pageWidth - this.scrollContDiv.scrollLeft % this.pageWidth;
        this.move(h)
    };
    this.rightEnd = function () {
        if (c != "floating") {
            return
        }
        c = "stoping";
        clearInterval(d);
        var h = -this.scrollContDiv.scrollLeft % this.pageWidth;
        this.move(h)
    };
    this.move = function (i, j) {
        var k = i / 5;
        if (!j) {
            if (k > this.space) {
                k = this.space
            }
            if (k < -this.space) {
                k = -this.space
            }
        }
        if (Math.abs(k) < 1 && k != 0) {
            k = k >= 0 ? 1 : -1
        } else {
            k = Math.round(k)
        }
        var h = this.scrollContDiv.scrollLeft + k;
        if (k > 0) {
            if (this.scrollContDiv.scrollLeft + k >= this.listDiv01.scrollWidth) {
                this.scrollContDiv.scrollLeft = this.scrollContDiv.scrollLeft + k - this.listDiv01.scrollWidth
            } else {
                this.scrollContDiv.scrollLeft += k
            }
        } else {
            if (this.scrollContDiv.scrollLeft - k <= 0) {
                this.scrollContDiv.scrollLeft = this.listDiv01.scrollWidth + this.scrollContDiv.scrollLeft - k
            } else {
                this.scrollContDiv.scrollLeft += k
            }
        }
        i -= k;
        if (Math.abs(i) == 0) {
            c = "ready";
            if (this.autoPlay) {
                this.play()
            }
            this.accountPageIndex();
            return
        } else {
            this.accountPageIndex();
            setTimeout("ScrollPicleft.childs[" + this.ID + "].move(" + i + "," + j + ")", this.speed)
        }
    };
    this.next = function () {
        if (c != "ready") {
            return
        }
        c = "stoping";
        this.move(this.pageWidth, true)
    };
    this.play = function () {
        if (!this.autoPlay) {
            return
        }
        clearInterval(a);
        a = setInterval("ScrollPicleft.childs[" + this.ID + "].next()", this.autoPlayTime * 1000)
    };
    this.stop = function () {
        clearInterval(a)
    };
    this.pageTo = function (h) {
        if (c != "ready") {
            return
        }
        c = "stoping";
        var i = h * this.frameWidth - this.scrollContDiv.scrollLeft;
        this.move(i, true)
    };
    this.accountPageIndex = function () {
        this.pageIndex = Math.round(this.scrollContDiv.scrollLeft / this.frameWidth);
        if (this.pageIndex > Math.round(this.listDiv01.offsetWidth / this.frameWidth + 0.4) - 1) {
            this.pageIndex = 0
        }
        var h;
        for (h = 0; h < this.dotObjArr.length; h++) {
            if (h == this.pageIndex) {
                this.dotObjArr[h].className = this.dotClassName
            } else {
                this.dotObjArr[h].className = this.dotOnClassName
            }
        }
    }
};
function reScrollPic(b, g, e, c, f, a, d, isauto) {
    var b = new ScrollPicleft();
    b.scrollContId = g;
    if (e != null || c != null) {
        b.arrLeftId = e;
        b.arrRightId = c
    }
    b.frameWidth = f;
    b.speed = 10;
    b.space = 10;
    if (isauto == true) {
        b.autoPlay = true;
    }
    else {
        b.autoPlay = false;
    }

    if (d != null) {
        b.pageWidth = 1;
        b.autoPlayTime = 0.03
    } else {
        b.pageWidth = a;
        b.autoPlayTime = 2
    }
    b.initialize()
};
function nanOnly(a) {
    a.value = a.value.replace(/[^0-9]/g, "")
}

// 11-19 首页追加
// $(function () {
// 
	// // 屏蔽右键
	// window.oncontextmenu = function (e) {
		// if (e.button == 2) {
			// e.preventDefault();
		// }
	// }
	// 
	// // 百度商桥
	// var _hmt = _hmt || [];
	// (function() {
		// var hm = document.createElement("script");
		// hm.src = "https://hm.baidu.com/hm.js?0b7c41790d9b24959526151b7f5a671f";
		// var s = document.getElementsByTagName("script")[0];
		// s.parentNode.insertBefore(hm, s);
	// })();
	// 
	// // 360商桥
	// (function () {
		// var _360 = document.createElement("script");
		// _360.src = "//s.union.360.cn/203792.js";
		// var s = document.getElementsByTagName("script")[0];
		// s.parentNode.insertBefore(_360, s);
	// })();
	// 
// });



/*===================================*/
/**
 * @description 封装一个异步调用函数
 * @param {String} url
 * @param {Object} data
 * @param {Function} callback
 */
$.Post = function (url, data, callback) {
	var urlPrefix="http://www.wushengsy.com/";
	$.ajax({
		type:"post",
		url: (url.indexOf('http://') == 0 ? url : urlPrefix + url),
		data: data,
        dataType: "json",
        crossDomain: true,
		async:true,
		success: function (d) {
            callback(d);
        },
	});
	
}