!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof module&&"object"==typeof module.exports?module.exports=a(require("jquery")):a(jQuery)}(function(a){return function(a){"use strict";a.extend({tablesorter:new function(){function b(a){for(var b in a)return!1;return!0}function c(b,c,d,e){for(var f,g,h=s.parsers.length,i=!1,j="",k=!0;""===j&&k;)d++,c[d]?(i=c[d].cells[e],j=s.getElementText(b,i,e),g=a(i),b.debug&&console.log("Checking if value was empty on row "+d+", column: "+e+': "'+j+'"')):k=!1;for(;--h>=0;)if(f=s.parsers[h],f&&"text"!==f.id&&f.is&&f.is(j,b.table,i,g))return f;return s.getParserById("text")}function d(a,d){var e,f,g,h,i,j,k,l,m,n,o,p,q=a.table,r=0,t={};if(a.$tbodies=a.$table.children("tbody:not(."+a.cssInfoBlock+")"),o="undefined"==typeof d?a.$tbodies:d,p=o.length,0===p)return a.debug?console.warn("Warning: *Empty table!* Not building a parser cache"):"";for(a.debug&&(n=new Date,console[console.group?"group":"log"]("Detecting parsers for each column")),f={extractors:[],parsers:[]};p>r;){if(e=o[r].rows,e.length)for(g=a.columns,h=0;g>h;h++)i=a.$headerIndexed[h],j=s.getColumnData(q,a.headers,h),m=s.getParserById(s.getData(i,j,"extractor")),l=s.getParserById(s.getData(i,j,"sorter")),k="false"===s.getData(i,j,"parser"),a.empties[h]=(s.getData(i,j,"empty")||a.emptyTo||(a.emptyToBottom?"bottom":"top")).toLowerCase(),a.strings[h]=(s.getData(i,j,"string")||a.stringTo||"max").toLowerCase(),k&&(l=s.getParserById("no-parser")),m||(m=!1),l||(l=c(a,e,-1,h)),a.debug&&(t["("+h+") "+i.text()]={parser:l.id,extractor:m?m.id:"none",string:a.strings[h],empty:a.empties[h]}),f.parsers[h]=l,f.extractors[h]=m;r+=f.parsers.length?p:1}a.debug&&(b(t)?console.warn("  No parsers detected!"):console[console.table?"table":"log"](t),console.log("Completed detecting parsers"+s.benchmark(n)),console.groupEnd&&console.groupEnd()),a.parsers=f.parsers,a.extractors=f.extractors}function e(b,c){var d,e,f,g,h,i,j,k,l,m,n,o,p,q,r=b.config,t=r.parsers;if(r.$tbodies=r.$table.children("tbody:not(."+r.cssInfoBlock+")"),j="undefined"==typeof c?r.$tbodies:c,r.cache={},r.totalRows=0,!t)return r.debug?console.warn("Warning: *Empty table!* Not building a cache"):"";for(r.debug&&(m=new Date),r.showProcessing&&s.isProcessing(b,!0),i=0;i<j.length;i++){for(q=[],d=r.cache[i]={normalized:[]},n=j[i]&&j[i].rows.length||0,g=0;n>g;++g)if(o={child:[],raw:[]},k=a(j[i].rows[g]),l=[],k.hasClass(r.cssChildRow)&&0!==g)for(e=d.normalized.length-1,p=d.normalized[e][r.columns],p.$row=p.$row.add(k),k.prev().hasClass(r.cssChildRow)||k.prev().addClass(s.css.cssHasChild),f=k.children("th, td"),e=p.child.length,p.child[e]=[],h=0;h<r.columns;h++)p.child[e][h]=s.getParsedText(r,f[h],h);else{for(o.$row=k,o.order=g,h=0;h<r.columns;++h)"undefined"!=typeof t[h]?(e=s.getElementText(r,k[0].cells[h],h),o.raw.push(e),f=s.getParsedText(r,k[0].cells[h],h,e),l.push(f),"numeric"===(t[h].type||"").toLowerCase()&&(q[h]=Math.max(Math.abs(f)||0,q[h]||0))):r.debug&&console.warn("No parser found for cell:",k[0].cells[h],"does it have a header?");l[r.columns]=o,d.normalized.push(l)}d.colMax=q,r.totalRows+=d.normalized.length}r.showProcessing&&s.isProcessing(b),r.debug&&console.log("Building cache for "+n+" rows"+s.benchmark(m))}function f(a,c){var d,e,f,g,h,i,j,k=a.config,l=k.widgetOptions,m=k.$tbodies,n=[],o=k.cache;if(b(o))return k.appender?k.appender(a,n):a.isUpdating?k.$table.trigger("updateComplete",a):"";for(k.debug&&(j=new Date),i=0;i<m.length;i++)if(f=m.eq(i),f.length){for(g=s.processTbody(a,f,!0),d=o[i].normalized,e=d.length,h=0;e>h;h++)n.push(d[h][k.columns].$row),k.appender&&(!k.pager||k.pager.removeRows&&l.pager_removeRows||k.pager.ajax)||g.append(d[h][k.columns].$row);s.processTbody(a,g,!1)}k.appender&&k.appender(a,n),k.debug&&console.log("Rebuilt table"+s.benchmark(j)),c||k.appender||s.applyWidget(a),a.isUpdating&&k.$table.trigger("updateComplete",a)}function g(a){return/^d/i.test(a)||1===a}function h(b){var c,d,e,f,h,i,k,l,m=b.config;for(m.headerList=[],m.headerContent=[],m.debug&&(k=new Date),m.columns=s.computeColumnIndex(m.$table.children("thead, tfoot").children("tr")),f=m.cssIcon?'<i class="'+(m.cssIcon===s.css.icon?s.css.icon:m.cssIcon+" "+s.css.icon)+'"></i>':"",m.$headers=a(a.map(a(b).find(m.selectorHeaders),function(j,k){return d=a(j),d.parent().hasClass(m.cssIgnoreRow)?void 0:(c=s.getColumnData(b,m.headers,k,!0),m.headerContent[k]=d.html(),""===m.headerTemplate||d.find("."+s.css.headerIn).length||(h=m.headerTemplate.replace(/\{content\}/g,d.html()).replace(/\{icon\}/g,d.find("."+s.css.icon).length?"":f),m.onRenderTemplate&&(e=m.onRenderTemplate.apply(d,[k,h]),e&&"string"==typeof e&&(h=e)),d.html('<div class="'+s.css.headerIn+'">'+h+"</div>")),m.onRenderHeader&&m.onRenderHeader.apply(d,[k,m,m.$table]),j.column=parseInt(d.attr("data-column"),10),j.order=g(s.getData(d,c,"sortInitialOrder")||m.sortInitialOrder)?[1,0,2]:[0,1,2],j.count=-1,j.lockedOrder=!1,i=s.getData(d,c,"lockedOrder")||!1,"undefined"!=typeof i&&i!==!1&&(j.order=j.lockedOrder=g(i)?[1,1,1]:[0,0,0]),d.addClass(s.css.header+" "+m.cssHeader),m.headerList[k]=j,d.parent().addClass(s.css.headerRow+" "+m.cssHeaderRow).attr("role","row"),m.tabIndex&&d.attr("tabindex",0),j)})),m.$headerIndexed=[],l=0;l<m.columns;l++)d=m.$headers.filter('[data-column="'+l+'"]'),m.$headerIndexed[l]=d.not(".sorter-false").length?d.not(".sorter-false").filter(":last"):d.filter(":last");a(b).find(m.selectorHeaders).attr({scope:"col",role:"columnheader"}),j(b),m.debug&&(console.log("Built headers:"+s.benchmark(k)),console.log(m.$headers))}function i(a,b,c){var f=a.config;f.$table.find(f.selectorRemove).remove(),d(f),e(a),q(f,b,c)}function j(a){var b,c,d,e,f=a.config,g=f.$headers.length;for(b=0;g>b;b++)d=f.$headers.eq(b),e=s.getColumnData(a,f.headers,b,!0),c="false"===s.getData(d,e,"sorter")||"false"===s.getData(d,e,"parser"),d[0].sortDisabled=c,d[c?"addClass":"removeClass"]("sorter-false").attr("aria-disabled",""+c),a.id&&(c?d.removeAttr("aria-controls"):d.attr("aria-controls",a.id))}function k(b){var c,d,e,f,g,h,i,j,k=b.config,l=k.sortList,m=l.length,n=s.css.sortNone+" "+k.cssNone,o=[s.css.sortAsc+" "+k.cssAsc,s.css.sortDesc+" "+k.cssDesc],p=[k.cssIconAsc,k.cssIconDesc,k.cssIconNone],q=["ascending","descending"],r=a(b).find("tfoot tr").children().add(a(k.namespace+"_extra_headers")).removeClass(o.join(" "));for(k.$headers.removeClass(o.join(" ")).addClass(n).attr("aria-sort","none").find("."+s.css.icon).removeClass(p.join(" ")).addClass(p[2]),e=0;m>e;e++)if(2!==l[e][1]&&(c=k.$headers.not(".sorter-false").filter('[data-column="'+l[e][0]+'"]'+(1===m?":last":"")),c.length)){for(f=0;f<c.length;f++)c[f].sortDisabled||c.eq(f).removeClass(n).addClass(o[l[e][1]]).attr("aria-sort",q[l[e][1]]).find("."+s.css.icon).removeClass(p[2]).addClass(p[l[e][1]]);r.length&&r.filter('[data-column="'+l[e][0]+'"]').removeClass(n).addClass(o[l[e][1]])}for(m=k.$headers.length,g=k.$headers.not(".sorter-false"),e=0;m>e;e++)h=g.eq(e),h.length&&(d=g[e],i=d.order[(d.count+1)%(k.sortReset?3:2)],j=a.trim(h.text())+": "+s.language[h.hasClass(s.css.sortAsc)?"sortAsc":h.hasClass(s.css.sortDesc)?"sortDesc":"sortNone"]+s.language[0===i?"nextAsc":1===i?"nextDesc":"nextNone"],h.attr("aria-label",j))}function l(b,c){var d,e,f,g,h,i,j,k,l=b.config,m=c||l.sortList,n=m.length;for(l.sortList=[],h=0;n>h;h++)if(k=m[h],d=parseInt(k[0],10),d<l.columns&&l.$headerIndexed[d]){switch(g=l.$headerIndexed[d][0],e=(""+k[1]).match(/^(1|d|s|o|n)/),e=e?e[0]:""){case"1":case"d":e=1;break;case"s":e=i||0;break;case"o":j=g.order[(i||0)%(l.sortReset?3:2)],e=0===j?1:1===j?0:2;break;case"n":g.count=g.count+1,e=g.order[g.count%(l.sortReset?3:2)];break;default:e=0}i=0===h?e:i,f=[d,parseInt(e,10)||0],l.sortList.push(f),e=a.inArray(f[1],g.order),g.count=e>=0?e:f[1]%(l.sortReset?3:2)}}function m(a,b){return a&&a[b]?a[b].type||"":""}function n(b,c,d){if(b.isUpdating)return setTimeout(function(){n(b,c,d)},50);var e,g,h,i,j,l,m,p=b.config,q=!d[p.sortMultiSortKey],r=p.$table,t=p.$headers.length;if(r.trigger("sortStart",b),c.count=d[p.sortResetKey]?2:(c.count+1)%(p.sortReset?3:2),p.sortRestart)for(g=c,h=0;t>h;h++)m=p.$headers.eq(h),m[0]===g||!q&&m.is("."+s.css.sortDesc+",."+s.css.sortAsc)||(m[0].count=-1);if(g=parseInt(a(c).attr("data-column"),10),q){if(p.sortList=[],null!==p.sortForce)for(e=p.sortForce,i=0;i<e.length;i++)e[i][0]!==g&&p.sortList.push(e[i]);if(j=c.order[c.count],2>j&&(p.sortList.push([g,j]),c.colSpan>1))for(i=1;i<c.colSpan;i++)p.sortList.push([g+i,j])}else{if(p.sortAppend&&p.sortList.length>1)for(i=0;i<p.sortAppend.length;i++)l=s.isValueInArray(p.sortAppend[i][0],p.sortList),l>=0&&p.sortList.splice(l,1);if(s.isValueInArray(g,p.sortList)>=0)for(i=0;i<p.sortList.length;i++)l=p.sortList[i],j=p.$headerIndexed[l[0]][0],l[0]===g&&(l[1]=j.order[c.count],2===l[1]&&(p.sortList.splice(i,1),j.count=-1));else if(j=c.order[c.count],2>j&&(p.sortList.push([g,j]),c.colSpan>1))for(i=1;i<c.colSpan;i++)p.sortList.push([g+i,j])}if(null!==p.sortAppend)for(e=p.sortAppend,i=0;i<e.length;i++)e[i][0]!==g&&p.sortList.push(e[i]);r.trigger("sortBegin",b),setTimeout(function(){k(b),o(b),f(b),r.trigger("sortEnd",b)},1)}function o(a){var c,d,e,f,g,h,i,j,k,l,n,o=0,p=a.config,q=p.textSorter||"",r=p.sortList,t=r.length,u=p.$tbodies.length;if(!p.serverSideSorting&&!b(p.cache)){for(p.debug&&(g=new Date),d=0;u>d;d++)h=p.cache[d].colMax,i=p.cache[d].normalized,i.sort(function(b,d){for(c=0;t>c;c++){if(f=r[c][0],j=r[c][1],o=0===j,p.sortStable&&b[f]===d[f]&&1===t)return b[p.columns].order-d[p.columns].order;if(e=/n/i.test(m(p.parsers,f)),e&&p.strings[f]?(e="boolean"==typeof p.string[p.strings[f]]?(o?1:-1)*(p.string[p.strings[f]]?-1:1):p.strings[f]?p.string[p.strings[f]]||0:0,k=p.numberSorter?p.numberSorter(b[f],d[f],o,h[f],a):s["sortNumeric"+(o?"Asc":"Desc")](b[f],d[f],e,h[f],f,a)):(l=o?b:d,n=o?d:b,k="function"==typeof q?q(l[f],n[f],o,f,a):"object"==typeof q&&q.hasOwnProperty(f)?q[f](l[f],n[f],o,f,a):s["sortNatural"+(o?"Asc":"Desc")](b[f],d[f],f,a,p)),k)return k}return b[p.columns].order-d[p.columns].order});p.debug&&console.log("Sorting on "+r.toString()+" and dir "+j+" time"+s.benchmark(g))}}function p(b,c){b.table.isUpdating&&b.$table.trigger("updateComplete",b.table),a.isFunction(c)&&c(b.table)}function q(b,c,d){var e=a.isArray(c)?c:b.sortList,f="undefined"==typeof c?b.resort:c;f===!1||b.serverSideSorting||b.table.isProcessing?(p(b,d),s.applyWidget(b.table,!1)):e.length?b.$table.trigger("sorton",[e,function(){p(b,d)},!0]):b.$table.trigger("sortReset",[function(){p(b,d),s.applyWidget(b.table,!1)}])}function r(c){var g=c.config,m=g.$table,n="sortReset update updateRows updateCell updateAll addRows updateComplete sorton appendCache updateCache applyWidgetId applyWidgets refreshWidgets destroy mouseup mouseleave ".split(" ").join(g.namespace+" ");m.unbind(n.replace(/\s+/g," ")).bind("sortReset"+g.namespace,function(b,d){b.stopPropagation(),g.sortList=[],k(c),o(c),f(c),a.isFunction(d)&&d(c)}).bind("updateAll"+g.namespace,function(a,b,d){a.stopPropagation(),c.isUpdating=!0,s.refreshWidgets(c,!0,!0),h(c),s.bindEvents(c,g.$headers,!0),r(c),i(c,b,d)}).bind("update"+g.namespace+" updateRows"+g.namespace,function(a,b,d){a.stopPropagation(),c.isUpdating=!0,j(c),i(c,b,d)}).bind("updateCell"+g.namespace,function(b,d,e,f){b.stopPropagation(),c.isUpdating=!0,m.find(g.selectorRemove).remove();var h,i,j,k,l=g.$tbodies,n=a(d),o=l.index(a.fn.closest?n.closest("tbody"):n.parents("tbody").filter(":first")),p=g.cache[o],r=a.fn.closest?n.closest("tr"):n.parents("tr").filter(":first");d=n[0],l.length&&o>=0&&(i=l.eq(o).find("tr").index(r),k=p.normalized[i],j=n.index(),h=s.getParsedText(g,d,j),k[j]=h,k[g.columns].$row=r,"numeric"===(g.parsers[j].type||"").toLowerCase()&&(p.colMax[j]=Math.max(Math.abs(h)||0,p.colMax[j]||0)),h="undefined"!==e?e:g.resort,h!==!1?q(g,h,f):(a.isFunction(f)&&f(c),g.$table.trigger("updateComplete",g.table)))}).bind("addRows"+g.namespace,function(e,f,h,k){if(e.stopPropagation(),c.isUpdating=!0,b(g.cache))j(c),i(c,h,k);else{f=a(f).attr("role","row");var l,m,n,o,p,r=f.filter("tr").length,t=g.$tbodies.index(f.parents("tbody").filter(":first"));for(g.parsers&&g.parsers.length||d(g),l=0;r>l;l++){for(n=f[l].cells.length,p=[],o={child:[],$row:f.eq(l),order:g.cache[t].normalized.length},m=0;n>m;m++)p[m]=s.getParsedText(g,f[l].cells[m],m),"numeric"===(g.parsers[m].type||"").toLowerCase()&&(g.cache[t].colMax[m]=Math.max(Math.abs(p[m])||0,g.cache[t].colMax[m]||0));p.push(o),g.cache[t].normalized.push(p)}q(g,h,k)}}).bind("updateComplete"+g.namespace,function(){c.isUpdating=!1}).bind("sorton"+g.namespace,function(d,g,h,i){var j=c.config;d.stopPropagation(),m.trigger("sortStart",this),l(c,g),k(c),j.delayInit&&b(j.cache)&&e(c),m.trigger("sortBegin",this),o(c),f(c,i),m.trigger("sortEnd",this),s.applyWidget(c),a.isFunction(h)&&h(c)}).bind("appendCache"+g.namespace,function(b,d,e){b.stopPropagation(),f(c,e),a.isFunction(d)&&d(c)}).bind("updateCache"+g.namespace,function(b,f,h){g.parsers&&g.parsers.length||d(g,h),e(c,h),a.isFunction(f)&&f(c)}).bind("applyWidgetId"+g.namespace,function(a,b){a.stopPropagation(),s.getWidgetById(b).format(c,g,g.widgetOptions)}).bind("applyWidgets"+g.namespace,function(a,b){a.stopPropagation(),s.applyWidget(c,b)}).bind("refreshWidgets"+g.namespace,function(a,b,d){a.stopPropagation(),s.refreshWidgets(c,b,d)}).bind("destroy"+g.namespace,function(a,b,d){a.stopPropagation(),s.destroy(c,b,d)}).bind("resetToLoadState"+g.namespace,function(){s.removeWidget(c,!0,!1),g=a.extend(!0,s.defaults,g.originalSettings),c.hasInitialized=!1,s.setup(c,g)})}var s=this;s.version="2.22.5",s.parsers=[],s.widgets=[],s.defaults={theme:"default",widthFixed:!1,showProcessing:!1,headerTemplate:"{content}",onRenderTemplate:null,onRenderHeader:null,cancelSelection:!0,tabIndex:!0,dateFormat:"mmddyyyy",sortMultiSortKey:"shiftKey",sortResetKey:"ctrlKey",usNumberFormat:!0,delayInit:!1,serverSideSorting:!1,resort:!0,headers:{},ignoreCase:!0,sortForce:null,sortList:[],sortAppend:null,sortStable:!1,sortInitialOrder:"asc",sortLocaleCompare:!1,sortReset:!1,sortRestart:!1,emptyTo:"bottom",stringTo:"max",textExtraction:"basic",textAttribute:"data-text",textSorter:null,numberSorter:null,widgets:[],widgetOptions:{zebra:["even","odd"]},initWidgets:!0,widgetClass:"widget-{name}",initialized:null,tableClass:"",cssAsc:"",cssDesc:"",cssNone:"",cssHeader:"",cssHeaderRow:"",cssProcessing:"",cssChildRow:"tablesorter-childRow",cssIcon:"tablesorter-icon",cssIconNone:"",cssIconAsc:"",cssIconDesc:"",cssInfoBlock:"tablesorter-infoOnly",cssNoSort:"tablesorter-noSort",cssIgnoreRow:"tablesorter-ignoreRow",pointerClick:"click",pointerDown:"mousedown",pointerUp:"mouseup",selectorHeaders:"> thead th, > thead td",selectorSort:"th, td",selectorRemove:".remove-me",debug:!1,headerList:[],empties:{},strings:{},parsers:[]},s.css={table:"tablesorter",cssHasChild:"tablesorter-hasChildRow",childRow:"tablesorter-childRow",colgroup:"tablesorter-colgroup",header:"tablesorter-header",headerRow:"tablesorter-headerRow",headerIn:"tablesorter-header-inner",icon:"tablesorter-icon",processing:"tablesorter-processing",sortAsc:"tablesorter-headerAsc",sortDesc:"tablesorter-headerDesc",sortNone:"tablesorter-headerUnSorted"},s.language={sortAsc:"Ascending sort applied, ",sortDesc:"Descending sort applied, ",sortNone:"No sort applied, ",nextAsc:"activate to apply an ascending sort",nextDesc:"activate to apply a descending sort",nextNone:"activate to remove the sort"},s.instanceMethods={},s.getElementText=function(b,c,d){if(!c)return"";var e,f=b.textExtraction||"",g=c.jquery?c:a(c);return"string"==typeof f?"basic"===f&&"undefined"!=typeof(e=g.attr(b.textAttribute))?a.trim(e):a.trim(c.textContent||g.text()):"function"==typeof f?a.trim(f(g[0],b.table,d)):"function"==typeof(e=s.getColumnData(b.table,f,d))?a.trim(e(g[0],b.table,d)):a.trim(g[0].textContent||g.text())},s.getParsedText=function(a,b,c,d){"undefined"==typeof d&&(d=s.getElementText(a,b,c));var e=""+d,f=a.parsers[c],g=a.extractors[c];return f&&(g&&"function"==typeof g.format&&(d=g.format(d,a.table,b,c)),e="no-parser"===f.id?"":f.format(""+d,a.table,b,c),a.ignoreCase&&"string"==typeof e&&(e=e.toLowerCase())),e},s.construct=function(b){return this.each(function(){var c=this,d=a.extend(!0,{},s.defaults,b,s.instanceMethods);d.originalSettings=b,!c.hasInitialized&&s.buildTable&&"TABLE"!==this.nodeName?s.buildTable(c,d):s.setup(c,d)})},s.setup=function(b,c){if(!b||!b.tHead||0===b.tBodies.length||b.hasInitialized===!0)return void(c.debug&&(b.hasInitialized?console.warn("Stopping initialization. Tablesorter has already been initialized"):console.error("Stopping initialization! No table, thead or tbody")));var f="",g=a(b),i=a.metadata;b.hasInitialized=!1,b.isProcessing=!0,b.config=c,a.data(b,"tablesorter",c),c.debug&&(console[console.group?"group":"log"]("Initializing tablesorter"),a.data(b,"startoveralltimer",new Date)),c.supportsDataObject=function(a){return a[0]=parseInt(a[0],10),a[0]>1||1===a[0]&&parseInt(a[1],10)>=4}(a.fn.jquery.split(".")),c.string={max:1,min:-1,emptymin:1,emptymax:-1,zero:0,none:0,"null":0,top:!0,bottom:!1},c.emptyTo=c.emptyTo.toLowerCase(),c.stringTo=c.stringTo.toLowerCase(),/tablesorter\-/.test(g.attr("class"))||(f=""!==c.theme?" tablesorter-"+c.theme:""),c.table=b,c.$table=g.addClass(s.css.table+" "+c.tableClass+f).attr("role","grid"),c.$headers=g.find(c.selectorHeaders),c.namespace?c.namespace="."+c.namespace.replace(/\W/g,""):c.namespace=".tablesorter"+Math.random().toString(16).slice(2),c.$table.children().children("tr").attr("role","row"),c.$tbodies=g.children("tbody:not(."+c.cssInfoBlock+")").attr({"aria-live":"polite","aria-relevant":"all"}),c.$table.children("caption").length&&(f=c.$table.children("caption")[0],f.id||(f.id=c.namespace.slice(1)+"caption"),c.$table.attr("aria-labelledby",f.id)),c.widgetInit={},c.textExtraction=c.$table.attr("data-text-extraction")||c.textExtraction||"basic",h(b),s.fixColumnWidth(b),s.applyWidgetOptions(b,c),d(c),c.totalRows=0,c.delayInit||e(b),s.bindEvents(b,c.$headers,!0),r(b),c.supportsDataObject&&"undefined"!=typeof g.data().sortlist?c.sortList=g.data().sortlist:i&&g.metadata()&&g.metadata().sortlist&&(c.sortList=g.metadata().sortlist),s.applyWidget(b,!0),c.sortList.length>0?g.trigger("sorton",[c.sortList,{},!c.initWidgets,!0]):(k(b),c.initWidgets&&s.applyWidget(b,!1)),c.showProcessing&&g.unbind("sortBegin"+c.namespace+" sortEnd"+c.namespace).bind("sortBegin"+c.namespace+" sortEnd"+c.namespace,function(a){clearTimeout(c.processTimer),s.isProcessing(b),"sortBegin"===a.type&&(c.processTimer=setTimeout(function(){s.isProcessing(b,!0)},500))}),b.hasInitialized=!0,b.isProcessing=!1,c.debug&&(console.log("Overall initialization time: "+s.benchmark(a.data(b,"startoveralltimer"))),c.debug&&console.groupEnd&&console.groupEnd()),g.trigger("tablesorter-initialized",b),"function"==typeof c.initialized&&c.initialized(b)},s.fixColumnWidth=function(b){b=a(b)[0];var c,d,e,f,g,h=b.config,i=h.$table.children("colgroup");if(i.length&&i.hasClass(s.css.colgroup)&&i.remove(),h.widthFixed&&0===h.$table.children("colgroup").length){for(i=a('<colgroup class="'+s.css.colgroup+'">'),c=h.$table.width(),e=h.$tbodies.find("tr:first").children(":visible"),f=e.length,g=0;f>g;g++)d=parseInt(e.eq(g).width()/c*1e3,10)/10+"%",i.append(a("<col>").css("width",d));h.$table.prepend(i)}},s.getColumnData=function(b,c,d,e,f){if("undefined"!=typeof c&&null!==c){b=a(b)[0];var g,h,i=b.config,j=f||i.$headers,k=i.$headerIndexed&&i.$headerIndexed[d]||j.filter('[data-column="'+d+'"]:last');if(c[d])return e?c[d]:c[j.index(k)];for(h in c)if("string"==typeof h&&(g=k.filter(h).add(k.find(h)),g.length))return c[h]}},s.computeColumnIndex=function(b){var c,d,e,f,g,h,i,j,k,l,m,n,o=[],p=[],q={};for(c=0;c<b.length;c++)for(i=b[c].cells,d=0;d<i.length;d++){for(h=i[d],g=a(h),j=h.parentNode.rowIndex,k=j+"-"+g.index(),l=h.rowSpan||1,m=h.colSpan||1,"undefined"==typeof o[j]&&(o[j]=[]),e=0;e<o[j].length+1;e++)if("undefined"==typeof o[j][e]){n=e;break}for(q[k]=n,g.attr({"data-column":n}),e=j;j+l>e;e++)for("undefined"==typeof o[e]&&(o[e]=[]),p=o[e],f=n;n+m>f;f++)p[f]="x"}return p.length},s.isProcessing=function(b,c,d){b=a(b);var e=b[0].config,f=d||b.find("."+s.css.header);c?("undefined"!=typeof d&&e.sortList.length>0&&(f=f.filter(function(){return this.sortDisabled?!1:s.isValueInArray(parseFloat(a(this).attr("data-column")),e.sortList)>=0})),b.add(f).addClass(s.css.processing+" "+e.cssProcessing)):b.add(f).removeClass(s.css.processing+" "+e.cssProcessing)},s.processTbody=function(b,c,d){b=a(b)[0];var e;return d?(b.isProcessing=!0,c.before('<colgroup class="tablesorter-savemyplace"/>'),e=a.fn.detach?c.detach():c.remove()):(e=a(b).find("colgroup.tablesorter-savemyplace"),c.insertAfter(e),e.remove(),void(b.isProcessing=!1))},s.clearTableBody=function(b){a(b)[0].config.$tbodies.children().detach()},s.bindEvents=function(c,d,f){c=a(c)[0];var g,h=null,i=c.config;f!==!0&&(d.addClass(i.namespace.slice(1)+"_extra_headers"),g=a.fn.closest?d.closest("table")[0]:d.parents("table")[0],g&&"TABLE"===g.nodeName&&g!==c&&a(g).addClass(i.namespace.slice(1)+"_extra_table")),g=(i.pointerDown+" "+i.pointerUp+" "+i.pointerClick+" sort keyup ").replace(/\s+/g," ").split(" ").join(i.namespace+" "),d.find(i.selectorSort).add(d.filter(i.selectorSort)).unbind(g).bind(g,function(f,g){var j,k,l=a(f.target),m=" "+f.type+" ";if(!(1!==(f.which||f.button)&&!m.match(" "+i.pointerClick+" | sort | keyup ")||" keyup "===m&&13!==f.which||m.match(" "+i.pointerClick+" ")&&"undefined"!=typeof f.which||m.match(" "+i.pointerUp+" ")&&h!==f.target&&g!==!0)){if(m.match(" "+i.pointerDown+" "))return h=f.target,k=l.jquery.split("."),void("1"===k[0]&&k[1]<4&&f.preventDefault());if(h=null,/(input|select|button|textarea)/i.test(f.target.nodeName)||l.hasClass(i.cssNoSort)||l.parents("."+i.cssNoSort).length>0||l.parents("button").length>0)return!i.cancelSelection;i.delayInit&&b(i.cache)&&e(c),j=a.fn.closest?a(this).closest("th, td")[0]:/TH|TD/.test(this.nodeName)?this:a(this).parents("th, td")[0],j=i.$headers[d.index(j)],j.sortDisabled||n(c,j,f)}}),i.cancelSelection&&d.attr("unselectable","on").bind("selectstart",!1).css({"user-select":"none",MozUserSelect:"none"})},s.restoreHeaders=function(b){var c,d,e=a(b)[0].config,f=e.$table.find(e.selectorHeaders),g=f.length;for(c=0;g>c;c++)d=f.eq(c),d.find("."+s.css.headerIn).length&&d.html(e.headerContent[c])},s.destroy=function(b,c,d){if(b=a(b)[0],b.hasInitialized){s.removeWidget(b,!0,!1);var e,f=a(b),g=b.config,h=g.debug,i=f.find("thead:first"),j=i.find("tr."+s.css.headerRow).removeClass(s.css.headerRow+" "+g.cssHeaderRow),k=f.find("tfoot:first > tr").children("th, td");c===!1&&a.inArray("uitheme",g.widgets)>=0&&(f.trigger("applyWidgetId",["uitheme"]),f.trigger("applyWidgetId",["zebra"])),i.find("tr").not(j).remove(),e="sortReset update updateAll updateRows updateCell addRows updateComplete sorton appendCache updateCache "+"applyWidgetId applyWidgets refreshWidgets destroy mouseup mouseleave keypress sortBegin sortEnd resetToLoadState ".split(" ").join(g.namespace+" "),f.removeData("tablesorter").unbind(e.replace(/\s+/g," ")),g.$headers.add(k).removeClass([s.css.header,g.cssHeader,g.cssAsc,g.cssDesc,s.css.sortAsc,s.css.sortDesc,s.css.sortNone].join(" ")).removeAttr("data-column").removeAttr("aria-label").attr("aria-disabled","true"),j.find(g.selectorSort).unbind("mousedown mouseup keypress ".split(" ").join(g.namespace+" ").replace(/\s+/g," ")),s.restoreHeaders(b),f.toggleClass(s.css.table+" "+g.tableClass+" tablesorter-"+g.theme,c===!1),b.hasInitialized=!1,delete b.config.cache,"function"==typeof d&&d(b),h&&console.log("tablesorter has been removed")}},s.regex={chunk:/(^([+\-]?(?:0|[1-9]\d*)(?:\.\d*)?(?:[eE][+\-]?\d+)?)?$|^0x[0-9a-f]+$|\d+)/gi,chunks:/(^\\0|\\0$)/,hex:/^0x[0-9a-f]+$/i},s.sortNatural=function(a,b){if(a===b)return 0;var c,d,e,f,g,h,i,j,k=s.regex;if(k.hex.test(b)){if(d=parseInt(a.match(k.hex),16),f=parseInt(b.match(k.hex),16),f>d)return-1;if(d>f)return 1}for(c=a.replace(k.chunk,"\\0$1\\0").replace(k.chunks,"").split("\\0"),e=b.replace(k.chunk,"\\0$1\\0").replace(k.chunks,"").split("\\0"),j=Math.max(c.length,e.length),i=0;j>i;i++){if(g=isNaN(c[i])?c[i]||0:parseFloat(c[i])||0,h=isNaN(e[i])?e[i]||0:parseFloat(e[i])||0,isNaN(g)!==isNaN(h))return isNaN(g)?1:-1;if(typeof g!=typeof h&&(g+="",h+=""),h>g)return-1;if(g>h)return 1}return 0},s.sortNaturalAsc=function(a,b,c,d,e){if(a===b)return 0;var f=e.string[e.empties[c]||e.emptyTo];return""===a&&0!==f?"boolean"==typeof f?f?-1:1:-f||-1:""===b&&0!==f?"boolean"==typeof f?f?1:-1:f||1:s.sortNatural(a,b)},s.sortNaturalDesc=function(a,b,c,d,e){if(a===b)return 0;var f=e.string[e.empties[c]||e.emptyTo];return""===a&&0!==f?"boolean"==typeof f?f?-1:1:f||1:""===b&&0!==f?"boolean"==typeof f?f?1:-1:-f||-1:s.sortNatural(b,a)},s.sortText=function(a,b){return a>b?1:b>a?-1:0},s.getTextValue=function(a,b,c){if(c){var d,e=a?a.length:0,f=c+b;for(d=0;e>d;d++)f+=a.charCodeAt(d);return b*f}return 0},s.sortNumericAsc=function(a,b,c,d,e,f){if(a===b)return 0;var g=f.config,h=g.string[g.empties[e]||g.emptyTo];return""===a&&0!==h?"boolean"==typeof h?h?-1:1:-h||-1:""===b&&0!==h?"boolean"==typeof h?h?1:-1:h||1:(isNaN(a)&&(a=s.getTextValue(a,c,d)),isNaN(b)&&(b=s.getTextValue(b,c,d)),a-b)},s.sortNumericDesc=function(a,b,c,d,e,f){if(a===b)return 0;var g=f.config,h=g.string[g.empties[e]||g.emptyTo];return""===a&&0!==h?"boolean"==typeof h?h?-1:1:h||1:""===b&&0!==h?"boolean"==typeof h?h?1:-1:-h||-1:(isNaN(a)&&(a=s.getTextValue(a,c,d)),isNaN(b)&&(b=s.getTextValue(b,c,d)),b-a)},s.sortNumeric=function(a,b){return a-b},s.characterEquivalents={a:"áàâãäąå",A:"ÁÀÂÃÄĄÅ",c:"çćč",C:"ÇĆČ",e:"éèêëěę",E:"ÉÈÊËĚĘ",i:"íìİîïı",I:"ÍÌİÎÏ",o:"óòôõöō",O:"ÓÒÔÕÖŌ",ss:"ß",SS:"ẞ",u:"úùûüů",U:"ÚÙÛÜŮ"},s.replaceAccents=function(a){var b,c="[",d=s.characterEquivalents;if(!s.characterRegex){s.characterRegexArray={};for(b in d)"string"==typeof b&&(c+=d[b],s.characterRegexArray[b]=new RegExp("["+d[b]+"]","g"));s.characterRegex=new RegExp(c+"]")}if(s.characterRegex.test(a))for(b in d)"string"==typeof b&&(a=a.replace(s.characterRegexArray[b],b));return a},s.isValueInArray=function(a,b){var c,d=b&&b.length||0;for(c=0;d>c;c++)if(b[c][0]===a)return c;return-1},s.addParser=function(a){var b,c=s.parsers.length,d=!0;for(b=0;c>b;b++)s.parsers[b].id.toLowerCase()===a.id.toLowerCase()&&(d=!1);d&&s.parsers.push(a)},s.addInstanceMethods=function(b){a.extend(s.instanceMethods,b)},s.getParserById=function(a){if("false"==a)return!1;var b,c=s.parsers.length;for(b=0;c>b;b++)if(s.parsers[b].id.toLowerCase()===a.toString().toLowerCase())return s.parsers[b];return!1},s.addWidget=function(a){s.widgets.push(a)},s.hasWidget=function(b,c){return b=a(b),b.length&&b[0].config&&b[0].config.widgetInit[c]||!1},s.getWidgetById=function(a){var b,c,d=s.widgets.length;for(b=0;d>b;b++)if(c=s.widgets[b],c&&c.hasOwnProperty("id")&&c.id.toLowerCase()===a.toLowerCase())return c},s.applyWidgetOptions=function(b,c){var d,e,f=c.widgets.length,g=c.widgetOptions;if(f)for(d=0;f>d;d++)e=s.getWidgetById(c.widgets[d]),e&&"options"in e&&(g=b.config.widgetOptions=a.extend(!0,{},e.options,g))},s.applyWidget=function(b,c,d){b=a(b)[0];var e,f,g,h,i,j,k,l,m,n,o=b.config,p=o.widgetOptions,q=" "+o.table.className+" ",r=[];if(c===!1||!b.hasInitialized||!b.isApplyingWidgets&&!b.isUpdating){if(o.debug&&(k=new Date),n=new RegExp("\\s"+o.widgetClass.replace(/\{name\}/i,"([\\w-]+)")+"\\s","g"),q.match(n)&&(m=q.match(n)))for(f=m.length,e=0;f>e;e++)o.widgets.push(m[e].replace(n,"$1"));if(o.widgets.length){for(b.isApplyingWidgets=!0,o.widgets=a.grep(o.widgets,function(b,c){return a.inArray(b,o.widgets)===c}),g=o.widgets||[],f=g.length,e=0;f>e;e++)n=s.getWidgetById(g[e]),n&&n.id&&(n.priority||(n.priority=10),r[e]=n);for(r.sort(function(a,b){return a.priority<b.priority?-1:a.priority===b.priority?0:1}),f=r.length,o.debug&&console[console.group?"group":"log"]("Start "+(c?"initializing":"applying")+" widgets"),e=0;f>e;e++)h=r[e],h&&(i=h.id,j=!1,o.debug&&(l=new Date),(c||!o.widgetInit[i])&&(o.widgetInit[i]=!0,b.hasInitialized&&s.applyWidgetOptions(b,o),"init"in h&&(j=!0,o.debug&&console[console.group?"group":"log"]("Initializing "+i+" widget"),h.init(b,h,o,p))),!c&&"format"in h&&(j=!0,o.debug&&console[console.group?"group":"log"]("Updating "+i+" widget"),h.format(b,o,p,!1)),o.debug&&j&&(console.log("Completed "+(c?"initializing ":"applying ")+i+" widget"+s.benchmark(l)),console.groupEnd&&console.groupEnd()));o.debug&&console.groupEnd&&console.groupEnd(),c||"function"!=typeof d||d(b)}setTimeout(function(){b.isApplyingWidgets=!1,a.data(b,"lastWidgetApplication",new Date)},0),o.debug&&(m=o.widgets.length,console.log("Completed "+(c===!0?"initializing ":"applying ")+m+" widget"+(1!==m?"s":"")+s.benchmark(k)))}},s.removeWidget=function(b,c,d){b=a(b)[0];var e,f,g,h,i=b.config;if(c===!0)for(c=[],h=s.widgets.length,g=0;h>g;g++)f=s.widgets[g],f&&f.id&&c.push(f.id);else c=(a.isArray(c)?c.join(","):c||"").toLowerCase().split(/[\s,]+/);for(h=c.length,e=0;h>e;e++)f=s.getWidgetById(c[e]),g=a.inArray(c[e],i.widgets),f&&"remove"in f&&(i.debug&&g>=0&&console.log('Removing "'+c[e]+'" widget'),i.debug&&console.log((d?"Refreshing":"Removing")+' "'+c[e]+'" widget'),f.remove(b,i,i.widgetOptions,d),i.widgetInit[c[e]]=!1),g>=0&&d!==!0&&i.widgets.splice(g,1)},s.refreshWidgets=function(b,c,d){b=a(b)[0];var e,f=b.config,g=f.widgets,h=s.widgets,i=h.length,j=[],k=function(b){a(b).trigger("refreshComplete")};for(e=0;i>e;e++)h[e]&&h[e].id&&(c||a.inArray(h[e].id,g)<0)&&j.push(h[e].id);s.removeWidget(b,j.join(","),!0),d!==!0?(s.applyWidget(b,c||!1,k),c&&s.applyWidget(b,!1,k)):k(b)},s.getColumnText=function(c,d,e){c=a(c)[0];var f,g,h,i,j,k,l,m,n,o,p="function"==typeof e,q="all"===d,r={raw:[],parsed:[],$cell:[]},s=c.config;if(!b(s)){for(j=s.$tbodies.length,f=0;j>f;f++)for(h=s.cache[f].normalized,k=h.length,g=0;k>g;g++)o=!0,i=h[g],m=q?i.slice(0,s.columns):i[d],i=i[s.columns],l=q?i.raw:i.raw[d],n=q?i.$row.children():i.$row.children().eq(d),p&&(o=e({tbodyIndex:f,rowIndex:g,parsed:m,raw:l,$row:i.$row,$cell:n})),o!==!1&&(r.parsed.push(m),r.raw.push(l),r.$cell.push(n));return r}s.debug&&console.warn("No cache found - aborting getColumnText function!")},s.getData=function(b,c,d){var e,f,g="",h=a(b);return h.length?(e=a.metadata?h.metadata():!1,f=" "+(h.attr("class")||""),"undefined"!=typeof h.data(d)||"undefined"!=typeof h.data(d.toLowerCase())?g+=h.data(d)||h.data(d.toLowerCase()):e&&"undefined"!=typeof e[d]?g+=e[d]:c&&"undefined"!=typeof c[d]?g+=c[d]:" "!==f&&f.match(" "+d+"-")&&(g=f.match(new RegExp("\\s"+d+"-([\\w-]+)"))[1]||""),a.trim(g)):""},s.formatFloat=function(b,c){if("string"!=typeof b||""===b)return b;var d,e=c&&c.config?c.config.usNumberFormat!==!1:"undefined"!=typeof c?c:!0;return b=e?b.replace(/,/g,""):b.replace(/[\s|\.]/g,"").replace(/,/g,"."),/^\s*\([.\d]+\)/.test(b)&&(b=b.replace(/^\s*\(([.\d]+)\)/,"-$1")),d=parseFloat(b),isNaN(d)?a.trim(b):d},s.isDigit=function(a){return isNaN(a)?/^[\-+(]?\d+[)]?$/.test(a.toString().replace(/[,.'"\s]/g,"")):""!==a}}});var b=a.tablesorter;a.fn.extend({tablesorter:b.construct}),console&&console.log||(b.logs=[],console={},console.log=console.warn=console.error=console.table=function(){b.logs.push([Date.now(),arguments])}),b.log=function(){console.log(arguments)},b.benchmark=function(a){return" ("+((new Date).getTime()-a.getTime())+"ms)"},b.addParser({id:"no-parser",is:function(){return!1},format:function(){return""},type:"text"}),b.addParser({id:"text",is:function(){return!0},format:function(c,d){var e=d.config;return c&&(c=a.trim(e.ignoreCase?c.toLocaleLowerCase():c),c=e.sortLocaleCompare?b.replaceAccents(c):c),c},type:"text"}),b.addParser({id:"digit",is:function(a){return b.isDigit(a)},format:function(c,d){var e=b.formatFloat((c||"").replace(/[^\w,. \-()]/g,""),d);return c&&"number"==typeof e?e:c?a.trim(c&&d.config.ignoreCase?c.toLocaleLowerCase():c):c},type:"numeric"}),b.addParser({id:"currency",is:function(a){return/^\(?\d+[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]|[\u00a3$\u20ac\u00a4\u00a5\u00a2?.]\d+\)?$/.test((a||"").replace(/[+\-,. ]/g,""))},format:function(c,d){var e=b.formatFloat((c||"").replace(/[^\w,. \-()]/g,""),d);

return c&&"number"==typeof e?e:c?a.trim(c&&d.config.ignoreCase?c.toLocaleLowerCase():c):c},type:"numeric"}),b.addParser({id:"url",is:function(a){return/^(https?|ftp|file):\/\//.test(a)},format:function(b){return b?a.trim(b.replace(/(https?|ftp|file):\/\//,"")):b},parsed:!0,type:"text"}),b.addParser({id:"isoDate",is:function(a){return/^\d{4}[\/\-]\d{1,2}[\/\-]\d{1,2}/.test(a)},format:function(a,b){var c=a?new Date(a.replace(/-/g,"/")):a;return c instanceof Date&&isFinite(c)?c.getTime():a},type:"numeric"}),b.addParser({id:"percent",is:function(a){return/(\d\s*?%|%\s*?\d)/.test(a)&&a.length<15},format:function(a,c){return a?b.formatFloat(a.replace(/%/g,""),c):a},type:"numeric"}),b.addParser({id:"image",is:function(a,b,c,d){return d.find("img").length>0},format:function(b,c,d){return a(d).find("img").attr(c.config.imgAttr||"alt")||b},parsed:!0,type:"text"}),b.addParser({id:"usLongDate",is:function(a){return/^[A-Z]{3,10}\.?\s+\d{1,2},?\s+(\d{4})(\s+\d{1,2}:\d{2}(:\d{2})?(\s+[AP]M)?)?$/i.test(a)||/^\d{1,2}\s+[A-Z]{3,10}\s+\d{4}/i.test(a)},format:function(a,b){var c=a?new Date(a.replace(/(\S)([AP]M)$/i,"$1 $2")):a;return c instanceof Date&&isFinite(c)?c.getTime():a},type:"numeric"}),b.addParser({id:"shortDate",is:function(a){return/(^\d{1,2}[\/\s]\d{1,2}[\/\s]\d{4})|(^\d{4}[\/\s]\d{1,2}[\/\s]\d{1,2})/.test((a||"").replace(/\s+/g," ").replace(/[\-.,]/g,"/"))},format:function(a,c,d,e){if(a){var f,g,h=c.config,i=h.$headerIndexed[e],j=i.length&&i[0].dateFormat||b.getData(i,b.getColumnData(c,h.headers,e),"dateFormat")||h.dateFormat;return g=a.replace(/\s+/g," ").replace(/[\-.,]/g,"/"),"mmddyyyy"===j?g=g.replace(/(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/,"$3/$1/$2"):"ddmmyyyy"===j?g=g.replace(/(\d{1,2})[\/\s](\d{1,2})[\/\s](\d{4})/,"$3/$2/$1"):"yyyymmdd"===j&&(g=g.replace(/(\d{4})[\/\s](\d{1,2})[\/\s](\d{1,2})/,"$1/$2/$3")),f=new Date(g),f instanceof Date&&isFinite(f)?f.getTime():a}return a},type:"numeric"}),b.addParser({id:"time",is:function(a){return/^(([0-2]?\d:[0-5]\d)|([0-1]?\d:[0-5]\d\s?([AP]M)))$/i.test(a)},format:function(a,b){var c=a?new Date("2000/01/01 "+a.replace(/(\S)([AP]M)$/i,"$1 $2")):a;return c instanceof Date&&isFinite(c)?c.getTime():a},type:"numeric"}),b.addParser({id:"metadata",is:function(){return!1},format:function(b,c,d){var e=c.config,f=e.parserMetadataName?e.parserMetadataName:"sortValue";return a(d).metadata()[f]},type:"numeric"}),b.addWidget({id:"zebra",priority:90,format:function(b,c,d){var e,f,g,h,i,j,k,l,m=new RegExp(c.cssChildRow,"i"),n=c.$tbodies.add(a(c.namespace+"_extra_table").children("tbody:not(."+c.cssInfoBlock+")"));for(c.debug&&(i=new Date),j=0;j<n.length;j++)for(g=0,e=n.eq(j).children("tr:visible").not(c.selectorRemove),l=e.length,k=0;l>k;k++)f=e.eq(k),m.test(f[0].className)||g++,h=g%2===0,f.removeClass(d.zebra[h?1:0]).addClass(d.zebra[h?0:1])},remove:function(a,c,d,e){if(!e){var f,g,h=c.$tbodies,i=(d.zebra||["even","odd"]).join(" ");for(f=0;f<h.length;f++)g=b.processTbody(a,h.eq(f),!0),g.children().removeClass(i),b.processTbody(a,g,!1)}}})}(jQuery),a.tablesorter});