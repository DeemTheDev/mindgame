import{h as w,e as R,u as z,G as V,f as K,c as W,n as X}from"./links.50b3c915.js";import{l as J}from"./license.a5355f46.js";import{a as Q}from"./allowed.8cc2579e.js";/* empty css             */import{g as Z,r as tt}from"./params.0be92a7a.js";import{o as n,c as l,a as i,r as u,d as p,b as f,e as d,i as b,F as N,h as D,t as a,n as T,w as m,g as y,C as x,f as U,j as E}from"./vue.runtime.esm-bundler.3acceac0.js";import{_ as k}from"./_plugin-vue_export-helper.109ab23d.js";import"./index.333853dc.js";import{a as G,d as et,B as it,S as q,c as j}from"./Caret.918abbf1.js";/* empty css                                            *//* empty css                                              */import{_ as O}from"./default-i18n.41786823.js";import"./constants.008ef172.js";import{S as st}from"./SaveChanges.7ff5a9ed.js";/* empty css                                              */import{b as ot,C as nt,G as rt}from"./Header.6b3613fe.js";import{C as at,a as ct}from"./LicenseKeyBar.409140a3.js";import{S as lt}from"./Logo.35a4df98.js";import{S as dt}from"./Support.086162cc.js";import{C as ut}from"./Tabs.de5972ab.js";import{n as ft}from"./isArrayLikeObject.71906cce.js";import{D as _t}from"./Date.c9a4f74a.js";import{S as ht}from"./Exclamation.d174eb67.js";import{U as mt}from"./Url.213fa2f5.js";import{S as gt}from"./Gear.dd775150.js";import{T as B}from"./Slide.0a204345.js";const pt={computed:{notificationsCount(){const t=w();return this.dismissed?t.dismissedNotificationsCount:t.activeNotificationsCount},notifications(){const t=w();return this.dismissed?t.dismissedNotifications:t.activeNotifications},notificationTitle(){return this.dismissed?this.strings.notifications:this.strings.newNotifications}}},H="all-in-one-seo-pack",vt=()=>({strings:{notifications:O("Notifications",H),newNotifications:O("New Notifications",H),activeNotifications:O("Active Notifications",H)}}),yt={},bt={viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-description"},kt=i("path",{d:"M0 0h24v24H0V0z",fill:"none"},null,-1),St=i("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z",fill:"currentColor"},null,-1),$t=[kt,St];function Nt(t,e){return n(),l("svg",bt,$t)}const Ct=k(yt,[["render",Nt]]),wt={},Dt={viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-folder-open"},Lt=i("path",{d:"M0 0h24v24H0V0z",fill:"none"},null,-1),At=i("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M20 6h-8l-2-2H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm0 12H4V8h16v10z",fill:"currentColor"},null,-1),Pt=[Lt,At];function Tt(t,e){return n(),l("svg",Dt,Pt)}const Bt=k(wt,[["render",Tt]]);const It={setup(){return{licenseStore:R(),rootStore:z(),helpPanelStore:V(),settingsStore:K()}},components:{CoreApiBar:at,CoreLicenseKeyBar:ct,CoreUpgradeBar:ot,SvgAioseoLogo:lt,SvgClose:G,SvgDescription:Ct,SvgFolderOpen:Bt,SvgSupport:dt},data(){return{searchItem:null,strings:{close:this.$t.__("Close",this.$td),search:this.$t.__("Search",this.$td),viewAll:this.$t.__("View All",this.$td),docs:this.$t.__("Docs",this.$td),viewDocumentation:this.$t.__("View Documentation",this.$td),browseDocumentation:this.$t.sprintf(this.$t.__("Browse documentation, reference material, and tutorials for %1$s.",this.$td),"AIOSEO"),viewAllDocumentation:this.$t.__("View All Documentation",this.$td),getSupport:this.$t.__("Get Support",this.$td),submitTicket:this.$t.__("Submit a ticket and our world class support team will be in touch soon.",this.$td),submitSupportTicket:this.$t.__("Submit a Support Ticket",this.$td),upgradeToPro:this.$t.__("Upgrade to Pro",this.$td)}}},computed:{filteredDocs(){return this.searchItem!==""?Object.values(this.helpPanelStore.docs).filter(t=>this.searchItem!==null?t.title.toLowerCase().includes(this.searchItem.toLowerCase()):null):null}},methods:{inputSearch:function(t){et(()=>{this.searchItem=t},1e3)},toggleSection:function(t){t.target.parentNode.parentNode.classList.toggle("opened")},toggleDocs:function(t){t.target.previousSibling.classList.toggle("opened"),t.target.style.display="none"},toggleModal(){document.getElementById("aioseo-help-modal").classList.toggle("visible"),document.body.classList.toggle("modal-open")},getCategoryDocs(t){return Object.values(this.helpPanelStore.docs).filter(e=>e.categories.flat().includes(t)?e:null)}}},Mt={id:"aioseo-help-modal",class:"aioseo-help"},Ot={class:"aioseo-help-header"},Ht={class:"logo"},Ut=["href"],Et=["title"],zt={class:"help-content"},qt={id:"aioseo-help-search"},Rt={id:"aioseo-help-result"},Vt={class:"aioseo-help-docs"},xt={class:"icon"},Gt=["href"],jt={id:"aioseo-help-categories"},Ft={class:"aioseo-help-categories-toggle"},Yt={class:"folder-open"},Kt={class:"title"},Wt=i("span",{class:"dashicons dashicons-arrow-right-alt2"},null,-1),Xt={class:"aioseo-help-docs"},Jt={class:"icon"},Qt=["href"],Zt={class:"aioseo-help-additional-docs"},te={class:"icon"},ee=["href"],ie={id:"aioseo-help-footer"},se={class:"aioseo-help-footer-block"},oe=["href"],ne={class:"aioseo-help-footer-block"},re=["href"];function ae(t,e,r,c,s,o){const h=u("core-upgrade-bar"),g=u("core-license-key-bar"),_=u("core-api-bar"),v=u("svg-aioseo-logo"),L=u("svg-close"),I=u("base-input"),A=u("svg-description"),F=u("svg-folder-open"),P=u("base-button"),Y=u("svg-support");return n(),l("div",Mt,[!t.$isPro&&c.settingsStore.settings.showUpgradeBar&&c.rootStore.pong?(n(),p(h,{key:0})):f("",!0),t.$isPro&&c.licenseStore.isUnlicensed&&c.rootStore.pong?(n(),p(g,{key:1})):f("",!0),c.rootStore.pong?f("",!0):(n(),p(_,{key:2})),i("div",Ot,[i("div",Ht,[c.licenseStore.isUnlicensed?(n(),l("a",{key:0,href:t.$links.utmUrl("header-logo"),target:"_blank"},[d(v,{id:"aioseo-help-logo"})],8,Ut)):f("",!0),c.licenseStore.isUnlicensed?f("",!0):(n(),p(v,{key:1,id:"aioseo-help-logo"}))]),i("div",{id:"aioseo-help-close",title:s.strings.close,onClick:e[0]||(e[0]=b((...S)=>o.toggleModal&&o.toggleModal(...S),["stop"]))},[d(L)],8,Et)]),i("div",zt,[i("div",qt,[d(I,{type:"text",size:"medium",placeholder:s.strings.search,"onUpdate:modelValue":e[1]||(e[1]=S=>o.inputSearch(S))},null,8,["placeholder"])]),i("div",Rt,[i("ul",Vt,[(n(!0),l(N,null,D(o.filteredDocs,(S,C)=>(n(),l("li",{key:C},[i("span",xt,[d(A)]),i("a",{href:t.$links.utmUrl("help-panel-doc","",S.url),rel:"noopener noreferrer",target:"_blank"},a(S.title),9,Gt)]))),128))])]),i("div",jt,[i("ul",Ft,[(n(!0),l(N,null,D(c.helpPanelStore.categories,(S,C)=>(n(),l("li",{key:C,class:T(["aioseo-help-category",{opened:C==="getting-started"}])},[i("header",{onClick:e[2]||(e[2]=b($=>o.toggleSection($),["stop"]))},[i("span",Yt,[d(F)]),i("span",Kt,a(S),1),Wt]),i("ul",Xt,[(n(!0),l(N,null,D(o.getCategoryDocs(C).slice(0,5),($,M)=>(n(),l("li",{key:M},[i("span",Jt,[d(A)]),i("a",{href:t.$links.utmUrl("help-panel-doc","",$.url),rel:"noopener noreferrer",target:"_blank"},a($.title),9,Qt)]))),128)),i("div",Zt,[(n(!0),l(N,null,D(o.getCategoryDocs(C).slice(5,o.getCategoryDocs(C).length),($,M)=>(n(),l("li",{key:M},[i("span",te,[d(A)]),i("a",{href:t.$links.utmUrl("help-panel-doc","",$.url),rel:"noopener noreferrer",target:"_blank"},a($.title),9,ee)]))),128))]),o.getCategoryDocs(C).length>=5?(n(),p(P,{key:0,class:"aioseo-help-docs-viewall gray medium",onClick:e[3]||(e[3]=b($=>o.toggleDocs($),["stop"]))},{default:m(()=>[y(a(s.strings.viewAll)+" "+a(S)+" "+a(s.strings.docs),1)]),_:2},1024)):f("",!0)])],2))),128))])]),i("div",ie,[i("div",se,[i("a",{href:t.$links.utmUrl("help-panel-all-docs","","https://aioseo.com/docs/"),rel:"noopener noreferrer",target:"_blank"},[d(A),i("h3",null,a(s.strings.viewDocumentation),1),i("p",null,a(s.strings.browseDocumentation),1),d(P,{class:"aioseo-help-docs-viewall gray small"},{default:m(()=>[y(a(s.strings.viewAllDocumentation),1)]),_:1})],8,oe)]),i("div",ne,[i("a",{href:!t.$isPro||!c.licenseStore.license.isActive?t.$links.getUpsellUrl("help-panel","get-support","liteUpgrade"):t.$links.utmUrl("help-panel-support","","https://aioseo.com/account/support/"),rel:"noopener noreferrer",target:"_blank"},[d(Y),i("h3",null,a(s.strings.getSupport),1),i("p",null,a(s.strings.submitTicket),1),t.$isPro&&c.licenseStore.license.isActive?(n(),p(P,{key:0,class:"aioseo-help-docs-support blue small"},{default:m(()=>[y(a(s.strings.submitSupportTicket),1)]),_:1})):f("",!0),!t.$isPro||!c.licenseStore.license.isActive?(n(),p(P,{key:1,class:"aioseo-help-docs-support green small"},{default:m(()=>[y(a(s.strings.upgradeToPro),1)]),_:1})):f("",!0)],8,re)])])])])}const ce=k(It,[["render",ae]]),le=""+window.__aioseoDynamicImportPreload__("images/dannie-detective.f19b97eb.png");const de={setup(){return{notificationsStore:w()}},emits:["dismissed-notification"],components:{BaseButton:it,SvgCircleCheck:q,SvgCircleClose:j,SvgCircleExclamation:ht,SvgGear:gt,TransitionSlide:B},mixins:[mt,_t],props:{notification:{type:Object,required:!0}},data(){return{active:!0,strings:{dismiss:this.$t.__("Dismiss",this.$td)}}},computed:{getIcon(){switch(this.notification.type){case"warning":return"svg-circle-exclamation";case"error":return"svg-circle-close";case"info":return"svg-gear";case"success":default:return"svg-circle-check"}},getDate(){return this.dateSqlToLocalRelative(this.notification.start)}},methods:{processDismissNotification(){this.active=!1,this.notificationsStore.dismissNotifications([this.notification.slug]),this.$emit("dismissed-notification")}}},ue={class:"icon"},fe={class:"body"},_e={class:"title"},he={class:"date"},me=["innerHTML"],ge={class:"actions"};function pe(t,e,r,c,s,o){const h=u("base-button"),g=u("transition-slide");return n(),p(g,{class:"aioseo-notification",active:s.active},{default:m(()=>[i("div",null,[i("div",ue,[(n(),p(x(o.getIcon),{class:T(r.notification.type)},null,8,["class"]))]),i("div",fe,[i("div",_e,[i("div",null,a(r.notification.title),1),i("div",he,a(o.getDate),1)]),i("div",{class:"notification-content",innerHTML:r.notification.content},null,8,me),i("div",ge,[r.notification.button1_label&&r.notification.button1_action?(n(),p(h,{key:0,size:"small",type:"gray",tag:t.getTagType(r.notification.button1_action),href:t.getHref(r.notification.button1_action),target:t.getTarget(r.notification.button1_action),onClick:e[0]||(e[0]=_=>t.processButtonClick(r.notification.button1_action,1)),loading:t.button1Loading},{default:m(()=>[y(a(r.notification.button1_label),1)]),_:1},8,["tag","href","target","loading"])):f("",!0),r.notification.button2_label&&r.notification.button2_action?(n(),p(h,{key:1,size:"small",type:"gray",tag:t.getTagType(r.notification.button2_action),href:t.getHref(r.notification.button2_action),target:t.getTarget(r.notification.button2_action),onClick:e[1]||(e[1]=_=>t.processButtonClick(r.notification.button2_action,2)),loading:t.button2Loading},{default:m(()=>[y(a(r.notification.button2_label),1)]),_:1},8,["tag","href","target","loading"])):f("",!0),r.notification.dismissed?f("",!0):(n(),l("a",{key:2,href:"#",class:"dismiss",onClick:e[2]||(e[2]=b((..._)=>o.processDismissNotification&&o.processDismissNotification(..._),["stop","prevent"]))},a(s.strings.dismiss),1))])])])]),_:1},8,["active"])}const ve=k(de,[["render",pe]]);const ye={setup(){return{licenseStore:R(),notificationsStore:w(),optionsStore:W(),rootStore:z()}},emits:["dismissed-notification"],components:{SvgCircleCheck:q,TransitionSlide:B},props:{notification:{type:Object,required:!0}},data(){return{step:1,active:!0,strings:{dismiss:this.$t.__("Dismiss",this.$td),yesILoveIt:this.$t.__("Yes, I love it!",this.$td),notReally:this.$t.__("Not Really...",this.$td),okYouDeserveIt:this.$t.__("Ok, you deserve it",this.$td),nopeMaybeLater:this.$t.__("Nope, maybe later",this.$td),giveFeedback:this.$t.__("Give feedback",this.$td),noThanks:this.$t.__("No thanks",this.$td)}}},computed:{title(){switch(this.step){case 2:return this.$t.__("That's Awesome!",this.$td);case 3:return this.$t.__("Help us improve",this.$td);default:return this.$t.sprintf(this.$t.__("Are you enjoying %1$s?",this.$td),"AIOSEO")}},content(){switch(this.step){case 2:return this.$t.__("Could you please do me a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?",this.$td)+"<br><br><strong>~ Syed Balkhi<br>"+this.$t.sprintf(this.$t.__("CEO of %1$s",this.$td),"All in One SEO")+"</strong>";case 3:return this.$t.sprintf(this.$t.__("We're sorry to hear you aren't enjoying %1$s. We would love a chance to improve. Could you take a minute and let us know what we can do better?",this.$td),"All in One SEO");default:return""}},feedbackUrl(){const t=this.optionsStore.options.general&&this.licenseStore.licenseKey?this.licenseStore.licenseKey:"",e=this.$isPro?"pro":"lite";return this.$links.utmUrl("notification-review-notice",this.rootStore.aioseo.version,"https://aioseo.com/plugin-feedback/?wpf7528_24="+encodeURIComponent(this.rootStore.aioseo.urls.home)+"&wpf7528_26="+t+"&wpf7528_27="+e+"&wpf7528_28="+this.rootStore.aioseo.version)}},methods:{processDismissNotification(t=!1){this.active=!1,this.notificationsStore.dismissNotifications([this.notification.slug+(t?"-delay":"")]),this.$emit("dismissed-notification")}}},be={class:"icon"},ke={class:"body"},Se={class:"title"},$e=["innerHTML"],Ne={class:"actions"};function Ce(t,e,r,c,s,o){const h=u("svg-circle-check"),g=u("base-button"),_=u("transition-slide");return n(),p(_,{class:"aioseo-notification",active:s.active},{default:m(()=>[i("div",null,[i("div",be,[d(h,{class:"success"})]),i("div",ke,[i("div",Se,[i("div",null,a(o.title),1)]),i("div",{class:"notification-content",innerHTML:o.content},null,8,$e),i("div",Ne,[s.step===1?(n(),l(N,{key:0},[d(g,{size:"small",type:"blue",onClick:e[0]||(e[0]=b(v=>s.step=2,["stop"]))},{default:m(()=>[y(a(s.strings.yesILoveIt),1)]),_:1}),d(g,{size:"small",type:"gray",onClick:e[1]||(e[1]=b(v=>s.step=3,["stop"]))},{default:m(()=>[y(a(s.strings.notReally),1)]),_:1})],64)):f("",!0),s.step===2?(n(),l(N,{key:1},[d(g,{tag:"a",href:"https://wordpress.org/support/plugin/all-in-one-seo-pack/reviews/?filter=5#new-post",size:"small",type:"blue",target:"_blank",rel:"noopener noreferrer",onClick:e[2]||(e[2]=v=>o.processDismissNotification(!1))},{default:m(()=>[y(a(s.strings.okYouDeserveIt),1)]),_:1}),d(g,{size:"small",type:"gray",onClick:e[3]||(e[3]=b(v=>o.processDismissNotification(!0),["stop","prevent"]))},{default:m(()=>[y(a(s.strings.nopeMaybeLater),1)]),_:1})],64)):f("",!0),s.step===3?(n(),l(N,{key:2},[d(g,{tag:"a",href:o.feedbackUrl,size:"small",type:"blue",target:"_blank",rel:"noopener noreferrer",onClick:e[4]||(e[4]=v=>o.processDismissNotification(!1))},{default:m(()=>[y(a(s.strings.giveFeedback),1)]),_:1},8,["href"]),d(g,{size:"small",type:"gray",onClick:e[5]||(e[5]=b(v=>o.processDismissNotification(!1),["stop","prevent"]))},{default:m(()=>[y(a(s.strings.noThanks),1)]),_:1})],64)):f("",!0),r.notification.dismissed?f("",!0):(n(),l("a",{key:3,class:"dismiss",href:"#",onClick:e[6]||(e[6]=b(v=>o.processDismissNotification(!1),["stop","prevent"]))},a(s.strings.dismiss),1))])])])]),_:1},8,["active"])}const we=k(ye,[["render",Ce]]);const De={setup(){return{notificationsStore:w()}},emits:["dismissed-notification"],components:{SvgCircleCheck:q,TransitionSlide:B},props:{notification:{type:Object,required:!0}},data(){return{active:!0,strings:{dismiss:this.$t.__("Dismiss",this.$td),yesILoveIt:this.$t.__("Yes, I love it!",this.$td),notReally:this.$t.__("Not Really...",this.$td),okYouDeserveIt:this.$t.__("Ok, you deserve it",this.$td),nopeMaybeLater:this.$t.__("Nope, maybe later",this.$td),giveFeedback:this.$t.__("Give feedback",this.$td),noThanks:this.$t.__("No thanks",this.$td)}}},computed:{title(){return this.$t.sprintf(this.$t.__("Are you enjoying %1$s?",this.$td),"AIOSEO")},content(){return this.$t.sprintf(this.$t.__("Hey, I noticed you have been using %1$s for some time - that’s awesome! Could you please do me a BIG favor and give it a 5-star rating on WordPress to help us spread the word and boost our motivation?",this.$td),"<strong>All in One SEO</strong>")+"<br><br><strong>~ Syed Balkhi<br>"+this.$t.sprintf(this.$t.__("CEO of %1$s",this.$td),"All in One SEO")+"</strong>"}},methods:{processDismissNotification(t=!1){this.active=!1,this.notificationsStore.dismissNotifications([this.notification.slug+(t?"-delay":"")]),this.$emit("dismissed-notification")}}},Le={class:"icon"},Ae={class:"body"},Pe={class:"title"},Te=["innerHTML"],Be={class:"actions"};function Ie(t,e,r,c,s,o){const h=u("svg-circle-check"),g=u("base-button"),_=u("transition-slide");return n(),p(_,{class:"aioseo-notification",active:s.active},{default:m(()=>[i("div",null,[i("div",Le,[d(h,{class:"success"})]),i("div",Ae,[i("div",Pe,[i("div",null,a(o.title),1)]),i("div",{class:"notification-content",innerHTML:o.content},null,8,Te),i("div",Be,[d(g,{tag:"a",href:"https://wordpress.org/support/plugin/all-in-one-seo-pack/reviews/?filter=5#new-post",size:"small",type:"blue",target:"_blank",rel:"noopener noreferrer",onClick:e[0]||(e[0]=v=>o.processDismissNotification(!1))},{default:m(()=>[y(a(s.strings.okYouDeserveIt),1)]),_:1}),d(g,{size:"small",type:"gray",onClick:e[1]||(e[1]=b(v=>o.processDismissNotification(!0),["stop","prevent"]))},{default:m(()=>[y(a(s.strings.nopeMaybeLater),1)]),_:1}),r.notification.dismissed?f("",!0):(n(),l("a",{key:0,class:"dismiss",href:"#",onClick:e[2]||(e[2]=b(v=>o.processDismissNotification(!1),["stop","prevent"]))},a(s.strings.dismiss),1))])])])]),_:1},8,["active"])}const Me=k(De,[["render",Ie]]);const Oe={components:{SvgCircleClose:j,TransitionSlide:B},props:{notification:{type:Object,required:!0}},data(){return{active:!0,strings:{title:this.$t.sprintf(this.$t.__("%1$s Addons Not Configured Properly",this.$td),"AIOSEO"),learnMore:this.$t.__("Learn More",this.$td),upgrade:this.$t.__("Upgrade",this.$td)}}},computed:{content(){let t="<ul>";return this.notification.addons.forEach(e=>{t+="<li><strong>AIOSEO - "+e.name+"</strong></li>"}),t+="</ul>",this.notification.message+t}}},He={class:"icon"},Ue={class:"body"},Ee={class:"title"},ze=["innerHTML"],qe={class:"actions"};function Re(t,e,r,c,s,o){const h=u("svg-circle-close"),g=u("base-button"),_=u("transition-slide");return n(),p(_,{class:"aioseo-notification",active:s.active},{default:m(()=>[i("div",null,[i("div",He,[d(h,{class:"error"})]),i("div",Ue,[i("div",Ee,[i("div",null,a(s.strings.title),1)]),i("div",{class:"notification-content",innerHTML:o.content},null,8,ze),i("div",qe,[d(g,{size:"small",type:"green",tag:"a",href:t.$links.utmUrl("notification-unlicensed-addons"),target:"_blank"},{default:m(()=>[y(a(s.strings.upgrade),1)]),_:1},8,["href"])])])])]),_:1},8,["active"])}const Ve=k(Oe,[["render",Re]]);const xe={emits:["toggle-dismissed","dismissed-notification"],components:{CoreNotification:ve,NotificationsReview:we,NotificationsReview2:Me,NotificationsUnlicensedAddons:Ve},props:{dismissedCount:{type:Number,required:!0},notifications:{type:Array,required:!0}},data(){return{dannieDetectiveImg:le,strings:{greatScott:this.$t.__("Great Scott! Where'd they all go?",this.$td),noNewNotifications:this.$t.__("You have no new notifications.",this.$td),seeDismissed:this.$t.__("See Dismissed Notifications",this.$td)}}},methods:{getAssetUrl:ft}},Ge={class:"aioseo-notification-cards"},je={key:"no-notifications"},Fe={class:"no-notifications"},Ye=["src"],Ke={class:"great-scott"},We={class:"no-new-notifications"};function Xe(t,e,r,c,s,o){return n(),l("div",Ge,[r.notifications.length?(n(!0),l(N,{key:0},D(r.notifications,h=>(n(),p(x(h.component?h.component:"core-notification"),{key:h.slug,notification:h,ref_for:!0,ref:"notification",onDismissedNotification:e[0]||(e[0]=g=>t.$emit("dismissed-notification"))},null,40,["notification"]))),128)):f("",!0),r.notifications.length?f("",!0):(n(),l("div",je,[U(t.$slots,"no-notifications",{},()=>[i("div",Fe,[i("img",{alt:"Dannie the Detective",src:o.getAssetUrl(s.dannieDetectiveImg)},null,8,Ye),i("div",Ke,a(s.strings.greatScott),1),i("div",We,a(s.strings.noNewNotifications),1),r.dismissedCount?(n(),l("a",{key:0,href:"#",class:"dismiss",onClick:e[1]||(e[1]=b(h=>t.$emit("toggle-dismissed"),["stop","prevent"]))},a(s.strings.seeDismissed),1)):f("",!0)])])]))])}const Je=k(xe,[["render",Xe]]);const Qe={setup(){const{strings:t}=vt();return{notificationsStore:w(),composableStrings:t}},components:{CoreNotificationCards:Je,SvgClose:G},mixins:[pt],data(){return{dismissed:!1,maxNotifications:Number.MAX_SAFE_INTEGER,currentPage:0,totalPages:1,strings:X(this.composableStrings,{dismissedNotifications:this.$t.__("Dismissed Notifications",this.$td),dismissAll:this.$t.__("Dismiss All",this.$td)})}},watch:{"notificationsStore.showNotifications"(t){t?(this.currentPage=0,this.setMaxNotifications(),this.addBodyClass()):this.removeBodyClass()},dismissed(){this.setMaxNotifications()},notifications(){this.setMaxNotifications()}},computed:{filteredNotifications(){return[...this.notifications].splice(this.currentPage===0?0:this.currentPage*this.maxNotifications,this.maxNotifications)},pages(){const t=[];for(let e=0;e<this.totalPages;e++)t.push({number:e+1});return t}},methods:{escapeListener(t){t.key==="Escape"&&this.notificationsStore.showNotifications&&this.notificationsStore.toggleNotifications()},addBodyClass(){document.body.classList.add("aioseo-show-notifications")},removeBodyClass(){document.body.classList.remove("aioseo-show-notifications")},documentClick(t){if(!this.notificationsStore.showNotifications)return;const e=t&&t.target?t.target:null,r=document.querySelector("#wp-admin-bar-aioseo-notifications");if(r&&(r===e||r.contains(e)))return;const c=document.querySelector("#toplevel_page_aioseo .wp-first-item"),s=document.querySelector("#toplevel_page_aioseo .wp-first-item .aioseo-menu-notification-indicator");if(c&&c.contains(s)&&(c===e||c.contains(e)))return;const o=this.$refs["aioseo-notifications"];o&&(o===e||o.contains(e))||this.notificationsStore.toggleNotifications()},notificationsLinkClick(t){t.preventDefault(),this.notificationsStore.toggleNotifications()},processDismissAllNotifications(){const t=[];this.notifications.forEach(e=>{t.push(e.slug)}),this.notificationsStore.dismissNotifications(t).then(()=>{this.setMaxNotifications()})},setMaxNotifications(){const t=this.currentPage;this.currentPage=0,this.totalPages=1,this.maxNotifications=Number.MAX_SAFE_INTEGER,this.$nextTick(async()=>{const e=[],r=document.querySelectorAll(".notification-menu .aioseo-notification");r&&r.forEach(s=>{let o=s.offsetHeight;const h=window.getComputedStyle?getComputedStyle(s,null):s.currentStyle,g=parseInt(h.marginTop)||0,_=parseInt(h.marginBottom)||0;o+=g+_,e.push(o)});const c=document.querySelector(".notification-menu .aioseo-notification-cards");if(c){let s=0,o=0;for(let h=0;h<e.length&&(o+=e[h],!(o>c.offsetHeight));h++)s++;this.maxNotifications=s||1,this.totalPages=Math.ceil(e.length/s)}this.currentPage=t>this.totalPages-1?this.totalPages-1:t})}},mounted(){document.addEventListener("keydown",this.escapeListener),document.addEventListener("click",this.documentClick);const t=document.querySelector("#wp-admin-bar-aioseo-notifications .ab-item");t&&t.addEventListener("click",this.notificationsLinkClick);const e=document.querySelector("#toplevel_page_aioseo .wp-first-item"),r=document.querySelector("#toplevel_page_aioseo .wp-first-item .aioseo-menu-notification-indicator");e&&r&&e.addEventListener("click",this.notificationsLinkClick)}},Ze={class:"aioseo-notifications",ref:"aioseo-notifications"},ti={key:0,class:"notification-menu"},ei={class:"notification-header"},ii={class:"new-notifications"},si={class:"dismissed-notifications"},oi={class:"notification-footer"},ni={class:"pagination"},ri=["onClick"],ai={key:0,class:"dismiss-all"};function ci(t,e,r,c,s,o){const h=u("svg-close"),g=u("core-notification-cards");return n(),l("div",Ze,[d(E,{name:"notifications-slide"},{default:m(()=>[c.notificationsStore.showNotifications?(n(),l("div",ti,[i("div",ei,[i("span",ii,"("+a(t.notificationsCount)+") "+a(t.notificationTitle),1),i("div",si,[!s.dismissed&&c.notificationsStore.dismissedNotificationsCount?(n(),l("a",{key:0,href:"#",onClick:e[0]||(e[0]=b(_=>s.dismissed=!0,["stop","prevent"]))},a(s.strings.dismissedNotifications),1)):f("",!0),s.dismissed&&c.notificationsStore.dismissedNotificationsCount?(n(),l("a",{key:1,href:"#",onClick:e[1]||(e[1]=b(_=>s.dismissed=!1,["stop","prevent"]))},a(s.strings.activeNotifications),1)):f("",!0)]),i("div",{onClick:e[2]||(e[2]=b((..._)=>c.notificationsStore.toggleNotifications&&c.notificationsStore.toggleNotifications(..._),["stop"]))},[d(h)])]),d(g,{class:"notification-cards",notifications:o.filteredNotifications,dismissedCount:c.notificationsStore.dismissedNotificationsCount,onToggleDismissed:e[3]||(e[3]=_=>s.dismissed=!s.dismissed)},null,8,["notifications","dismissedCount"]),i("div",oi,[i("div",ni,[s.totalPages>1?(n(!0),l(N,{key:0},D(o.pages,(_,v)=>(n(),l("div",{class:T(["page-number",{active:_.number===1+s.currentPage}]),key:v,onClick:L=>s.currentPage=_.number-1},a(_.number),11,ri))),128)):f("",!0)]),s.dismissed?f("",!0):(n(),l("div",ai,[t.notifications.length?(n(),l("a",{key:0,href:"#",class:"dismiss",onClick:e[4]||(e[4]=b((..._)=>o.processDismissAllNotifications&&o.processDismissAllNotifications(..._),["stop","prevent"]))},a(s.strings.dismissAll),1)):f("",!0)]))])])):f("",!0)]),_:1}),d(E,{name:"notifications-fade"},{default:m(()=>[c.notificationsStore.showNotifications?(n(),l("div",{key:0,onClick:e[5]||(e[5]=(..._)=>c.notificationsStore.toggleNotifications&&c.notificationsStore.toggleNotifications(..._)),class:"overlay"})):f("",!0)]),_:1})],512)}const li=k(Qe,[["render",ci]]),di={setup(){return{helpPanelStore:V(),notificationsStore:w(),rootStore:z()}},components:{CoreHeader:nt,CoreHelp:ce,CoreMainTabs:ut,CoreNotifications:li,GridContainer:rt},mixins:[st],props:{pageName:{type:String,required:!0},showTabs:{type:Boolean,default(){return!0}},showSaveButton:{type:Boolean,default(){return!0}},excludeTabs:{type:Array,default(){return[]}},containerClasses:{type:Array,default(){return[]}}},data(){return{tabsKey:0,strings:{saveChanges:this.$t.__("Save Changes",this.$td)}}},watch:{excludeTabs(){this.tabsKey+=1}},computed:{tabs(){return this.$router.options.routes.filter(t=>t.name&&t.meta&&t.meta.name).filter(t=>Q(t.meta.access)).filter(t=>!t.meta.license||J.hasMinimumLevel(t.meta.license)).filter(t=>!(t.meta.display==="lite"&&this.$isPro||t.meta.display==="pro"&&!this.$isPro)).filter(t=>!this.excludeTabs.includes(t.name)).map(t=>({slug:t.name,name:t.meta.name,url:{name:t.name},access:t.meta.access,pro:!!t.meta.pro}))},shouldShowSaveButton(){if(this.$route&&this.$route.name){const t=this.$router.options.routes.find(e=>e.name===this.$route.name);if(t&&t.meta&&t.meta.hideSaveButton)return!1}return this.showSaveButton}},mounted(){Z().notifications&&(this.notificationsStore.showNotifications||this.notificationsStore.toggleNotifications(),setTimeout(()=>{tt("notifications")},500)),this.notificationsStore.force&&this.notificationsStore.active.length&&(this.notificationsStore.force=!1,this.notificationsStore.toggleNotifications())}},ui={class:"aioseo-main"},fi={key:1,class:"save-changes"};function _i(t,e,r,c,s,o){const h=u("core-notifications"),g=u("core-header"),_=u("core-main-tabs"),v=u("base-button"),L=u("grid-container"),I=u("core-help");return n(),l("div",null,[d(h),i("div",ui,[d(g,{"page-name":r.pageName},null,8,["page-name"]),d(L,{class:T(r.containerClasses)},{default:m(()=>[r.showTabs?(n(),p(_,{key:s.tabsKey,tabs:o.tabs,showSaveButton:o.shouldShowSaveButton},{extra:m(()=>[U(t.$slots,"extra")]),_:3},8,["tabs","showSaveButton"])):f("",!0),d(E,{name:"route-fade",mode:"out-in"},{default:m(()=>[U(t.$slots,"default")]),_:3}),o.shouldShowSaveButton?(n(),l("div",fi,[d(v,{type:"blue",size:"medium",loading:c.rootStore.loading,onClick:t.processSaveChanges},{default:m(()=>[y(a(s.strings.saveChanges),1)]),_:1},8,["loading","onClick"])])):f("",!0)]),_:3},8,["class"])]),c.helpPanelStore.docs&&Object.keys(c.helpPanelStore.docs).length?(n(),p(I,{key:0})):f("",!0)])}const qi=k(di,[["render",_i]]);export{qi as C,pt as N,Je as a,vt as u};
