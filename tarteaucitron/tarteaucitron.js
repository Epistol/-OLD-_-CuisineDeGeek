var scripts=document.getElementsByTagName("script"),path=scripts[scripts.length-1].src.split("?")[0],cdn=path.split("/").slice(0,-1).join("/")+"/",alreadyLaunch=void 0===alreadyLaunch?0:alreadyLaunch,tarteaucitronForceLanguage=void 0===tarteaucitronForceLanguage?"":tarteaucitronForceLanguage,tarteaucitronProLoadServices,tarteaucitronNoAdBlocker=!1,tarteaucitron={version:323,cdn:cdn,user:{},lang:{},services:{},added:[],idprocessed:[],state:[],launch:[],parameters:{},isAjax:!1,reloadThePage:!1,init:function(t){"use strict";var e;tarteaucitron.parameters=t,0===alreadyLaunch&&(alreadyLaunch=1,window.addEventListener?(window.addEventListener("load",function(){tarteaucitron.load(),tarteaucitron.fallback(["tarteaucitronOpenPanel"],function(t){t.addEventListener("click",function(){tarteaucitron.userInterface.openPanel()},!1)},!0)},!1),window.addEventListener("scroll",function(){var t,e=window.pageYOffset||document.documentElement.scrollTop;null===document.getElementById("tarteaucitronAlertBig")||tarteaucitron.highPrivacy||"block"===document.getElementById("tarteaucitronAlertBig").style.display&&(t=document.getElementById("tarteaucitronAlertBig").offsetHeight+"px",e>2*screen.height?tarteaucitron.userInterface.respondAll(!0):e>screen.height/2&&(document.getElementById("tarteaucitronDisclaimerAlert").innerHTML="<b>"+tarteaucitron.lang.alertBigScroll+"</b> "+tarteaucitron.lang.alertBig),"top"===tarteaucitron.orientation?document.getElementById("tarteaucitronPercentage").style.top=t:document.getElementById("tarteaucitronPercentage").style.bottom=t,document.getElementById("tarteaucitronPercentage").style.width=100/(2*screen.height)*e+"%")},!1),window.addEventListener("keydown",function(t){27===t.keyCode&&tarteaucitron.userInterface.closePanel()},!1),window.addEventListener("hashchange",function(){document.location.hash===tarteaucitron.hashtag&&""!==tarteaucitron.hashtag&&tarteaucitron.userInterface.openPanel()},!1),window.addEventListener("resize",function(){null!==document.getElementById("tarteaucitron")&&"block"===document.getElementById("tarteaucitron").style.display&&tarteaucitron.userInterface.jsSizing("main"),null!==document.getElementById("tarteaucitronCookiesListContainer")&&"block"===document.getElementById("tarteaucitronCookiesListContainer").style.display&&tarteaucitron.userInterface.jsSizing("cookie")},!1)):(window.attachEvent("onload",function(){tarteaucitron.load(),tarteaucitron.fallback(["tarteaucitronOpenPanel"],function(t){t.attachEvent("onclick",function(){tarteaucitron.userInterface.openPanel()})},!0)}),window.attachEvent("onscroll",function(){var t,e=window.pageYOffset||document.documentElement.scrollTop;null===document.getElementById("tarteaucitronAlertBig")||tarteaucitron.highPrivacy||"block"===document.getElementById("tarteaucitronAlertBig").style.display&&(t=document.getElementById("tarteaucitronAlertBig").offsetHeight+"px",e>2*screen.height?tarteaucitron.userInterface.respondAll(!0):e>screen.height/2&&(document.getElementById("tarteaucitronDisclaimerAlert").innerHTML="<b>"+tarteaucitron.lang.alertBigScroll+"</b> "+tarteaucitron.lang.alertBig),"top"===tarteaucitron.orientation?document.getElementById("tarteaucitronPercentage").style.top=t:document.getElementById("tarteaucitronPercentage").style.bottom=t,document.getElementById("tarteaucitronPercentage").style.width=100/(2*screen.height)*e+"%")}),window.attachEvent("onkeydown",function(t){27===t.keyCode&&tarteaucitron.userInterface.closePanel()}),window.attachEvent("onhashchange",function(){document.location.hash===tarteaucitron.hashtag&&""!==tarteaucitron.hashtag&&tarteaucitron.userInterface.openPanel()}),window.attachEvent("onresize",function(){null!==document.getElementById("tarteaucitron")&&"block"===document.getElementById("tarteaucitron").style.display&&tarteaucitron.userInterface.jsSizing("main"),null!==document.getElementById("tarteaucitronCookiesListContainer")&&"block"===document.getElementById("tarteaucitronCookiesListContainer").style.display&&tarteaucitron.userInterface.jsSizing("cookie")})),"undefined"!=typeof XMLHttpRequest&&(e=XMLHttpRequest.prototype.open,XMLHttpRequest.prototype.open=function(){window.addEventListener?this.addEventListener("load",function(){"function"==typeof tarteaucitronProLoadServices&&tarteaucitronProLoadServices()},!1):"undefined"!=typeof this.attachEvent?this.attachEvent("onload",function(){"function"==typeof tarteaucitronProLoadServices&&tarteaucitronProLoadServices()}):"function"==typeof tarteaucitronProLoadServices&&setTimeout(tarteaucitronProLoadServices,1e3);try{e.apply(this,arguments)}catch(t){}}))},load:function(){"use strict";var t=tarteaucitron.cdn,e=tarteaucitron.getLanguage(),r=t+"lang/tarteaucitron."+e+".js?v="+tarteaucitron.version,a=t+"tarteaucitron.services.js?v="+tarteaucitron.version,n=document.createElement("link"),i={adblocker:!1,hashtag:"#tarteaucitron",highPrivacy:!1,orientation:"top",removeCredit:!1,showAlertSmall:!0,cookieslist:!0},o=tarteaucitron.parameters;void 0!==o&&tarteaucitron.extend(i,o),tarteaucitron.orientation=i.orientation,tarteaucitron.hashtag=i.hashtag,tarteaucitron.highPrivacy=i.highPrivacy,n.rel="stylesheet",n.type="text/css",n.href=t+"css/tarteaucitron.css?v="+tarteaucitron.version,document.getElementsByTagName("head")[0].appendChild(n),tarteaucitron.addScript(r,"",function(){tarteaucitron.addScript(a,"",function(){var t,e,r=document.body,a=document.createElement("div"),n="",o="Top",c=["ads","analytic","api","comment","social","support","video"];for(c=c.sort(function(t,e){return tarteaucitron.lang[t].title>tarteaucitron.lang[e].title?1:tarteaucitron.lang[t].title<tarteaucitron.lang[e].title?-1:0}),n+='<div id="tarteaucitronPremium"></div>',n+='<div id="tarteaucitronBack" onclick="tarteaucitron.userInterface.closePanel();"></div>',n+='<div id="tarteaucitron">',n+='   <div id="tarteaucitronClosePanel" onclick="tarteaucitron.userInterface.closePanel();">',n+="       "+tarteaucitron.lang.close,n+="   </div>",n+='   <div id="tarteaucitronServices">',n+='      <div class="tarteaucitronLine tarteaucitronMainLine" id="tarteaucitronMainLineOffset">',n+='         <div class="tarteaucitronName">',n+="            <b><a href=\"#\" onclick=\"tarteaucitron.userInterface.toggle('tarteaucitronInfo', 'tarteaucitronInfoBox');return false\">&#10011;</a> "+tarteaucitron.lang.all+"</b>",n+="         </div>",n+='         <div class="tarteaucitronAsk" id="tarteaucitronScrollbarAdjust">',n+='            <div id="tarteaucitronAllAllowed" class="tarteaucitronAllow" onclick="tarteaucitron.userInterface.respondAll(true);">',n+="               &#10003; "+tarteaucitron.lang.allow,n+="            </div> ",n+='            <div id="tarteaucitronAllDenied" class="tarteaucitronDeny" onclick="tarteaucitron.userInterface.respondAll(false);">',n+="               &#10007; "+tarteaucitron.lang.deny,n+="            </div>",n+="         </div>",n+="      </div>",n+='      <div id="tarteaucitronInfo" class="tarteaucitronInfoBox">',n+="         "+tarteaucitron.lang.disclaimer,i.removeCredit===!1&&(n+="        <br/><br/>",n+='        <a href="https://opt-out.ferank.eu/" rel="nofollow" target="_blank">'+tarteaucitron.lang.credit+"</a>"),n+="      </div>",n+='      <div class="tarteaucitronBorder" id="tarteaucitronScrollbarParent">',n+='         <div class="clear"></div>',e=0;e<c.length;e+=1)n+='         <div id="tarteaucitronServicesTitle_'+c[e]+'" class="tarteaucitronHidden">',n+='            <div class="tarteaucitronTitle">',n+='               <a href="#" onclick="tarteaucitron.userInterface.toggle(\'tarteaucitronDetails'+c[e]+"', 'tarteaucitronInfoBox');return false\">&#10011;</a> "+tarteaucitron.lang[c[e]].title,n+="            </div>",n+='            <div id="tarteaucitronDetails'+c[e]+'" class="tarteaucitronDetails tarteaucitronInfoBox">',n+="               "+tarteaucitron.lang[c[e]].details,n+="            </div>",n+="         </div>",n+='         <div id="tarteaucitronServices_'+c[e]+'"></div>';n+='         <div class="tarteaucitronHidden" id="tarteaucitronScrollbarChild" style="height:20px;display:block"></div>',n+="       </div>",n+="   </div>",n+="</div>","bottom"===i.orientation&&(o="Bottom"),i.highPrivacy?(n+='<div id="tarteaucitronAlertBig" class="tarteaucitronAlertBig'+o+'">',n+='   <span id="tarteaucitronDisclaimerAlert">',n+="       "+tarteaucitron.lang.alertBigPrivacy,n+="   </span>",n+='   <span id="tarteaucitronPersonalize" onclick="tarteaucitron.userInterface.openPanel();">',n+="       "+tarteaucitron.lang.personalize,n+="   </span>",n+="</div>"):(n+='<div id="tarteaucitronAlertBig" class="tarteaucitronAlertBig'+o+'">',n+='   <span id="tarteaucitronDisclaimerAlert">',n+="       "+tarteaucitron.lang.alertBigClick+" "+tarteaucitron.lang.alertBig,n+="   </span>",n+='   <span id="tarteaucitronPersonalize" onclick="tarteaucitron.userInterface.respondAll(true);">',n+='       <i class="material-icons">done</i> '+tarteaucitron.lang.acceptAll,n+="   </span>",n+='   <span id="tarteaucitronCloseAlert" onclick="tarteaucitron.userInterface.openPanel();">',n+="       "+tarteaucitron.lang.personalize,n+="   </span>",n+="</div>",n+='<div id="tarteaucitronPercentage"></div>'),i.showAlertSmall===!0&&(n+='<div id="tarteaucitronAlertSmall">',n+='   <div id="tarteaucitronManager" onclick="tarteaucitron.userInterface.openPanel();">',n+="       "+tarteaucitron.lang.alertSmall,n+='       <div id="tarteaucitronDot">',n+='           <span id="tarteaucitronDotGreen"></span>',n+='           <span id="tarteaucitronDotYellow"></span>',n+='           <span id="tarteaucitronDotRed"></span>',n+="       </div>",i.cookieslist===!0?(n+="   </div><!-- @whitespace",n+='   --><div id="tarteaucitronCookiesNumber" onclick="tarteaucitron.userInterface.toggleCookiesList();">0</div>',n+='   <div id="tarteaucitronCookiesListContainer">',n+='       <div id="tarteaucitronClosePanelCookie" onclick="tarteaucitron.userInterface.closePanel();">',n+="           "+tarteaucitron.lang.close,n+="       </div>",n+='       <div class="tarteaucitronCookiesListMain" id="tarteaucitronCookiesTitle">',n+='            <b id="tarteaucitronCookiesNumberBis">0 cookie</b>',n+="       </div>",n+='       <div id="tarteaucitronCookiesList"></div>',n+="    </div>"):n+="   </div>",n+="</div>"),tarteaucitron.addScript(tarteaucitron.cdn+"advertising.js?v="+tarteaucitron.version,"",function(){if(tarteaucitronNoAdBlocker===!0||i.adblocker===!1){if(a.id="tarteaucitronRoot",r.appendChild(a,r),a.innerHTML=n,void 0!==tarteaucitron.job)for(tarteaucitron.job=tarteaucitron.cleanArray(tarteaucitron.job),t=0;t<tarteaucitron.job.length;t+=1)tarteaucitron.addService(tarteaucitron.job[t]);tarteaucitron.isAjax=!0,tarteaucitron.job.push=function(t){"undefined"==typeof tarteaucitron.job.indexOf&&(tarteaucitron.job.indexOf=function(t,e){var r,a=this.length;for(r=e||0;a>r;r+=1)if(this[r]===t)return r;return-1}),-1===tarteaucitron.job.indexOf(t)&&Array.prototype.push.call(this,t),tarteaucitron.launch[t]=!1,tarteaucitron.addService(t)},document.location.hash===tarteaucitron.hashtag&&""!==tarteaucitron.hashtag&&tarteaucitron.userInterface.openPanel(),tarteaucitron.cookie.number(),setInterval(tarteaucitron.cookie.number,6e4)}},i.adblocker),i.adblocker===!0&&setTimeout(function(){tarteaucitronNoAdBlocker===!1?(n='<div id="tarteaucitronAlertBig" class="tarteaucitronAlertBig'+o+'" style="display:block">',n+='   <span id="tarteaucitronDisclaimerAlert">',n+="       "+tarteaucitron.lang.adblock+"<br/>",n+="       <b>"+tarteaucitron.lang.adblock_call+"</b>",n+="   </span>",n+='   <span id="tarteaucitronPersonalize" onclick="location.reload();">',n+="       "+tarteaucitron.lang.reload,n+="   </span>",n+="</div>",n+='<div id="tarteaucitronPremium"></div>',a.id="tarteaucitronRoot",r.appendChild(a,r),a.innerHTML=n,tarteaucitron.pro("!adblocker=true")):tarteaucitron.pro("!adblocker=false")},1500)})})},addService:function(t){"use strict";var e="",r=tarteaucitron.services,a=r[t],n=tarteaucitron.cookie.read(),i=document.location.hostname,o=document.referrer.split("/")[2],c=o===i?!0:!1,u=a.needConsent?!1:!0,s=n.indexOf(a.key+"=wait")>=0?!0:!1,l=n.indexOf(a.key+"=false")>=0?!0:!1,d=n.indexOf(a.key+"=true")>=0?!0:!1,g=n.indexOf(a.key+"=false")>=0||n.indexOf(a.key+"=true")>=0?!0:!1;tarteaucitron.added[a.key]!==!0&&(tarteaucitron.added[a.key]=!0,e+='<div id="'+a.key+'Line" class="tarteaucitronLine">',e+='   <div class="tarteaucitronName">',e+="       <b>"+a.name+"</b><br/>",e+='       <span id="tacCL'+a.key+'" class="tarteaucitronListCookies"></span><br/>',e+='       <a href="https://opt-out.ferank.eu/service/'+a.key+'/" target="_blank">',e+="           "+tarteaucitron.lang.more,e+="       </a>",e+="        - ",e+='       <a href="'+a.uri+'" target="_blank">',e+="           "+tarteaucitron.lang.source,e+="       </a>",e+="   </div>",e+='   <div class="tarteaucitronAsk">',e+='       <div id="'+a.key+'Allowed" class="tarteaucitronAllow" onclick="tarteaucitron.userInterface.respond(this, true);">',e+="           &#10003; "+tarteaucitron.lang.allow,e+="       </div> ",e+='       <div id="'+a.key+'Denied" class="tarteaucitronDeny" onclick="tarteaucitron.userInterface.respond(this, false);">',e+="           &#10007; "+tarteaucitron.lang.deny,e+="       </div>",e+="   </div>",e+="</div>",tarteaucitron.userInterface.css("tarteaucitronServicesTitle_"+a.type,"display","block"),null!==document.getElementById("tarteaucitronServices_"+a.type)&&(document.getElementById("tarteaucitronServices_"+a.type).innerHTML+=e),tarteaucitron.userInterface.order(a.type)),g===!1&&tarteaucitron.user.bypass===!0&&(d=!0,tarteaucitron.cookie.create(a.key,!0)),!g&&(u||c&&s)&&!tarteaucitron.highPrivacy||d?(d||tarteaucitron.cookie.create(a.key,!0),tarteaucitron.launch[a.key]!==!0&&(tarteaucitron.launch[a.key]=!0,a.js()),tarteaucitron.state[a.key]=!0,tarteaucitron.userInterface.color(a.key,!0)):l?("function"==typeof a.fallback&&a.fallback(),tarteaucitron.state[a.key]=!1,tarteaucitron.userInterface.color(a.key,!1)):g||(tarteaucitron.cookie.create(a.key,"wait"),"function"==typeof a.fallback&&a.fallback(),tarteaucitron.userInterface.color(a.key,"wait"),tarteaucitron.userInterface.openAlert()),tarteaucitron.cookie.checkCount(a.key)},cleanArray:function(t){"use strict";var e,r=t.length,a=[],n={},i=tarteaucitron.services;for(e=0;r>e;e+=1)n[t[e]]||(n[t[e]]={},void 0!==tarteaucitron.services[t[e]]&&a.push(t[e]));return a=a.sort(function(t,e){return i[t].type+i[t].key>i[e].type+i[e].key?1:i[t].type+i[t].key<i[e].type+i[e].key?-1:0})},userInterface:{css:function(t,e,r){"use strict";null!==document.getElementById(t)&&(document.getElementById(t).style[e]=r)},respondAll:function(t){"use strict";var e,r,a=tarteaucitron.services,n=0;for(n=0;n<tarteaucitron.job.length;n+=1)e=a[tarteaucitron.job[n]],r=e.key,tarteaucitron.state[r]!==t&&(t===!1&&tarteaucitron.launch[r]===!0&&(tarteaucitron.reloadThePage=!0),tarteaucitron.launch[r]!==!0&&t===!0&&(tarteaucitron.launch[r]=!0,tarteaucitron.services[r].js()),tarteaucitron.state[r]=t,tarteaucitron.cookie.create(r,t),tarteaucitron.userInterface.color(r,t))},respond:function(t,e){"use strict";var r=t.id.replace(new RegExp("(Eng[0-9]+|Allow|Deni)ed","g"),"");tarteaucitron.state[r]!==e&&(e===!1&&tarteaucitron.launch[r]===!0&&(tarteaucitron.reloadThePage=!0),e===!0&&tarteaucitron.launch[r]!==!0&&(tarteaucitron.launch[r]=!0,tarteaucitron.services[r].js()),tarteaucitron.state[r]=e,tarteaucitron.cookie.create(r,e),tarteaucitron.userInterface.color(r,e))},color:function(t,e){"use strict";var r,a="#808080",n="#1B870B",i="#9C1A1A",o="tarteaucitron",c=0,u=0,s=0,l=tarteaucitron.job.length;for(e===!0?(tarteaucitron.userInterface.css(t+"Line","borderLeft","5px solid "+n),tarteaucitron.userInterface.css(t+"Allowed","backgroundColor",n),tarteaucitron.userInterface.css(t+"Denied","backgroundColor",a)):e===!1&&(tarteaucitron.userInterface.css(t+"Line","borderLeft","5px solid "+i),tarteaucitron.userInterface.css(t+"Allowed","backgroundColor",a),tarteaucitron.userInterface.css(t+"Denied","backgroundColor",i)),r=0;l>r;r+=1)tarteaucitron.state[tarteaucitron.job[r]]===!1?c+=1:void 0===tarteaucitron.state[tarteaucitron.job[r]]?u+=1:tarteaucitron.state[tarteaucitron.job[r]]===!0&&(s+=1);tarteaucitron.userInterface.css(o+"DotGreen","width",100/l*s+"%"),tarteaucitron.userInterface.css(o+"DotYellow","width",100/l*u+"%"),tarteaucitron.userInterface.css(o+"DotRed","width",100/l*c+"%"),0===c&&0===u?(tarteaucitron.userInterface.css(o+"AllAllowed","backgroundColor",n),tarteaucitron.userInterface.css(o+"AllDenied","backgroundColor",a)):0===s&&0===u?(tarteaucitron.userInterface.css(o+"AllAllowed","backgroundColor",a),tarteaucitron.userInterface.css(o+"AllDenied","backgroundColor",i)):(tarteaucitron.userInterface.css(o+"AllAllowed","backgroundColor",a),tarteaucitron.userInterface.css(o+"AllDenied","backgroundColor",a)),0===u&&tarteaucitron.userInterface.closeAlert(),tarteaucitron.services[t].cookies.length>0&&e===!1&&tarteaucitron.cookie.purge(tarteaucitron.services[t].cookies),e===!0?(null!==document.getElementById("tacCL"+t)&&(document.getElementById("tacCL"+t).innerHTML="..."),setTimeout(function(){tarteaucitron.cookie.checkCount(t)},2500)):tarteaucitron.cookie.checkCount(t)},openPanel:function(){"use strict";tarteaucitron.userInterface.css("tarteaucitron","display","block"),tarteaucitron.userInterface.css("tarteaucitronBack","display","block"),tarteaucitron.userInterface.css("tarteaucitronCookiesListContainer","display","none"),tarteaucitron.userInterface.jsSizing("main")},closePanel:function(){"use strict";document.location.hash===tarteaucitron.hashtag&&(document.location.hash=""),tarteaucitron.userInterface.css("tarteaucitron","display","none"),tarteaucitron.userInterface.css("tarteaucitronCookiesListContainer","display","none"),tarteaucitron.fallback(["tarteaucitronInfoBox"],function(t){t.style.display="none"},!0),tarteaucitron.reloadThePage===!0?window.location.reload():tarteaucitron.userInterface.css("tarteaucitronBack","display","none")},openAlert:function(){"use strict";var t="tarteaucitron";tarteaucitron.userInterface.css(t+"Percentage","display","block"),tarteaucitron.userInterface.css(t+"AlertSmall","display","none"),tarteaucitron.userInterface.css(t+"AlertBig","display","block")},closeAlert:function(){"use strict";var t="tarteaucitron";tarteaucitron.userInterface.css(t+"Percentage","display","none"),tarteaucitron.userInterface.css(t+"AlertSmall","display","block"),tarteaucitron.userInterface.css(t+"AlertBig","display","none"),tarteaucitron.userInterface.jsSizing("box")},toggleCookiesList:function(){"use strict";var t=document.getElementById("tarteaucitronCookiesListContainer");null!==t&&("block"!==t.style.display?(tarteaucitron.cookie.number(),t.style.display="block",tarteaucitron.userInterface.jsSizing("cookie"),tarteaucitron.userInterface.css("tarteaucitron","display","none"),tarteaucitron.userInterface.css("tarteaucitronBack","display","block"),tarteaucitron.fallback(["tarteaucitronInfoBox"],function(t){t.style.display="none"},!0)):(t.style.display="none",tarteaucitron.userInterface.css("tarteaucitron","display","none"),tarteaucitron.userInterface.css("tarteaucitronBack","display","none")))},toggle:function(t,e){"use strict";var r=document.getElementById(t);null!==r&&(void 0!==e&&tarteaucitron.fallback([e],function(e){e.id!==t&&(e.style.display="none")},!0),"block"!==r.style.display?r.style.display="block":r.style.display="none")},order:function(t){"use strict";var e,r=document.getElementById("tarteaucitronServices_"+t);null!==r&&(e=r.childNodes,"function"==typeof Array.prototype.map&&Array.prototype.map.call(r.children,Object).sort(function(t,e){return tarteaucitron.services[t.id.replace(/Line/g,"")].name>tarteaucitron.services[e.id.replace(/Line/g,"")].name?1:tarteaucitron.services[t.id.replace(/Line/g,"")].name<tarteaucitron.services[e.id.replace(/Line/g,"")].name?-1:0}).forEach(function(t){r.appendChild(t)}))},jsSizing:function(t){"use strict";var e,r,a,n,i,o,c,u,s,l,d,g,f,m=10,p=window,y="inner",v=window.innerHeight||document.documentElement.clientHeight||document.body.clientHeight;"box"===t?null!==document.getElementById("tarteaucitronAlertSmall")&&null!==document.getElementById("tarteaucitronCookiesNumber")&&(tarteaucitron.userInterface.css("tarteaucitronCookiesNumber","padding","0px 10px"),g=document.getElementById("tarteaucitronAlertSmall").offsetHeight,f=document.getElementById("tarteaucitronCookiesNumber").offsetHeight,d=(g-f)/2,tarteaucitron.userInterface.css("tarteaucitronCookiesNumber","padding",d+"px 10px")):"main"===t?(void 0===window.innerWidth&&(y="client",p=document.documentElement||document.body),null!==document.getElementById("tarteaucitron")&&null!==document.getElementById("tarteaucitronClosePanel")&&null!==document.getElementById("tarteaucitronMainLineOffset")&&(tarteaucitron.userInterface.css("tarteaucitronScrollbarParent","height","auto"),i=document.getElementById("tarteaucitron").offsetHeight,o=document.getElementById("tarteaucitronClosePanel").offsetHeight,c=document.getElementById("tarteaucitronMainLineOffset").offsetHeight,a=i-o-c+1,tarteaucitron.userInterface.css("tarteaucitronScrollbarParent","height",a+"px")),null!==document.getElementById("tarteaucitronScrollbarParent")&&null!==document.getElementById("tarteaucitronScrollbarChild")&&(p[y+"Width"]<=479?tarteaucitron.userInterface.css("tarteaucitronScrollbarAdjust","marginLeft","11px"):p[y+"Width"]<=767&&(m=12),e=document.getElementById("tarteaucitronScrollbarParent").offsetWidth,r=document.getElementById("tarteaucitronScrollbarChild").offsetWidth,tarteaucitron.userInterface.css("tarteaucitronScrollbarAdjust","marginRight",e-r+m+"px")),null!==document.getElementById("tarteaucitron")&&(n=p[y+"Width"]<=767?0:(v-document.getElementById("tarteaucitron").offsetHeight)/2-21,0>n&&(n=0),null!==document.getElementById("tarteaucitronMainLineOffset")&&document.getElementById("tarteaucitron").offsetHeight<v/2&&(n-=document.getElementById("tarteaucitronMainLineOffset").offsetHeight),tarteaucitron.userInterface.css("tarteaucitron","top",n+"px"))):"cookie"===t&&(null!==document.getElementById("tarteaucitronAlertSmall")&&tarteaucitron.userInterface.css("tarteaucitronCookiesListContainer","bottom",document.getElementById("tarteaucitronAlertSmall").offsetHeight+"px"),null!==document.getElementById("tarteaucitronCookiesListContainer")&&(tarteaucitron.userInterface.css("tarteaucitronCookiesList","height","auto"),u=document.getElementById("tarteaucitronCookiesListContainer").offsetHeight,s=document.getElementById("tarteaucitronClosePanelCookie").offsetHeight,l=document.getElementById("tarteaucitronCookiesTitle").offsetHeight,tarteaucitron.userInterface.css("tarteaucitronCookiesList","height",u-s-l-2+"px")))}},cookie:{owner:{},create:function(t,e){"use strict";var r=new Date,a=r.getTime(),n=a+31536e6,i=new RegExp("!"+t+"=(wait|true|false)","g"),o=tarteaucitron.cookie.read().replace(i,""),c="tarteaucitron="+o+"!"+t+"="+e;-1===tarteaucitron.cookie.read().indexOf(t+"="+e)&&tarteaucitron.pro("!"+t+"="+e),r.setTime(n),document.cookie=c+"; expires="+r.toGMTString()+"; path=/;"},read:function(){"use strict";var t,e,r="tarteaucitron=",a=document.cookie.split(";");for(t=0;t<a.length;t+=1){for(e=a[t];" "===e.charAt(0);)e=e.substring(1,e.length);if(0===e.indexOf(r))return e.substring(r.length,e.length)}return""},purge:function(t){"use strict";var e;for(e=0;e<t.length;e+=1)document.cookie=t[e]+"=; expires=Thu, 01 Jan 2000 00:00:00 GMT; path=/;",document.cookie=t[e]+"=; expires=Thu, 01 Jan 2000 00:00:00 GMT; path=/; domain=."+location.hostname+";",document.cookie=t[e]+"=; expires=Thu, 01 Jan 2000 00:00:00 GMT; path=/; domain=."+location.hostname.split(".").slice(-2).join(".")+";"},checkCount:function(t){"use strict";var e,r=tarteaucitron.services[t].cookies,a=r.length,n=0,i="",o=document.cookie.indexOf(t+"=true");if(o>=0&&0===a)i+=tarteaucitron.lang.useNoCookie;else if(o>=0){for(e=0;a>e;e+=1)-1!==document.cookie.indexOf(r[e]+"=")&&(n+=1,void 0===tarteaucitron.cookie.owner[r[e]]&&(tarteaucitron.cookie.owner[r[e]]=[]),tarteaucitron.cookie.crossIndexOf(tarteaucitron.cookie.owner[r[e]],tarteaucitron.services[t].name)===!1&&tarteaucitron.cookie.owner[r[e]].push(tarteaucitron.services[t].name));n>0?(i+=tarteaucitron.lang.useCookieCurrent+" "+n+" cookie",n>1&&(i+="s"),i+="."):i+=tarteaucitron.lang.useNoCookie}else 0===a?i=tarteaucitron.lang.noCookie:(i+=tarteaucitron.lang.useCookie+" "+a+" cookie",a>1&&(i+="s"),i+=".");null!==document.getElementById("tacCL"+t)&&(document.getElementById("tacCL"+t).innerHTML=i)},crossIndexOf:function(t,e){"use strict";var r;for(r=0;r<t.length;r+=1)if(t[r]===e)return!0;return!1},number:function(){"use strict";var t,e,r,a,n,i,o,c=document.cookie.split(";"),u=""!==document.cookie?c.length:0,s="",l=u>1?"s":"",d=/^https?\:\/\/([^\/?#]+)(?:[\/?#]|$)/i,g=null!==tarteaucitron.cdn.match(d)?tarteaucitron.cdn.match(d)[1]:tarteaucitron.cdn,f=void 0!==tarteaucitron.domain?tarteaucitron.domain:g;if(c=c.sort(function(t,e){return r=t.split("=",1).toString().replace(/ /g,""),a=e.split("=",1).toString().replace(/ /g,""),n=void 0!==tarteaucitron.cookie.owner[r]?tarteaucitron.cookie.owner[r]:"0",i=void 0!==tarteaucitron.cookie.owner[a]?tarteaucitron.cookie.owner[a]:"0",n+t>i+e?1:i+e>n+t?-1:0}),""!==document.cookie)for(t=0;u>t;t+=1)e=c[t].split("=",1).toString().replace(/ /g,""),void 0!==tarteaucitron.cookie.owner[e]&&tarteaucitron.cookie.owner[e].join(" // ")!==o?(o=tarteaucitron.cookie.owner[e].join(" // "),s+='<div class="tarteaucitronHidden">',s+='     <div class="tarteaucitronTitle">',s+="        "+tarteaucitron.cookie.owner[e].join(" // "),s+="    </div>",s+="</div>"):void 0===tarteaucitron.cookie.owner[e]&&f!==o&&(o=f,s+='<div class="tarteaucitronHidden">',s+='     <div class="tarteaucitronTitle">',s+="        "+f,s+="    </div>",s+="</div>"),s+='<div class="tarteaucitronCookiesListMain">',s+='    <div class="tarteaucitronCookiesListLeft"><a href="#" onclick="tarteaucitron.cookie.purge([\''+c[t].split("=",1)+"']);tarteaucitron.cookie.number();tarteaucitron.userInterface.jsSizing('cookie');return false\"><b>&times;</b></a> <b>"+e+"</b>",s+="    </div>",s+='    <div class="tarteaucitronCookiesListRight">'+c[t].split("=").slice(1).join("=")+"</div>",s+="</div>";else s+='<div class="tarteaucitronCookiesListMain">',s+='    <div class="tarteaucitronCookiesListLeft"><b>-</b></div>',s+='    <div class="tarteaucitronCookiesListRight"></div>',s+="</div>";for(s+='<div class="tarteaucitronHidden" style="height:20px;display:block"></div>',null!==document.getElementById("tarteaucitronCookiesList")&&(document.getElementById("tarteaucitronCookiesList").innerHTML=s),null!==document.getElementById("tarteaucitronCookiesNumber")&&(document.getElementById("tarteaucitronCookiesNumber").innerHTML=u),null!==document.getElementById("tarteaucitronCookiesNumberBis")&&(document.getElementById("tarteaucitronCookiesNumberBis").innerHTML=u+" cookie"+l),t=0;t<tarteaucitron.job.length;t+=1)tarteaucitron.cookie.checkCount(tarteaucitron.job[t])}},getLanguage:function(){"use strict";if(!navigator)return"en";var t="en,fr,es,it,de,pt,pl,ru",e="en",r=navigator.language||navigator.browserLanguage||navigator.systemLanguage||navigator.userLang||null,a=r.substr(0,2);return""!==tarteaucitronForceLanguage&&-1!==t.indexOf(tarteaucitronForceLanguage)?tarteaucitronForceLanguage:-1===t.indexOf(a)?e:a},getLocale:function(){"use strict";if(!navigator)return"en_US";var t=navigator.language||navigator.browserLanguage||navigator.systemLanguage||navigator.userLang||null,e=t.substr(0,2);return"fr"===e?"fr_FR":"en"===e?"en_US":"de"===e?"de_DE":"es"===e?"es_ES":"it"===e?"it_IT":"pt"===e?"pt_PT":"en_US"},addScript:function(t,e,r,a,n,i){"use strict";var o,c=!1;a===!1?"function"==typeof r&&r():(o=document.createElement("script"),o.type="text/javascript",o.id=void 0!==e?e:"",o.async=!0,o.src=t,void 0!==n&&void 0!==i&&o.setAttribute(n,i),"function"==typeof r&&(o.onreadystatechange=o.onload=function(){var t=o.readyState;c||t&&!/loaded|complete/.test(t)||(c=!0,r())}),document.getElementsByTagName("head")[0].appendChild(o))},makeAsync:{antiGhost:0,buffer:"",init:function(t,e){"use strict";var r=document.write,a=document.writeln;document.write=function(t){tarteaucitron.makeAsync.buffer+=t},document.writeln=function(t){tarteaucitron.makeAsync.buffer+=t.concat("\n")},setTimeout(function(){document.write=r,document.writeln=a},2e4),tarteaucitron.makeAsync.getAndParse(t,e)},getAndParse:function(t,e){"use strict";return tarteaucitron.makeAsync.antiGhost>9?void(tarteaucitron.makeAsync.antiGhost=0):(tarteaucitron.makeAsync.antiGhost+=1,void tarteaucitron.addScript(t,"",function(){null!==document.getElementById(e)&&(document.getElementById(e).innerHTML+="<span style='display:none'>&nbsp;</span>"+tarteaucitron.makeAsync.buffer,tarteaucitron.makeAsync.buffer="",tarteaucitron.makeAsync.execJS(e))}))},execJS:function(id){var i,scripts,childId,type;if(null!==document.getElementById(id))for(scripts=document.getElementById(id).getElementsByTagName("script"),i=0;i<scripts.length;i+=1)type=null!==scripts[i].getAttribute("type")?scripts[i].getAttribute("type"):"",""===type&&(type=null!==scripts[i].getAttribute("language")?scripts[i].getAttribute("language"):""),null!==scripts[i].getAttribute("src")&&""!==scripts[i].getAttribute("src")?(childId=id+Math.floor(99999999999*Math.random()),document.getElementById(id).innerHTML+='<div id="'+childId+'"></div>',tarteaucitron.makeAsync.getAndParse(scripts[i].getAttribute("src"),childId)):(-1!==type.indexOf("javascript")||""===type)&&eval(scripts[i].innerHTML)}},fallback:function(t,e,r){"use strict";var a,n=document.getElementsByTagName("*"),i=0;for(a in n)if(void 0!==n[a])for(i=0;i<t.length;i+=1)(" "+n[a].className+" ").indexOf(" "+t[i]+" ")>-1&&("function"==typeof e?r===!0?e(n[a]):n[a].innerHTML=e(n[a]):n[a].innerHTML=e)},engage:function(t){"use strict";var e="",r=Math.floor(1e5*Math.random());return e+='<div class="tac_activate">',e+='   <div class="tac_float">',e+="      <b>"+tarteaucitron.services[t].name+"</b> "+tarteaucitron.lang.fallback,e+='      <div class="tarteaucitronAllow" id="Eng'+r+"ed"+t+'" onclick="tarteaucitron.userInterface.respond(this, true);">',e+="          &#10003; "+tarteaucitron.lang.allow,e+="       </div>",e+="   </div>",e+="</div>"},extend:function(t,e){"use strict";var r;for(r in e)e.hasOwnProperty(r)&&(t[r]=e[r])},proTemp:"",proTimer:function(){"use strict";setTimeout(tarteaucitron.proPing,1e3)},pro:function(t){"use strict";tarteaucitron.proTemp+=t,clearTimeout(tarteaucitron.proTimer),tarteaucitron.proTimer=setTimeout(tarteaucitron.proPing,2500)},proPing:function(){"use strict";if(""!==tarteaucitron.uuid&&void 0!==tarteaucitron.uuid&&""!==tarteaucitron.proTemp){var t=document.getElementById("tarteaucitronPremium"),e=(new Date).getTime(),r="//opt-out.ferank.eu/premium.php?";if(null===t)return;r+="domain="+tarteaucitron.domain+"&",r+="uuid="+tarteaucitron.uuid+"&",r+="c="+encodeURIComponent(tarteaucitron.proTemp)+"&",r+="_"+e,t.innerHTML='<img src="'+r+'" style="display:none" />',tarteaucitron.proTemp=""}tarteaucitron.cookie.number()}};