/*! For license information please see app.js.LICENSE.txt */
(()=>{var e,t={80:()=>{$((function(){var e=document.body.querySelector("#sidebarToggle");e&&("true"===localStorage.getItem("sb|sidebar-toggle")&&document.body.classList.toggle("sb-sidenav-toggled"),e.addEventListener("click",(function(e){e.preventDefault(),document.body.classList.toggle("sb-sidenav-toggled"),localStorage.setItem("sb|sidebar-toggle",document.body.classList.contains("sb-sidenav-toggled"))}))),$("#dataTable").DataTable({language:{decimal:"",emptyTable:"Geen data beschikbaar",info:"_START_ t/m _END_ van _TOTAL_ items zichtbaar",infoEmpty:"0 items beschikbaar",infoFiltered:"(gefilterd van _MAX_ items)",infoPostFix:"",thousands:",",lengthMenu:"Toon _MENU_ items",loadingRecords:"Laden...",processing:"",search:"Zoeken:",zeroRecords:"Geen overeenkomsten gevonden",paginate:{first:"Eerste",last:"Laatste",next:"Volgende",previous:"Vorige"},aria:{sortAscending:": activate to sort column ascending",sortDescending:": activate to sort column descending"}}}),$("#dataTable").show()}))},792:()=>{}},o={};function a(e){var n=o[e];if(void 0!==n)return n.exports;var r=o[e]={exports:{}};return t[e](r,r.exports,a),r.exports}a.m=t,e=[],a.O=(t,o,n,r)=>{if(!o){var s=1/0;for(c=0;c<e.length;c++){for(var[o,n,r]=e[c],i=!0,l=0;l<o.length;l++)(!1&r||s>=r)&&Object.keys(a.O).every((e=>a.O[e](o[l])))?o.splice(l--,1):(i=!1,r<s&&(s=r));if(i){e.splice(c--,1);var d=n();void 0!==d&&(t=d)}}return t}r=r||0;for(var c=e.length;c>0&&e[c-1][2]>r;c--)e[c]=e[c-1];e[c]=[o,n,r]},a.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),(()=>{var e={773:0,170:0};a.O.j=t=>0===e[t];var t=(t,o)=>{var n,r,[s,i,l]=o,d=0;if(s.some((t=>0!==e[t]))){for(n in i)a.o(i,n)&&(a.m[n]=i[n]);if(l)var c=l(a)}for(t&&t(o);d<s.length;d++)r=s[d],a.o(e,r)&&e[r]&&e[r][0](),e[r]=0;return a.O(c)},o=self.webpackChunk=self.webpackChunk||[];o.forEach(t.bind(null,0)),o.push=t.bind(null,o.push.bind(o))})(),a.O(void 0,[170],(()=>a(80)));var n=a.O(void 0,[170],(()=>a(792)));n=a.O(n)})();